<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Tag\TagListResource;
use Modules\CoreData\Http\Resources\Tag\TagResource;
use Modules\CoreData\Repositories\TagRepository;

class TagService extends BasicService
{
    protected $repo, $categoryService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(TagRepository $repository, CategoryService $categoryService)
    {
        $this->repo = $repository;
        $this->categoryService = $categoryService;
    }

    public function findBy(Request $request,  $pagination = false, $perPage = 10, $pluck = [],$get = '',$moreConditionForFirstLevel=[],$recursiveRel=[])
    {
        return $this->repo->findBy($request,  $pagination, $perPage, $pluck,$get,$moreConditionForFirstLevel, $recursiveRel);

    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'tag');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data, actionType()['ua'], 'tag');
        return new TagResource($data);
    }

    public function list(Request $request, $pagination = false, $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'tag');
        return TagListResource::collection($this->repo->list($request, $pagination, $perPage));
    }

    public function getListCategory(Request $request)
    {
        return $this->categoryService->list($request);
    }

    public function search(Request $request)
    {
        $data = [];
        $category = [];
        if ($request->name) {
            $category = $this->findBy($request,  false, 0, ['category_id', 'category_id']);
            $data = $this->categoryService->findBy($request, false, 0, ['id', 'id']);
        }
        $data = array_merge(count($data) ? $data->toArray() : [], count($category) ? $category->toArray() : []);
        if (count($data)) {
            return $this->categoryService->findBy(new Request(['id' => $data]),  false, 0);
        }
        return [];
    }
    public function delete($id)
    {
        $recursiveRel = [
        'user'=> [
            'type' => 'WhereDoesntHave',
        ],
    ];
        $data = $this->findBy(new Request(),false,0,[],'count',[],$recursiveRel);
        if($data == 0){
            $this->repo->delete($id);
        return true;
        }else{
            return false;
        }
    }
}

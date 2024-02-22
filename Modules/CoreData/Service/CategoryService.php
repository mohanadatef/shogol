<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Category\CategoryListResource;
use Modules\CoreData\Http\Resources\Category\CategoryResource;
use Modules\CoreData\Repositories\CategoryRepository;
use Modules\CoreData\Repositories\TagRepository;

class CategoryService extends BasicService
{
    protected $repo, $tagRepository;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CategoryRepository $repository, TagRepository $tagRepository)
    {
        $this->repo = $repository;
        $this->tagRepository = $tagRepository;
    }

    public function findBy(Request $request,  $pagination = false, $perPage = 10, $pluck = [],$get = '', $moreConditionForFirstLevel = [],$recursiveRel = [])
    {
        return $this->repo->findBy($request,  $pagination, $perPage, $pluck,$get , $moreConditionForFirstLevel,$recursiveRel);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'category');
        $tag = $this->tagRepository->save($request->merge(['category_id' => $data->id]));
        $this->createTag($request,$data);
        ActiveLog($tag, actionType()['ca'], 'tag');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        $this->createTag($request,$data);
        ActiveLog($data, actionType()['ua'], 'category');
        return new CategoryResource($data);
    }

    public function list(Request $request, $pagination = false, $perPage = 10,$recursiveRel = [])
    {
        $moreConditionForFirstLevel=[];
        ActiveLog(null, actionType()['va'], 'category');
        if(isset($request->name) && !empty($request->name))
        {
           $tags = $this->tagRepository->findBy(new Request(['name'=>$request->name]),false,10,['category_id','category_id']);
           if($tags){
               $moreConditionForFirstLevel=['orWhere'=>['id'=> $tags->toArray()]];
           }
        }else{
            $moreConditionForFirstLevel=  ['where'=>['parent_id'=>0]];
        }
        return CategoryResource::collection($this->repo->list($request, $moreConditionForFirstLevel, $recursiveRel, $pagination, $perPage));
    }

    public function parent(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        $childs = $data->childs()->pluck('id')->toArray();
        $moreConditionForFirstLevel = ['whereNotIn' => ['id' => array_merge($childs, [$request->id])]];
        return CategoryListResource::collection($this->repo->list(new Request(), $moreConditionForFirstLevel));
    }

    public function createTag($request,$data)
    {
        $tags = explode('-', $request->tag);
        $tagRemove = array_diff($data->tags->pluck('name.value')->toArray(),$tags);
        foreach ($tags as $tag) {
            $tagCount = $this->tagRepository->findBy(new Request(['name' => $tag]), false, 10, [], 'count');
            if (!$tagCount) {
                $name = [];
                foreach (language() as $lang) {
                    $name += [$lang->code => $tag];
                }
                $this->tagRepository->save(new Request(['category_id' => $data->id, 'name' => $name]));
            }
        }
        foreach ($tagRemove as $tag) {
            $tagCount = $this->tagRepository->findBy(new Request(['name' => $tag]),  false, 10, [],'first');
            if ($tagCount) {
                $this->tagRepository->delete($tagCount->id);
            }
        }
        return true;
    }
    public function delete($id)
    {
        $recursiveRel = [

        'user_category'=> [
            'type' => 'WhereDoesntHave ',
        ],
        'task_category'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'ad_category'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'tags'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'children'=> [
            'type' => 'orWhereDoesntHave ',
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

    public function listParent(Request $request, $pagination = false, $perPage = 10,$recursiveRel = [])
    {
        ActiveLog(null, actionType()['va'], 'category');
        return CategoryResource::collection($this->repo->list($request, ['where'=>['parent_id'=>0]], $recursiveRel, $pagination, $perPage));
    }
}

<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Level\LevelListResource;
use Modules\CoreData\Http\Resources\Level\LevelResource;
use Modules\CoreData\Repositories\LevelRepository;

class LevelService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(LevelRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$get = '',$recursiveRel =[])
    {
        return $this->repo->findBy($request,$pagination,$perPage,$get, $recursiveRel);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'level');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'level');
        return new LevelResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'level');
        return LevelListResource::collection($this->repo->list($request,$pagination,$perPage));
    }
    public function delete($id)
    {
        $recursiveRel = [
        'skill'=> [
            'type' => 'WhereDoesntHave',
        ],
    ];
        $data = $this->findBy(new Request(),false,0,'count',$recursiveRel);
        if($data == 0){
            $this->repo->delete($id);
        return true;
        }else{
            return false;
        }
    }
}

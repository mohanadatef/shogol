<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Gender\GenderListResource;
use Modules\CoreData\Http\Resources\Gender\GenderResource;
use Modules\CoreData\Repositories\GenderRepository;

class GenderService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(GenderRepository $repository)
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
        ActiveLog($data,actionType()['ca'],'gender');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'gender');
        return new GenderResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'gender');
        return GenderListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

    public function delete($id)
    {
        $recursiveRel = [
        'user'=> [
            'type' => 'WhereDoesntHave ',
        ],
    ];
        $data = $this->findBy(new Request(),false,0,[],'count',$recursiveRel);
        if($data == 0){
            $this->repo->delete($id);
        return true;
        }else{
        return false;
        }
    }
}

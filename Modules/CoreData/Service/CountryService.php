<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Country\CountryListResource;
use Modules\CoreData\Http\Resources\Country\CountryResource;
use Modules\CoreData\Repositories\CountryRepository;

class CountryService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CountryRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10 , $get = '',$recursiveRel =[],$pluck=[])
    {
        return $this->repo->findBy($request,$pagination,  $perPage, $get, $recursiveRel,$pluck);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'country');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'country');
        return new CountryResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'country');
        return CountryListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

    public function delete($id)
    {
        $recursiveRel = [

        'state'=> [
            'type' => 'WhereDoesntHave ',
        ],
        'city'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'task'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'user'=> [
            'type' => 'orWhereDoesntHave ',
        ]
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

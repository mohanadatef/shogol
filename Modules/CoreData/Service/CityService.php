<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\City\CityResource;
use Modules\CoreData\Repositories\CityRepository;

class CityService extends BasicService
{
    protected $repo,$countryService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CityRepository $repository,CountryService $countryService)
    {
        $this->repo = $repository;
        $this->countryService = $countryService;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$withRelations = [],$get = '',$recursiveRel =[],$pluck=[])
    {
        return $this->repo->findBy($request,$pagination,$perPage,$withRelations, $get, $recursiveRel,$pluck);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'city');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'city');
        return new CityResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'city');
        return CityListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

    public function getListCountry(Request $request){
        return $this->countryService->list($request);
    }

    public function delete($id)
    {
        $recursiveRel = [

        'state'=> [
            'type' => 'WhereDoesntHave ',
        ],
        'country'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'area'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'task'=> [
            'type' => 'orWhereDoesntHave ',
        ],
        'user'=> [
            'type' => 'orWhereDoesntHave ',
        ]
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

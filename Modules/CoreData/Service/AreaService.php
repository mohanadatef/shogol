<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Area\AreaListResource;
use Modules\CoreData\Http\Resources\Area\AreaResource;
use Modules\CoreData\Repositories\AreaRepository;

class AreaService extends BasicService
{
    protected $repo,$countryService,$stateService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(AreaRepository $repository,CountryService $countryService)
    {
        $this->repo = $repository;
        $this->countryService = $countryService;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10,$pluck=[])
    {
        return $this->repo->findBy($request,$pagination,$perPage,$pluck);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'state');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'state');
        return new AreaResource($data);
    }

    public function list (Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'state');
        return AreaListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

    public function getListCountry(Request $request){
        return $this->countryService->list($request);
    }

}

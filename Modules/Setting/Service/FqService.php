<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Http\Resources\Fq\FqListResource;
use Modules\Setting\Http\Resources\Fq\FqResource;
use Modules\Setting\Repositories\FqRepository;

class FqService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(FqRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'fq');
        return $this->repo->findBy($request,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        $data=$this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'fq');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data=$this->repo->save($request, $id);
        ActiveLog($data, actionType()['ua'], 'fq');
        return new FqResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'fq');
        return FqListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

}

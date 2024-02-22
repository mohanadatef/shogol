<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Http\Resources\cancellation\CancellationListResource;
use Modules\Setting\Http\Resources\cancellation\CancellationResource;
use Modules\Setting\Repositories\CancellationRepository;

class CancellationService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CancellationRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$pagination = false , $perPage = 10)
    {
        return $this->repo->findBy($request,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'cancellation');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'cancellation');
        return new CancellationResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'cancellation');
        return CancellationListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

    public function parent (Request $request)
    {
        $data = $this->repo->findOne($request->id);
        $childs=$data->childs()->pluck('id')->toArray();
        $moreConditionForFirstLevel=['whereNotIn'=>['id'=>array_merge($childs,[$request->id])]];
        return CancellationListResource::collection($this->repo->list(new Request(),0,$moreConditionForFirstLevel));
    }
}

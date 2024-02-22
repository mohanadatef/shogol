<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Acl\Http\Resources\Permission\PermissionListResource;
use Modules\Acl\Http\Resources\Permission\PermissionResource;
use Modules\Acl\Repositories\PermissionRepository;
use Modules\Basic\Service\BasicService;


class PermissionService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(PermissionRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request, $get = '',$pluck = [],$moreConditionForFirstLevel=[],$pagination = false , $perPage = 10)
    {
        return $this->repo->findBy($request, $get,$pluck,$moreConditionForFirstLevel,$pagination,$perPage);
    }

    public function update(Request $request, $id)
    {
        $data=$this->repo->save($request, $id);
        ActiveLog($data, actionType()['ua'], 'Permission');
        return new PermissionResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'Permission');
        return PermissionListResource::collection($this->repo->list($request,$pagination,$perPage));
    }
}

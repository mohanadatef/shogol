<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Acl\Http\Resources\Role\RoleListResource;
use Modules\Acl\Repositories\RoleRepository;
use Modules\Basic\Service\BasicService;


class RoleService extends BasicService
{
    protected $repo,$permissionService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(RoleRepository $repository,PermissionService $permissionService)
    {
        $this->repo = $repository;
        $this->permissionService = $permissionService;
    }

    public function findBy(Request $request, $get = '',$pagination = false , $perPage = 10)
    {
        return $this->repo->findBy($request, $get,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        $data=$this->repo->save($request);
        ActiveLog(null, actionType()['va'], 'role');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data, actionType()['va'], 'role');
        return $data;
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'role');
        return RoleListResource::collection($this->repo->list($request,$pagination, $perPage));
    }

    public function listPermission()
    {
        return $this->permissionService->list(new Request());
    }
}

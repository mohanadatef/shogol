<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\RolePermission;
use Modules\Acl\Service\PermissionService;
use Modules\Acl\Service\RoleService;

class AddCompanyRoleTableSeeder extends Seeder
{
    protected $permissionService, $roleService;

    public function __construct(PermissionService $permissionService, RoleService $roleService)
    {
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
    }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $permissions = ['user-edit',
            "ad-index", "ad-create", "ad-edit", "ad-show", "ad-delete",  "ad-cansel", "task-index",
            "task-create", "task-edit", "task-show", "task-delete",  "task-change-status", "task-cansel", "offer-index",
            "offer-create", "offer-edit", "offer-show", "offer-delete", "offer-approve",  "offer-change-status",
            "offer-cansel", "report-create"
        ];
        $role = $this->roleService->findBy(new Request(['name' => 'company']),  'first');
        RolePermission::where('role_id', $role->id)->delete();
        foreach ($permissions as $value) {
            $Permission = $this->permissionService->findBy(new Request(['name' => $value]), 'first');
            RolePermission::create(['role_id' => $role->id, 'permission_id' => $Permission->id]);
        }
    }
}

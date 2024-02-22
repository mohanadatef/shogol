<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'role index',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'role index',
                'description' => 'view role index'
            ],
            [
                'name' => 'role create',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'role create',
                'description' => 'role create'
            ],
            [
                'name' => 'role filter',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'role filter',
                'description' => 'role filter'
            ],
            [
                'name' => 'role edit',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'role edit',
                'description' => 'role edit'
            ],
            [
                'name' => 'role show',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'role show',
                'description' => 'role show'
            ],
            [
                'name' => 'role delete',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'role delete',
                'description' => 'role delete'
            ],
            [
                'name' => 'role change status',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'role change status',
                'description' => 'role change status'
            ],
        ];
        foreach ($permissions as $value) {
            $data = app()->make(PermissionService::class)->findBy(new Request(['name' => strtolower(str_replace([" " ,'_'],"-",$value['name']))]), 'count');
            if ($data == 0) {
                $permission = Permission::create(['name' => str_replace([" " ,'_'],"-",$value['name']), 'permission_group' => $value['permission_group']]);
                foreach (language() as $lang) {
                    $permission->translation()->create(['key' => 'display_name', 'value' => $value['display_name'], 'language_id' => $lang->id]);
                    $permission->translation()->create(['key' => 'description', 'value' => $value['description'], 'language_id' => $lang->id]);
                }
            }
        }
    }
}

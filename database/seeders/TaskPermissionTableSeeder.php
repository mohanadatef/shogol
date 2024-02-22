<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class TaskPermissionTableSeeder extends Seeder
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
                'name' => 'task index',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task index',
                'description' => 'view task index'
            ],
            [
                'name' => 'task create',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task create',
                'description' => 'task create'
            ],
            [
                'name' => 'task filter',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task filter',
                'description' => 'task filter'
            ],
            [
                'name' => 'task edit',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task edit',
                'description' => 'task edit'
            ],
            [
                'name' => 'task show',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task show',
                'description' => 'task show'
            ],
            [
                'name' => 'task delete',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task delete',
                'description' => 'task delete'
            ],
            [
                'name' => 'task approve',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task approve',
                'description' => 'task approve'
            ],
            [
                'name' => 'task change status',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task change status',
                'description' => 'task change status'
            ],
            [
                'name' => 'task cansel',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task cansel',
                'description' => 'task cansel'
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

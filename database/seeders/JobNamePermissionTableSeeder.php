<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class JobNamePermissionTableSeeder extends Seeder
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
                'name' => 'job name index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'job name index',
                'description' => 'view job name index'
            ],
            [
                'name' => 'job name create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'job name create',
                'description' => 'job name create'
            ],
            [
                'name' => 'job name filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'job name filter',
                'description' => 'job name filter'
            ],
            [
                'name' => 'job name edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'job name edit',
                'description' => 'job name edit'
            ],
            [
                'name' => 'job name delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'job name delete',
                'description' => 'job name delete'
            ],
            [
                'name' => 'job name change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'job name change status',
                'description' => 'job name change status'
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

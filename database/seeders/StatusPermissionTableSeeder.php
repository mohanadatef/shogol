<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class StatusPermissionTableSeeder extends Seeder
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
                'name' => 'status index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'status index',
                'description' => 'view status index'
            ],
            [
                'name' => 'status create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'status create',
                'description' => 'status create'
            ],
            [
                'name' => 'status filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'status filter',
                'description' => 'status filter'
            ],
            [
                'name' => 'status edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'status edit',
                'description' => 'status edit'
            ],
            [
                'name' => 'status delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'status delete',
                'description' => 'status delete'
            ],
            [
                'name' => 'status change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'status change status',
                'description' => 'status change status'
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

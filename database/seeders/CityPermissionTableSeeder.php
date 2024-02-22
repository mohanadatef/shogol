<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class CityPermissionTableSeeder extends Seeder
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
                'name' => 'city index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'city index',
                'description' => 'view city index'
            ],
            [
                'name' => 'city create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'city create',
                'description' => 'city create'
            ],
            [
                'name' => 'city filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'city filter',
                'description' => 'city filter'
            ],
            [
                'name' => 'city edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'city edit',
                'description' => 'city edit'
            ],
            [
                'name' => 'city delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'city delete',
                'description' => 'city delete'
            ],
            [
                'name' => 'city change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'city change status',
                'description' => 'city change status'
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

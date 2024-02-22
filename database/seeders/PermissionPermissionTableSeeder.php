<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class PermissionPermissionTableSeeder extends Seeder
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
                'name' => 'permission index',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'permission index',
                'description' => 'view permission index'
            ],
            [
                'name' => 'permission filter',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'permission filter',
                'description' => 'permission filter'
            ],
            [
                'name' => 'permission edit',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'permission edit',
                'description' => 'permission edit'
            ],
            [
                'name' => 'permission delete',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'permission delete',
                'description' => 'permission delete'
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

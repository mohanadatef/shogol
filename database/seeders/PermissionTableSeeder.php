<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class PermissionTableSeeder extends Seeder
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
                'name' => 'dashboard',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'dashboard',
                'description' => 'view dashboard'
            ],
            [
                'name' => 'acl',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'access control list',
                'description' => 'view acl'
            ],
            [
                'name' => 'core data',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'core data',
                'description' => 'view core data'
            ],
            [
                'name' => 'setting',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'setting',
                'description' => 'view setting'
            ],
            [
                'name' => 'task',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'task',
                'description' => 'view task'
            ],
            [
                'name' => 'trash list',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'trash list',
                'description' => 'view trash list'
            ],
            [
                'name' => 'dashboard report',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'dashboard report',
                'description' => 'view dashboard report'
            ],
            [
                'name' => 'translation list',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'translation list',
                'description' => 'view translation list'
            ],
            [
                'name' => 'translation list',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'translation list',
                'description' => 'view translation list'
            ],
            [
                'name' => 'location list',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'location list',
                'description' => 'view location list'
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

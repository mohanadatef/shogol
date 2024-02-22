<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class AdPermissionTableSeeder extends Seeder
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
                'name' => 'ad index',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'ad index',
                'description' => 'view ad index'
            ],
            [
                'name' => 'ad create',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'ad create',
                'description' => 'ad create'
            ],
            [
                'name' => 'ad filter',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'ad filter',
                'description' => 'ad filter'
            ],
            [
                'name' => 'ad edit',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'ad edit',
                'description' => 'ad edit'
            ],
            [
                'name' => 'ad show',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'ad show',
                'description' => 'ad show'
            ],
            [
                'name' => 'ad delete',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'ad delete',
                'description' => 'ad delete'
            ],
            [
                'name' => 'ad cansel',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'ad cansel',
                'description' => 'ad cansel'
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

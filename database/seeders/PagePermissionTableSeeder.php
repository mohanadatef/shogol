<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class PagePermissionTableSeeder extends Seeder
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
                'name' => 'page index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'page index',
                'description' => 'view page index'
            ],
            [
                'name' => 'page create',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'page create',
                'description' => 'page create'
            ],
            [
                'name' => 'page filter',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'page filter',
                'description' => 'page filter'
            ],
            [
                'name' => 'page edit',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'page edit',
                'description' => 'page edit'
            ],
            [
                'name' => 'page show',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'page show',
                'description' => 'page show'
            ],
            [
                'name' => 'page delete',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'page delete',
                'description' => 'page delete'
            ],
            [
                'name' => 'page change status',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'page change status',
                'description' => 'page change status'
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

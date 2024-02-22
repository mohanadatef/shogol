<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class FqPermissionTableSeeder extends Seeder
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
                'name' => 'fq index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'fq index',
                'description' => 'view fq index'
            ],
            [
                'name' => 'fq create',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'fq create',
                'description' => 'fq create'
            ],
            [
                'name' => 'fq filter',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'fq filter',
                'description' => 'fq filter'
            ],
            [
                'name' => 'fq edit',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'fq edit',
                'description' => 'fq edit'
            ],
            [
                'name' => 'fq show',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'fq show',
                'description' => 'fq show'
            ],
            [
                'name' => 'fq delete',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'fq delete',
                'description' => 'fq delete'
            ],
            [
                'name' => 'fq change status',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'fq change status',
                'description' => 'fq change status'
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

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class NationalityPermissionTableSeeder extends Seeder
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
                'name' => 'nationality index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'nationality index',
                'description' => 'view nationality index'
            ],
            [
                'name' => 'nationality create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'nationality create',
                'description' => 'nationality create'
            ],
            [
                'name' => 'nationality filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'nationality filter',
                'description' => 'nationality filter'
            ],
            [
                'name' => 'nationality edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'nationality edit',
                'description' => 'nationality edit'
            ],
            [
                'name' => 'nationality delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'nationality delete',
                'description' => 'nationality delete'
            ],
            [
                'name' => 'nationality change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'nationality change status',
                'description' => 'nationality change status'
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

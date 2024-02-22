<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class LevelPermissionTableSeeder extends Seeder
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
                'name' => 'level index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'level index',
                'description' => 'view level index'
            ],
            [
                'name' => 'level create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'level create',
                'description' => 'level create'
            ],
            [
                'name' => 'level filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'level filter',
                'description' => 'level filter'
            ],
            [
                'name' => 'level edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'level edit',
                'description' => 'level edit'
            ],
            [
                'name' => 'level delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'level delete',
                'description' => 'level delete'
            ],
            [
                'name' => 'level change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'level change status',
                'description' => 'level change status'
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

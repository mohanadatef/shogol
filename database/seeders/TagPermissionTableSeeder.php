<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class TagPermissionTableSeeder extends Seeder
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
                'name' => 'tag index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'tag index',
                'description' => 'view tag index'
            ],
            [
                'name' => 'tag create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'tag create',
                'description' => 'tag create'
            ],
            [
                'name' => 'tag filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'tag filter',
                'description' => 'tag filter'
            ],
            [
                'name' => 'tag edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'tag edit',
                'description' => 'tag edit'
            ],
            [
                'name' => 'tag delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'tag delete',
                'description' => 'tag delete'
            ],
            [
                'name' => 'tag change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'tag change status',
                'description' => 'tag change status'
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

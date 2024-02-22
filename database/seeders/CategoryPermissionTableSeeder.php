<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class CategoryPermissionTableSeeder extends Seeder
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
                'name' => 'category index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'category index',
                'description' => 'view category index'
            ],
            [
                'name' => 'category create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'category create',
                'description' => 'category create'
            ],
            [
                'name' => 'category filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'category filter',
                'description' => 'category filter'
            ],
            [
                'name' => 'category edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'category edit',
                'description' => 'category edit'
            ],
            [
                'name' => 'category delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'category delete',
                'description' => 'category delete'
            ],
            [
                'name' => 'category change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'category change status',
                'description' => 'category change status'
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

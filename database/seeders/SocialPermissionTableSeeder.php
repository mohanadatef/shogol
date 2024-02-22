<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class SocialPermissionTableSeeder extends Seeder
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
                'name' => 'social index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'social index',
                'description' => 'view social index'
            ],
            [
                'name' => 'social create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'social create',
                'description' => 'social create'
            ],
            [
                'name' => 'social filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'social filter',
                'description' => 'social filter'
            ],
            [
                'name' => 'social edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'social edit',
                'description' => 'social edit'
            ],
            [
                'name' => 'social delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'social delete',
                'description' => 'social delete'
            ],
            [
                'name' => 'social change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'social change status',
                'description' => 'social change status'
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

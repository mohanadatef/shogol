<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class CountryPermissionTableSeeder extends Seeder
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
                'name' => 'country index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'country index',
                'description' => 'view country index'
            ],
            [
                'name' => 'country create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'country create',
                'description' => 'country create'
            ],
            [
                'name' => 'country filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'country filter',
                'description' => 'country filter'
            ],
            [
                'name' => 'country edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'country edit',
                'description' => 'country edit'
            ],
            [
                'name' => 'country delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'country delete',
                'description' => 'country delete'
            ],
            [
                'name' => 'country change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'country change status',
                'description' => 'country change status'
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

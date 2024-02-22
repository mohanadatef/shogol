<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class BankPermissionTableSeeder extends Seeder
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
                'name' => 'bank index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'bank index',
                'description' => 'view bank index'
            ],
            [
                'name' => 'bank create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'bank create',
                'description' => 'bank create'
            ],
            [
                'name' => 'bank filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'bank filter',
                'description' => 'bank filter'
            ],
            [
                'name' => 'bank edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'bank edit',
                'description' => 'bank edit'
            ],
            [
                'name' => 'bank delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'bank delete',
                'description' => 'bank delete'
            ],
            [
                'name' => 'bank change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'bank change status',
                'description' => 'bank change status'
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

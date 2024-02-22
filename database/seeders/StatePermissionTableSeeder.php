<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class StatePermissionTableSeeder extends Seeder
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
                'name' => 'state index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'state index',
                'description' => 'view state index'
            ],
            [
                'name' => 'state create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'state create',
                'description' => 'state create'
            ],
            [
                'name' => 'state filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'state filter',
                'description' => 'state filter'
            ],
            [
                'name' => 'state edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'state edit',
                'description' => 'state edit'
            ],
            [
                'name' => 'state delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'state delete',
                'description' => 'state delete'
            ],
            [
                'name' => 'state change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'state change status',
                'description' => 'state change status'
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

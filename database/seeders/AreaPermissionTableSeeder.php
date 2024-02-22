<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class AreaPermissionTableSeeder extends Seeder
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
                'name' => 'area index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'area index',
                'description' => 'view area index'
            ],
            [
                'name' => 'area create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'area create',
                'description' => 'area create'
            ],
            [
                'name' => 'area filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'area filter',
                'description' => 'area filter'
            ],
            [
                'name' => 'area edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'area edit',
                'description' => 'area edit'
            ],
            [
                'name' => 'area delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'area delete',
                'description' => 'area delete'
            ],
            [
                'name' => 'area change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'area change status',
                'description' => 'area change status'
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

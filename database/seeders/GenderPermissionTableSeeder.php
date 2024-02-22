<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class GenderPermissionTableSeeder extends Seeder
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
                'name' => 'gender index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'gender index',
                'description' => 'view gender index'
            ],
            [
                'name' => 'gender create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'gender create',
                'description' => 'gender create'
            ],
            [
                'name' => 'gender filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'gender filter',
                'description' => 'gender filter'
            ],
            [
                'name' => 'gender edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'gender edit',
                'description' => 'gender edit'
            ],
            [
                'name' => 'gender delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'gender delete',
                'description' => 'gender delete'
            ],
            [
                'name' => 'gender change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'gender change status',
                'description' => 'gender change status'
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

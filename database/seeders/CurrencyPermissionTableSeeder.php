<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class CurrencyPermissionTableSeeder extends Seeder
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
                'name' => 'currency index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'currency index',
                'description' => 'view currency index'
            ],
            [
                'name' => 'currency create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'currency create',
                'description' => 'currency create'
            ],
            [
                'name' => 'currency filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'currency filter',
                'description' => 'currency filter'
            ],
            [
                'name' => 'currency edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'currency edit',
                'description' => 'currency edit'
            ],
            [
                'name' => 'currency delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'currency delete',
                'description' => 'currency delete'
            ],
            [
                'name' => 'currency change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'currency change status',
                'description' => 'currency change status'
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

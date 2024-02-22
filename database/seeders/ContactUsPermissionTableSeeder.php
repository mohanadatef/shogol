<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class ContactUsPermissionTableSeeder extends Seeder
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
                'name' => 'contact us index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'contact us index',
                'description' => 'view contact us index'
            ],
            [
                'name' => 'contact us filter',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'contact us filter',
                'description' => 'contact us filter'
            ],
            [
                'name' => 'contact us delete',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'contact us delete',
                'description' => 'contact us delete'
            ],
            [
                'name' => 'contact us change status',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'contact us change status',
                'description' => 'contact us change status'
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

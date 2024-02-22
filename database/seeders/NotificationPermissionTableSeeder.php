<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class NotificationPermissionTableSeeder extends Seeder
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
                'name' => 'notification',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'notification',
                'description' => 'view notification'
            ],
            [
                'name' => 'notification filter',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'notification filter',
                'description' => 'notification filter'
            ],
            [
                'name' => 'notification push',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'notification push',
                'description' => 'notification push'
            ],
            [
                'name' => 'notification index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'notification index',
                'description' => 'notification index'
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

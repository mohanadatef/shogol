<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Acl\Service\PermissionService;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;

class ReportPermissionTableSeeder extends Seeder
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
                'name' => 'report index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'report index',
                'description' => 'view report index'
            ],
            [
                'name' => 'report solve status',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'report solve status',
                'description' => 'report solve status'
            ],
            [
                'name' => 'report create',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'report create',
                'description' => 'report create'
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

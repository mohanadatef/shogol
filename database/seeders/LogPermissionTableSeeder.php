<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class LogPermissionTableSeeder extends Seeder
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
                'name' => 'log system',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'log system',
                'description' => 'view log system'
            ],
            [
                'name' => 'log filter',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'log filter',
                'description' => 'log filter'
            ],
            [
                'name' => 'log search',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'log search',
                'description' => 'log search'
            ],
            [
                'name' => 'log list',
                'permission_group' => permissionGroup()['syp'],
                'display_name' => 'log list',
                'description' => 'view log list'
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

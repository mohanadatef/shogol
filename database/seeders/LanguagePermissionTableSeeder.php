<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class LanguagePermissionTableSeeder extends Seeder
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
                'name' => 'language index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'language index',
                'description' => 'view language index'
            ],
            [
                'name' => 'language create',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'language create',
                'description' => 'language create'
            ],
            [
                'name' => 'language filter',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'language filter',
                'description' => 'language filter'
            ],
            [
                'name' => 'language edit',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'language edit',
                'description' => 'language edit'
            ],
            [
                'name' => 'language delete',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'language delete',
                'description' => 'language delete'
            ],
            [
                'name' => 'language change status',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'language change status',
                'description' => 'language change status'
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

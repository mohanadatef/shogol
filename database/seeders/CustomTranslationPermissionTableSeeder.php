<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class CustomTranslationPermissionTableSeeder extends Seeder
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
                'name' => 'custom translation index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'custom translation index',
                'description' => 'view custom translation index'
            ],
            [
                'name' => 'custom translation create',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'custom translation create',
                'description' => 'custom translation create'
            ],
            [
                'name' => 'custom translation filter',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'custom translation filter',
                'description' => 'custom translation filter'
            ],
            [
                'name' => 'custom translation edit',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'custom translation edit',
                'description' => 'custom translation edit'
            ],
            [
                'name' => 'custom translation delete',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'custom translation delete',
                'description' => 'custom translation delete'
            ],
            [
                'name' => 'custom translation change status',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'custom translation change status',
                'description' => 'custom translation change status'
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

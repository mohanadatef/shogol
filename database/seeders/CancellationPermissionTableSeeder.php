<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class CancellationPermissionTableSeeder extends Seeder
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
                'name' => 'cancellation index',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'cancellation index',
                'description' => 'view cancellation index'
            ],
            [
                'name' => 'cancellation create',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'cancellation create',
                'description' => 'cancellation create'
            ],
            [
                'name' => 'cancellation filter',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'cancellation filter',
                'description' => 'cancellation filter'
            ],
            [
                'name' => 'cancellation edit',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'cancellation edit',
                'description' => 'cancellation edit'
            ],
            [
                'name' => 'cancellation show',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'cancellation show',
                'description' => 'cancellation show'
            ],
            [
                'name' => 'cancellation delete',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'cancellation delete',
                'description' => 'cancellation delete'
            ],
            [
                'name' => 'cancellation change status',
                'permission_group' => permissionGroup()['sp'],
                'display_name' => 'cancellation change status',
                'description' => 'cancellation change status'
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

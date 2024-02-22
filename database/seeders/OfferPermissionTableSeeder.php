<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class OfferPermissionTableSeeder extends Seeder
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
                'name' => 'offer index',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer index',
                'description' => 'view offer index'
            ],
            [
                'name' => 'offer create',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer create',
                'description' => 'offer create'
            ],
            [
                'name' => 'offer edit',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer edit',
                'description' => 'offer edit'
            ],
            [
                'name' => 'offer show',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer show',
                'description' => 'offer show'
            ],
            [
                'name' => 'offer delete',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer delete',
                'description' => 'offer delete'
            ],
            [
                'name' => 'offer approve',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer approve',
                'description' => 'offer approve'
            ],
            [
                'name' => 'offer change status',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer change status',
                'description' => 'offer change status'
            ],
            [
                'name' => 'offer cansel',
                'permission_group' => permissionGroup()['tp'],
                'display_name' => 'offer cansel',
                'description' => 'offer cansel'
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

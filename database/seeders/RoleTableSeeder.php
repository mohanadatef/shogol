<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Role;
use Modules\Acl\Service\RoleService;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'is_web' => 0,
                'is_report' => 0,
                'is_approve' => 0,
                'is_verified' => 0,
            ],
            [
                'name' => 'client',
                'is_web' => 1,
                'is_report' => 1,
                'is_approve' => 0,
                'is_verified' => 0,
            ],
            [
                'name' => 'freelancer',
                'is_web' => 1,
                'is_report' => 1,
                'is_approve' => 0,
                'is_verified' => 0,
            ],
            [
                'name' => 'company',
                'is_web' => 1,
                'is_report' => 1,
                'is_approve' => 0,
                'is_verified' => 0,
            ],
        ];
        foreach ($roles as $value) {
            $data = app()->make(RoleService::class)->findBy(new Request(['name' => $value['name']]), 'count');
            if ($data == 0) {
                $role = Role::create(['is_web' => $value['is_web'],'is_report' => $value['is_report']
                    ,'is_approve'=>$value['is_approve'],'is_verified'=>$value['is_verified']]);
                foreach (language() as $lang) {
                    $role->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
                }
            }
        }
    }
}

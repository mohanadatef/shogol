<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            //admin default data
            [
                'id'=>1,
                'username' => 'admin',
                'fullname' => 'admin',
                'email' => 'admin@shogol.com',
                'password' => Hash::make('admin@shogol.com'),
                'mobile' => '00000000000',
                'nationality_number' => '00000000000',
                'role_id' =>1,
                'approve' =>1,
                'gender_id' => 1,
                'job_name_id' => 1,
                'nationality_id' => 1,
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'country_id' =>1,
                'city_id' =>1,
                'state_id' =>1,
            ]);
    }
}

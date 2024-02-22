<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class OtpSettingValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'otp_authorization','value'=>"eyJhbGciOiJIUzI1NiJ9.eyJzZXJ2aWNlX2lkIjoiQVBlZTk2ZjUyNGYzMjc0MjI3OWRiMTRlMjQxMTExOWE3MCJ9.yBoy3EC-Y3eB9blWDFq-Q6rm01Y4Fus7eV1oxxsTq1s"],
            ['key' => 'otp_app_id','value'=>"APee96f524f32742279db14e2411119a70"],
        ];
        foreach ($setting as $value) {
            $data = app()->make(SettingService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),'count');
            if ($data == 0) {
                Setting::create($value);
            }
        }
    }
}

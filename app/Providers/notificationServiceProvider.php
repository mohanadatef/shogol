<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class notificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
 //todo move file to module -heba-
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            config(['services.fcm.key' => getValueSetting('fcm_secret_key') ?? ""]);
        }catch (\Exception $exception) {
            $exception->getMessage();
        }
    }
}

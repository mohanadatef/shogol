<?php

namespace Modules\Setting\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('settings')) {
            $config = [
                'driver' => 'SMTP',
                'host' => DB::table('settings')->where('key','mail_configHost')->value('value'),
                'port' => DB::table('settings')->where('key','mail_config_port')->value('value'),
                'encryption' => DB::table('settings')->where('key','mail_config_encryption')->value('value'),
                'username' => DB::table('settings')->where('key','mail_config_address')->value('value'),
                'from' => [
                    'address' => DB::table('settings')->where('key','mail_config_address')->value('value'),
                    'name' => DB::table('settings')->where('key','mail_config_address')->value('value')
                ],
                'password' => DB::table('settings')->where('key','mail_config_password')->value('value'),
                'sendmail' => '/usr/sbin/sendmail -bs',
                'markdown' => [
                    'theme' => 'default',
                    'paths' => [
                        resource_path('views/vendor/mail'),
                    ],
                ],
            ];
            Config::set('mail', $config);
        }


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function resetConfig()
    {
        if (Schema::hasTable('settings')) {
            $config = [
                'driver' => 'SMTP',
                'host' => DB::table('settings')->where('key','mail_configHost')->value('value'),
                'port' => DB::table('settings')->where('key','mail_config_port')->value('value'),
                'encryption' => DB::table('settings')->where('key','mail_config_encryption')->value('value'),
                'username' => DB::table('settings')->where('key','mail_config_address')->value('value'),
                 'from' => [
                    'address' => DB::table('settings')->where('key','mail_config_address')->value('value'),
                    'name' => DB::table('settings')->where('key','mail_config_address')->value('value')
                ],
                'password' => DB::table('settings')->where('key','mail_config_password')->value('value'),
                'sendmail' => '/usr/sbin/sendmail -bs',
                'markdown' => [
                    'theme' => 'default',
                    'paths' => [
                        resource_path('views/vendor/mail'),
                    ],
                ],
            ];
            Config::set('mail', $config);
        }

    }

    public static function modifyMail($mail)
    {

            $config = [
                'driver' => 'SMTP',
                'host' => $mail->host,
                'port' => $mail->port,
                'from' => [
                    'address' => $mail->email,
                    'name' => $mail->name
                ],
                'encryption' => $mail->encryption_type,
                'username' => $mail->email,
                'password' => $mail->password,
                'sendmail' => '/usr/sbin/sendmail -bs',
                'markdown' => [
                    'theme' => 'default',
                    'paths' => [
                        resource_path('views/vendor/mail'),
                    ],
                ],
            ];
            Config::set('mail', $config);

    }

}

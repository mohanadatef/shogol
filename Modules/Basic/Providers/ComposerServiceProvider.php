<?php

namespace Modules\Basic\Providers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Acl\Service\RoleService;
use Modules\Acl\Service\UserService;
use Modules\Basic\Service\CustomTranslationService;
use Modules\CoreData\Service\CategoryService;
use Modules\CoreData\Service\CityService;
use Modules\CoreData\Service\CountryService;
use Modules\CoreData\Service\CurrencyService;
use Modules\CoreData\Service\GenderService;
use Modules\CoreData\Service\JobNameService;
use Modules\CoreData\Service\NationalityService;
use Modules\CoreData\Service\StateService;
use Modules\CoreData\Service\StatusService;
use Modules\Setting\Service\NotificationService;
use Modules\Setting\Service\CancellationService;
use Modules\Setting\Service\SettingService;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $setting = $language = $languageActive = [];
        if (Schema::hasTable('languages')) {
            $languageActive = languageActive();
            $language = language();
        }
        if (Schema::hasTable('settings')) {
            $setting = app()->make(SettingService::class)->findBy(new Request(['status' => activeType()['as']]), '', ['value', 'key']);
        }
        view()->composer(['*'], function ($view) use ( $languageActive, $language, $setting) {
            $custom = app()->make(CustomTranslationService::class)->findBy(new Request(['status' => activeType()['as']]));
            $custom = $custom->pluck('value.value', 'key')->toArray();
            $view->with('languageActive', $languageActive->count() > 1 ? $languageActive : null);
            $view->with('language', $language);
            $view->with('custom', $custom);
            $view->with('setting', $setting);
            $view->with('user', user());
        });
        view()->composer(['admin.admin'], function ($view) {
            $dates[] = ['start' => Carbon::today()->toDateTimeString(), 'end' => Carbon::tomorrow()->toDateTimeString()];
            $dates[] = ['start' => Carbon::now()->startOfWeek()->toDateTimeString(), 'end' => Carbon::now()->endOfWeek()->toDateTimeString()];
            $dates[] = ['start' => Carbon::now()->startOfMonth()->toDateTimeString(), 'end' => Carbon::now()->lastOfMonth()->toDateTimeString()];
            $dates[] = ['start' => Carbon::now()->startOfYear()->toDateTimeString(), 'end' => Carbon::now()->lastOfYear()->toDateTimeString()];
            $view->with('dates', $dates);
        });
        view()->composer(['task::*', 'acl::user.*'], function ($view) {
            $cancellation = app()->make(CancellationService::class)->findBy(new Request(['status' => activeType()['as']]));
            $view->with('cancellation', $cancellation);
        });
        $nationality = $category = $job_name = $role = $country = $city = $state = $gender = [];
        if (Schema::hasTable('categories')) {
            $category = app()->make(CategoryService::class)->findBy(new Request());
        }
        if (Schema::hasTable('job_names')) {
            $job_name = app()->make(JobNameService::class)->findBy(new Request());
        }
        if (Schema::hasTable('roles')) {
            $role = app()->make(RoleService::class)->findBy(new Request());
        }
        if (Schema::hasTable('nationalities')) {
            $nationality = app()->make(NationalityService::class)->findBy(new Request());
        }
        if (Schema::hasTable('countries')) {
            $country = app()->make(CountryService::class)->findBy(new Request());
        }
        if (Schema::hasTable('cities')) {
            $city = app()->make(CityService::class)->findBy(new Request());
        }
        if (Schema::hasTable('states')) {
            $state = app()->make(StateService::class)->findBy(new Request());
        }
        if (Schema::hasTable('genders')) {
            $gender = app()->make(GenderService::class)->findBy(new Request());
        }
        view()->composer(['acl::user.filter', 'setting::notification.push'], function ($view) use ($gender, $state, $city, $country, $nationality, $role, $category, $job_name) {
            $view->with('category', $category);
            $view->with('job_name', $job_name);
            $view->with('role', $role);
            $view->with('nationality', $nationality);
            $view->with('country', $country);
            $view->with('city', $city);
            $view->with('state', $state);
            $view->with('gender', $gender);
        });
        view()->composer(['task::task.show'], function ($view)  {
            $view->with('status', app()->make(StatusService::class)->findBy(new Request()));
        });
        view()->composer(['task::*.filter'], function ($view) use($category,$country,$city,$state) {
            $view->with('category',$category);
            $view->with('country', $country);
            $view->with('city', $city);
            $view->with('state', $state);
            $view->with('currency', app()->make(CurrencyService::class)->findBy(new Request()));
            $view->with('status', app()->make(StatusService::class)->findBy(new Request()));
            $recursiveRel = [
                'role' => [
                    'type' => 'whereHas',
                    'recursive' => [
                        'permission' => [
                            'type' => 'whereHas',
                            'where' => ['name' => 'ad-create']
                        ]
                    ],
                    'where' => ['is_web' => [1]]
                ]
            ];
            $view->with('userAd', app()->make(UserService::class)->findBy(new Request(),  [], '', ['*'], false, 10, $recursiveRel));
            $view->with('freelancer', app()->make(UserService::class)->findBy(new Request(),  [], '', ['*'], false, 10, $recursiveRel));
            $recursiveRel = [
                'role' => [
                    'type' => 'whereHas',
                    'recursive' => [
                        'permission' => [
                            'type' => 'whereHas',
                            'where' => ['name' => 'ad-task']
                        ]
                    ],
                    'where' => ['is_web' => [1]]
                ]
            ];
            $view->with('userTask', app()->make(UserService::class)->findBy(new Request(),  [], '', ['*'], false, 10, $recursiveRel));

        });
        $notifications = [];
        $countNotification = 0;
        if (user()) {
            $notifications = app()->make(NotificationService::class)->findBy(new Request(['receiver_id' => user()->id]),  false, 10, 10, 'get');
            $countNotification = app()->make(NotificationService::class)->findBy(new Request(['receiver_id' => user()->id]),  false, 10, 10, 'count', ['where' => ['read_at' => null]]);
        }
        view()->composer(['includes.admin.header'], function ($view) use($countNotification,$notifications){
            $view->with('notifications', $notifications);
            $view->with('countNotification', $countNotification);
        });
    }
}

<?php

namespace Modules\Acl\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Acl\Events\verifiedEmailEvent;
use Modules\Acl\Listeners\verifiedEmailListener;
use Modules\Acl\Observers\UserObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        verifiedEmailEvent::class => [
            verifiedEmailListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}

<?php

namespace TransitPro\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'TransitPro\Events\SomeEvent' => [
            'TransitPro\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

            // Fired on successful logins...
        $events->listen('auth.login', function ($user, $remember) {
          DB::table('users')
                -> where('id', Auth::user()->id)
                -> update(array(
                        'last_login_at'    =>  Carbon::now()
                    ));
        });

        // Fired on logouts...
        $events->listen('auth.logout', function ($user) {
            //
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        'Illuminate\Auth\Events\Registered' => [
            'Illuminate\Auth\Listeners\SendEmailVerificationNotification',
        ],
		'Illuminate\Routing\Events\RouteMatched' => [
            'App\Listeners\PhpToJs',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() {
		
		
		\App\Models\Users::observe(\App\Observers\UsersObserver::class);
        \App\Models\Role::observe(\App\Observers\RoleObserver::class);
		\App\Models\Album::observe(\App\Observers\AlbumObserver::class);
    }
}

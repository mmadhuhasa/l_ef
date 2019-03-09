<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\UserRegisterEvent' => [
            'App\Listeners\UserRegisterListener'
        ],
        'App\Events\Home\ContactUsEvent' => [
            'App\Listeners\Home\ContactUsListeners'
        ],
        'App\Events\Lr\AddLicenseEvent' => [
            'App\Listeners\Lr\AddLicenseListeners'
        ],
        'App\Events\Lr\EditLicenseEvent' => [
            'App\Listeners\Lr\EditLicenseListeners'
        ],
        'App\Events\Lr\DeleteLicenseEvent' => [
            'App\Listeners\Lr\DeleteLicenseListeners'
        ],
        'App\Events\Lr\AddUserEvent' => [
            'App\Listeners\Lr\AddUserListeners'
        ],
        'App\Events\Lr\EditUserEvent' => [
            'App\Listeners\Lr\EditUserListeners'
        ],
        'App\Events\Lr\DeleteUserEvent' => [
            'App\Listeners\Lr\DeleteUserListeners'
        ],
        'App\Events\Lr\LicenseHistoryEvent' => [
            'App\Listeners\Lr\LicenseHistoryListeners'
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events) {
        parent::boot($events);

        //
    }

}

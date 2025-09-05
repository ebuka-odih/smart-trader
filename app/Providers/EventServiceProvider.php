<?php

namespace App\Providers;

use App\Events\DepositApproved;
use App\Events\DepositCompleted;
use App\Events\DepositSubmitted;
use App\Events\WithdrawalApproved;
use App\Events\WithdrawalCompleted;
use App\Events\WithdrawalSubmitted;
use App\Listeners\SendDepositApprovedNotification;
use App\Listeners\SendDepositNotification;
use App\Listeners\SendDepositSubmittedNotification;
use App\Listeners\SendWithdrawalApprovedNotification;
use App\Listeners\SendWithdrawalNotification;
use App\Listeners\SendWithdrawalSubmittedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Deposit Events
        DepositCompleted::class => [
            SendDepositNotification::class,
        ],

        // Withdrawal Events
        WithdrawalCompleted::class => [
            SendWithdrawalNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Manually register events to avoid duplicates
        Event::listen(DepositSubmitted::class, SendDepositSubmittedNotification::class);
        Event::listen(DepositApproved::class, SendDepositApprovedNotification::class);
        Event::listen(WithdrawalSubmitted::class, SendWithdrawalSubmittedNotification::class);
        Event::listen(WithdrawalApproved::class, SendWithdrawalApprovedNotification::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return true;
    }
}

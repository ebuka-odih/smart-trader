<?php

namespace App\Listeners;

use App\Events\WithdrawalCompleted;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWithdrawalNotification
{
    protected NotificationService $notificationService;

    /**
     * Create the event listener.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(WithdrawalCompleted $event): void
    {
        $this->notificationService->createWithdrawalNotification(
            $event->user,
            $event->amount,
            $event->status
        );
    }
}

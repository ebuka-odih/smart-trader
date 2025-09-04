<?php

namespace App\Listeners;

use App\Events\DepositCompleted;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDepositNotification
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
    public function handle(DepositCompleted $event): void
    {
        $this->notificationService->createDepositNotification(
            $event->user,
            $event->amount,
            $event->status
        );
    }
}

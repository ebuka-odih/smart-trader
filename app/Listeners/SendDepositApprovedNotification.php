<?php

namespace App\Listeners;

use App\Events\DepositApproved;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDepositApprovedNotification
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
    public function handle(DepositApproved $event): void
    {
        // Create notification for the user whose deposit was approved
        $this->notificationService->createNotification(
            $event->user,
            'deposit_approved',
            'Deposit Approved',
            "Your deposit of $" . number_format($event->amount, 2) . " has been approved and credited to your " . ucfirst($event->walletType) . " wallet.",
            [
                'amount' => $event->amount,
                'wallet_type' => $event->walletType,
                'deposit_id' => $event->deposit->id,
                'status' => 'approved',
                'type' => 'deposit_approved'
            ]
        );

        // Log the approval for admin tracking
        \Log::info('Deposit approved', [
            'user_id' => $event->user->id,
            'amount' => $event->amount,
            'wallet_type' => $event->walletType,
            'deposit_id' => $event->deposit->id
        ]);
    }
}

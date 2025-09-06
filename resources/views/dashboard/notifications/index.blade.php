@extends('dashboard.layout.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Notifications</h1>
            <p class="text-gray-400 mt-1">Stay updated with your account activities</p>
        </div>
        <div class="flex items-center space-x-3">
            <button id="markAllReadBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Mark All as Read
            </button>
            <button id="clearAllBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                Clear All
            </button>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="border-b border-gray-700">
        <nav class="-mb-px flex space-x-8">
            <button id="allTab" class="tab-button active py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-400">
                All Notifications
            </button>
            <button id="unreadTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-400 hover:text-gray-300">
                Unread
            </button>
            <button id="depositTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-400 hover:text-gray-300">
                Deposits
            </button>
            <button id="withdrawalTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-400 hover:text-gray-300">
                Withdrawals
            </button>
            <button id="tradingTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-400 hover:text-gray-300">
                Trading
            </button>
            <button id="systemTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-400 hover:text-gray-300">
                System
            </button>
        </nav>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">
        @forelse($notifications as $notification)
        <div class="notification-item bg-gray-800 rounded-lg border border-gray-700 p-6 hover:border-gray-600 transition-colors {{ !$notification->read_at ? 'border-l-4 border-l-blue-500' : '' }}" 
             data-type="{{ $notification->type }}" 
             data-id="{{ $notification->id }}">
            
            <div class="flex items-start space-x-4">
                <!-- Notification Icon -->
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $notification->type === 'deposit' || $notification->type === 'deposit_submitted' || $notification->type === 'deposit_approved' ? 'bg-green-600' : ($notification->type === 'withdrawal' || $notification->type === 'withdrawal_submitted' || $notification->type === 'withdrawal_approved' ? 'bg-red-600' : ($notification->type === 'trading' ? 'bg-blue-600' : 'bg-gray-600')) }}">
                        @if($notification->type === 'deposit' || $notification->type === 'deposit_submitted' || $notification->type === 'deposit_approved')
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        @elseif($notification->type === 'withdrawal' || $notification->type === 'withdrawal_submitted' || $notification->type === 'withdrawal_approved')
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m16 0l-4-4m4 4l-4 4"></path>
                            </svg>
                        @elseif($notification->type === 'trading')
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-6H4v6z"></path>
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- Notification Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">{{ $notification->title }}</h3>
                        <div class="flex items-center space-x-2">
                            @if(!$notification->read_at)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    New
                                </span>
                            @endif
                            <span class="text-sm text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-300 mt-1">{{ $notification->message }}</p>
                    
                    @if($notification->data)
                        <div class="mt-3 p-3 bg-gray-700 rounded-lg">
                            @if(isset($notification->data['amount']))
                                <div class="text-sm text-gray-300">
                                    <span class="font-medium">Amount:</span> {{ auth()->user()->formatAmount($notification->data['amount']) }}
                                </div>
                            @endif
                            @if(isset($notification->data['status']))
                                <div class="text-sm text-gray-300 mt-1">
                                    <span class="font-medium">Status:</span> 
                                    <span class="px-2 py-1 rounded text-xs {{ $notification->data['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($notification->data['status']) }}
                                    </span>
                                </div>
                            @endif
                            @if(isset($notification->data['symbol']))
                                <div class="text-sm text-gray-300 mt-1">
                                    <span class="font-medium">Symbol:</span> {{ $notification->data['symbol'] }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex-shrink-0 flex items-center space-x-2">
                    @if(!$notification->read_at)
                        <button class="mark-read-btn px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors" 
                                data-id="{{ $notification->id }}">
                            Mark Read
                        </button>
                    @endif
                    <button class="delete-notification-btn px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700 transition-colors" 
                            data-id="{{ $notification->id }}">
                        Delete
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-6H4v6z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-400 mb-2">No notifications</h3>
            <p class="text-gray-500">You're all caught up! New notifications will appear here.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.tab-button');
    const notificationItems = document.querySelectorAll('.notification-item');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => {
                t.classList.remove('active', 'border-blue-500', 'text-blue-400');
                t.classList.add('border-transparent', 'text-gray-400');
            });

            // Add active class to clicked tab
            this.classList.add('active', 'border-blue-500', 'text-blue-400');
            this.classList.remove('border-transparent', 'text-gray-400');

            // Filter notifications
            const filterType = this.id.replace('Tab', '');
            filterNotifications(filterType);
        });
    });

    function filterNotifications(type) {
        notificationItems.forEach(item => {
            if (type === 'all') {
                item.style.display = 'block';
            } else if (type === 'unread') {
                item.style.display = item.querySelector('.bg-blue-100') ? 'block' : 'none';
            } else {
                const itemType = item.getAttribute('data-type');
                item.style.display = itemType === type ? 'block' : 'none';
            }
        });
    }

    // Mark as read functionality
    document.querySelectorAll('.mark-read-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const notificationId = this.getAttribute('data-id');
            markAsRead(notificationId);
        });
    });

    // Delete notification functionality
    document.querySelectorAll('.delete-notification-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const notificationId = this.getAttribute('data-id');
            deleteNotification(notificationId);
        });
    });

    // Mark all as read
    document.getElementById('markAllReadBtn').addEventListener('click', function() {
        markAllAsRead();
    });

    // Clear all notifications
    document.getElementById('clearAllBtn').addEventListener('click', function() {
        if (confirm('Are you sure you want to clear all notifications?')) {
            clearAllNotifications();
        }
    });

    function markAsRead(notificationId) {
        fetch(`/user/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function markAllAsRead() {
        fetch('/user/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function deleteNotification(notificationId) {
        fetch(`/user/notifications/${notificationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function clearAllNotifications() {
        fetch('/user/notifications/clear-all', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
@endsection

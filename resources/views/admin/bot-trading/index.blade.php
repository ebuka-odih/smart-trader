@extends('admin.layout.app')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">Bot Trading Management</h1>
                <p class="text-gray-400 mt-2">Manage all trading bots across the platform</p>
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="refreshStats()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Bots -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Bots</p>
                    <p class="text-3xl font-bold">{{ number_format($stats['total_bots']) }}</p>
                </div>
                <div class="bg-blue-500 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-blue-100">Active: {{ $stats['active_bots'] }}</span>
                <span class="mx-2">•</span>
                <span class="text-blue-100">Paused: {{ $stats['paused_bots'] }}</span>
            </div>
        </div>

        <!-- Total Profit -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Profit</p>
                    <p class="text-3xl font-bold">${{ number_format($stats['total_profit'], 2) }}</p>
                </div>
                <div class="bg-green-500 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-100">Invested: ${{ number_format($stats['total_invested'], 2) }}</span>
            </div>
        </div>

        <!-- Total Trades -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Trades</p>
                    <p class="text-3xl font-bold">{{ number_format($stats['total_trades']) }}</p>
                </div>
                <div class="bg-purple-500 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-purple-100">Success Rate: {{ $stats['total_trades'] > 0 ? number_format(($stats['profitable_trades'] / $stats['total_trades']) * 100, 1) : 0 }}%</span>
            </div>
        </div>

        <!-- Stopped Bots -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Stopped Bots</p>
                    <p class="text-3xl font-bold">{{ number_format($stats['stopped_bots']) }}</p>
                </div>
                <div class="bg-red-500 rounded-full p-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-red-100">{{ $stats['stopped_bots'] > 0 ? number_format(($stats['stopped_bots'] / $stats['total_bots']) * 100, 1) : 0 }}% of total</span>
            </div>
        </div>
    </div>

    <!-- Bots Table -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Bot Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Performance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($bots as $bot)
                    <tr class="hover:bg-gray-700 transition-colors">
                        <!-- Bot Info -->
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-white">{{ $bot->name }}</div>
                                <div class="text-sm text-gray-400">{{ $bot->base_asset }}/{{ $bot->quote_asset }}</div>
                                <div class="text-xs text-gray-500">{{ ucfirst($bot->strategy) }} Strategy</div>
                                <div class="text-xs text-gray-500">Created: {{ $bot->created_at->format('M d, Y H:i') }}</div>
                            </div>
                        </td>

                        <!-- User -->
                        <td class="px-6 py-4">
                            <div class="text-sm text-white">{{ $bot->user->name }}</div>
                            <div class="text-sm text-gray-400">{{ $bot->user->email }}</div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full font-medium
                                @if($bot->status === 'active') bg-green-900 text-green-300
                                @elseif($bot->status === 'paused') bg-yellow-900 text-yellow-300
                                @else bg-red-900 text-red-300 @endif">
                                {{ ucfirst($bot->status) }}
                            </span>
                        </td>

                        <!-- Performance -->
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <div class="flex items-center space-x-2">
                                    <span class="text-gray-400">Profit:</span>
                                    <span class="font-medium {{ $bot->total_profit >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                        ${{ number_format($bot->total_profit, 2) }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-gray-400">Trades:</span>
                                    <span class="text-white">{{ $bot->total_trades }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-gray-400">Success:</span>
                                    <span class="text-white">{{ $bot->success_rate ? number_format($bot->success_rate, 1) : 0 }}%</span>
                                </div>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.bot-trading.show', $bot) }}" class="text-blue-400 hover:text-blue-300" title="View Details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.bot-trading.edit', $bot) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit Bot">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <button onclick="editPnl({{ $bot->id }})" class="text-green-400 hover:text-green-300" title="Edit PnL">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </button>
                                @if($bot->status !== 'stopped')
                                <button onclick="stopBot({{ $bot->id }})" class="text-red-400 hover:text-red-300" title="Stop Bot">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                                    </svg>
                                </button>
                                @endif
                                <button onclick="deleteBot({{ $bot->id }})" class="text-red-600 hover:text-red-500" title="Delete Bot">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            No bots found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bots->hasPages())
        <div class="px-6 py-4 border-t border-gray-700">
            {{ $bots->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

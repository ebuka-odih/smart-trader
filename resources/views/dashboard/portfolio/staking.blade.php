@extends('dashboard.layout.app')

@section('content')
<div class="space-y-6">
    <!-- Balance Card -->
    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-white">Total Balance</h2>
            <div class="text-2xl font-bold text-green-400">${{ number_format($totalBalance, 2) }}</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Total Staked</div>
                <div class="text-white font-semibold">${{ number_format($totalStaked, 2) }}</div>
            </div>
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Active Stakings</div>
                <div class="text-green-400 font-semibold">{{ $activeStakings }}</div>
            </div>
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Total Rewards</div>
                <div class="text-blue-400 font-semibold">${{ number_format($totalRewards, 2) }}</div>
            </div>
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Current Value</div>
                <div class="text-purple-400 font-semibold">${{ number_format($currentValue, 2) }}</div>
            </div>
        </div>
    </div>

    <!-- Staking Activities Table -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="p-6 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Staking Activities</h3>
        </div>
        <div class="overflow-x-auto">
            @if($stakings->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount Staked</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">APY Rate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Rewards</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Current Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @foreach($stakings as $staking)
                        <tr class="hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $staking->plan->name }}</div>
                                <div class="text-sm text-gray-400">{{ $staking->plan->description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                ${{ number_format($staking->amount_staked, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">
                                {{ $staking->apy_rate }}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($staking->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @elseif($staking->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Completed
                                    </span>
                                @elseif($staking->status === 'cancelled')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Cancelled
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ ucfirst($staking->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-400">
                                ${{ number_format($staking->total_rewards, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-400">
                                ${{ number_format($staking->current_value, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('user.staking.show', $staking) }}" class="text-blue-400 hover:text-blue-300">View Details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-6 text-center">
                    <div class="text-gray-400 text-lg">No staking activities found</div>
                    <div class="mt-2">
                        <a href="{{ route('user.staking.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Start Staking
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Mobile Footer Menu -->
<div class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 md:hidden z-50">
    <div class="flex justify-around">
        <a href="{{ route('user.portfolio.trade') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.portfolio.trade') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">Plans</span>
        </a>
        <a href="{{ route('user.portfolio.staking') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.portfolio.staking') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">Staking</span>
        </a>
        <a href="{{ route('user.portfolio.mining') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.portfolio.mining') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">Mining</span>
        </a>
        <a href="{{ route('user.portfolio.holding') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.portfolio.holding') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
            </svg>
            <span class="text-xs">Holding</span>
        </a>
        <a href="{{ route('user.portfolio.signal') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.portfolio.signal') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">Signal</span>
        </a>
    </div>
</div>

<!-- Add bottom padding for mobile footer -->
<div class="pb-20 md:pb-0"></div>
@endsection

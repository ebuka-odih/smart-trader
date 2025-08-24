@extends('dashboard.layout.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Mining Dashboard</h1>
                        <p class="text-gray-400">Manage your cryptocurrency mining subscriptions</p>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('user.mining.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Start Mining
                        </a>
                        <a href="{{ route('user.mining.statistics') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            View Statistics
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-900/20 border border-green-500/30 rounded-lg">
                    <div class="text-green-400">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-900/20 border border-red-500/30 rounded-lg">
                    <div class="text-red-400">{{ session('error') }}</div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Available Mining Plans -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow">
                        <div class="px-6 py-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white">Available Mining Plans</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($miningPlans as $plan)
                                    <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                                        <div class="flex items-center justify-between mb-3">
                                            <h3 class="text-white font-semibold">{{ $plan->name }}</h3>
                                            <span class="text-blue-400 font-bold">${{ number_format($plan->price, 2) }}</span>
                                        </div>
                                        <div class="space-y-2 text-sm text-gray-300">
                                            <div class="flex justify-between">
                                                <span>Hashrate:</span>
                                                <span class="text-blue-400 font-semibold">{{ $plan->hashrate }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Equipment:</span>
                                                <span>{{ $plan->equipment }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Uptime:</span>
                                                <span>{{ $plan->downtime }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span>Duration:</span>
                                                <span>{{ $plan->mining_duration }} days</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('user.mining.create', ['plan' => $plan->id]) }}" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded text-center text-sm font-medium transition-colors block">
                                            Start Mining
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Active Mining -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow">
                        <div class="px-6 py-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white">Active Mining</h2>
                        </div>
                        <div class="divide-y divide-gray-700">
                            @forelse($activeMinings as $mining)
                                <div class="p-6 flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="text-white font-medium">{{ $mining->plan->name }}</div>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </div>
                                        <div class="text-gray-400 text-sm space-y-1">
                                            <div>Invested: {{ $mining->formatted_amount_invested }}</div>
                                            <div>Total Mined: {{ $mining->formatted_total_mined }}</div>
                                            <div>Progress: {{ $mining->mining_progress }}%</div>
                                            <div>Started: {{ $mining->start_date->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col space-y-2">
                                        <a href="{{ route('user.mining.show', $mining) }}" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded text-sm font-medium transition-colors">
                                            Details
                                        </a>
                                        @if($mining->canBeCancelled())
                                            <form method="POST" action="{{ route('user.mining.cancel', $mining) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-medium transition-colors w-full">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-gray-400 text-center">
                                    <p>No active mining subscriptions yet.</p>
                                    <a href="{{ route('user.mining.create') }}" class="text-blue-400 hover:text-blue-300 mt-2 inline-block">
                                        Start your first mining subscription
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Completed Mining -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow">
                        <div class="px-6 py-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white">Completed Mining</h2>
                        </div>
                        <div class="divide-y divide-gray-700">
                            @forelse($completedMinings as $mining)
                                <div class="p-6 flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="text-white font-medium">{{ $mining->plan->name }}</div>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Completed
                                            </span>
                                        </div>
                                        <div class="text-gray-400 text-sm space-y-1">
                                            <div>Invested: {{ $mining->formatted_amount_invested }}</div>
                                            <div>Total Mined: {{ $mining->formatted_total_mined }}</div>
                                            <div>Ended: {{ $mining->end_date ? $mining->end_date->format('M d, Y') : 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('user.mining.show', $mining) }}" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded text-sm font-medium transition-colors">
                                        Details
                                    </a>
                                </div>
                            @empty
                                <div class="p-6 text-gray-400 text-center">
                                    <p>No completed mining subscriptions yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow">
                        <div class="px-6 py-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white">Quick Stats</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Active Mining:</span>
                                <span class="text-white font-semibold">{{ $activeMinings->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Total Invested:</span>
                                <span class="text-white font-semibold">
                                    @php
                                        $totalInvested = $activeMinings->sum('amount_invested');
                                        echo number_format($totalInvested, 2);
                                    @endphp
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Total Mined:</span>
                                <span class="text-green-400 font-semibold">
                                    @php
                                        $totalMined = $activeMinings->sum('total_mined') + $completedMinings->sum('total_mined');
                                        echo number_format($totalMined, 8);
                                    @endphp
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Mining Platforms -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow">
                        <div class="px-6 py-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white">Popular Platforms</h2>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="#" class="flex items-center justify-between p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-colors">
                                <div>
                                    <div class="text-white font-medium">NiceHash</div>
                                    <div class="text-gray-400 text-sm">Cloud Mining Platform</div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                            <a href="#" class="flex items-center justify-between p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-colors">
                                <div>
                                    <div class="text-white font-medium">Genesis Mining</div>
                                    <div class="text-gray-400 text-sm">Cloud Mining Service</div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                            <a href="#" class="flex items-center justify-between p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-colors">
                                <div>
                                    <div class="text-white font-medium">Hashflare</div>
                                    <div class="text-gray-400 text-sm">Mining Contracts</div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Mining Tips -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow">
                        <div class="px-6 py-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white">Mining Tips</h2>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-medium">Diversify Your Mining</h4>
                                    <p class="text-gray-400 text-sm">Spread your investment across different cryptocurrencies</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-medium">Monitor Performance</h4>
                                    <p class="text-gray-400 text-sm">Regularly check your mining progress and profitability</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-medium">Consider Electricity Costs</h4>
                                    <p class="text-gray-400 text-sm">Factor in power consumption when calculating profitability</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('dashboard.layout.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Mining Dashboard</h1>
                        <p class="text-gray-400">Start mining cryptocurrency with our professional mining solutions</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('user.mining.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Start Mining
                        </a>
                        <a href="{{ route('user.mining.statistics') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Statistics
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Available Mining Plans -->
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow">
                        <div class="px-6 py-4 border-b border-gray-700">
                            <h2 class="text-lg font-semibold text-white">Available Mining Plans</h2>
                        </div>
                        <div class="p-6">
                            @if($miningPlans->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($miningPlans as $plan)
                                        <div class="bg-gray-700 rounded-lg p-6 border border-gray-600 hover:border-blue-500 transition-colors">
                                            <div class="flex justify-between items-start mb-4">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-white">{{ $plan->name }}</h3>
                                                    <p class="text-gray-400 text-sm">{{ $plan->description }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-white">${{ number_format($plan->price, 2) }}</div>
                                                    @if($plan->original_price && $plan->original_price > $plan->price)
                                                        <div class="text-sm text-gray-400 line-through">${{ number_format($plan->original_price, 2) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="space-y-3 mb-6">
                                                @if($plan->hashrate)
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                    <span class="text-gray-300 text-sm">{{ $plan->hashrate }}</span>
                                                </div>
                                                @endif
                                                
                                                @if($plan->equipment)
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                    <span class="text-gray-300 text-sm">{{ $plan->equipment }}</span>
                                                </div>
                                                @endif
                                                
                                                @if($plan->downtime)
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-gray-300 text-sm">{{ $plan->downtime }}</span>
                                                </div>
                                                @endif
                                                
                                                @if($plan->electricity_costs)
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                    <span class="text-gray-300 text-sm">{{ $plan->electricity_costs }}</span>
                                                </div>
                                                @endif
                                                
                                                @if($plan->mining_duration)
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span class="text-gray-300 text-sm">{{ $plan->mining_duration }} days</span>
                                                </div>
                                                @endif
                                            </div>
                                            
                                            <div class="flex space-x-2">
                                                <a href="{{ route('user.mining.create') }}?plan={{ $plan->id }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm font-medium text-center transition-colors">
                                                    Start Mining
                                                </a>
                                                @if($plan->features)
                                                    <button class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded text-sm font-medium transition-colors">
                                                        Details
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="text-gray-400 mb-4">
                                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-white mb-2">No Mining Plans Available</h3>
                                    <p class="text-gray-400">Check back later for new mining opportunities.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Active Mining Subscriptions -->
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
                                            <div>Mined: {{ $mining->formatted_total_mined }}</div>
                                            <div>Hashrate: {{ $mining->formatted_hashrate }}</div>
                                            @if($mining->end_date)
                                                <div>Ends: {{ $mining->end_date->format('M d, Y') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col space-y-2 ml-4">
                                        <a href="{{ route('user.mining.show', $mining) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm font-medium transition-colors">
                                            View
                                        </a>
                                        <form method="POST" action="{{ route('user.mining.withdraw', $mining) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded text-sm font-medium transition-colors">
                                                Withdraw
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-gray-400 text-center">
                                    <div class="mb-4">
                                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <p>No active mining subscriptions.</p>
                                    <a href="{{ route('user.mining.create') }}" class="text-blue-400 hover:text-blue-300 mt-2 inline-block">
                                        Start your first mining
                                    </a>
                                </div>
                            @endforelse
                        </div>
                        @if($activeMinings->hasPages())
                            <div class="px-6 py-4 border-t border-gray-700">
                                {{ $activeMinings->links() }}
                            </div>
                        @endif
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
                        @if($completedMinings->hasPages())
                            <div class="px-6 py-4 border-t border-gray-700">
                                {{ $completedMinings->links() }}
                            </div>
                        @endif
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
                                    <div class="text-gray-400 text-sm">Cloud Mining Solutions</div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

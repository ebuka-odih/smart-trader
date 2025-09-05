@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-white">Plan Management</h1>
                <p class="text-gray-400 mt-1">Manage all trading, signal, staking, and mining plans</p>
            </div>
            
            <!-- Create Plan Button -->
            <div class="flex space-x-3">
                <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors flex items-center space-x-2 shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Create Plan</span>
                </button>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabs -->
        <div class="bg-gray-800 rounded-xl p-2 shadow-lg">
            <div class="flex flex-wrap space-x-1">
                <button onclick="switchTab('trading')" id="tab-trading" class="tab-button flex-1 min-w-0 py-3 px-4 rounded-lg font-medium transition-all duration-200 text-sm sm:text-base">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                        <span>Trading Plans</span>
                    </div>
                </button>
                <button onclick="switchTab('signal')" id="tab-signal" class="tab-button flex-1 min-w-0 py-3 px-4 rounded-lg font-medium transition-all duration-200 text-sm sm:text-base">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Signal Plans</span>
                    </div>
                </button>
                <button onclick="switchTab('staking')" id="tab-staking" class="tab-button flex-1 min-w-0 py-3 px-4 rounded-lg font-medium transition-all duration-200 text-sm sm:text-base">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Staking Plans</span>
                    </div>
                </button>
                <button onclick="switchTab('mining')" id="tab-mining" class="tab-button flex-1 min-w-0 py-3 px-4 rounded-lg font-medium transition-all duration-200 text-sm sm:text-base">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Mining Plans</span>
                    </div>
                </button>
            </div>
        </div>

    <!-- Tab Content -->
    <div class="space-y-6">
        <!-- Trading Plans Tab -->
        <div id="content-trading" class="tab-content">
            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg">
                <div class="px-6 py-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-white">Trading Plans</h2>
                            <p class="text-gray-400 text-sm">Manage trading plan configurations</p>
                        </div>
                        <button onclick="openCreateModal('trading')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center space-x-2 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Create Trading Plan</span>
                        </button>
                    </div>
                </div>
                
                @if($tradingPlans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Funding Range</th>
                                    <th class="hidden lg:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Leverage</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($tradingPlans as $plan)
                                    <tr class="hover:bg-gray-700 transition-colors duration-150">
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="text-sm font-medium text-white">{{ $plan->name }}</div>
                                            <div class="text-sm text-gray-400 truncate max-w-xs">{{ $plan->description }}</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="text-lg font-bold text-blue-400">{{ $plan->currency }} {{ number_format($plan->min_funding, 2) }}</div>
                                            <div class="text-xs text-gray-400">
                                                @if($plan->hasUnlimitedFunding())
                                                    - Unlimited
                                                @else
                                                    - {{ $plan->currency }} {{ number_format($plan->max_funding, 2) }}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="hidden lg:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            {{ $plan->leverage ? number_format($plan->leverage, 2) : 'N/A' }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <!-- View/Edit Button -->
                                                <button type="button" onclick="openEditModal({{ $plan->id }})" class="inline-flex items-center px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-700 text-white">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </button>

                                                <!-- Activate/Deactivate -->
                                                <form action="{{ route('admin.plans.toggle-status', $plan) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-md {{ $plan->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white">
                                                        {{ $plan->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-md bg-red-600 hover:bg-red-700 text-white">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <div class="text-gray-400 mb-6">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">No Trading Plans</h3>
                        <p class="text-gray-400 mb-6">Get started by creating your first trading plan.</p>
                        <button onclick="openCreateModal('trading')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors shadow-lg">
                            Create Trading Plan
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Signal Plans Tab -->
        <div id="content-signal" class="tab-content hidden">
            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg">
                <div class="px-6 py-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-white">Signal Plans</h2>
                            <p class="text-gray-400 text-sm">Manage signal plan configurations</p>
                        </div>
                        <button onclick="openCreateModal('signal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center space-x-2 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Create Signal Plan</span>
                        </button>
                    </div>
                </div>
                
                @if($signalPlans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                                    <th class="hidden">Signals</th>
                                    <th class="hidden">Duration</th>
                                    <th class="hidden">Market Type</th>
                                    <th class="hidden">Signal Strength</th>
                                    <th class="hidden">Daily Signals</th>
                                    <th class="hidden">Success Rate</th>
                                    <th class="hidden">Max Daily Signals</th>
                                    <th class="hidden">Features</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @php
                                    // Build a lightweight map for client-side edit prefill
                                    $__plan_map = [];
                                @endphp
                                @foreach($signalPlans as $plan)
                                    @php
                                        $__plan_map[$plan->id] = [
                                            'id' => $plan->id,
                                            'type' => $plan->type,
                                            'name' => $plan->name,
                                            'description' => $plan->description,
                                            'currency' => $plan->currency,
                                            'price' => $plan->price,
                                            'sort_order' => $plan->sort_order,
                                            'signal_quantity' => $plan->signal_quantity,
                                            'signal_duration' => $plan->signal_duration,
                                            'signal_strength' => $plan->signal_strength,
                                            'success_rate' => $plan->success_rate,
                                            'daily_signals' => $plan->daily_signals,
                                            'max_daily_signals' => $plan->max_daily_signals,
                                            'signal_market_type' => $plan->signal_market_type,
                                            'signal_features' => $plan->signal_features,
                                            'update_url' => route('admin.plans.update', $plan),
                                        ];
                                    @endphp
                                    <tr class="hover:bg-gray-700 transition-colors duration-150">
                                        <td class="px-4 sm:px-6 py-4">
                                            <div class="text-sm font-medium text-white">{{ $plan->name }}</div>
                                            <div class="text-sm text-gray-400 truncate max-w-xs">{{ $plan->description }}</div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            <div class="text-sm font-semibold text-white">{{ $plan->formatted_price }}</div>
                                        </td>
                                        <td class="hidden sm:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->signal_quantity)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $plan->signal_quantity }}
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="hidden lg:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->signal_duration)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $plan->signal_duration }} days
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="hidden xl:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->signal_market_type)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ ucfirst($plan->signal_market_type) }}
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="hidden lg:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->signal_strength)
                                                <div class="flex items-center">
                                                    <span class="text-yellow-400 mr-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $plan->signal_strength)
                                                                ★
                                                            @else
                                                                ☆
                                                            @endif
                                                        @endfor
                                                    </span>
                                                    <span class="text-xs text-gray-400">({{ $plan->signal_strength }}/5)</span>
                                                </div>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="hidden xl:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->daily_signals)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $plan->daily_signals }}/day
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="hidden xl:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->success_rate)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                    {{ number_format($plan->success_rate, 1) }}%
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="hidden xl:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->max_daily_signals)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                    {{ $plan->max_daily_signals }}
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="hidden xl:table-cell px-4 sm:px-6 py-4 text-sm text-gray-300">
                                            @if($plan->signal_features && is_array($plan->signal_features) && count($plan->signal_features) > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach(array_slice($plan->signal_features, 0, 3) as $feature)
                                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            {{ $feature }}
                                                        </span>
                                                    @endforeach
                                                    @if(count($plan->signal_features) > 3)
                                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            +{{ count($plan->signal_features) - 3 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-4 sm:px-6 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <!-- View/Edit Button -->
                                                <button type="button" onclick="openEditModal({{ $plan->id }})" class="inline-flex items-center px-3 py-1.5 rounded-md bg-blue-600 hover:bg-blue-700 text-white">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </button>

                                                <!-- Activate/Deactivate -->
                                                <form action="{{ route('admin.plans.toggle-status', $plan) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-md {{ $plan->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white">
                                                        {{ $plan->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-md bg-red-600 hover:bg-red-700 text-white">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <script>
                                    window.__PLAN_MAP = @json($__plan_map);
                                </script>
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <div class="text-gray-400 mb-6">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">No Signal Plans</h3>
                        <p class="text-gray-400 mb-6">Get started by creating your first signal plan.</p>
                        <button onclick="openCreateModal('signal')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors shadow-lg">
                            Create Signal Plan
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Staking Plans Tab -->
        <div id="content-staking" class="tab-content hidden">
            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg">
                <div class="px-6 py-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-white">Staking Plans</h2>
                            <p class="text-gray-400 text-sm">Manage staking plan configurations</p>
                        </div>
                        <button onclick="openCreateModal('staking')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center space-x-2 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Create Staking Plan</span>
                        </button>
                    </div>
                </div>
                
                @if($stakingPlans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">APY Rate</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Min Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($stakingPlans as $plan)
                                    <tr class="hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">{{ $plan->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $plan->description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white">{{ $plan->formatted_price }}</div>
                                            @if($plan->has_discount)
                                                <div class="text-xs text-gray-400 line-through">{{ $plan->formatted_original_price }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $plan->apy_rate ? "{$plan->apy_rate}%" : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $plan->minimum_amount ? "$" . number_format($plan->minimum_amount, 2) : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.plans.edit', $plan) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                                <form action="{{ route('admin.plans.toggle-status', $plan) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-yellow-400 hover:text-yellow-300">
                                                        {{ $plan->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-8 text-center">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">No Staking Plans</h3>
                        <p class="text-gray-400 mb-4">Get started by creating your first staking plan.</p>
                        <button onclick="openCreateModal('staking')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Create Staking Plan
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Mining Plans Tab -->
        <div id="content-mining" class="tab-content hidden">
            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg">
                <div class="px-6 py-4 border-b border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-white">Mining Plans</h2>
                            <p class="text-gray-400 text-sm">Manage mining plan configurations</p>
                        </div>
                        <button onclick="openCreateModal('mining')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center space-x-2 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Create Mining Plan</span>
                        </button>
                    </div>
                </div>
                
                @if($miningPlans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Hashrate</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Equipment</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($miningPlans as $plan)
                                    <tr class="hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">{{ $plan->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $plan->description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white">{{ $plan->formatted_price }}</div>
                                            @if($plan->has_discount)
                                                <div class="text-xs text-gray-400 line-through">{{ $plan->formatted_original_price }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $plan->hashrate ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $plan->equipment ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.plans.edit', $plan) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                                <form action="{{ route('admin.plans.toggle-status', $plan) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-yellow-400 hover:text-yellow-300">
                                                        {{ $plan->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-8 text-center">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">No Mining Plans</h3>
                        <p class="text-gray-400 mb-4">Get started by creating your first mining plan.</p>
                        <button onclick="openCreateModal('mining')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Create Mining Plan
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Create Plan Modal -->
<div id="createPlanModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col border border-gray-200 dark:border-gray-700">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 rounded-t-2xl flex-shrink-0">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white" id="modalTitle">Create Plan</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Configure your new plan settings</p>
                </div>
                <button onclick="closeCreateModal()" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body - Scrollable -->
            <div class="flex-1 overflow-y-auto p-6">
                    
                @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Please fix the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                
                <form id="createPlanForm" action="{{ route('admin.plans.store') }}" data-default-action="{{ route('admin.plans.store') }}" method="POST" class="space-y-6" onsubmit="return validateForm()">
                    @csrf
                    
                    <!-- Basic Plan Information -->
                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Basic Information
                        </h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="modal_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Plan Type <span class="text-red-500">*</span></label>
                                <select id="modal_type" name="type" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" onchange="showTypeSpecificFields()">
                                    <option value="">Select Plan Type</option>
                                    <option value="trading">Trading</option>
                                    <option value="signal">Signal</option>
                                    <option value="staking">Staking</option>
                                    <option value="mining">Mining</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="modal_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Plan Name <span class="text-red-500">*</span></label>
                                <input type="text" id="modal_name" name="name" required class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="Enter plan name">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="modal_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                            <textarea id="modal_description" name="description" rows="3" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none" placeholder="Plan description..."></textarea>
                        </div>
                    </div>

                    <!-- Pricing (for non-signal plans) -->
                    <div id="modal_pricing_fields" class="type-specific-fields">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                </svg>
                                Pricing & Funding
                            </h4>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div>
                                    <label for="modal_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price <span class="text-red-500">*</span></label>
                                    <input type="number" id="modal_price" name="price" step="0.01" min="0" required class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="0.00">
                                </div>
                                
                                <div>
                                    <label for="modal_currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Currency</label>
                                    <select id="modal_currency" name="currency" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="JPY">JPY</option>
                                        <option value="CAD">CAD</option>
                                        <option value="AUD">AUD</option>
                                        <option value="CHF">CHF</option>
                                        <option value="CNY">CNY</option>
                                        <option value="SGD">SGD</option>
                                        <option value="NZD">NZD</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="modal_original_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Original Price <span class="text-gray-500 text-xs">(Optional)</span></label>
                                    <input type="number" id="modal_original_price" name="original_price" step="0.01" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="0.00">
                                </div>
                            </div>

                            <!-- Funding Range -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="modal_min_funding" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Min Funding <span class="text-red-500">*</span></label>
                                    <input type="number" id="modal_min_funding" name="min_funding" step="0.01" min="0" required class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="0.00">
                                </div>
                                
                                <div>
                                    <label for="modal_max_funding" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Max Funding <span class="text-gray-500 text-xs">(Optional)</span></label>
                                    <input type="number" id="modal_max_funding" name="max_funding" step="0.01" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="0.00 for unlimited">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Leave empty or set to 0 for unlimited funding</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signal Pricing (for signal plans only) -->
                    <div id="modal_signal_pricing" class="type-specific-fields hidden">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Signal Pricing
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="modal_signal_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Signal Amount <span class="text-red-500">*</span></label>
                                    <input type="number" id="modal_signal_amount" name="min_funding" step="0.01" min="0" required class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="0.00">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Amount users pay for signal entry</p>
                                </div>
                                
                                <div>
                                    <label for="modal_signal_currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Currency</label>
                                    <select id="modal_signal_currency" name="currency" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="JPY">JPY</option>
                                        <option value="CAD">CAD</option>
                                        <option value="AUD">AUD</option>
                                        <option value="CHF">CHF</option>
                                        <option value="CNY">CNY</option>
                                        <option value="SGD">SGD</option>
                                        <option value="NZD">NZD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trading Plan Specific Fields -->
                    <div id="modal_trading-fields" class="type-specific-fields hidden">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                </svg>
                                Trading Plan Settings
                            </h4>
                            
                            <!-- First Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="modal_pairs" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Trading Pairs</label>
                                    <input type="text" id="modal_pairs" name="pairs" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 50+ Trading Pairs">
                                </div>
                                
                                <div>
                                    <label for="modal_leverage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Leverage</label>
                                    <input type="text" id="modal_leverage" name="leverage" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 100.00">
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="modal_spreads" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Spreads</label>
                                    <input type="text" id="modal_spreads" name="spreads" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 1.5">
                                </div>
                                
                                <div>
                                    <label for="modal_swap_fees" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Swap Fees</label>
                                    <input type="text" id="modal_swap_fees" name="swap_fees" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 2.5">
                                </div>
                            </div>

                            <!-- Third Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="modal_minimum_deposit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Minimum Deposit</label>
                                    <input type="number" id="modal_minimum_deposit" name="minimum_deposit" step="0.01" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="0.00">
                                </div>
                                
                                <div>
                                    <label for="modal_max_lot_size" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Max Lot Size</label>
                                    <input type="text" id="modal_max_lot_size" name="max_lot_size" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 10 lots">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signal Plan Specific Fields -->
                    <div id="modal_signal-fields" class="type-specific-fields hidden">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Signal Plan Settings
                            </h4>
                            
                            <!-- First Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="modal_signal_strength" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Signal Strength (1-5)</label>
                                    <input type="number" id="modal_signal_strength" name="signal_strength" min="1" max="5" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 4">
                                </div>
                                
                                <div>
                                    <label for="modal_daily_signals" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Daily Signals</label>
                                    <input type="number" id="modal_daily_signals" name="daily_signals" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 2">
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="modal_success_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Success Rate (%)</label>
                                    <input type="number" id="modal_success_rate" name="success_rate" step="0.01" min="0" max="100" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 85.5">
                                </div>
                                
                                <div>
                                    <label for="modal_signal_duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration (Days)</label>
                                    <input type="number" id="modal_signal_duration" name="signal_duration" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 30">
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>

                    <!-- Mining Plan Specific Fields -->
                    <div id="modal_mining-fields" class="type-specific-fields hidden">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                </svg>
                                Mining Plan Settings
                            </h4>
                            
                            <!-- First Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="modal_hashrate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hashrate</label>
                                    <input type="text" id="modal_hashrate" name="hashrate" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 1000 TH/s">
                                </div>
                                
                                <div>
                                    <label for="modal_equipment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Equipment</label>
                                    <input type="text" id="modal_equipment" name="equipment" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 10 Antminer S19">
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="modal_downtime" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Downtime</label>
                                    <input type="text" id="modal_downtime" name="downtime" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 99.9% Uptime">
                                </div>
                                
                                <div>
                                    <label for="modal_electricity_costs" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Electricity Costs</label>
                                    <input type="text" id="modal_electricity_costs" name="electricity_costs" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., Included">
                                </div>
                            </div>

                            <!-- Third Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="modal_mining_duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration (Days)</label>
                                    <input type="number" id="modal_mining_duration" name="mining_duration" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 30">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Staking Plan Specific Fields -->
                    <div id="modal_staking-fields" class="type-specific-fields hidden">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                </svg>
                                Staking Plan Settings
                            </h4>
                            
                            <!-- First Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="modal_apy_rate" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">APY Rate (%)</label>
                                    <input type="number" id="modal_apy_rate" name="apy_rate" step="0.01" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 12.5">
                                </div>
                                
                                <div>
                                    <label for="modal_minimum_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Minimum Amount</label>
                                    <input type="number" id="modal_minimum_amount" name="minimum_amount" step="0.01" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 100.00">
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="modal_reward_frequency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Reward Frequency</label>
                                    <input type="text" id="modal_reward_frequency" name="reward_frequency" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., Daily">
                                </div>
                                
                                <div>
                                    <label for="modal_lock_period" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lock Period (Days)</label>
                                    <input type="number" id="modal_lock_period" name="lock_period" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 30">
                                </div>
                            </div>

                            <!-- Third Row -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="modal_staking_duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Staking Duration (Days)</label>
                                    <input type="number" id="modal_staking_duration" name="staking_duration" min="0" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="e.g., 365">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Status & Actions -->
                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Plan Status & Actions
                        </h4>
                        
                        <div class="space-y-4">
                            <!-- Plan Status -->
                            <div class="flex items-center">
                                <input type="checkbox" id="modal_is_active" name="is_active" value="1" checked class="w-5 h-5 text-blue-600 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2 transition-all duration-200">
                                <label for="modal_is_active" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Active Plan</label>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Uncheck to create an inactive plan that won't be visible to users</p>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200 dark:border-gray-600">
                                <button type="button" onclick="closeCreateModal()" class="w-full sm:w-auto bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-6 py-3 rounded-lg font-medium transition-all duration-200">
                                    Cancel
                                </button>
                                <button type="submit" form="createPlanForm" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                                    Create Plan
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</div>

<script>
// Tab functionality
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
        button.classList.add('text-gray-400', 'hover:text-white', 'hover:bg-gray-700');
    });
    
    // Show selected tab content
    document.getElementById(`content-${tabName}`).classList.remove('hidden');
    
    // Add active class to selected tab button
    const activeButton = document.getElementById(`tab-${tabName}`);
    activeButton.classList.remove('text-gray-400', 'hover:text-white', 'hover:bg-gray-700');
    activeButton.classList.add('bg-blue-600', 'text-white', 'shadow-lg');
    
    // Update URL without page reload
    const url = new URL(window.location);
    url.searchParams.set('tab', tabName);
    window.history.pushState({}, '', url);
}

// Initialize with active tab
document.addEventListener('DOMContentLoaded', function() {
    const activeTab = '{{ $activeTab }}';
    
    // Set initial state for all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.add('text-gray-400', 'hover:text-white', 'hover:bg-gray-700');
    });
    
    // Switch to active tab
    switchTab(activeTab);
    
    // Add hover effects for better UX
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('mouseenter', function() {
            if (!this.classList.contains('bg-blue-600')) {
                this.classList.add('bg-gray-700');
            }
        });
        
        button.addEventListener('mouseleave', function() {
            if (!this.classList.contains('bg-blue-600')) {
                this.classList.remove('bg-gray-700');
            }
        });
    });
});

// Create plan modal functionality
function openCreateModal(type = null) {
    const modal = document.getElementById('createPlanModal');
    const modalTitle = document.getElementById('modalTitle');
    const typeSelect = document.getElementById('modal_type');
    
    // Set the plan type if provided
    if (type) {
        typeSelect.value = type;
        modalTitle.textContent = `Create ${type.charAt(0).toUpperCase() + type.slice(1)} Plan`;
    } else {
        modalTitle.textContent = 'Create Plan';
    }
    
    // Show the modal
    modal.classList.remove('hidden');
    
    // Show type-specific fields
    showTypeSpecificFields();
}

function closeCreateModal() {
    const modal = document.getElementById('createPlanModal');
    const form = document.getElementById('createPlanForm');
    modal.classList.add('hidden');
    
    // Reset form and restore action/method
    form.reset();
    const defaultAction = form.getAttribute('data-default-action') || form.action;
    form.action = defaultAction;
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) methodInput.remove();
    
    // Hide all type-specific fields
    document.querySelectorAll('.type-specific-fields').forEach(field => {
        field.classList.add('hidden');
    });
}

// Edit existing plan (prefill form and switch to PUT)
function openEditModal(planId) {
    const form = document.getElementById('createPlanForm');
    const modal = document.getElementById('createPlanModal');
    const modalTitle = document.getElementById('modalTitle');
    const typeSelect = document.getElementById('modal_type');
    const plan = window.__PLAN_MAP ? window.__PLAN_MAP[planId] : null;
    if (!plan) { alert('Unable to load this plan for editing.'); return; }
    
    // Switch action and method
    form.action = plan.update_url;
    let methodInput = form.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'PUT';
    
    // Base fields
    document.getElementById('modal_name').value = plan.name || '';
    document.getElementById('modal_description').value = plan.description || '';
    document.getElementById('modal_currency').value = plan.currency || 'USD';
    document.getElementById('modal_price').value = plan.price ?? 0;
    document.getElementById('modal_sort_order').value = plan.sort_order ?? 0;
    
    // Type and type-specific fields
    typeSelect.value = plan.type;
    showTypeSpecificFields();
    modalTitle.textContent = `Edit ${plan.type.charAt(0).toUpperCase() + plan.type.slice(1)} Plan`;
    
    if (plan.type === 'signal') {
        const qty = document.getElementById('modal_signal_quantity');
        const dur = document.getElementById('modal_signal_duration');
        const str = document.getElementById('modal_signal_strength');
        const rate = document.getElementById('modal_success_rate');
        const daily = document.getElementById('modal_daily_signals');
        const maxDaily = document.getElementById('modal_max_daily_signals');
        const market = document.getElementById('modal_signal_market_type') || document.getElementById('modal_market_type');
        const features = document.getElementById('modal_signal_features');
        if (qty) qty.value = plan.signal_quantity ?? '';
        if (dur) dur.value = plan.signal_duration ?? '';
        if (str) str.value = plan.signal_strength ?? '';
        if (rate) rate.value = plan.success_rate ?? '';
        if (daily) daily.value = plan.daily_signals ?? '';
        if (maxDaily) maxDaily.value = plan.max_daily_signals ?? '';
        if (market) market.value = plan.signal_market_type ?? '';
        if (features) features.value = JSON.stringify(plan.signal_features || []);
    }
    
    // Show modal
    modal.classList.remove('hidden');
}

// Modal field visibility function
function showTypeSpecificFields() {
    const type = document.getElementById('modal_type').value;
    
    // Hide all type-specific fields
    document.querySelectorAll('.type-specific-fields').forEach(field => {
        field.classList.add('hidden');
    });
    
    // Show fields for selected type
    if (type) {
        const targetField = document.getElementById(`modal_${type}-fields`);
        if (targetField) {
            targetField.classList.remove('hidden');
        }
        
        // Show/hide market type container and pricing fields based on plan type
        const marketTypeContainer = document.getElementById('modal_market_type_container');
        const pricingFields = document.getElementById('modal_pricing_fields');
        const signalPricing = document.getElementById('modal_signal_pricing');
        
        if (type === 'signal') {
            marketTypeContainer.classList.remove('hidden');
            pricingFields.classList.add('hidden'); // Hide regular pricing for signal plans
            signalPricing.classList.remove('hidden'); // Show signal-specific pricing
        } else {
            marketTypeContainer.classList.add('hidden');
            pricingFields.classList.remove('hidden');
            signalPricing.classList.add('hidden');
        }
    }
}



// Add responsive table functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add responsive behavior for tables
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        const wrapper = document.createElement('div');
        wrapper.className = 'overflow-x-auto';
        table.parentNode.insertBefore(wrapper, table);
        wrapper.appendChild(table);
    });
});

// Form validation function
function validateForm() {
    const form = document.getElementById('createPlanForm');
    const formData = new FormData(form);
    
    // Basic validation
    const planType = formData.get('type');
    const planName = formData.get('name');
    const price = formData.get('price');
    
    if (!planType) {
        alert('Please select a plan type');
        return false;
    }
    
    if (!planName || planName.trim() === '') {
        alert('Please enter a plan name');
        return false;
    }
    
    if (!price || price <= 0) {
        alert('Please enter a valid price');
        return false;
    }
    
    return true;
}
</script>
@endsection

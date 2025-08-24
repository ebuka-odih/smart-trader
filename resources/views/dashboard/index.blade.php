@extends('dashboard.layout.app')
@section('content')

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard</h1>
            <p class="text-gray-400 mt-1">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
    </div>

        <!-- First Row: Balance & Trading Strength -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Balance Card -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 h-full">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Wallet Overview</h3>
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                    </svg>
                </div>
            </div>
            
            @php
                $walletBalance = auth()->user()->balance ?? 0;
                $tradingBalance = auth()->user()->trading_balance ?? 0;
                $holdings = auth()->user()->holding_balance ?? 0;
                $staking = auth()->user()->staking_balance ?? 0;
                $totalPortfolio = $walletBalance + $tradingBalance + $holdings + $staking;
            @endphp

            <!-- Total Balance -->
            <div class="mb-6">
                <div class="text-3xl font-bold text-white animate-pulse">${{ number_format($totalPortfolio, 2) }}</div>
                <div class="text-sm text-gray-400">Total Portfolio Value</div>
            </div>

            <!-- Balance Breakdown -->
            <div class="space-y-3 mb-4">
                <div class="flex justify-between items-center py-2 px-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-sm text-gray-300">Wallet Balance</span>
                    </div>
                    <span class="text-sm font-semibold text-white">${{ number_format($walletBalance, 2) }}</span>
                </div>
                
                <div class="flex justify-between items-center py-2 px-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                        <span class="text-sm text-gray-300">Trading Balance</span>
                    </div>
                    <span class="text-sm font-semibold text-white">${{ number_format($tradingBalance, 2) }}</span>
                </div>
                
                <div class="flex justify-between items-center py-2 px-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                        <span class="text-sm text-gray-300">Holdings</span>
                    </div>
                    <span class="text-sm font-semibold text-white">${{ number_format($holdings, 2) }}</span>
                </div>
                
                <div class="flex justify-between items-center py-2 px-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-300 transform hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-purple-500 rounded-full animate-pulse" style="animation-delay: 1.5s;"></div>
                        <span class="text-sm text-gray-300">Staking</span>
                    </div>
                    <span class="text-sm font-semibold text-white">${{ number_format($staking, 2) }}</span>
                </div>
            </div>

            <!-- Wallet Status -->
            <div class="border-t border-gray-700 pt-3">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-400">Wallet Status</span>
                    <span class="text-green-400 font-medium flex items-center">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse mr-1"></span>
                        Active
                    </span>
                </div>
                <div class="flex items-center justify-between text-xs mt-1">
                    <span class="text-gray-400">Last Updated</span>
                    <span class="text-gray-300">{{ now()->format('M d, H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Trading Strength Card -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700 h-full flex flex-col">
            <!-- Top Section: Trading Strength (Mobile: Full, Desktop: Top Half) -->
            <div class="lg:flex-1">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Trading Strength</h3>
                    <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="text-3xl font-bold text-purple-400">85%</div>
                    <div class="text-sm text-gray-400">Strong Performance</div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Win Rate</span>
                        <span class="text-white">78%</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Total Trades</span>
                        <span class="text-white">156</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Avg. Profit</span>
                        <span class="text-green-400">+$245.30</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Subscription State (Desktop Only) -->
            <div class="hidden lg:block lg:flex-1 lg:mt-6 lg:pt-6 lg:border-t lg:border-gray-700">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-sm font-semibold text-gray-300">Subscription Status</h4>
                    <div class="w-6 h-6 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Active Plans</span>
                        <span class="text-green-400 font-semibold">7</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Premium Status</span>
                        <span class="text-blue-400 font-semibold">Active</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Next Renewal</span>
                        <span class="text-white">Dec 15, 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row: My Subscriptions -->
    <div class="mb-6">
        <!-- User Subscriptions Card -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">My Subscriptions</h3>
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Trading Plans</span>
                    <span class="text-blue-400 font-semibold">2 Active</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Signal Plans</span>
                    <span class="text-green-400 font-semibold">1 Active</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Staking Plans</span>
                    <span class="text-purple-400 font-semibold">3 Active</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Mining Plans</span>
                    <span class="text-orange-400 font-semibold">1 Active</span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-gray-700">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Total Subscriptions</span>
                    <span class="text-white font-semibold">7 Active</span>
                </div>
            </div>
        </div>
    </div>

        <!-- Second Row: Trades Tabs -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
                <!-- Tabs Header -->
                <div class="border-b border-gray-700">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button id="openTradesTab" class="tab-button active py-4 px-1 border-b-2 border-blue-500 text-blue-400 font-medium text-sm">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Open Trades</span>
                            </div>
                        </button>
                        <button id="closedTradesTab" class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-400 hover:text-gray-300 font-medium text-sm">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Closed Trades</span>
                            </div>
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Open Trades Tab -->
                    <div id="openTradesContent" class="tab-content active">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Pair</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Leverage</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Entry Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Current P&L</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Action</th>
                                </tr>
                                </thead>
                                <tbody class="bg-gray-800 divide-y divide-gray-700">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">BTC/USD</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">BUY</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$1,000</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">10x</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$45,230</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">+$156.80</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-red-400 hover:text-red-300">Close</button>
                                            </td>
                                </tr>
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">ETH/USD</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">SELL</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$500</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">20x</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$3,240</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-400">-$89.50</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-red-400 hover:text-red-300">Close</button>
                                        </td>
                                </tr>
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">ADA/USD</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">BUY</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$750</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">15x</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$0.48</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">+$234.20</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="text-red-400 hover:text-red-300">Close</button>
                                        </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Closed Trades Tab -->
                    <div id="closedTradesContent" class="tab-content hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Pair</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Entry Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Exit Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">P&L</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                </tr>
                                </thead>
                                <tbody class="bg-gray-800 divide-y divide-gray-700">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">BTC/USD</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">BUY</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$2,000</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$44,500</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$45,800</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">+$580.40</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">2024-01-15</td>
                                </tr>
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">ETH/USD</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">SELL</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$1,500</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$3,300</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$3,180</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">+$545.45</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">2024-01-14</td>
                                </tr>
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">SOL/USD</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">BUY</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$800</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$98.50</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$95.20</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-400">-$268.02</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">2024-01-13</td>
                                </tr>
                                <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">XRP/USD</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">SELL</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$600</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$0.58</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$0.55</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">+$310.34</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">2024-01-12</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                                                </div>
                                            </div>

    <!-- Mobile Bottom Menu -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-gray-900 border-t border-gray-700 z-50">
        <div class="flex justify-around items-center py-3 px-4">
            <!-- Quick Trade -->
            <a href="{{ route('user.trade.index') }}" class="flex flex-col items-center space-y-1 text-gray-400 hover:text-blue-400 transition-colors">
                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium">Trade</span>
            </a>

            <!-- Deposit -->
            <button id="mobileDepositBtn" class="flex flex-col items-center space-y-1 text-gray-400 hover:text-green-400 transition-colors">
                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors">
                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium">Deposit</span>
            </button>

            <!-- Plans -->
            <a href="{{ route('user.plans.index') }}" class="flex flex-col items-center space-y-1 text-gray-400 hover:text-purple-400 transition-colors">
                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-purple-600 transition-colors">
                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium">Plans</span>
            </a>

            <!-- Copy Trade -->
            <a href="{{ route('user.copyTrading.index') }}" class="flex flex-col items-center space-y-1 text-gray-400 hover:text-orange-400 transition-colors">
                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center hover:bg-orange-600 transition-colors">
                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium">Copy Trade</span>
            </a>
        </div>
    </div>

    <!-- Deposit Modal -->
    <div id="depositModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full border border-gray-700">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-700">
                    <h3 class="text-lg font-semibold text-white">New Deposit</h3>
                    <button id="closeDepositModal" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form id="depositForm" action="{{ route('user.payment') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    
                    <!-- Amount Input -->
                    <div class="mb-6">
                        <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 sm:text-sm">$</span>
                            </div>
                            <input type="number" 
                                   id="amount" 
                                   name="amount" 
                                   step="0.01" 
                                   min="0" 
                                   required
                                   value="{{ old('amount') }}"
                                   class="block w-full pl-7 pr-12 py-3 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0.00">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 sm:text-sm">USD</span>
                            </div>
                        </div>
                    </div>

                    <!-- Wallet Selection -->
                    <div class="mb-6">
                        <label for="wallet_type" class="block text-sm font-medium text-gray-300 mb-2">Select Wallet</label>
                        <select id="wallet_type" 
                                name="wallet_type" 
                                required
                                class="block w-full py-3 px-3 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Choose a wallet</option>
                            <option value="trading" {{ old('wallet_type') == 'trading' ? 'selected' : '' }}>Trading Balance</option>
                            <option value="holding" {{ old('wallet_type') == 'holding' ? 'selected' : '' }}>Holding Balance</option>
                            <option value="staking" {{ old('wallet_type') == 'staking' ? 'selected' : '' }}>Staking Balance</option>
                        </select>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-6">
                        <label for="payment_method_id" class="block text-sm font-medium text-gray-300 mb-2">Payment Method</label>
                        <select id="payment_method_id" 
                                name="payment_method_id" 
                                required
                                class="block w-full py-3 px-3 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select payment method</option>
                            @if(isset($wallets))
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}" {{ old('payment_method_id') == $wallet->id ? 'selected' : '' }}>{{ $wallet->wallet }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Payment Proof -->
                    <div class="mb-6">
                        <label for="proof" class="block text-sm font-medium text-gray-300 mb-2">Payment Proof</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 border-dashed rounded-lg bg-gray-700 hover:bg-gray-600 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-400">
                                    <label for="proof" class="relative cursor-pointer bg-gray-700 rounded-md font-medium text-blue-400 hover:text-blue-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="proof" name="proof" type="file" class="sr-only" required>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                            </div>
                        </div>
                        <div id="filePreview" class="mt-2 text-sm text-gray-400 hidden"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex space-x-3">
                        <button type="button" 
                                id="cancelDepositBtn"
                                class="flex-1 px-4 py-3 border border-gray-600 rounded-lg text-gray-300 hover:bg-gray-700 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            Submit Deposit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
    </div>

</div>

    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const openTradesTab = document.getElementById('openTradesTab');
            const closedTradesTab = document.getElementById('closedTradesTab');
            const openTradesContent = document.getElementById('openTradesContent');
            const closedTradesContent = document.getElementById('closedTradesContent');

            // Open Trades Tab
            openTradesTab.addEventListener('click', function() {
                // Update tab buttons
                openTradesTab.classList.add('active', 'border-blue-500', 'text-blue-400');
                openTradesTab.classList.remove('border-transparent', 'text-gray-400');
                closedTradesTab.classList.remove('active', 'border-blue-500', 'text-blue-400');
                closedTradesTab.classList.add('border-transparent', 'text-gray-400');

                // Update content
                openTradesContent.classList.remove('hidden');
                openTradesContent.classList.add('active');
                closedTradesContent.classList.add('hidden');
                closedTradesContent.classList.remove('active');
            });

            // Closed Trades Tab
            closedTradesTab.addEventListener('click', function() {
                // Update tab buttons
                closedTradesTab.classList.add('active', 'border-blue-500', 'text-blue-400');
                closedTradesTab.classList.remove('border-transparent', 'text-gray-400');
                openTradesTab.classList.remove('active', 'border-blue-500', 'text-blue-400');
                openTradesTab.classList.add('border-transparent', 'text-gray-400');

                // Update content
                closedTradesContent.classList.remove('hidden');
                closedTradesContent.classList.add('active');
                openTradesContent.classList.add('hidden');
                openTradesContent.classList.remove('active');
            });

            // Deposit Modal functionality
            const depositModal = document.getElementById('depositModal');
            const mobileDepositBtn = document.getElementById('mobileDepositBtn');
            const closeDepositModal = document.getElementById('closeDepositModal');
            const cancelDepositBtn = document.getElementById('cancelDepositBtn');
            const depositForm = document.getElementById('depositForm');
            const fileInput = document.getElementById('proof');
            const filePreview = document.getElementById('filePreview');

            // Open deposit modal
            if (mobileDepositBtn) {
                mobileDepositBtn.addEventListener('click', () => {
                    depositModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
            }

            // Close deposit modal functions
            function closeDepositModalFunc() {
                depositModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                depositForm.reset();
                filePreview.classList.add('hidden');
            }

            if (closeDepositModal) {
                closeDepositModal.addEventListener('click', closeDepositModalFunc);
            }
            if (cancelDepositBtn) {
                cancelDepositBtn.addEventListener('click', closeDepositModalFunc);
            }

            // Close modal when clicking outside
            if (depositModal) {
                depositModal.addEventListener('click', (e) => {
                    if (e.target === depositModal) {
                        closeDepositModalFunc();
                    }
                });
            }

            // File upload preview
            if (fileInput) {
                fileInput.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        filePreview.textContent = `Selected: ${file.name}`;
                        filePreview.classList.remove('hidden');
                    } else {
                        filePreview.classList.add('hidden');
                    }
                });
            }

            // Form submission
            if (depositForm) {
                depositForm.addEventListener('submit', (e) => {
                    const amount = document.getElementById('amount').value;
                    const walletType = document.getElementById('wallet_type').value;
                    const paymentMethod = document.getElementById('payment_method_id').value;
                    const proof = fileInput ? fileInput.files[0] : null;

                    if (!amount || !walletType || !paymentMethod || !proof) {
                        e.preventDefault();
                        alert('Please fill in all required fields');
                        return;
                    }

                    // Show loading state
                    const submitBtn = depositForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Submitting...';
                    submitBtn.disabled = true;
                });
            }
        });
    </script>
@endsection

@extends('dashboard.layout.app')
@section('content')

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Dashboard</h1>
            <p class="text-gray-400 mt-1">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-gray-800 rounded-lg px-4 py-2">
                <div class="text-sm text-gray-400">Total Balance</div>
                <div class="text-white font-semibold text-lg">${{ number_format(auth()->user()->balance ?? 0, 2) }}</div>
            </div>
        </div>
    </div>

    <!-- First Row: 4/8 Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Column: 4 cols - User Balance & Trading Strength -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Balance Card -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Account Balance</h3>
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="text-3xl font-bold text-white">${{ number_format(auth()->user()->balance ?? 0, 2) }}</div>
                    <div class="text-sm text-gray-400">Available for trading</div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-16 h-1 bg-gray-600 rounded-full">
                        <div class="w-8 h-1 bg-green-500 rounded-full"></div>
                    </div>
                    <span class="text-sm text-gray-400">0 BALANCE</span>
                </div>
            </div>

            <!-- Trading Strength Card -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
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
        </div>

        <!-- Right Column: 8 cols - Trades Tabs -->
        <div class="lg:col-span-8">
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

    <!-- My Traders Section -->
    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-white">My Traders</h3>
            <span class="text-sm text-gray-400">(0)</span>
        </div>
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                </svg>
            </div>
            <p class="text-gray-400 mb-4">No traders found</p>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Find Traders
            </button>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <h3 class="text-lg font-semibold text-white mb-4">Recent Activity</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-700 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium">Account Created</p>
                        <p class="text-gray-400 text-sm">
                            @if(auth()->user() && auth()->user()->created_at && auth()->user()->created_at instanceof \Carbon\Carbon)
                                {{ auth()->user()->created_at->diffForHumans() }}
                            @else
                                Just now
                            @endif
                        </p>
                    </div>
                </div>
                <span class="text-green-400 text-sm">+$0.00</span>
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
        });
    </script>
@endsection

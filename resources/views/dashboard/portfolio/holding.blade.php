@extends('dashboard.layout.app')

@section('content')
<div class="space-y-6">
    <!-- Investment Stats Card -->
    <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white">Holding Portfolio</h2>
            <div class="text-2xl font-bold text-green-400">${{ number_format($totalBalance, 2) }}</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Total Invested</div>
                <div class="text-white font-semibold text-lg">$24,500.00</div>
                <div class="text-green-400 text-xs">+$2,450.00</div>
            </div>
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Total ROI</div>
                <div class="text-green-400 font-semibold text-lg">+10.2%</div>
                <div class="text-green-400 text-xs">+2.1% this week</div>
            </div>
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Current Value</div>
                <div class="text-blue-400 font-semibold text-lg">$26,950.00</div>
                <div class="text-green-400 text-xs">+$2,450.00 profit</div>
            </div>
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="text-gray-400 text-sm">Assets Held</div>
                <div class="text-purple-400 font-semibold text-lg">8</div>
                <div class="text-gray-400 text-xs">Across 5 categories</div>
            </div>
        </div>
    </div>

    <!-- Assets List -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">Held Assets</h3>
                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Buy Asset
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Asset</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Avg Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Current Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ROI</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    <!-- Bitcoin -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">₿</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Bitcoin</div>
                                    <div class="text-sm text-gray-400">BTC</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">0.25 BTC</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$42,000.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">$45,200.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$11,300.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                +7.6%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>

                    <!-- Ethereum -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">Ξ</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Ethereum</div>
                                    <div class="text-sm text-gray-400">ETH</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">2.5 ETH</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$2,800.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">$3,150.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$7,875.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                +12.5%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>

                    <!-- Cardano -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">₳</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Cardano</div>
                                    <div class="text-sm text-gray-400">ADA</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">5,000 ADA</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$0.45</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-400">$0.42</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$2,100.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                -6.7%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>

                    <!-- Solana -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">◎</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Solana</div>
                                    <div class="text-sm text-gray-400">SOL</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">15 SOL</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$95.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">$108.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$1,620.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                +13.7%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>

                    <!-- Polkadot -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">DOT</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Polkadot</div>
                                    <div class="text-sm text-gray-400">DOT</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">200 DOT</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$6.80</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">$7.25</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$1,450.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                +6.6%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>

                    <!-- Chainlink -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">LINK</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Chainlink</div>
                                    <div class="text-sm text-gray-400">LINK</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">500 LINK</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$12.50</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">$13.80</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$6,900.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                +10.4%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>

                    <!-- Uniswap -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-pink-400 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">UNI</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Uniswap</div>
                                    <div class="text-sm text-gray-400">UNI</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">300 UNI</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$8.20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-400">$7.95</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$2,385.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                -3.0%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>

                    <!-- Polygon -->
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white text-xs font-bold">MATIC</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-white">Polygon</div>
                                    <div class="text-sm text-gray-400">MATIC</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">10,000 MATIC</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">$0.85</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400">$0.92</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">$9,200.00</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                +8.2%
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-400 hover:text-blue-300 mr-3">Sell</a>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Buy More</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Portfolio Summary -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="p-6 border-b border-gray-700">
            <h3 class="text-lg font-semibold text-white">Portfolio Summary</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-medium mb-3">Performance</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Best Performer</span>
                            <span class="text-green-400">Solana (+13.7%)</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Worst Performer</span>
                            <span class="text-red-400">Cardano (-6.7%)</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Avg ROI</span>
                            <span class="text-blue-400">+7.1%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-medium mb-3">Distribution</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Bitcoin</span>
                            <span class="text-white">41.9%</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Ethereum</span>
                            <span class="text-white">29.2%</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Others</span>
                            <span class="text-white">28.9%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-medium mb-3">Quick Actions</h4>
                    <div class="space-y-2">
                        <a href="#" class="block text-sm text-blue-400 hover:text-blue-300">View Transaction History</a>
                        <a href="#" class="block text-sm text-blue-400 hover:text-blue-300">Export Portfolio</a>
                        <a href="#" class="block text-sm text-blue-400 hover:text-blue-300">Set Price Alerts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Footer Menu -->
<div class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 md:hidden z-50">
    <div class="flex justify-around">
        <a href="{{ route('user.portfolio.trade') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.portfolio.trade') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
            </svg>
            <span class="text-xs">Trade</span>
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

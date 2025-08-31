@extends('dashboard.layout.app')

@php
use App\Helpers\AssetHelper;
@endphp

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Holding Overview</h1>
            <p class="text-gray-400 mt-1">Manage your crypto and stock portfolio</p>
        </div>
        <button id="buyAssetBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center sm:justify-start space-x-2 w-full sm:w-auto mt-4 sm:mt-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span>Buy Asset</span>
        </button>
    </div>

    <!-- Portfolio Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Total Value</h3>
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-white">${{ number_format($total_value ?? 0, 2) }}</div>
            <div class="text-sm text-gray-400 mt-1">Current portfolio value</div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Total Invested</h3>
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-white">${{ number_format($total_invested ?? 0, 2) }}</div>
            <div class="text-sm text-gray-400 mt-1">Total amount invested</div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Total P&L</h3>
                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold {{ ($total_pnl ?? 0) >= 0 ? 'text-green-400' : 'text-red-400' }}">
                ${{ number_format($total_pnl ?? 0, 2) }}
            </div>
            <div class="text-sm text-gray-400 mt-1">Unrealized profit/loss</div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">P&L %</h3>
                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold {{ ($total_pnl_percentage ?? 0) >= 0 ? 'text-green-400' : 'text-red-400' }}">
                {{ number_format($total_pnl_percentage ?? 0, 2) }}%
            </div>
            <div class="text-sm text-gray-400 mt-1">Percentage return</div>
        </div>
    </div>

    <!-- Holdings Table -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-white">Your Holdings</h2>
            <button id="refreshHoldingsBtn" class="text-blue-400 hover:text-blue-300 text-sm flex items-center space-x-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>Refresh</span>
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Asset</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Avg Buy Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Current Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">P&L</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="holdingsTableBody" class="bg-gray-800 divide-y divide-gray-700">
                    @forelse($holdings ?? [] as $holding)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full flex items-center justify-center {{ AssetHelper::getAssetIconClass($holding->asset->symbol) }}">
                                        <span class="text-sm font-bold text-white">{{ AssetHelper::getAssetInitial($holding->asset->symbol) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-white">{{ $holding->asset->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $holding->asset->symbol }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            {{ number_format($holding->quantity, 8) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            ${{ number_format($holding->average_buy_price, 8) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            ${{ number_format($holding->asset->current_price, 8) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                            ${{ number_format($holding->current_value, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm {{ $holding->unrealized_pnl >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                ${{ number_format($holding->unrealized_pnl, 2) }}
                                <span class="text-xs">({{ number_format($holding->unrealized_pnl_percentage, 2) }}%)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-blue-400 hover:text-blue-300 mr-3" onclick="openSellModal({{ $holding->id }}, '{{ $holding->asset->symbol }}', {{ $holding->quantity }}, {{ $holding->asset->current_price }})">
                                Sell
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No holdings found</p>
                                <p class="text-sm">Start by buying your first asset</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Refresh holdings
document.getElementById('refreshHoldingsBtn').addEventListener('click', function() {
    location.reload();
});

// Buy asset button
document.getElementById('buyAssetBtn').addEventListener('click', function() {
    window.location.href = '{{ route("user.holding.buy-assets") }}';
});

function openSellModal(holdingId, symbol, quantity, currentPrice) {
    alert('Sell functionality will be implemented in the next phase');
}
</script>

@include('dashboard.portfolio.partials.footer-menu')
@endsection

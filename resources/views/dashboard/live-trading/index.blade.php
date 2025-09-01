@extends('dashboard.layout.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Live Trading</h1>
            <p class="text-gray-400 mt-1">Trade crypto, stocks, and forex in real-time</p>
        </div>
    </div>

    <!-- Asset Type Tabs -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="border-b border-gray-700">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <button type="button" class="asset-tab active border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-400" data-type="crypto">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                    Crypto
                </button>
                <button type="button" class="asset-tab border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-400 hover:text-gray-300 hover:border-gray-300" data-type="stock">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    Stocks
                </button>
                <button type="button" class="asset-tab border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-400 hover:text-gray-300 hover:border-gray-300" data-type="forex">
                    <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    Forex
                </button>
            </nav>
        </div>

        <!-- Crypto Tab Content -->
        <div id="crypto-content" class="asset-content active p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-400">Asset</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">Price</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">24h Change</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">7d Change</th>
                            <th class="text-center py-3 px-4 text-sm font-medium text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cryptoAssets as $asset)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">{{ substr($asset->symbol, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-white font-medium">{{ $asset->name }}</div>
                                        <div class="text-gray-400 text-sm">{{ $asset->symbol }}/USD</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-white font-medium">${{ number_format($asset->current_price, 4) }}</div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-{{ $asset->price_change_24h >= 0 ? 'green' : 'red' }}-400 font-medium">
                                    {{ $asset->price_change_24h >= 0 ? '+' : '' }}{{ number_format($asset->price_change_24h, 2) }}%
                                </div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-gray-400 text-sm">--</div>
                            </td>
                            <td class="text-center py-4 px-4">
                                <a href="{{ route('user.liveTrading.trade', ['asset_type' => 'crypto', 'symbol' => $asset->symbol]) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    Trade
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-400">No crypto assets available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Stock Tab Content -->
        <div id="stock-content" class="asset-content hidden p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-400">Asset</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">Price</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">24h Change</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">7d Change</th>
                            <th class="text-center py-3 px-4 text-sm font-medium text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockAssets as $asset)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">{{ substr($asset->symbol, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-white font-medium">{{ $asset->name }}</div>
                                        <div class="text-gray-400 text-sm">{{ $asset->symbol }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-white font-medium">${{ number_format($asset->current_price, 2) }}</div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-{{ $asset->price_change_24h >= 0 ? 'green' : 'red' }}-400 font-medium">
                                    {{ $asset->price_change_24h >= 0 ? '+' : '' }}{{ number_format($asset->price_change_24h, 2) }}%
                                </div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-gray-400 text-sm">--</div>
                            </td>
                            <td class="text-center py-4 px-4">
                                <a href="{{ route('user.liveTrading.trade', ['asset_type' => 'stock', 'symbol' => $asset->symbol]) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    Trade
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-400">No stock assets available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Forex Tab Content -->
        <div id="forex-content" class="asset-content hidden p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-400">Asset</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">Price</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">24h Change</th>
                            <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">7d Change</th>
                            <th class="text-center py-3 px-4 text-sm font-medium text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($forexAssets as $asset)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">{{ substr($asset['symbol'], 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-white font-medium">{{ $asset['name'] }}</div>
                                        <div class="text-gray-400 text-sm">{{ $asset['symbol'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-white font-medium">{{ number_format(rand(100, 200) / 100, 4) }}</div>
                            </td>
                            <td class="text-right py-3 px-4">
                                <div class="text-{{ rand(0, 1) ? 'green' : 'red' }}-400 font-medium">
                                    {{ rand(0, 1) ? '+' : '' }}{{ number_format(rand(10, 50) / 10, 2) }}%
                                </div>
                            </td>
                            <td class="text-right py-4 px-4">
                                <div class="text-gray-400 text-sm">--</div>
                            </td>
                            <td class="text-center py-4 px-4">
                                <a href="{{ route('user.liveTrading.trade', ['asset_type' => 'forex', 'symbol' => $asset['symbol']]) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    Trade
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-400">No forex assets available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Trades -->
    @if($liveTrades->count() > 0)
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <h2 class="text-lg font-semibold text-white mb-4">Recent Trades</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-400">Symbol</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-400">Type</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-400">Side</th>
                        <th class="text-right py-3 px-4 text-sm font-medium text-gray-400">Amount</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-400">Status</th>
                        <th class="text-center py-3 px-4 text-sm font-medium text-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($liveTrades->take(5) as $trade)
                    <tr class="border-b border-gray-700">
                        <td class="py-3 px-4">
                            <div class="text-white font-medium">{{ $trade->symbol }}</div>
                            <div class="text-gray-400 text-sm">{{ ucfirst($trade->asset_type) }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $trade->order_type === 'market' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($trade->order_type) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $trade->side === 'buy' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($trade->side) }}
                            </span>
                        </td>
                        <td class="text-right py-3 px-4">
                            <div class="text-white font-medium">${{ number_format($trade->amount, 2) }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $trade->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($trade->status === 'filled' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($trade->status) }}
                            </span>
                        </td>
                        <td class="text-center py-3 px-4">
                            @if($trade->status === 'pending')
                            <button onclick="cancelTrade({{ $trade->id }})" class="text-red-400 hover:text-red-300 text-sm font-medium">
                                Cancel
                            </button>
                            @else
                            <span class="text-gray-400 text-sm">--</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.asset-tab');
    const contents = document.querySelectorAll('.asset-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetType = tab.getAttribute('data-type');
            
            // Update active tab
            tabs.forEach(t => t.classList.remove('active', 'border-blue-500', 'text-blue-400'));
            tab.classList.add('active', 'border-blue-500', 'text-blue-400');
            
            // Update active content
            contents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            
            const targetContent = document.getElementById(targetType + '-content');
            if (targetContent) {
                targetContent.classList.remove('hidden');
                targetContent.classList.add('active');
            }
        });
    });
});

function cancelTrade(tradeId) {
    if (confirm('Are you sure you want to cancel this trade?')) {
        fetch(`/user/live-trading/${tradeId}/cancel`, {
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
            } else {
                alert('Failed to cancel trade: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while cancelling the trade');
        });
    }
}
</script>

<style>
.asset-content {
    transition: all 0.3s ease;
}

.asset-content.active {
    display: block;
}

.asset-content.hidden {
    display: none;
}
</style>
@endsection

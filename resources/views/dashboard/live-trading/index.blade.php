@extends('dashboard.layout.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Live Trading</h1>
            <p class="text-gray-400 mt-1">Trade crypto, stocks, and forex in real-time</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <button id="newTradeBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                New Trade
            </button>
        </div>
    </div>

    <!-- Trading Interface -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Trading Panel -->
        <div class="lg:col-span-2">
            <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-white mb-4">Place Trade</h2>
                
                <!-- Asset Type Tabs -->
                <div class="mb-6">
                    <div class="border-b border-gray-700">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button type="button" class="asset-tab active border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-400" data-type="crypto">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                Crypto
                            </button>
                            <button type="button" class="asset-tab border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-400 hover:text-gray-300 hover:border-gray-300" data-type="stock">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                                Stocks
                            </button>
                            <button type="button" class="asset-tab border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-400 hover:text-gray-300 hover:border-gray-300" data-type="forex">
                                <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                                Forex
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Trading Form -->
                <form id="tradingForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="asset_type" value="crypto">
                    
                    <!-- Symbol Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Trading Pair</label>
                        <select name="symbol" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Trading Pair</option>
                        </select>
                    </div>

                    <!-- Order Type -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Order Type</label>
                            <select name="order_type" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="market">Market Order</option>
                                <option value="limit">Limit Order</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Side</label>
                            <select name="side" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="buy">Buy</option>
                                <option value="sell">Sell</option>
                            </select>
                        </div>
                    </div>

                    <!-- Limit Order Fields (hidden by default) -->
                    <div id="limitOrderFields" class="hidden space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Price</label>
                                <input type="number" name="price" step="0.00000001" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Quantity</label>
                                <input type="number" name="quantity" step="0.00000001" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <!-- Market Order Fields -->
                    <div id="marketOrderFields">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Amount (USD)</label>
                            <input type="number" name="amount" step="0.01" min="1" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="100.00">
                            <div class="mt-1 text-xs text-blue-400">
                                Trading Balance: ${{ number_format(auth()->user()->trading_balance, 2) }}
                            </div>
                        </div>
                    </div>

                    <!-- Leverage -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Leverage</label>
                        <select name="leverage" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="1.00">1x (No Leverage)</option>
                            <option value="2.00">2x</option>
                            <option value="5.00">5x</option>
                            <option value="10.00">10x</option>
                            <option value="20.00">20x</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition-colors">
                        Place Trade
                    </button>
                </form>
            </div>
        </div>

        <!-- Market Overview -->
        <div class="lg:col-span-1">
            <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-white mb-4">Market Overview</h2>
                
                <!-- Current Prices -->
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-sm">BTC/USDT</span>
                        <span class="text-white font-medium">$45,250.00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-sm">ETH/USDT</span>
                        <span class="text-white font-medium">$2,850.00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-sm">AAPL</span>
                        <span class="text-white font-medium">$175.50</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-sm">EUR/USD</span>
                        <span class="text-white font-medium">1.0850</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Trades -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="p-6 border-b border-gray-700">
            <h2 class="text-lg font-semibold text-white">Recent Trades</h2>
        </div>
        
        <div class="p-6">
            @if($liveTrades->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-400 uppercase bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">Symbol</th>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Side</th>
                                <th class="px-4 py-3">Amount</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-white">
                            @foreach($liveTrades as $trade)
                                <tr class="border-b border-gray-700">
                                    <td class="px-4 py-3">
                                        <span class="font-medium">{{ $trade->symbol }}</span>
                                        <span class="text-xs text-gray-400 block">{{ ucfirst($trade->asset_type) }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $trade->order_type_badge }}">
                                            {{ ucfirst($trade->order_type) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $trade->side_badge }}">
                                            {{ ucfirst($trade->side) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">${{ number_format($trade->amount, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $trade->status_badge }}">
                                            {{ ucfirst($trade->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-400">{{ $trade->created_at->format('M d, H:i') }}</td>
                                    <td class="px-4 py-3">
                                        @if($trade->isPending())
                                            <button onclick="cancelTrade({{ $trade->id }})" class="text-red-400 hover:text-red-300 text-sm">
                                                Cancel
                                            </button>
                                        @else
                                            <span class="text-gray-500 text-sm">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-white mb-2">No trades yet</h3>
                    <p class="text-gray-400">Start trading to see your trade history here</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Asset type tabs
    const assetTabs = document.querySelectorAll('.asset-tab');
    const tradingForm = document.getElementById('tradingForm');
    const assetTypeInput = tradingForm.querySelector('input[name="asset_type"]');
    const symbolSelect = tradingForm.querySelector('select[name="symbol"]');
    const orderTypeSelect = tradingForm.querySelector('select[name="order_type"]');
    const limitOrderFields = document.getElementById('limitOrderFields');
    const marketOrderFields = document.getElementById('marketOrderFields');

    // Asset data
    const assetData = {
        crypto: @json($cryptoAssets->map(fn($asset) => ['symbol' => $asset->symbol, 'name' => $asset->name])),
        stock: @json($stockAssets->map(fn($stock) => ['symbol' => $stock->symbol, 'name' => $stock->name])),
        forex: @json($forexAssets->map(fn($forex) => ['symbol' => $forex['symbol'], 'name' => $forex['name']]))
    };

    // Tab switching
    assetTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const assetType = tab.getAttribute('data-type');
            
            // Update tab styling
            assetTabs.forEach(t => {
                t.classList.remove('active', 'border-blue-500', 'text-blue-400');
                t.classList.add('border-transparent', 'text-gray-400');
            });
            tab.classList.add('active', 'border-blue-500', 'text-blue-400');
            
            // Update asset type
            assetTypeInput.value = assetType;
            
            // Update symbol options
            updateSymbolOptions(assetType);
        });
    });

    // Update symbol options based on asset type
    function updateSymbolOptions(assetType) {
        symbolSelect.innerHTML = '<option value="">Select Trading Pair</option>';
        
        if (assetData[assetType]) {
            assetData[assetType].forEach(asset => {
                const option = document.createElement('option');
                option.value = asset.symbol;
                option.textContent = asset.symbol;
                symbolSelect.appendChild(option);
            });
        }
    }

    // Order type switching
    orderTypeSelect.addEventListener('change', () => {
        if (orderTypeSelect.value === 'limit') {
            limitOrderFields.classList.remove('hidden');
            marketOrderFields.classList.add('hidden');
        } else {
            limitOrderFields.classList.add('hidden');
            marketOrderFields.classList.remove('hidden');
        }
    });

    // Form submission
    tradingForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(tradingForm);
        
        // Validate required fields
        const requiredFields = ['asset_type', 'symbol', 'order_type', 'side'];
        const missingFields = [];
        
        requiredFields.forEach(field => {
            if (!formData.get(field)) {
                missingFields.push(field.replace('_', ' '));
            }
        });
        
        if (missingFields.length > 0) {
            alert(`Please fill in the following fields: ${missingFields.join(', ')}`);
            return;
        }

        // Validate limit order fields
        if (formData.get('order_type') === 'limit') {
            if (!formData.get('price') || !formData.get('quantity')) {
                alert('Price and quantity are required for limit orders.');
                return;
            }
        } else {
            if (!formData.get('amount')) {
                alert('Amount is required for market orders.');
                return;
            }
        }

        try {
            const response = await fetch('{{ route("user.liveTrading.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (result.success) {
                alert('Trade placed successfully!');
                window.location.reload();
            } else {
                alert(result.message || 'Failed to place trade');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while placing the trade');
        }
    });

    // Initialize with crypto tab
    updateSymbolOptions('crypto');
});

// Cancel trade function
function cancelTrade(tradeId) {
    if (!confirm('Are you sure you want to cancel this trade?')) return;

    fetch(`/user/live-trading/${tradeId}/cancel`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Trade cancelled successfully!');
            window.location.reload();
        } else {
            alert(result.message || 'Failed to cancel trade');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while cancelling the trade');
    });
}
</script>
@endpush

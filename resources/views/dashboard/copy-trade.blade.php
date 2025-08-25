@extends('dashboard.layout.app')

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="rounded-md border border-green-500 bg-green-600 text-white px-4 py-3">
            <div class="font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-md border border-red-500 bg-red-600 text-white px-4 py-3">
            <div class="font-medium">{{ session('error') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-md border border-yellow-500 bg-yellow-600 text-white px-4 py-3">
            <div class="font-semibold mb-1">Please fix the following:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Copy Trading</h1>
            <p class="text-gray-400 mt-1">Follow successful traders and copy their strategies</p>
        </div>
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <div class="text-sm text-gray-400">Available Balance</div>
            <div class="text-xl font-bold text-white">${{ number_format(auth()->user()->balance, 2) }}</div>
        </div>
    </div>

    <!-- Available Traders Section -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white">Available Traders</h2>
            <div class="text-sm text-gray-400">{{ count($traders) }} traders available</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($traders as $trader)
            <div class="bg-gray-700 rounded-lg border border-gray-600 hover:border-blue-500 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                <!-- Trader Header -->
                <div class="p-6 border-b border-gray-600">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <img src="{{ asset($trader->avatar) }}" alt="{{ $trader->name }}" 
                                 class="w-16 h-16 rounded-full object-cover border-2 border-gray-600">
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-gray-700"></div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white">{{ $trader->name }}</h3>
                            <p class="text-sm text-gray-400">Professional Trader</p>
                        </div>
                    </div>
                </div>

                <!-- Trader Stats -->
                <div class="p-6 space-y-4">
                    <!-- Win Rate -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-400">Win Rate</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-16 bg-gray-600 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $trader->win_rate }}%"></div>
                            </div>
                            <span class="text-sm font-semibold text-white">{{ $trader->win_rate }}%</span>
                        </div>
                    </div>

                    <!-- Performance Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-gray-600 rounded-lg">
                            <div class="text-lg font-bold text-green-400">{{ $trader->win }}</div>
                            <div class="text-xs text-gray-400">Wins</div>
                        </div>
                        <div class="text-center p-3 bg-gray-600 rounded-lg">
                            <div class="text-lg font-bold text-red-400">{{ $trader->loss }}</div>
                            <div class="text-xs text-gray-400">Losses</div>
                        </div>
                    </div>

                    <!-- Profit Share -->
                    <div class="flex items-center justify-between p-3 bg-blue-900/20 border border-blue-700/30 rounded-lg">
                        <span class="text-sm text-gray-400">Profit Share</span>
                        <span class="text-sm font-semibold text-blue-400">${{ number_format($trader->profit_share, 2) }}</span>
                    </div>

                    <!-- Minimum Amount -->
                    <div class="text-center p-3 bg-gray-600 rounded-lg">
                        <div class="text-sm text-gray-400">Minimum Investment</div>
                        <div class="text-lg font-bold text-white">${{ number_format($trader->amount, 2) }}</div>
                    </div>

                    <!-- Copy Trade Button -->
                    <form action="{{ route('user.copyTrading.store') }}" method="POST" class="pt-2 copy-trade-form" data-trader="{{ $trader->id }}">
                        @csrf
                        <input type="hidden" name="trader_id" value="{{ $trader->id }}">
                        <input type="hidden" name="amount" value="{{ $trader->amount }}">
                        
                        <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>Copy Trade</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- My Copied Trades Section -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-white">My Copied Trades</h2>
            <div class="text-sm text-gray-400">{{ count($copiedTrades) }} active trades</div>
        </div>

        @if(count($copiedTrades) > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Trader</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Amount</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Date Started</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($copiedTrades as $trade)
                    <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition-colors">
                        <td class="py-4 px-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset($trade->copy_trader->avatar ?? '') }}" alt="" 
                                     class="w-8 h-8 rounded-full object-cover">
                                <span class="text-white">{{ $trade->copy_trader->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-white">${{ number_format($trade->amount, 2) }}</td>
                        <td class="py-4 px-4 text-gray-400">{{ date('M d, Y', strtotime($trade->created_at)) }}</td>
                        <td class="py-4 px-4">
                            @if($trade->status == 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-900 text-yellow-200">
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900 text-green-200">
                                    Active
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <a href="{{ route('user.copyTrading.detail', $trade->id) }}" 
                               class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-300 mb-2">No Copied Trades Yet</h3>
            <p class="text-gray-500">Start copying trades from our professional traders above</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Log any flash messages present in DOM
        const successEl = document.getElementById('alert-success');
        const errorEl = document.getElementById('alert-error');
        const validationEl = document.getElementById('alert-validation');
        if (successEl) console.log('[CopyTrading] Success message:', successEl.textContent.trim());
        if (errorEl) console.log('[CopyTrading] Error message:', errorEl.textContent.trim());
        if (validationEl) console.log('[CopyTrading] Validation errors present');

        // Attach submit logging to forms
        document.querySelectorAll('.copy-trade-form').forEach(function(form){
            form.addEventListener('submit', function(){
                const traderId = form.getAttribute('data-trader');
                const amount = form.querySelector('input[name="amount"]').value;
                console.log('[CopyTrading] Submitting copy trade:', { traderId, amount, action: form.action, method: form.method });
            });
        });
    });
</script>
@endpush
@endsection

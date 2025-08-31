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

    @if(session('warning'))
        <div class="rounded-md border border-yellow-500 bg-yellow-600 text-white px-4 py-3">
            <div class="font-medium">{{ session('warning') }}</div>
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
        </div>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-700">
        <nav class="-mb-px flex space-x-8">
            <button id="tradersTab" class="tab-button active py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-400">
                Available Traders
            </button>
            <button id="historyTab" class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-400 hover:text-gray-300">
                My History
            </button>
        </nav>
    </div>

    <!-- Available Traders Section -->
    <div id="tradersSection" class="tab-content">
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-white">Available Traders</h2>
                <div class="text-sm text-gray-400">{{ count($traders) }} traders available</div>
            </div>

        <!-- Search Box -->
        <div class="mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                       id="traderSearch" 
                       placeholder="Search traders by name..." 
                       class="block w-full pl-10 pr-3 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
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
                    @php
                        $barPercent = min(100, max(0, (int)($trader->win_rate ?? 0)));
                    @endphp
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-400">Win Rate</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 md:w-28 bg-gray-600 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-green-500 h-1.5" style="width: {{ $barPercent }}%"></div>
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
                        <span class="text-sm font-semibold text-blue-400">{{ number_format($trader->profit_share, 1) }}%</span>
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
                                class="copy-trade-btn w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                            <!-- Default state -->
                            <svg class="copy-trade-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="copy-trade-text">Copy Trade</span>
                            
                            <!-- Loading state (hidden by default) -->
                            <svg class="copy-trade-spinner hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="copy-trade-loading hidden">Processing...</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>

    <!-- My Copied Trades Section -->
    <div id="historySection" class="tab-content hidden">
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
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const tradersTab = document.getElementById('tradersTab');
        const historyTab = document.getElementById('historyTab');
        const tradersSection = document.getElementById('tradersSection');
        const historySection = document.getElementById('historySection');

        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-blue-500', 'text-blue-400');
                button.classList.add('border-transparent', 'text-gray-400');
            });

            // Show selected tab content
            if (tabName === 'traders') {
                tradersSection.classList.remove('hidden');
                tradersTab.classList.add('active', 'border-blue-500', 'text-blue-400');
                tradersTab.classList.remove('border-transparent', 'text-gray-400');
            } else if (tabName === 'history') {
                historySection.classList.remove('hidden');
                historyTab.classList.add('active', 'border-blue-500', 'text-blue-400');
                historyTab.classList.remove('border-transparent', 'text-gray-400');
            }
        }

        // Add click event listeners to tabs
        tradersTab.addEventListener('click', () => {
            showTab('traders');
            // Update URL without page reload
            const url = new URL(window.location);
            url.searchParams.set('tab', 'traders');
            window.history.pushState({}, '', url);
        });
        historyTab.addEventListener('click', () => {
            showTab('history');
            // Update URL without page reload
            const url = new URL(window.location);
            url.searchParams.set('tab', 'history');
            window.history.pushState({}, '', url);
        });

        // Check URL parameters for initial tab
        const urlParams = new URLSearchParams(window.location.search);
        const initialTab = urlParams.get('tab');
        if (initialTab === 'history') {
            showTab('history');
        } else {
            showTab('traders'); // Default to traders tab
        }

        // Log any flash messages present in DOM
        const successEl = document.getElementById('alert-success');
        const errorEl = document.getElementById('alert-error');
        const validationEl = document.getElementById('alert-validation');
        if (successEl) console.log('[CopyTrading] Success message:', successEl.textContent.trim());
        if (errorEl) console.log('[CopyTrading] Error message:', errorEl.textContent.trim());
        if (validationEl) console.log('[CopyTrading] Validation errors present');

        // Function to reset copy trade button state
        function resetCopyTradeButton(form) {
            const submitBtn = form.querySelector('.copy-trade-btn');
            const icon = form.querySelector('.copy-trade-icon');
            const text = form.querySelector('.copy-trade-text');
            const spinner = form.querySelector('.copy-trade-spinner');
            const loadingText = form.querySelector('.copy-trade-loading');
            
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            icon.classList.remove('hidden');
            text.classList.remove('hidden');
            spinner.classList.add('hidden');
            loadingText.classList.add('hidden');
        }

        // Copy trade form submission with loading state
        document.querySelectorAll('.copy-trade-form').forEach(function(form){
            form.addEventListener('submit', function(e){
                const traderId = form.getAttribute('data-trader');
                const amount = form.querySelector('input[name="amount"]').value;
                const submitBtn = form.querySelector('.copy-trade-btn');
                const icon = form.querySelector('.copy-trade-icon');
                const text = form.querySelector('.copy-trade-text');
                const spinner = form.querySelector('.copy-trade-spinner');
                const loadingText = form.querySelector('.copy-trade-loading');
                
                console.log('[CopyTrading] Submitting copy trade:', { traderId, amount, action: form.action, method: form.method });
                
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                icon.classList.add('hidden');
                text.classList.add('hidden');
                spinner.classList.remove('hidden');
                loadingText.classList.remove('hidden');
                
                // Prevent double submission
                e.preventDefault();
                
                // Submit the form after a brief delay to show loading state
                setTimeout(() => {
                    form.submit();
                }, 100);
                
                // Fallback: Reset button state if form submission takes too long
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        resetCopyTradeButton(form);
                    }
                }, 10000); // Reset after 10 seconds if still loading
            });
        });

        // Trader Search Functionality
        const searchInput = document.getElementById('traderSearch');
        const traderCards = document.querySelectorAll('.bg-gray-700.rounded-lg.border.border-gray-600');
        const traderCountElement = document.querySelector('.text-sm.text-gray-400');

        if (searchInput && traderCards.length > 0) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                let visibleCount = 0;
                
                traderCards.forEach(function(card) {
                    const traderNameElement = card.querySelector('h3');
                    if (traderNameElement) {
                        const traderName = traderNameElement.textContent.toLowerCase();
                        
                        if (searchTerm === '' || traderName.includes(searchTerm)) {
                            card.style.display = 'block';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });

                // Update trader count
                if (traderCountElement) {
                    traderCountElement.textContent = `${visibleCount} traders available`;
                }

                // Show "no results" message if no traders match
                const noResultsMessage = document.getElementById('noResultsMessage');
                if (visibleCount === 0 && searchTerm !== '') {
                    if (!noResultsMessage) {
                        const gridContainer = traderCards[0].parentElement;
                        const messageDiv = document.createElement('div');
                        messageDiv.id = 'noResultsMessage';
                        messageDiv.className = 'col-span-full text-center py-12';
                        messageDiv.innerHTML = `
                            <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-300 mb-2">No traders found</h3>
                            <p class="text-gray-500">Try adjusting your search terms</p>
                        `;
                        gridContainer.appendChild(messageDiv);
                    }
                } else if (noResultsMessage) {
                    noResultsMessage.remove();
                }
            });

            // Clear search functionality
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    this.dispatchEvent(new Event('input'));
                }
            });
        }
    });
</script>
@endpush
@endsection

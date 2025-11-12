@extends('admin.layouts.app')

@section('content')
<div class="px-4 pt-5">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Place Trade for User</h1>
        <p class="text-gray-600 dark:text-gray-400">Create a new trade on behalf of a user</p>
    </div>

    <!-- Navigation Bar -->
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.trade.history') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 {{ request()->routeIs('admin.trade.history') ? 'bg-blue-50 border-blue-500 text-blue-700 dark:bg-blue-900 dark:border-blue-700 dark:text-blue-300' : '' }}">
                Trade History
            </a>
            <a href="{{ route('admin.trade.place') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 {{ request()->routeIs('admin.trade.place') ? 'bg-blue-50 border-blue-500 text-blue-700 dark:bg-blue-900 dark:border-blue-700 dark:text-blue-300' : '' }}">
                Place Trade
            </a>
        </div>
    </div>

    <!-- Success Message Container -->
    <div id="successMessage" class="hidden mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-800 dark:border-green-600 dark:text-green-300">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span id="successMessageText"></span>
            </div>
            <button onclick="hideSuccessMessage()" class="text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Error Message Container -->
    <div id="errorMessage" class="hidden mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-800 dark:border-red-600 dark:text-red-300">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span id="errorMessageText"></span>
            </div>
            <button onclick="hideErrorMessage()" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-800 dark:border-green-600 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-800 dark:border-red-600 dark:text-red-300">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg dark:bg-red-800 dark:border-red-600 dark:text-red-300">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Place Trade Form -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Trade Details</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Fill in the details below to place a trade for a user</p>
        </div>
        <div class="px-6 py-6">
            <form action="{{ route('admin.trade.store') }}" method="POST" id="placeTradeForm">
                @csrf
                <input type="hidden" name="redirect_to" value="place">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- User Selection -->
                    <div>
                        <label for="place_user_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                        <select id="place_user_id" name="user_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" data-balance="{{ $user->balance }}">
                                    {{ $user->name }} (Balance: ${{ number_format($user->balance, 2) }})
                                </option>
                            @endforeach
                        </select>
                        <p id="userBalance" class="mt-1 text-xs text-gray-500 dark:text-gray-400"></p>
                    </div>

                    <!-- Market Selection -->
                    <div>
                        <label for="place_market" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Market</label>
                        <select id="place_market" name="market" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Choose Market</option>
                            <option value="crypto">Crypto</option>
                            <option value="forex">Forex</option>
                            <option value="stock">Stock</option>
                        </select>
                    </div>

                    <!-- Trade Pair -->
                    <div>
                        <label for="place_trade_pair_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Trading Pair</label>
                        <select id="place_trade_pair_id" name="trade_pair_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Select Pair</option>
                            <!-- Options will be populated by JavaScript based on market selection -->
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="place_amount" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Amount ($)</label>
                        <input type="number" step="0.01" min="0.01" id="place_amount" name="amount" required placeholder="Enter amount" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- Leverage -->
                    <div>
                        <label for="place_leverage" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Leverage</label>
                        <div class="flex items-center space-x-2">
                            <input type="range" id="place_leverage_slider" min="5" max="100" value="10" step="5" class="flex-1">
                            <input type="number" id="place_leverage" name="leverage" value="10" min="5" max="100" step="5" required readonly class="w-20 px-3 py-2 border border-gray-300 rounded-md text-center dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <span class="text-sm text-gray-600 dark:text-gray-400">x</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">5x - 100x</p>
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="place_duration" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Duration</label>
                        <select id="place_duration" name="duration" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="1">1 Minute</option>
                            <option value="2">2 Minutes</option>
                            <option value="3">3 Minutes</option>
                            <option value="4">4 Minutes</option>
                            <option value="5">5 Minutes</option>
                            <option value="10">10 Minutes</option>
                            <option value="15">15 Minutes</option>
                            <option value="30">30 Minutes</option>
                            <option value="60">1 Hour</option>
                            <option value="120">2 Hours</option>
                            <option value="180">4 Hours</option>
                            <option value="360">6 Hours</option>
                            <option value="720">12 Hours</option>
                            <option value="1440">1 Day</option>
                            <option value="2880">2 Days</option>
                            <option value="5320">3 Days</option>
                            <option value="7200">5 Days</option>
                            <option value="10080">7 Days</option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex items-center justify-end space-x-3 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <button type="submit" name="action_type" value="buy" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Place Buy Order
                    </button>
                    <button type="submit" name="action_type" value="sell" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Place Sell Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Place Trade Form Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Trade pairs data from PHP
    const tradePairs = @json($pairs);
    const marketSelect = document.getElementById('place_market');
    const pairSelect = document.getElementById('place_trade_pair_id');
    const userSelect = document.getElementById('place_user_id');
    const userBalanceDisplay = document.getElementById('userBalance');
    const leverageSlider = document.getElementById('place_leverage_slider');
    const leverageInput = document.getElementById('place_leverage');
    const amountInput = document.getElementById('place_amount');

    // Handle market selection change
    if (marketSelect && pairSelect) {
        marketSelect.addEventListener('change', function() {
            const selectedMarket = this.value;
            pairSelect.innerHTML = '<option value="">Select Pair</option>';
            
            if (selectedMarket) {
                tradePairs.forEach(function(pair) {
                    if (pair.type === selectedMarket) {
                        const option = document.createElement('option');
                        option.value = pair.id;
                        option.textContent = pair.pair;
                        pairSelect.appendChild(option);
                    }
                });
            }
        });
    }

    // Handle user selection change - show balance
    if (userSelect && userBalanceDisplay) {
        userSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const balance = selectedOption.getAttribute('data-balance');
            
            if (balance && balance !== 'null') {
                userBalanceDisplay.textContent = `Available Balance: $${parseFloat(balance).toFixed(2)}`;
                userBalanceDisplay.classList.remove('hidden');
                
                // Validate amount doesn't exceed balance
                if (amountInput && parseFloat(amountInput.value) > parseFloat(balance)) {
                    amountInput.setCustomValidity('Amount exceeds available balance');
                } else if (amountInput) {
                    amountInput.setCustomValidity('');
                }
            } else {
                userBalanceDisplay.textContent = '';
                userBalanceDisplay.classList.add('hidden');
            }
        });
    }

    // Handle amount input - validate against balance
    if (amountInput && userSelect) {
        amountInput.addEventListener('input', function() {
            const selectedOption = userSelect.options[userSelect.selectedIndex];
            const balance = selectedOption ? selectedOption.getAttribute('data-balance') : null;
            
            if (balance && this.value && parseFloat(this.value) > parseFloat(balance)) {
                this.setCustomValidity('Amount exceeds available balance');
                this.classList.add('border-red-500');
            } else {
                this.setCustomValidity('');
                this.classList.remove('border-red-500');
            }
        });
    }

    // Handle leverage slider
    if (leverageSlider && leverageInput) {
        leverageSlider.addEventListener('input', function() {
            // Round to nearest 5
            const value = Math.round(this.value / 5) * 5;
            leverageInput.value = value;
            this.value = value;
        });

        leverageInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (value < 5) value = 5;
            if (value > 100) value = 100;
            value = Math.round(value / 5) * 5;
            this.value = value;
            leverageSlider.value = value;
        });
    }

    // Form submission validation
    const placeTradeForm = document.getElementById('placeTradeForm');
    if (placeTradeForm) {
        placeTradeForm.addEventListener('submit', function(e) {
            const selectedUser = userSelect.value;
            const selectedMarket = marketSelect.value;
            const selectedPair = pairSelect.value;
            const amount = amountInput.value;
            const selectedOption = userSelect.options[userSelect.selectedIndex];
            const balance = selectedOption ? parseFloat(selectedOption.getAttribute('data-balance')) : 0;

            if (!selectedUser) {
                e.preventDefault();
                showErrorMessage('Please select a user');
                return false;
            }

            if (!selectedMarket) {
                e.preventDefault();
                showErrorMessage('Please select a market');
                return false;
            }

            if (!selectedPair) {
                e.preventDefault();
                showErrorMessage('Please select a trading pair');
                return false;
            }

            if (!amount || parseFloat(amount) <= 0) {
                e.preventDefault();
                showErrorMessage('Please enter a valid amount');
                return false;
            }

            if (parseFloat(amount) > balance) {
                e.preventDefault();
                showErrorMessage('Amount exceeds available balance');
                return false;
            }
        });
    }
});

// Message display functions
function showSuccessMessage(message) {
    const successMessage = document.getElementById('successMessage');
    const successMessageText = document.getElementById('successMessageText');
    
    successMessageText.textContent = message;
    successMessage.classList.remove('hidden');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        successMessage.classList.add('hidden');
    }, 5000);
}

function showErrorMessage(message) {
    const errorMessage = document.getElementById('errorMessage');
    const errorMessageText = document.getElementById('errorMessageText');
    
    errorMessageText.textContent = message;
    errorMessage.classList.remove('hidden');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        errorMessage.classList.add('hidden');
    }, 5000);
}

function hideSuccessMessage() {
    document.getElementById('successMessage').classList.add('hidden');
}

function hideErrorMessage() {
    document.getElementById('errorMessage').classList.add('hidden');
}
</script>
@endpush


@extends('dashboard.layout.app')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Withdrawals & Transfers</h1>
            <p class="text-gray-400 mt-1">Manage your withdrawals and transfer funds between accounts</p>
        </div>
    </div>

    <!-- Balance Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Main Balance -->
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Main Balance</p>
                    <p class="text-white text-xl font-bold">${{ number_format(auth()->user()->balance, 2) }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Trading Balance -->
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Trading Balance</p>
                    <p class="text-white text-xl font-bold">${{ number_format(auth()->user()->trading_balance ?? 0, 2) }}</p>
                </div>
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Holding Balance -->
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Holding Balance</p>
                    <p class="text-white text-xl font-bold">${{ number_format(auth()->user()->holding_balance ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Portfolio value (not available for withdrawal)</p>
                </div>
                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Mining Balance -->
        <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Mining Balance</p>
                    <p class="text-white text-xl font-bold">${{ number_format(auth()->user()->mining_balance ?? 0, 2) }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="border-b border-gray-700">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <button id="withdrawTab" class="tab-button border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-400">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Withdraw</span>
                    </div>
                </button>
                <button id="transferTab" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-400 hover:text-gray-300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Transfer Funds</span>
                    </div>
                </button>
                <button id="historyTab" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-400 hover:text-gray-300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        <span>History</span>
                    </div>
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            <!-- Withdraw Tab -->
            <div id="withdrawContent" class="tab-content">
                <div class="max-w-md mx-auto">
                    <h3 class="text-lg font-medium text-white mb-4">Withdraw Funds</h3>
                    <form id="withdrawForm" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">From Account</label>
                            <select id="withdrawFromAccount" name="from_account" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Account</option>
                                <option value="balance" data-balance="{{ auth()->user()->balance }}">Main Balance (${{ number_format(auth()->user()->balance, 2) }})</option>
                                <option value="trading_balance" data-balance="{{ auth()->user()->trading_balance ?? 0 }}">Trading Balance (${{ number_format(auth()->user()->trading_balance ?? 0, 2) }})</option>
                                <option value="mining_balance" data-balance="{{ auth()->user()->mining_balance ?? 0 }}">Mining Balance (${{ number_format(auth()->user()->mining_balance ?? 0, 2) }})</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Payment Method</label>
                            <select id="withdrawalMethod" name="payment_method" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Payment Method</option>
                                <option value="crypto">Cryptocurrency</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <!-- Crypto Fields -->
                        <div id="cryptoFields" class="space-y-4 hidden">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Cryptocurrency</label>
                                <select name="wallet" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="BTC">Bitcoin (BTC)</option>
                                    <option value="ETH">Ethereum (ETH)</option>
                                    <option value="SOL">Solana (SOL)</option>
                                    <option value="BNB">Binance Coin (BNB)</option>
                                    <option value="USDT">Tether (USDT)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Wallet Address</label>
                                <input type="text" name="address" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter wallet address">
                            </div>
                        </div>

                        <!-- Bank Fields -->
                        <div id="bankFields" class="space-y-4 hidden">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Bank Name</label>
                                <input type="text" name="bank_name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Chase Bank">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Account Name</label>
                                <input type="text" name="acct_name" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Account holder name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Account Number</label>
                                <input type="text" name="acct_number" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Account number">
                            </div>
                        </div>

                        <!-- PayPal Fields -->
                        <div id="paypalFields" class="space-y-4 hidden">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">PayPal Email</label>
                                <input type="email" name="paypal" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="your@email.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                            <input type="number" id="withdrawAmount" name="amount" step="0.01" min="0.01" 
                                   class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0.00">
                            <p class="text-xs text-gray-400 mt-1">Available: $<span id="withdrawAvailableAmount">0.00</span></p>
                        </div>

                        <button type="submit" id="withdrawSubmitBtn" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            <span id="withdrawBtnText">Request Withdrawal</span>
                            <span id="withdrawBtnSpinner" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Transfer Funds Tab -->
            <div id="transferContent" class="tab-content hidden">
                <div class="max-w-md mx-auto">
                    <h3 class="text-lg font-medium text-white mb-4">Transfer Between Accounts</h3>
                    <div class="bg-blue-900/20 border border-blue-500/30 rounded-lg p-3 mb-4">
                        <p class="text-sm text-blue-300">
                            <strong>Note:</strong> Holding balance represents your portfolio value and cannot be transferred or withdrawn. 
                            To access these funds, you must sell your assets first.
                        </p>
                    </div>
                    <form id="transferForm" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">From Account</label>
                            <select id="fromAccount" name="from_account" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Account</option>
                                <option value="balance" data-balance="{{ auth()->user()->balance }}">Main Balance (${{ number_format(auth()->user()->balance, 2) }})</option>
                                <option value="trading_balance" data-balance="{{ auth()->user()->trading_balance ?? 0 }}">Trading Balance (${{ number_format(auth()->user()->trading_balance ?? 0, 2) }})</option>
                                <option value="mining_balance" data-balance="{{ auth()->user()->mining_balance ?? 0 }}">Mining Balance (${{ number_format(auth()->user()->mining_balance ?? 0, 2) }})</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">To Account</label>
                            <select id="toAccount" name="to_account" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Account</option>
                                <option value="balance" data-balance="{{ auth()->user()->balance }}">Main Balance (${{ number_format(auth()->user()->balance, 2) }})</option>
                                <option value="trading_balance" data-balance="{{ auth()->user()->trading_balance ?? 0 }}">Trading Balance (${{ number_format(auth()->user()->trading_balance ?? 0, 2) }})</option>
                                <option value="mining_balance" data-balance="{{ auth()->user()->mining_balance ?? 0 }}">Mining Balance (${{ number_format(auth()->user()->mining_balance ?? 0, 2) }})</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                            <input type="number" id="transferAmount" name="amount" step="0.01" min="0.01" 
                                   class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0.00">
                            <p class="text-xs text-gray-400 mt-1">Available: $<span id="availableAmount">0.00</span></p>
                        </div>

                        <button type="submit" id="transferSubmitBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors">
                            <span id="transferBtnText">Transfer Funds</span>
                            <span id="transferBtnSpinner" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </form>
                </div>
            </div>



            <!-- History Tab -->
            <div id="historyContent" class="tab-content hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Method/Details</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @php
                                $allTransactions = collect();
                                
                                // Add withdrawals with type identifier
                                foreach ($withdrawals as $withdrawal) {
                                    $withdrawal->transaction_type = 'withdrawal';
                                    $allTransactions->push($withdrawal);
                                }
                                
                                // Add transfers with type identifier
                                foreach ($transfers as $transfer) {
                                    $transfer->transaction_type = 'transfer';
                                    $allTransactions->push($transfer);
                                }
                                
                                // Sort by created_at descending (most recent first)
                                $allTransactions = $allTransactions->sortByDesc('created_at');
                            @endphp
                            
                            @forelse ($allTransactions as $index => $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($transaction->transaction_type === 'withdrawal')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Withdrawal
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            Transfer
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">${{ number_format($transaction->amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    @if($transaction->transaction_type === 'withdrawal')
                                        {{ ucfirst($transaction->payment_method) }}
                                        @switch($transaction->payment_method)
                                            @case('crypto')
                                                - {{ $transaction->wallet ?? '—' }}
                                                @break
                                            @case('bank')
                                                @php($bank = json_decode($transaction->bank, true))
                                                - {{ $bank['bank_name'] ?? '' }}
                                                @break
                                            @case('paypal')
                                                - {{ $transaction->paypal ?? '—' }}
                                                @break
                                            @default
                                                - {{ $transaction->address ?? '—' }}
                                        @endswitch
                                    @else
                                        {{ str_replace('_', ' ', ucfirst($transaction->from_account)) }} → {{ str_replace('_', ' ', ucfirst($transaction->to_account)) }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($transaction->transaction_type === 'withdrawal')
                                        {!! $transaction->status() !!}
                                    @else
                                        {!! $transaction->status() !!}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $transaction->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-400">No transaction history found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal -->
<div id="customModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 border border-gray-700">
        <div class="flex items-center justify-between mb-4">
            <h3 id="modalTitle" class="text-lg font-medium text-white">Notice</h3>
            <button id="closeModal" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="mb-6">
            <p id="modalMessage" class="text-gray-300"></p>
        </div>
        <div class="flex justify-end space-x-3">
            <button id="modalCancelBtn" class="px-4 py-2 text-gray-400 hover:text-white transition-colors">
                Cancel
            </button>
            <button id="modalConfirmBtn" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                OK
            </button>
        </div>
    </div>
</div>

<script>
// Tab functionality
document.getElementById('withdrawTab').addEventListener('click', () => switchTab('withdraw'));
document.getElementById('transferTab').addEventListener('click', () => switchTab('transfer'));
document.getElementById('historyTab').addEventListener('click', () => switchTab('history'));

function switchTab(tab) {
    // Update tab buttons
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('border-blue-500', 'text-blue-400');
        btn.classList.add('border-transparent', 'text-gray-400');
    });
    
    if (tab === 'withdraw') {
        document.getElementById('withdrawTab').classList.add('border-blue-500', 'text-blue-400');
        document.getElementById('withdrawTab').classList.remove('border-transparent', 'text-gray-400');
    } else if (tab === 'transfer') {
        document.getElementById('transferTab').classList.add('border-blue-500', 'text-blue-400');
        document.getElementById('transferTab').classList.remove('border-transparent', 'text-gray-400');
    } else if (tab === 'history') {
        document.getElementById('historyTab').classList.add('border-blue-500', 'text-blue-400');
        document.getElementById('historyTab').classList.remove('border-transparent', 'text-gray-400');
    }
    
    // Update content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    if (tab === 'withdraw') {
        document.getElementById('withdrawContent').classList.remove('hidden');
    } else if (tab === 'transfer') {
        document.getElementById('transferContent').classList.remove('hidden');
    } else if (tab === 'history') {
        document.getElementById('historyContent').classList.remove('hidden');
    }
}

// Transfer form functionality
document.getElementById('fromAccount').addEventListener('change', updateAvailableAmount);
document.getElementById('withdrawFromAccount').addEventListener('change', updateWithdrawAvailableAmount);

function updateAvailableAmount() {
    const select = document.getElementById('fromAccount');
    const option = select.options[select.selectedIndex];
    const balance = option.getAttribute('data-balance') || 0;
    document.getElementById('availableAmount').textContent = parseFloat(balance).toFixed(2);
}

function updateWithdrawAvailableAmount() {
    const select = document.getElementById('withdrawFromAccount');
    const option = select.options[select.selectedIndex];
    const balance = option.getAttribute('data-balance') || 0;
    document.getElementById('withdrawAvailableAmount').textContent = parseFloat(balance).toFixed(2);
}

// Withdrawal method toggle
document.getElementById('withdrawalMethod').addEventListener('change', function() {
    const method = this.value;
    
    // Hide all fields
    document.getElementById('cryptoFields').classList.add('hidden');
    document.getElementById('bankFields').classList.add('hidden');
    document.getElementById('paypalFields').classList.add('hidden');
    
    // Show relevant fields
    if (method === 'crypto') {
        document.getElementById('cryptoFields').classList.remove('hidden');
    } else if (method === 'bank') {
        document.getElementById('bankFields').classList.remove('hidden');
    } else if (method === 'paypal') {
        document.getElementById('paypalFields').classList.remove('hidden');
    }
});

// Transfer form submission
document.getElementById('transferForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Set button to processing state
    setButtonProcessing(true, 'transfer');
    
    const formData = new FormData(this);
    
    fetch('/user/transfer-funds', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Reset button state
        setButtonProcessing(false, 'transfer');
        
        if (data.success) {
            showModal('Success', 'Transfer completed successfully!');
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            showModal('Error', 'Error: ' + data.message);
        }
    })
    .catch(error => {
        // Reset button state
        setButtonProcessing(false, 'transfer');
        
        console.error('Error:', error);
        showModal('Error', 'An error occurred during transfer');
    });
});

// Modal functionality
function showModal(title, message, showCancel = false) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('modalCancelBtn').style.display = showCancel ? 'block' : 'none';
    document.getElementById('customModal').classList.remove('hidden');
}

function hideModal() {
    document.getElementById('customModal').classList.add('hidden');
}

// Modal event listeners
document.getElementById('closeModal').addEventListener('click', hideModal);
document.getElementById('modalConfirmBtn').addEventListener('click', hideModal);
document.getElementById('modalCancelBtn').addEventListener('click', hideModal);

// Close modal when clicking outside
document.getElementById('customModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideModal();
    }
});

// Button processing state
function setButtonProcessing(isProcessing, buttonType = 'withdraw') {
    const button = document.getElementById(buttonType + 'SubmitBtn');
    const buttonText = document.getElementById(buttonType + 'BtnText');
    const buttonSpinner = document.getElementById(buttonType + 'BtnSpinner');
    
    if (isProcessing) {
        button.disabled = true;
        button.classList.add('opacity-50', 'cursor-not-allowed');
        if (buttonType === 'withdraw') {
            button.classList.remove('hover:bg-red-700');
        } else {
            button.classList.remove('hover:bg-blue-700');
        }
        buttonText.classList.add('hidden');
        buttonSpinner.classList.remove('hidden');
    } else {
        button.disabled = false;
        button.classList.remove('opacity-50', 'cursor-not-allowed');
        if (buttonType === 'withdraw') {
            button.classList.add('hover:bg-red-700');
        } else {
            button.classList.add('hover:bg-blue-700');
        }
        buttonText.classList.remove('hidden');
        buttonSpinner.classList.add('hidden');
    }
}

// Withdrawal form submission
document.getElementById('withdrawForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Set button to processing state
    setButtonProcessing(true, 'withdraw');
    
    const formData = new FormData(this);
    
    fetch('/user/store/withdrawal/', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Reset button state
        setButtonProcessing(false, 'withdraw');
        
        if (data.success) {
            showModal('Success', 'Withdrawal request submitted successfully!');
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            showModal('Error', 'Error: ' + data.message);
        }
    })
    .catch(error => {
        // Reset button state
        setButtonProcessing(false, 'withdraw');
        
        console.error('Error:', error);
        showModal('Error', 'An error occurred during withdrawal request');
    });
});
</script>
@endsection

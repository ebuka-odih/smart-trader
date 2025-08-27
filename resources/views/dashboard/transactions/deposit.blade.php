@extends('dashboard.layout.app')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
@endpush

@section('content')
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-white">Fund Account</h1>
            <p class="text-gray-400 mt-1">Manage your deposits and account funding</p>
        </div>
        <button id="newDepositBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center sm:justify-start space-x-2 w-full sm:w-auto">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span>New Deposit</span>
        </button>
    </div>

    <!-- Balance Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Trading Balance</h3>
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                    </svg>
                        </div>
                    </div>
            <div class="text-3xl font-bold text-white">${{ number_format($user->balance ?? 0, 2) }}</div>
            <div class="text-sm text-gray-400 mt-1">Available for trading</div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Holding Balance</h3>
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                        </div>
            <div class="text-3xl font-bold text-white">${{ number_format($user->holding_balance ?? 0, 2) }}</div>
            <div class="text-sm text-gray-400 mt-1">Long-term holdings</div>
                                                </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Staking Balance</h3>
                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                    </svg>
                                            </div>
                                        </div>
            <div class="text-3xl font-bold text-white">${{ number_format($user->staking_balance ?? 0, 2) }}</div>
            <div class="text-sm text-gray-400 mt-1">Staked assets</div>
                                    </div>
                                </div>

    <!-- Deposit History Table -->
    <div class="bg-gray-800 rounded-lg border border-gray-700">
        <div class="px-6 py-4 border-b border-gray-700">
            <h2 class="text-xl font-semibold text-white">Deposit History</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Wallet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Payment Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse($deposits as $deposit)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white">${{ number_format($deposit->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                @if($deposit->wallet_type == 'trading')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Trading Balance
                                    </span>
                                @elseif($deposit->wallet_type == 'holding')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Holding Balance
                                    </span>
                                @elseif($deposit->wallet_type == 'staking')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Staking Balance
                                    </span>
                                @else
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ optional($deposit->payment_method)->wallet ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($deposit->status == 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @elseif($deposit->status == 1)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $deposit->created_at ? $deposit->created_at->format('M d, Y H:i') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($deposit->proof)
                                    <button class="text-blue-400 hover:text-blue-300 mr-3" onclick="viewProof('{{ $deposit->id }}')">
                                        View Proof
                                    </button>
                                @endif
                                @if($deposit->status == 0)
                                    <button class="text-red-400 hover:text-red-300" onclick="cancelDeposit('{{ $deposit->id }}')">
                                        Cancel
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No deposits found</p>
                                    <p class="text-sm">Start by creating your first deposit</p>
                                </div>
                            </td>
                        </tr>
                            @endforelse
                </tbody>
            </table>
                        </div>
                    </div>

    <!-- New Deposit Modal -->
    <div id="depositModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full border border-gray-700 max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b border-gray-700">
                    <h3 class="text-lg font-semibold text-white">New Deposit</h3>
                    <button id="closeModal" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form id="depositForm" action="{{ route('user.payment') }}" method="POST" enctype="multipart/form-data" class="p-4">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            {{ session('error') }}
                                    </div>
                                @endif
                    
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                        @endforeach
                            </ul>
                                </div>
                    @endif
                    @csrf
                    
                    <!-- Amount Input -->
                    <div class="mb-4">
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
                    <div class="mb-4">
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
                    <div class="mb-4">
                        <label for="payment_method_id" class="block text-sm font-medium text-gray-300 mb-2">Payment Method</label>
                        <select id="payment_method_id" 
                                name="payment_method_id" 
                                required
                                class="block w-full py-3 px-3 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select payment method</option>
                            @foreach($wallets as $wallet)
                                <option value="{{ $wallet->id }}" 
                                        data-address="{{ $wallet->address ?? '' }}"
                                        {{ old('payment_method_id') == $wallet->id ? 'selected' : '' }}>{{ $wallet->wallet }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Wallet Address Display -->
                    <div id="walletAddressSection" class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Wallet Address</label>
                        <div class="bg-gray-700 border border-gray-600 rounded-lg p-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-400">Send payment to:</span>
                                <button type="button" id="copyAddressBtn" class="text-blue-400 hover:text-blue-300 text-sm">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    Copy
                                </button>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex-1">
                                    <input type="text" id="walletAddress" readonly class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded text-white text-sm font-mono" />
                                </div>
                                <div id="qrCode" class="w-16 h-16 bg-white rounded p-1"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Proof -->
                    <div class="mb-4">
                        <label for="proof" class="block text-sm font-medium text-gray-300 mb-2">Payment Proof</label>
                        <div class="mt-1 flex justify-center px-3 pt-3 pb-3 border-2 border-gray-600 border-dashed rounded-lg bg-gray-700 hover:bg-gray-600 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-6 w-6 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
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
                                id="cancelBtn"
                                class="flex-1 px-4 py-2 border border-gray-600 rounded-lg text-gray-300 hover:bg-gray-700 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            Submit Deposit
                        </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal functionality
        const modal = document.getElementById('depositModal');
        const newDepositBtn = document.getElementById('newDepositBtn');
        const closeModal = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const depositForm = document.getElementById('depositForm');
        const fileInput = document.getElementById('proof');
        const filePreview = document.getElementById('filePreview');

        // Open modal
        newDepositBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        // Close modal functions
        function closeModalFunc() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            depositForm.reset();
            filePreview.classList.add('hidden');
        }

        closeModal.addEventListener('click', closeModalFunc);
        cancelBtn.addEventListener('click', closeModalFunc);

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModalFunc();
            }
        });

        // File upload preview
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                filePreview.textContent = `Selected: ${file.name}`;
                filePreview.classList.remove('hidden');
            } else {
                filePreview.classList.add('hidden');
            }
        });

        // Wallet address and QR code functionality
        const paymentMethodSelect = document.getElementById('payment_method_id');
        const walletAddressSection = document.getElementById('walletAddressSection');
        const walletAddressInput = document.getElementById('walletAddress');
        const qrCodeDiv = document.getElementById('qrCode');
        const copyAddressBtn = document.getElementById('copyAddressBtn');

        // Handle payment method selection
        paymentMethodSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const walletAddress = selectedOption.getAttribute('data-address');
            
            if (walletAddress && walletAddress.trim() !== '') {
                // Show wallet address section
                walletAddressSection.classList.remove('hidden');
                walletAddressInput.value = walletAddress;
                
                // Generate QR code
                qrCodeDiv.innerHTML = '';
                QRCode.toCanvas(walletAddress, {
                    width: 64,
                    height: 64,
                    margin: 1,
                    color: {
                        dark: '#000000',
                        light: '#FFFFFF'
                    }
                }).then(function(canvas) {
                    qrCodeDiv.appendChild(canvas);
                }).catch(function(error) {
                    console.error('QR Code generation error:', error);
                    qrCodeDiv.innerHTML = '<div class="w-full h-full bg-gray-300 rounded flex items-center justify-center text-xs text-gray-600">QR Error</div>';
                });
            } else {
                // Hide wallet address section
                walletAddressSection.classList.add('hidden');
                walletAddressInput.value = '';
                qrCodeDiv.innerHTML = '';
            }
        });

        // Copy address functionality
        copyAddressBtn.addEventListener('click', function() {
            const address = walletAddressInput.value;
            if (address) {
                // Fallback copy method for older browsers
                const copyToClipboard = async (text) => {
                    try {
                        if (navigator.clipboard && window.isSecureContext) {
                            await navigator.clipboard.writeText(text);
                            return true;
                        } else {
                            // Fallback for older browsers
                            const textArea = document.createElement('textarea');
                            textArea.value = text;
                            textArea.style.position = 'fixed';
                            textArea.style.left = '-999999px';
                            textArea.style.top = '-999999px';
                            document.body.appendChild(textArea);
                            textArea.focus();
                            textArea.select();
                            const result = document.execCommand('copy');
                            textArea.remove();
                            return result;
                        }
                    } catch (err) {
                        console.error('Copy failed:', err);
                        return false;
                    }
                };

                copyToClipboard(address).then(success => {
                    if (success) {
                        // Show success feedback
                        const originalText = copyAddressBtn.innerHTML;
                        copyAddressBtn.innerHTML = `
                            <svg class="w-4 h-4 inline mr-1 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Copied!
                        `;
                        copyAddressBtn.classList.remove('text-blue-400', 'hover:text-blue-300');
                        copyAddressBtn.classList.add('text-green-400');
                        
                        setTimeout(() => {
                            copyAddressBtn.innerHTML = originalText;
                            copyAddressBtn.classList.remove('text-green-400');
                            copyAddressBtn.classList.add('text-blue-400', 'hover:text-blue-300');
                        }, 2000);
                    } else {
                        alert('Failed to copy address to clipboard');
                    }
                });
            }
        });

        // Form submission
        depositForm.addEventListener('submit', (e) => {
            const amount = document.getElementById('amount').value;
            const walletType = document.getElementById('wallet_type').value;
            const paymentMethod = document.getElementById('payment_method_id').value;
            const proof = fileInput.files[0];

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

        // Auto-close modal on successful submission
        @if(session('success'))
            closeModalFunc();
        @endif

        // View proof function
        function viewProof(depositId) {
            window.open('{{ route("user.deposit.proof", "") }}/' + depositId, '_blank');
        }

        // Cancel deposit function
        function cancelDeposit(depositId) {
            if (confirm('Are you sure you want to cancel this deposit?')) {
                // Create a form to submit the cancel request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("user.deposit.cancel", "") }}/' + depositId;
                
                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection

@extends('admin.layouts.app')

@section('content')
<div class="px-4 pt-5">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Trade History</h1>
        <p class="text-gray-600 dark:text-gray-400">Manage all user trades from a single interface</p>
    </div>

    <!-- Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button id="openTradesTab" class="tab-button py-2 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm active">
                    Open Trades
                    <span class="ml-2 bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">{{ $openTrades->count() }}</span>
                </button>
                <button id="closedTradesTab" class="tab-button py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm">
                    Closed Trades
                    <span class="ml-2 bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $closedTrades->count() }}</span>
                </button>
            </nav>
        </div>
    </div>

    <!-- Open Trades Tab Content -->
    <div id="openTradesContent" class="tab-content">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Open Trades</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pair</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Side</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leverage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($openTrades as $trade)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->user->fullname() ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->trade_pair->pair ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->trade_pair->type ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $trade->action_type === 'buy' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($trade->action_type ?? 'N/A') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                ${{ number_format($trade->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->leverage ?? 'N/A' }}x
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->duration ?? 'N/A' }} min
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {!! $trade->adminStatus() !!}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick="openCloseTradeModal('{{ $trade->id }}', '{{ $trade->amount }}')" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                    Close
                                </button>
                                <button onclick="openEditPnlModal('{{ $trade->id }}')" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                    Edit PnL
                                </button>
                                <button onclick="deleteTrade('{{ $trade->id }}')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No open trades found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Closed Trades Tab Content -->
    <div id="closedTradesContent" class="tab-content hidden">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Closed Trades</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pair</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Side</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PnL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Closed At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($closedTrades as $trade)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->user->fullname() ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->trade_pair->pair ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->trade_pair->type ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $trade->action_type === 'buy' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($trade->action_type ?? 'N/A') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                ${{ number_format($trade->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ ($trade->profit_loss ?? 0) >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    ${{ number_format($trade->profit_loss ?? 0, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $trade->updated_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button onclick="openEditPnlModal('{{ $trade->id }}')" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                    Edit PnL
                                </button>
                                <button onclick="deleteTrade('{{ $trade->id }}')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No closed trades found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Close Trade Modal -->
<div id="closeTradeModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="closeTradeForm" method="POST">
                @csrf
                <div class="px-6 py-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Close Trade</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profit/Loss</label>
                        <input type="number" step="0.01" name="profit_loss" id="profitLossInput" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex justify-end space-x-3">
                    <button type="button" onclick="closeCloseTradeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                        Close Trade
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit PnL Modal -->
<div id="editPnlModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="editPnlForm" method="POST">
                @csrf
                <div class="px-6 py-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Edit Profit/Loss</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Profit/Loss</label>
                        <input type="number" step="0.01" name="profit_loss" id="editPnlInput" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditPnlModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700">
                        Update PnL
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteTradeModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Delete Trade</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Are you sure you want to delete this trade? This action cannot be undone.</p>
            </div>
            <form id="deleteTradeForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteTradeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const openTradesTab = document.getElementById('openTradesTab');
    const closedTradesTab = document.getElementById('closedTradesTab');
    const openTradesContent = document.getElementById('openTradesContent');
    const closedTradesContent = document.getElementById('closedTradesContent');

    function switchTab(activeTab, activeContent, inactiveTab, inactiveContent) {
        activeTab.classList.add('border-blue-500', 'text-blue-600');
        activeTab.classList.remove('border-transparent', 'text-gray-500');
        activeContent.classList.remove('hidden');
        
        inactiveTab.classList.remove('border-blue-500', 'text-blue-600');
        inactiveTab.classList.add('border-transparent', 'text-gray-500');
        inactiveContent.classList.add('hidden');
    }

    openTradesTab.addEventListener('click', () => {
        switchTab(openTradesTab, openTradesContent, closedTradesTab, closedTradesContent);
    });

    closedTradesTab.addEventListener('click', () => {
        switchTab(closedTradesTab, closedTradesContent, openTradesTab, openTradesContent);
    });
});

// Modal functions
function openCloseTradeModal(tradeId, amount) {
    document.getElementById('closeTradeForm').action = `{{ route('admin.trade.close', '') }}/${tradeId}`;
    document.getElementById('closeTradeModal').classList.remove('hidden');
}

function closeCloseTradeModal() {
    document.getElementById('closeTradeModal').classList.add('hidden');
}

function openEditPnlModal(tradeId) {
    document.getElementById('editPnlForm').action = `{{ route('admin.trade.edit-pnl', '') }}/${tradeId}`;
    document.getElementById('editPnlModal').classList.remove('hidden');
}

function closeEditPnlModal() {
    document.getElementById('editPnlModal').classList.add('hidden');
}

function deleteTrade(tradeId) {
    document.getElementById('deleteTradeForm').action = `{{ route('admin.trade.destroy', '') }}/${tradeId}`;
    document.getElementById('deleteTradeModal').classList.remove('hidden');
}

function closeDeleteTradeModal() {
    document.getElementById('deleteTradeModal').classList.add('hidden');
}

// Handle form submissions
document.getElementById('editPnlForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const tradeId = this.action.split('/').pop();
    
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            profit_loss: formData.get('profit_loss')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeEditPnlModal();
            location.reload();
        } else {
            alert('Error updating PnL');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating PnL');
    });
});
</script>
@endpush

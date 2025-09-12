@extends('admin.layouts.app')

@section('title', 'AI Trader History - ' . $userAiTrader->aiTrader->name)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">AI Trader History</h1>
            <p class="text-muted">{{ $userAiTrader->aiTrader->name }} - {{ $userAiTrader->user->name }}</p>
        </div>
        <div>
            <a href="{{ route('admin.ai-traders.management') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Management
            </a>
        </div>
    </div>

    <!-- Trader Information Card -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Trader Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-xs font-weight-bold text-primary text-uppercase">User</label>
                                <div class="text-sm">{{ $userAiTrader->user->name }}</div>
                                <div class="text-xs text-muted">{{ $userAiTrader->user->email }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="text-xs font-weight-bold text-primary text-uppercase">AI Trader</label>
                                <div class="text-sm">{{ $userAiTrader->aiTrader->name }}</div>
                                <div class="text-xs text-muted">{{ $userAiTrader->aiTrader->ai_model }} - {{ ucfirst($userAiTrader->aiTrader->trading_strategy) }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="text-xs font-weight-bold text-primary text-uppercase">Plan</label>
                                <div class="text-sm">{{ $userAiTrader->aiTraderPlan->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-xs font-weight-bold text-primary text-uppercase">Investment Amount</label>
                                <div class="text-sm font-weight-bold">${{ number_format($userAiTrader->investment_amount, 2) }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="text-xs font-weight-bold text-primary text-uppercase">Activated Date</label>
                                <div class="text-sm">{{ $userAiTrader->activated_at->format('M d, Y H:i') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="text-xs font-weight-bold text-primary text-uppercase">Status</label>
                                <div>
                                    <span class="badge badge-success">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Performance Summary</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-xs text-muted">Current Balance:</span>
                            <span class="text-sm font-weight-bold">${{ number_format($userAiTrader->current_balance, 2) }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-xs text-muted">Total P&L:</span>
                            <span class="text-sm font-weight-bold {{ $userAiTrader->total_profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                ${{ number_format($userAiTrader->total_profit_loss, 2) }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-xs text-muted">Total Trades:</span>
                            <span class="text-sm font-weight-bold">{{ $userAiTrader->total_trades_executed }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-xs text-muted">Winning Trades:</span>
                            <span class="text-sm font-weight-bold text-success">{{ $userAiTrader->winning_trades }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-xs text-muted">Win Rate:</span>
                            <span class="text-sm font-weight-bold">{{ number_format($userAiTrader->win_rate, 1) }}%</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-xs text-muted">Performance:</span>
                            <span class="text-sm font-weight-bold {{ $userAiTrader->total_profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $userAiTrader->investment_amount > 0 ? number_format(($userAiTrader->total_profit_loss / $userAiTrader->investment_amount) * 100, 2) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Performance Chart (Last 30 Days)</h6>
                </div>
                <div class="card-body">
                    <canvas id="performanceChart" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary mb-3">Quick Actions</h6>
                    <div class="btn-group" role="group">
                        <button type="button" 
                                class="btn btn-warning edit-performance-btn" 
                                data-trader-id="{{ $userAiTrader->id }}"
                                data-current-balance="{{ $userAiTrader->current_balance }}"
                                data-total-profit-loss="{{ $userAiTrader->total_profit_loss }}"
                                data-total-trades="{{ $userAiTrader->total_trades_executed }}"
                                data-winning-trades="{{ $userAiTrader->winning_trades }}"
                                data-win-rate="{{ $userAiTrader->win_rate }}">
                            <i class="fas fa-edit"></i> Edit Performance
                        </button>
                        <button type="button" 
                                class="btn btn-success create-trade-btn" 
                                data-trader-id="{{ $userAiTrader->id }}"
                                data-trader-name="{{ $userAiTrader->aiTrader->name }}">
                            <i class="fas fa-plus"></i> Create Trade
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Trades Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Trades</h6>
                </div>
                <div class="card-body">
                    @if($recentTrades->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Stock</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>P&L</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTrades as $trade)
                                <tr>
                                    <td>{{ $trade->created_at->format('M d, Y H:i') }}</td>
                                    <td>{{ $trade->stock_symbol }}</td>
                                    <td>
                                        <span class="badge {{ $trade->trade_type === 'buy' ? 'badge-success' : 'badge-danger' }}">
                                            {{ ucfirst($trade->trade_type) }}
                                        </span>
                                    </td>
                                    <td>{{ $trade->quantity }}</td>
                                    <td>${{ number_format($trade->price, 2) }}</td>
                                    <td>${{ number_format($trade->quantity * $trade->price, 2) }}</td>
                                    <td>
                                        <span class="font-weight-bold {{ $trade->profit_loss >= 0 ? 'text-success' : 'text-danger' }}">
                                            ${{ number_format($trade->profit_loss, 2) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-chart-line fa-3x text-gray-300 mb-3"></i>
                        <h5 class="text-gray-600">No Trades Yet</h5>
                        <p class="text-muted">This AI trader hasn't executed any trades yet.</p>
                        <button type="button" 
                                class="btn btn-success create-trade-btn" 
                                data-trader-id="{{ $userAiTrader->id }}"
                                data-trader-name="{{ $userAiTrader->aiTrader->name }}">
                            <i class="fas fa-plus"></i> Create First Trade
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Performance Modal -->
<div class="modal fade" id="editPerformanceModal" tabindex="-1" role="dialog" aria-labelledby="editPerformanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPerformanceModalLabel">Edit Trader Performance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPerformanceForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_balance">Current Balance</label>
                        <input type="number" class="form-control" id="current_balance" name="current_balance" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="total_profit_loss">Total Profit/Loss</label>
                        <input type="number" class="form-control" id="total_profit_loss" name="total_profit_loss" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="total_trades_executed">Total Trades Executed</label>
                        <input type="number" class="form-control" id="total_trades_executed" name="total_trades_executed" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="winning_trades">Winning Trades</label>
                        <input type="number" class="form-control" id="winning_trades" name="winning_trades" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="win_rate">Win Rate (%)</label>
                        <input type="number" class="form-control" id="win_rate" name="win_rate" min="0" max="100" step="0.1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Performance</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Trade Modal -->
<div class="modal fade" id="createTradeModal" tabindex="-1" role="dialog" aria-labelledby="createTradeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTradeModalLabel">Create New Trade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createTradeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stock_symbol">Stock Symbol</label>
                        <input type="text" class="form-control" id="stock_symbol" name="stock_symbol" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label for="trade_type">Trade Type</label>
                        <select class="form-control" id="trade_type" name="trade_type" required>
                            <option value="">Select Type</option>
                            <option value="buy">Buy</option>
                            <option value="sell">Sell</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price per Share</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" min="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="profit_loss">Profit/Loss</label>
                        <input type="number" class="form-control" id="profit_loss" name="profit_loss" step="0.01" required>
                        <small class="form-text text-muted">Positive for profit, negative for loss</small>
                    </div>
                    <div class="form-group">
                        <label for="trade_date">Trade Date</label>
                        <input type="date" class="form-control" id="trade_date" name="trade_date" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Create Trade</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    let currentTraderId = {{ $userAiTrader->id }};

    // Load performance chart
    loadPerformanceChart();

    // Edit Performance Modal
    $('.edit-performance-btn').click(function() {
        $('#current_balance').val($(this).data('current-balance'));
        $('#total_profit_loss').val($(this).data('total-profit-loss'));
        $('#total_trades_executed').val($(this).data('total-trades'));
        $('#winning_trades').val($(this).data('winning-trades'));
        $('#win_rate').val($(this).data('win-rate'));
        
        $('#editPerformanceModal').modal('show');
    });

    // Create Trade Modal
    $('.create-trade-btn').click(function() {
        const traderName = $(this).data('trader-name');
        $('#createTradeModalLabel').text(`Create New Trade - ${traderName}`);
        $('#createTradeModal').modal('show');
    });

    // Edit Performance Form Submit
    $('#editPerformanceForm').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: `/admin/ai-traders-performance/${currentTraderId}/update`,
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message || 'An error occurred'
                });
            }
        });
    });

    // Create Trade Form Submit
    $('#createTradeForm').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: `/admin/ai-traders-trade/${currentTraderId}/create`,
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message || 'An error occurred'
                });
            }
        });
    });

    function loadPerformanceChart() {
        $.ajax({
            url: `/admin/ai-traders-performance/${currentTraderId}/data`,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const ctx = document.getElementById('performanceChart').getContext('2d');
                    const data = response.data;
                    
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.map(item => item.date),
                            datasets: [{
                                label: 'Balance',
                                data: data.map(item => item.balance),
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Balance Over Time'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: false,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.1)'
                                    }
                                },
                                x: {
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.1)'
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    }
});
</script>
@endpush

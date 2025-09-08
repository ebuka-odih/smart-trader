@extends('admin.layouts.app')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Mining Statistics</h1>
            <p class="text-muted">Comprehensive mining analytics and insights</p>
        </div>
        <div>
            <a href="{{ route('admin.mining.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Mining Management
            </a>
        </div>
    </div>

    <!-- Overview Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Mining</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_mining']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-mountain fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Mining</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['active_mining']) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-play-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Invested</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($stats['total_invested'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Value</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($stats['total_value'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Breakdown -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mining Status Breakdown</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-weight-bold text-gray-600">Active</div>
                                    <div class="h6 mb-0 text-gray-800">{{ number_format($stats['active_mining']) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-info">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-weight-bold text-gray-600">Completed</div>
                                    <div class="h6 mb-0 text-gray-800">{{ number_format($stats['completed_mining']) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-pause text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-weight-bold text-gray-600">Suspended</div>
                                    <div class="h6 mb-0 text-gray-800">{{ number_format($stats['suspended_mining']) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-danger">
                                        <i class="fas fa-times text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs font-weight-bold text-gray-600">Cancelled</div>
                                    <div class="h6 mb-0 text-gray-800">{{ number_format($stats['cancelled_mining']) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Financial Overview</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-xs font-weight-bold text-gray-600">Total Invested</span>
                            <span class="h6 mb-0 text-gray-800">${{ number_format($stats['total_invested'], 2) }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-xs font-weight-bold text-gray-600">Total Mined</span>
                            <span class="h6 mb-0 text-gray-800">{{ number_format($stats['total_mined'], 8) }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-xs font-weight-bold text-gray-600">Current Value</span>
                            <span class="h6 mb-0 text-gray-800">${{ number_format($stats['total_value'], 2) }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-0">
                        @php
                            $totalPnL = $stats['total_value'] - $stats['total_invested'];
                            $totalPnLPercent = $stats['total_invested'] > 0 ? ($totalPnL / $stats['total_invested']) * 100 : 0;
                        @endphp
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-xs font-weight-bold text-gray-600">Total PnL</span>
                            <span class="h6 mb-0 {{ $totalPnL >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $totalPnL >= 0 ? '+' : '' }}${{ number_format($totalPnL, 2) }}
                                ({{ $totalPnL >= 0 ? '+' : '' }}{{ number_format($totalPnLPercent, 2) }}%)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Mining Data -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Mining Activity (Last 12 Months)</h6>
                </div>
                <div class="card-body">
                    @if($monthlyData->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>New Mining Activities</th>
                                    <th>Total Invested</th>
                                    <th>Total Mined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthlyData as $data)
                                <tr>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $data->month)->format('F Y') }}</td>
                                    <td>{{ number_format($data->count) }}</td>
                                    <td>${{ number_format($data->total_invested, 2) }}</td>
                                    <td>{{ number_format($data->total_mined, 8) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-chart-line fa-3x text-gray-300 mb-3"></i>
                        <h5 class="text-gray-600">No Monthly Data Available</h5>
                        <p class="text-gray-500">No mining activities found in the last 12 months.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Top Mining Plans -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Mining Plans</h6>
                </div>
                <div class="card-body">
                    @if($topPlans->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Plan Name</th>
                                    <th>Total Activities</th>
                                    <th>Total Invested</th>
                                    <th>Average Investment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topPlans as $index => $plan)
                                <tr>
                                    <td>
                                        <span class="badge badge-primary">{{ $index + 1 }}</span>
                                    </td>
                                    <td>{{ $plan->plan->name ?? 'Unknown Plan' }}</td>
                                    <td>{{ number_format($plan->count) }}</td>
                                    <td>${{ number_format($plan->total_invested, 2) }}</td>
                                    <td>${{ number_format($plan->total_invested / $plan->count, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-list fa-3x text-gray-300 mb-3"></i>
                        <h5 class="text-gray-600">No Plan Data Available</h5>
                        <p class="text-gray-500">No mining plans have been used yet.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

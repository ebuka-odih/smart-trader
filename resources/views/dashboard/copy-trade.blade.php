@extends('dashboard.layout.app')
@section('content')
     <style>
    .payment-grid {
        display: grid;
        grid-template-columns: 2fr 2fr 2fr 2fr ; /* Added one more 2fr for the "Ending" column */
        grid-gap: 10px;
        width: 100%;
    }

    .payment-grid-header, .payment-grid-row {
        display: contents;
    }

    .payment-grid div {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center; /* Center text in each grid cell */
    }

    .payment-grid-header div {
        font-weight: bold;
        text-align: center; /* Ensure header text is centered */
    }

    .payment-grid-row div {
        padding: 10px;
    }

    .payment-grid-row:last-child div {
        border-bottom: none;
    }

    .badge {
        padding: 0.3rem 0.6rem; /* Adjust badge padding for smaller display */
        font-size: 0.875rem;
    }
</style>
     <style>
          .icon {
              color: #3030da;
          }
          li {
              margin-top: 10px
          }
      </style>


    <div class="container">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i style="color: #6c6cf3; font-size: 30px" class="icon ion-md-cash"></i> Main Balance</h5>
                    <div>
                        <h5>
                            <small>USD</small><strong> {{ number_format($user->balance, 2) }}</strong>
                        </h5>

                         <h5>
                             <small>BTC</small><strong id="btc-balance"> {{ $user->balance }}</strong>
                         </h5>
                    </div>

                </div>
            </div>
        </div>
        <h2 class="text-center m-3">Copy Trading</h2>
        <div class="container">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <div class="row">


            @foreach($traders as $item)
                 <div  class="col-md-4">
                  <div style="border: 1px solid green" class="landing-feature-item">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img style="border-radius: 50%; height: 70px; width: 70px" src="{{ asset($item->avatar) }}" alt="">
                        <h3 class="mt-0"><strong>{{ $item->name }}</strong></h3>
                    </div>


                      <hr>

                    <div class="cad">
                        <div class="text-center m-3">
                            <h4><strong class="text-primary text-center">${{ $item->amount }}</strong>/<small>Min</small></h4>
                        </div>
                        <div  class="card-body">
                         <ul >
                            <li><i class="icon ion-ios-checkmark-circle"></i> Win Rate: <span class="badge badge-sm bg-secondary text-white">{{ $item->win_rate }}%</span></li>
                            <li><i class="icon ion-ios-checkmark-circle"></i> Profit Shared: <span class="badge badge-sm bg-secondary text-white">${{ $item->profit_share }}</span></li>
                            <li><i class="icon ion-ios-checkmark-circle"></i> Win: <span class="badge badge-sm bg-success text-white">{{ $item->win }}</span></li>
                            <li><i class="icon ion-ios-checkmark-circle"></i> Loss: <span class="badge bg-danger text-white">{{ $item->loss }}</span></li>
                          </ul>
                            <form  action="{{ route('user.copyTrading.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="trader_id" value="{{ $item->id }}">
                                <input type="hidden" name="amount" value="{{ $item->amount }}">

                                <button class="btn btn-primary btn-block submit-with mt-3" type="submit">Copy Trade</button>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>

            @endforeach

        </div>

        <div class="row">
             <div class="col-md-12 py-3">
                <div class="card my-2">
                    <div class="card-header">
                        <h4 class="mb-0">Copied Trades</h4>
                    </div>
                    <div class="card-body px-3 py-3">

                         <div class="payment-grid">
                                <div class="payment-grid-header">
                                    <div>Date</div>
                                    <div>Amount</div>
                                    <div>Trader</div>
                                    <div>Status</div>
                                </div>

                                @foreach($copiedTrades as $index => $item)
                                    <div class="payment-grid-row">
                                        <div>{{ date('d M, Y', strtotime($item->created_at)) }}</div>
                                        <div>${{ number_format($item->amount, 2) ?? '' }}</div>
                                        <div>{{ $item->copy_trader->name ?? '' }}</div>
                                        <div>
                                            @if($item->status == 0)
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @else
                                                <span class="badge bg-success text-white">Active</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

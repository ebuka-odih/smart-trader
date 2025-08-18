@extends('dashboard.layout.app')
@section('content')
   <style>
    .payment-grid {
        display: grid;
        /* 5 columns: #  Amount  Method  Details  Status */
        grid-template-columns: 1fr 2fr 2fr 3fr 2fr;
        width: 100%;
    }

    .payment-grid-header,
    .payment-grid-row {
        display: contents;        /* keep each cell inside the grid */
    }

    .payment-grid div {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .payment-grid-header div {
        font-weight: bold;
    }

    .payment-grid-row:last-child div {
        border-bottom: none;
    }
</style>


    <div class="container mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i style="color: #6c6cf3; font-size: 30px" class="icon ion-md-cash"></i> Main
                        Balance</h5>
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
        <h3 class="text-center mt-3">Withdrawal</h3>
        <div class="card mb-3 mt-4">
            <div class="card-header"><h5 class="mb-0">Withdraw</h5></div>
            <form action="{{ route('user.withdrawalStore') }}" method="POST"
                  class="card-body font-weight-bold">
                @csrf
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="mx-auto" style="max-width: 400px">
                    <p>
                        To make a withdrawal, select payment method, amount and verify the address/bank you wish for
                        payment to
                        be made into.
                    </p>
                    <select id="withdrawalMethod" name="payment_method" class="form-control mb-3"
                            onchange="toggleBeneficiaryFields()">
                        <option value="">Select Payment Method</option>
                        <option value="crypto">Crypto</option>
                        <option value="bank">Bank Transfer</option>
                        <option value="paypal">PayPal</option>
                    </select>

                    <div id="beneficiaryField6" style="display: none;">
                        <div class="form-group">
                            <label>Wallet</label>
                            <select name="wallet" id="" class="form-control">
                                <option value="Bitcoin">Bitcoin</option>
                                <option value="Ethereum">Ethereum</option>
                                <option value="Solana">Solana</option>
                                <option value="BNB">Binance Coin (BNB)</option>
                            </select>
                        </div>
                        <div class="form-group" id="walletInfo">
                            <label for="wallet">Your Address:</label>
                            <input type="text" name="address" class="form-control" id="wallet">
                        </div>

                    </div>

                    <!-- Bank Transfer Fields -->
                    <div id="beneficiaryField1" style="display: none;">
                        <div class="form-group">
                            <label>Bank Name:</label>
                            <input type="text" name="bank_name" placeholder="Chase Bank" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Account Name:</label>
                            <input type="text" name="acct_name" placeholder="John Doe" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Account Number:</label>
                            <input type="number" name="acct_number" placeholder="29930192" class="form-control">
                        </div>
                        <div class="mb-3 rounded p-3 border">Your Account Manager may request further information.</div>
                    </div>
                    <!-- PayPal Field -->
                    <div id="beneficiaryField5" style="display: none;">
                        <div class="form-group" id="walletInfo">
                            <label for="wallet">Paypal Email:</label>
                            <input type="text" name="paypal" class="form-control" id="wallet">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" step="0.000000000001" id="amount" name="amount" class="form-control">
                    </div>

                    <button class="btn btn-primary  btn-block" type="submit">Withdraw</button>
                </div>
            </form>

        </div>
        <div class="card my-2">
            <div class="card-header">
                <h4 class="mb-0">Withdrawals</h4>
            </div>
            <div class="card-body px-3 py-5">

                <div class="payment-grid">
    {{-- header --}}
    <div class="payment-grid-header">
        <div>#</div>
        <div>Amount</div>
        <div>Method</div>
        <div>Details</div>
        <div>Status</div>
    </div>

    {{-- rows --}}
    @forelse ($withdrawals as $index => $w)
        <div class="payment-grid-row">
            {{-- # --}}
            <div>{{ $index + 1 }}</div>

            {{-- Amount --}}
            <div>${{ number_format($w->amount, 2) }}</div>

            {{-- Method --}}
            <div>{{ ucfirst($w->payment_method) }}</div>

            {{-- Details: show ONLY what was provided --}}
            <div>
                @switch($w->payment_method)
                    @case('crypto')
                        {{ $w->wallet ?? '—' }}
                        @break

                    @case('bank')
                        @php($bank = json_decode($w->bank, true))
                        {{ $bank['bank_name'] ?? '' }}
                        {{ isset($bank['acct_name']) ? '· '.$bank['acct_name'] : '' }}
                        @break

                    @case('paypal')
                        {{ $w->paypal ?? '—' }}
                        @break

                    @default
                        {{ $w->address ?? '—' }}
                @endswitch
            </div>

            {{-- Status --}}
            <div>
                {!! $w->status() !!}
            </div>
        </div>
    @empty
        <div class="payment-grid-row">
            <div colspan="5">No withdrawals found.</div>
        </div>
    @endforelse
</div>


            </div>
        </div>
    </div>



    <script>
        function toggleBeneficiaryFields() {
            const pairType = document.getElementById('withdrawalMethod').value;

            // All fields to hide/show
            const allFields = [
                'beneficiaryField1', // Bank Transfer Fields
                'beneficiaryField5', // PayPal Field
                'beneficiaryField6', // Crypto Field
            ];

            // Define the fields to show for each payment method
            const methodFields = {
                'bank': ['beneficiaryField1'],
                'paypal': ['beneficiaryField5'],
                'crypto': ['beneficiaryField6']
            };

            // Hide all fields
            allFields.forEach(function (fieldId) {
                document.getElementById(fieldId).style.display = 'none';
            });

            // Show the fields corresponding to the selected payment method
            if (methodFields[pairType]) {
                methodFields[pairType].forEach(function (fieldId) {
                    document.getElementById(fieldId).style.display = 'block';
                });
            }
        }
    </script>

@endsection

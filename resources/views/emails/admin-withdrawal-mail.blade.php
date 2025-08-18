<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th, td {
      padding: 5px;
      text-align: left;
    }
    </style>
</head>
<body>


    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-black text-white">
                <h2 class="text-center">New Deposit</h2>
            </div>
            <div class="card-body">
                <p>Withdrawal Details</p>
                <table style="width:100%" class="table table-striped">
                  <tr>
                    <th>User:</th>
                     <td>{{ $withdraw->user->fullname() ?? '' }}</td>
                  </tr>
                    <tr>
                    <th>Transaction ID:</th>
                     <td>{{ $withdraw->id."#" }}</td>
                  </tr>
                  <tr>
                    <th>Amount:</th>
                    <td>${{ number_format($withdraw->amount, 2) ?? ''}}</td>
                  </tr>
                  <tr>
                    <th>Withdrawal Method:</th>
                    <td>{{ $withdraw->payment_method ?? '' }}</td>
                  </tr>
                  <tr>
                    <th>Payment Details:</th>
                      @if($withdraw->payment_method == 'crypto')
                          <td>{{ $withdraw->wallet ?? '' }}</td>
                          <td>{{ $withdraw->address ?? '' }}</td>
                      @elseif($withdraw->payment_method == 'bank')
                          <td>{{ $withdraw->bank_name ?? '' }}</td>
                          <td>{{ $withdraw->acct_name ?? '' }}</td>
                          <td>{{ $withdraw->acct_number ?? '' }}</td>
                      @else
                          <td>{{ $withdraw->paypal ?? '' }}</td>
                      @endif
                  </tr>
                  <tr>
                    <th>Date:</th>
                    <td>{{ date('d M, Y', strtotime($withdraw->created_at)) }}</td>
                  </tr>
                </table>

            </div>
            <div class="card-footer text-center text-muted">
                © {{ Date('Y') }} {{ env('APP_NAME') }} - All Rights Reserved
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

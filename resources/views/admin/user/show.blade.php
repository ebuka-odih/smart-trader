@extends('admin.layouts.app')
@section('content')
<style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 5px;
      text-align: left;
    }
</style>

 <div class="px-4 pt-5">
     <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-1 2xl:grid-cols-3 mb-5">
         <a class="text-dark dark:text-white" href="{{ route('admin.user.index') }}">
            <x-gmdi-arrow-back-ios-new-o class="w-4 h-4 mr-2"/> Back
         </a>

     <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
              <table style="width:100%" class="text-dark border-black dark:text-white dark:border-white">
              <tr>
                <th>Name:</th>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <th>Phone:</th>
                <td>{{ $user->phone ?? 'N/A' }}</td>
              </tr>
              <tr>
                <th>Telegram Handle:</th>
                <td>{{ $user->telegram ?? 'N/A'}}</td>
              </tr>
              <tr>
                <th>Trader:</th>
                <td>{{ $user->trader ? "Yes" : 'N/A'}}</td>
              </tr>
              <tr>
                <th>Trade Count:</th>
                <td>{{ $user->trade_count ? "Yes" : 'N/A'}}</td>
              </tr>
              <tr>
                <th>Main Balance:</th>
                <td>${{ number_format($user->balance, 2) ?? ''}}</td>
              </tr>
              <tr>
                <th>Profit Balance:</th>
                <td>${{ number_format($user->profit, 2) ?? ''}}</td>
              </tr>
              <tr>
                <th>Status:</th>
                <td>{!! $user->status() !!}</td>
              </tr>
            </table>

     </div>
         <div class=" p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                @if ($errors->any())
                    <div class="alert alert-danger text-red-500">
                        <ul class="text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
             <form class="max-w-2xl w-full mx-auto p-4" action="{{ route('admin.updateBalance', $user->id) }}" method="POST">
                 @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="col-span-2">
                        <label for="balance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Main Balance</label>
                        <input type="number" step="0.001" name="balance" id="balance"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-4
                            dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter Amount" >
                    </div>
                    <div class="col-span-2">
                        <label for="profit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profit</label>
                        <input type="number" step="0.001" name="profit" id="profit"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-4
                            dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Enter Amount" >
                    </div>
                </div>

               <button type="submit" name="action_type" value="add" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Fund</button>
            <button type="submit" name="action_type" value="defund" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Defund</button>
        </form>



         </div>


    </div>

    <!-- 2 columns -->

</div>

@endsection

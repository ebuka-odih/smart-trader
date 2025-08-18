@extends('admin.layouts.app')
@section('content')


 <div class="px-4 pt-5">
     <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3 mb-5">
         <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
          <h3 class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">Total Users</h3>
          <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $users }}</span>

        </div>
        <div class="w-full" id="week-signups-chart"></div>
      </div>
         <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
              <h3 class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">Total Deposits</h3>
              <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">${{ number_format($deposits, 2) }}</span>

            </div>
            <div class="w-full" id="week-signups-chart"></div>
      </div>
      <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
              <h3 class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">Total Withdrawal</h3>
              <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">${{ number_format($withdrawal, 2) }}</span>

            </div>
            <div class="w-full" id="week-signups-chart"></div>
      </div>
     <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="w-full">
              <h3 class="text-base font-normal text-gray-500 dark:text-gray-400 mb-3">Total Traded</h3>
              <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">${{ number_format($traded, 2) }}</span>

            </div>
            <div class="w-full" id="week-signups-chart"></div>
      </div>

    </div>

    <!-- 2 columns -->

</div>

@endsection

@extends('admin.layouts.app')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">
  <div class="mb-6 flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Copied History</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">List of all user copied trades</p>
    </div>
  </div>

  <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-900/50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Trader</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          @foreach($copiedTrades as $trade)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $trade->created_at->format('M d, Y') }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $trade->user->name ?? '—' }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $trade->copy_trader->name ?? '—' }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">${{ number_format($trade->amount, 2) }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($trade->status == 1)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
              @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">Inactive</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
              <div class="inline-flex items-center gap-2">
                <a href="{{ route('admin.user.index') }}" class="px-3 py-1.5 rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">User</a>
                <a href="{{ route('admin.copy-trader.index') }}" class="px-3 py-1.5 rounded-md border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">Trader</a>
                @if($trade->status == 1)
                  <form method="POST" action="#" onsubmit="return confirm('Mark this copied trade as inactive?');">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-md bg-red-600 text-white hover:bg-red-700">Deactivate</button>
                  </form>
                @else
                  <form method="POST" action="#" onsubmit="return confirm('Mark this copied trade as active?');">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-md bg-green-600 text-white hover:bg-green-700">Activate</button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">{{ $copiedTrades->links() }}</div>
  </div>
</div>
@endsection

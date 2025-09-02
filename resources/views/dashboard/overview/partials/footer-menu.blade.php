<!-- Footer Menu -->
<div class="fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 z-50">
    <div class="flex justify-around">
        <a href="{{ route('user.liveTrading.index') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.liveTrading.index') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">Live Trading</span>
        </a>
        <a href="{{ route('user.botTrading.index') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.botTrading.index') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"></path>
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">Bot Trading</span>
        </a>
        <a href="{{ route('user.copyTrading.index') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.copyTrading.index') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">Copy Trading</span>
        </a>

        <a href="{{ route('user.liveTrading.history') }}" class="flex flex-col items-center py-3 px-4 {{ request()->routeIs('user.liveTrading.history') ? 'text-blue-400' : 'text-gray-400' }} hover:text-white">
            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs">History</span>
        </a>
    </div>
</div>

<!-- Add bottom padding for footer -->
<div class="pb-20"></div>

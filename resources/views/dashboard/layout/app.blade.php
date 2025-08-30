
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} - Dashboard</title>
  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    
    <!-- Tailwind CSS CDN for immediate styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Pusher JS for real-time updates -->
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

    <!-- Vite assets (uncomment when running npm run dev) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-900 text-white min-h-screen">
    <div class="h-screen bg-gray-900">
        <!-- Sidebar Backdrop -->
        <div id="sidebarBackdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gray-800 border-r border-gray-700 flex flex-col transform transition-transform duration-300 ease-in-out z-50">
            <!-- User Profile Section -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white font-semibold">Menu</h3>
                    <!-- Close button -->
                    <button id="sidebarClose" class="p-1 text-gray-400 hover:text-white hover:bg-gray-700 rounded transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-400 text-sm">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>



            <!-- Navigation Menu -->
            <nav class="flex-1 p-4 space-y-4 overflow-y-auto">
                <!-- Main Section -->
                <div>
                    <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Main
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('user.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>

                <!-- Finance & Wallet Section -->
                <div>
                    <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Finance & Wallet
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('user.deposit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('user.deposit') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Deposit</span>
                        </a>
                        <a href="{{ route('user.withdrawal') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('user.withdrawal') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Withdraw</span>
                        </a>
                    </div>
                </div>

                <!-- Investments Section -->
                <div>
                    <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Investments
                    </div>
                    <div class="space-y-1">
                        <!-- Plans Dropdown -->
                        <div class="relative">
                            <button id="plansDropdown" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700 transition-colors">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Available Plans</span>
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="plansDropdownMenu" class="absolute left-0 right-0 mt-1 bg-gray-800 border border-gray-700 rounded-lg shadow-lg opacity-0 invisible transition-all duration-200 transform -translate-y-2 z-50">
                                <div class="py-1">
                                    <a href="{{ route('user.plan.trading') }}" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                        </svg>
                                        <span>Trading Plans</span>
                                    </a>
                                    <a href="{{ route('user.plan.signal') }}" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Signal Plans</span>
                                    </a>
                                    <a href="{{ route('user.mining.index') }}" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Mining Plans</span>
                                    </a>
                                    <a href="{{ route('user.staking.index') }}" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 transition-colors">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Staking Plans</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('user.plans.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('user.plans.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" clip-rule="evenodd"></path>
                            </svg>
                            <span>My Plans</span>
                        </a>
                        <a href="{{ route('user.portfolio.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('user.portfolio.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                            </svg>
                            <span>Portfolio</span>
                        </a>
                    </div>
                </div>

                <!-- Trading Section -->
                <div>
                    <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Trading
                    </div>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span>Overview</span>
                        </a>
                        <a href="{{ route('user.trade.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('user.trade.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                            </svg>
                            <span>Live Trading</span>
                        </a>
                        <a href="{{ route('user.copyTrading.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('user.copyTrading.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                            </svg>
                            <span>Copy Trading</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Bot Trading</span>
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Bottom padding to ensure last items are visible -->
            <div class="pb-8"></div>
        </div>

        <!-- Main Content -->
        <div class="w-full h-full flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-gray-800 border-b border-gray-700 py-4">
                <div class="flex items-center">
                    <!-- Left side - Brand and menu -->
                    <div class="flex items-center space-x-4 px-4 sm:px-6">
                        <!-- Menu Toggle Button -->
                        <button id="sidebarToggle" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <h1 class="text-xl font-semibold text-white">{{ env('APP_NAME') }}</h1>
                    </div>
                    
                    <!-- Right side - Notification and user profile -->
                    <div class="flex items-center space-x-1 sm:space-x-2 ml-auto -mr-2 sm:-mr-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                            </svg>
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400"></span>
                        </button>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-1 sm:space-x-2 p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-50">
                                <div class="py-1">
                                    <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Settings
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
                                            <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
      </div>
  </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900">
                <div class="container mx-auto px-6 py-8">
                    @if(session('success'))
                        <div id="alert-success" class="mb-4 rounded-md border border-green-500 bg-green-600 text-white px-4 py-3">
                            <div class="font-medium">{{ session('success') }}</div>
                        </div>
                        <script>console.log('[Flash] success:', @json(session('success')));</script>
                    @endif

                    @if(session('error'))
                        <div id="alert-error" class="mb-4 rounded-md border border-red-500 bg-red-600 text-white px-4 py-3">
                            <div class="font-medium">{{ session('error') }}</div>
                        </div>
                        <script>console.log('[Flash] error:', @json(session('error')));</script>
                    @endif

                    @if(session('warning'))
                        <div id="alert-warning" class="mb-4 rounded-md border border-yellow-500 bg-yellow-600 text-white px-4 py-3">
                            <div class="font-medium">{{ session('warning') }}</div>
                        </div>
                        <script>console.log('[Flash] warning:', @json(session('warning')));</script>
                    @endif

                    @if ($errors->any())
                        <div id="alert-validation" class="mb-4 rounded-md border border-yellow-500 bg-yellow-600 text-white px-4 py-3">
                            <div class="font-semibold mb-1">Please fix the following:</div>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <script>console.log('[Flash] validation errors:', @json($errors->all()));</script>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>


@livewireScripts
    @stack('scripts')

<script>
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            // Always start with sidebar hidden on page load
            sidebar.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('hidden');
            
            // Clear any existing localStorage to ensure clean state
            localStorage.removeItem('sidebarOpen');
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                const isCurrentlyOpen = !sidebar.classList.contains('-translate-x-full');
                
                if (isCurrentlyOpen) {
                    // Close sidebar
                    sidebar.classList.add('-translate-x-full');
                    sidebarBackdrop.classList.add('hidden');
                    localStorage.setItem('sidebarOpen', 'false');
                } else {
                    // Open sidebar
                    sidebar.classList.remove('-translate-x-full');
                    sidebarBackdrop.classList.remove('hidden');
                    localStorage.setItem('sidebarOpen', 'true');
                }
            });
            
            // Close sidebar when clicking backdrop
            sidebarBackdrop.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebarBackdrop.classList.add('hidden');
                localStorage.setItem('sidebarOpen', 'false');
            });
            
            // Close sidebar when clicking close button
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebarBackdrop.classList.add('hidden');
                localStorage.setItem('sidebarOpen', 'false');
            });
            
            // Close sidebar when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);
                const isClickOnBackdrop = sidebarBackdrop.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle && !isClickOnBackdrop && !sidebar.classList.contains('-translate-x-full')) {
                    // Close sidebar on any device when clicking outside
                    sidebar.classList.add('-translate-x-full');
                    sidebarBackdrop.classList.add('hidden');
                    localStorage.setItem('sidebarOpen', 'false');
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                // Always show backdrop when sidebar is open (both mobile and desktop)
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebarBackdrop.classList.remove('hidden');
                }
            });

            // Plans dropdown functionality
            const plansDropdown = document.getElementById('plansDropdown');
            const plansDropdownMenu = document.getElementById('plansDropdownMenu');
            const plansDropdownArrow = plansDropdown.querySelector('svg:last-child');

            if (plansDropdown && plansDropdownMenu) {
                plansDropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isOpen = plansDropdownMenu.classList.contains('opacity-100');
                    
                    if (isOpen) {
                        // Close dropdown
                        plansDropdownMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                        plansDropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                        plansDropdownArrow.style.transform = 'rotate(0deg)';
                    } else {
                        // Open dropdown
                        plansDropdownMenu.classList.remove('opacity-0', 'invisible', '-translate-y-2');
                        plansDropdownMenu.classList.add('opacity-100', 'visible', 'translate-y-0');
                        plansDropdownArrow.style.transform = 'rotate(180deg)';
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!plansDropdown.contains(e.target) && !plansDropdownMenu.contains(e.target)) {
                        plansDropdownMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                        plansDropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                        plansDropdownArrow.style.transform = 'rotate(0deg)';
                    }
                });

                // Close dropdown when sidebar closes
                sidebarToggle.addEventListener('click', function() {
                    plansDropdownMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    plansDropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                    plansDropdownArrow.style.transform = 'rotate(0deg)';
                });
    }
});
</script>
</body>
</html>

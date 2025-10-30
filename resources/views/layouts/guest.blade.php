<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="manifest" href="/manifest.webmanifest">
        <meta name="theme-color" content="#0b1020">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body  class="font-sans text-gray-900 antialiased">
        <div id="pwaPrompt" class="hidden fixed inset-0 z-50 items-end justify-center">
            <div class="fixed inset-0 bg-black/50"></div>
            <div class="relative m-4 w-full max-w-sm bg-white text-gray-900 rounded-xl shadow-xl p-4">
                <div class="flex items-start">
                    <img src="/img/100x.png" alt="App Icon" class="w-10 h-10 mr-3 rounded">
                    <div class="flex-1">
                        <div class="font-semibold">Add 100x to Home Screen</div>
                        <div class="text-sm text-gray-600 mt-1">Install the app for faster access and an app-like experience.</div>
                    </div>
                </div>
                <div class="mt-4 flex gap-2 justify-end">
                    <button id="pwaPromptDismiss" class="px-3 py-2 text-sm rounded border border-gray-300">Maybe later</button>
                    <button id="pwaPromptInstall" class="px-3 py-2 text-sm rounded bg-blue-600 text-white">Install</button>
                </div>
            </div>
        </div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="{{ route('index') }}">
                    @if(\App\Helpers\WebsiteSettingsHelper::hasTextLogo())
                        <!-- Text Logo -->
                        <div class="flex items-center justify-center px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg" style="width: 200px; height: 160px;">
                            <span class="text-white font-bold text-3xl">{{ \App\Helpers\WebsiteSettingsHelper::getTextLogo() }}</span>
                        </div>
                    @elseif(\App\Helpers\WebsiteSettingsHelper::hasImageLogo())
                        <!-- Image Logo -->
                        <img src="{{ \App\Helpers\WebsiteSettingsHelper::getLogoUrl() }}" 
                             alt="{{ \App\Helpers\WebsiteSettingsHelper::getSiteName() }}" 
                             width="200" height="160" 
                             style="background-color: white; object-fit: contain;">
                    @else
                        <!-- Site Name as Logo (fallback) -->
                        <div class="flex items-center justify-center px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg" style="width: 200px; height: 160px;">
                            <span class="text-white font-bold text-2xl text-center">{{ \App\Helpers\WebsiteSettingsHelper::getSiteName() }}</span>
                        </div>
                    @endif
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/service-worker.js').catch(function(e){
                        console.error('Service worker registration failed', e);
                    });
                });
            }

            (function() {
                var promptEvent = null;
                var promptEl = document.getElementById('pwaPrompt');
                var installBtn = document.getElementById('pwaPromptInstall');
                var dismissBtn = document.getElementById('pwaPromptDismiss');

                if (!promptEl) return;

                function showPrompt() {
                    if (!promptEvent) return;
                    promptEl.classList.remove('hidden');
                    promptEl.classList.add('flex');
                }

                function hidePrompt() {
                    promptEl.classList.add('hidden');
                    promptEl.classList.remove('flex');
                }

                var isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;
                if (isStandalone || localStorage.getItem('pwaInstalled') === '1') {
                    return;
                }

                window.addEventListener('beforeinstallprompt', function(e) {
                    e.preventDefault();
                    promptEvent = e;
                    setTimeout(showPrompt, 6000);
                });

                installBtn && installBtn.addEventListener('click', async function() {
                    if (!promptEvent) return;
                    try {
                        promptEvent.prompt();
                        var res = await promptEvent.userChoice;
                        if (res && res.outcome === 'accepted') hidePrompt();
                    } catch (err) {
                        console.error('Install failed', err);
                    } finally {
                        promptEvent = null;
                    }
                });

                dismissBtn && dismissBtn.addEventListener('click', function() {
                    hidePrompt();
                    localStorage.setItem('pwaPromptDismissed', '1');
                });

                window.addEventListener('appinstalled', function() {
                    localStorage.setItem('pwaInstalled', '1');
                    hidePrompt();
                });
            })();
        </script>
    </body>
</html>

const CACHE_NAME = 'st-dashboard-cache-v1';
const DASHBOARD_PREFIX = '/user/';

// Precache minimal shell for dashboard
self.addEventListener('install', (event) => {
  event.waitUntil((async () => {
    const cache = await caches.open(CACHE_NAME);
    try {
      await cache.addAll([
        '/user/dashboard',
        '/build/assets/app.css',
        '/build/assets/app.js',
        '/favicon.ico'
      ]);
    } catch (e) {
      // Ignore failures during install precache
    }
    self.skipWaiting();
  })());
});

self.addEventListener('activate', (event) => {
  event.waitUntil((async () => {
    const keys = await caches.keys();
    await Promise.all(keys.map((key) => {
      if (key !== CACHE_NAME) {
        return caches.delete(key);
      }
    }));
    await self.clients.claim();
  })());
});

// Network-first for dashboard API/data, cache-first for static assets
self.addEventListener('fetch', (event) => {
  const { request } = event;
  if (request.method !== 'GET') return;

  const url = new URL(request.url);

  // Only handle requests within our origin
  if (url.origin !== self.location.origin) return;

  // Only handle dashboard scope to avoid affecting public/admin
  const isInDashboard = url.pathname.startsWith(DASHBOARD_PREFIX);
  const isStaticAsset = url.pathname.startsWith('/build/') || url.pathname.startsWith('/assets/') || url.pathname.startsWith('/static/');

  if (!isInDashboard && !isStaticAsset) return;

  if (isStaticAsset) {
    event.respondWith(cacheFirst(request));
  } else {
    event.respondWith(networkFirst(request));
  }
});

async function cacheFirst(request) {
  const cache = await caches.open(CACHE_NAME);
  const cached = await cache.match(request);
  if (cached) return cached;
  const response = await fetch(request);
  cache.put(request, response.clone());
  return response;
}

async function networkFirst(request) {
  const cache = await caches.open(CACHE_NAME);
  try {
    const response = await fetch(request);
    cache.put(request, response.clone());
    return response;
  } catch (e) {
    const cached = await cache.match(request);
    if (cached) return cached;
    // Fallback to dashboard root if available
    return cache.match('/user/dashboard');
  }
}



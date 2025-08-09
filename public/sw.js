const CACHE_NAME = 'v1.0.0';

const cacheAssets = [
    '/favicon.ico',
    // You can add other static files here (e.g., CSS, logo, manifest.json, etc.)
];

// INSTALL EVENT: Cache static assets
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return cache.addAll(cacheAssets);
        })
    );
});

// ACTIVATE EVENT: Remove old caches
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(
                keys.map(key => {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            );
        })
    );
});

// FETCH EVENT: Handle requests
self.addEventListener('fetch', event => {
    const url = new URL(event.request.url);

    // 🚫 Bypass caching for Livewire, API, and PHP requests
    if (
        url.pathname.startsWith('/livewire/') ||
        url.pathname.endsWith('.php') ||
        url.pathname.startsWith('/api/')
    ) {
        return event.respondWith(fetch(event.request));
    }

    // ✅ Cache-first strategy for everything else
    event.respondWith(
        caches.open(CACHE_NAME).then(cache => {
            return cache.match(event.request).then(response => {
                return (
                    response ||
                    fetch(event.request).then(fetchRes => {
                        // Optionally cache the new response
                        cache.put(event.request, fetchRes.clone());
                        return fetchRes;
                    })
                );
            });
        })
    );
});

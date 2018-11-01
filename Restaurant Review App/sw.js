let cache_version = 'v1.0';
let cache_items = [
    'css/styles.css',
    'css/responsive.css',
    'data/restaurants.json',
    'img/1.jpg',
    'img/2.jpg',
    'img/3.jpg',
    'img/4.jpg',
    'img/5.jpg',
    'img/6.jpg',
    'img/7.jpg',
    'img/8.jpg',
    'img/9.jpg',
    'img/10.jpg',
    'js/dbhelper.js',
    'js/main.js',
    'js/restaurant_info.js',
    'index.html',
    'restaurant.html'
];



self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(cache_version).then(function (cache) {
            return cache.addAll(cache_items);
        })
    )
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.filter(function (cacheName) {
                    return cacheName.startsWith('v') && cacheName != cache_version;
                }).map(function (cacheName) {
                    return cache.delete(cacheName);
                })
            )
        })
    )
})

self.addEventListener('fetch', function (event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            if (response){
                return response;
            }
            else{
                return fetch(event.request);
            }
        })
    )
});
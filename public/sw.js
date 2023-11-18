const preLoad = function () {
    return caches.open("offline").then(function (cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("install", function (event) {
    event.waitUntil(preLoad());
});

const filesToCache = [
    "/",
    "/offline.html",
    "/css/adminlte.min.css",
    "/css/bootstrap.min.css",
    "/css/login.css",
    "/css/style.css",
    "/css/validasi.css",
    "/js/main.js",
    "/js/bootstrap.bundle.min.js",
    "/js/bootstrap.min.js",
    "/js/jquery.min.js",
    "/js/popper.js",
    "/img/LOGO PORBIO-01.png",
    "/img/sinjai.png",
    "/1.png",
];

const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

const addToCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};

const returnFromCache = function (request) {
    return caches.open("offline").then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status === 404) {
                return cache.match("offline.html");
            } else {
                return matching;
            }
        });
    });
};

self.addEventListener("fetch", function (event) {
    event.respondWith(
        checkResponse(event.request).catch(function () {
            return returnFromCache(event.request);
        })
    );
    if (!event.request.url.startsWith("http")) {
        event.waitUntil(addToCache(event.request));
    }
});

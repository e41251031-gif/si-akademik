<?php
// Meneruskan eksekusi ke kode Acara 8
require_once __DIR__ . '/index_acara8.php';
exit;
require_once __DIR__ . '/../routes/web.php';

$basePath = '/si-akademik/public';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}

$uri = $uri ?: '/';

$method = $_SERVER['REQUEST_METHOD'];


// ===============================
// ROUTE BIASA
// ===============================
if (isset($routes[$uri])) {

    $controllerName = $routes[$uri][0];
    $methodName = $routes[$uri][1];

    // ===============================
    // MIDDLEWARE DASHBOARD
    // ===============================
    if ($uri === '/dashboard') {

        $middlewareFile = __DIR__ . '/../app/Middleware/AuthMiddleware.php';

        if (file_exists($middlewareFile)) {
            require_once $middlewareFile;
        }

        $middleware = new AuthMiddleware();
        $middleware->handle();
    }

    // ===============================
    // LOAD CONTROLLER
    // ===============================
    $controllerFile = __DIR__ . '/../app/Controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    } else {
        http_response_code(500);
        echo "Controller tidak ditemukan: " . $controllerFile;
        exit;
    }

    // Cek apakah class Controller tersedia
    if (!class_exists($controllerName)) {
        http_response_code(500);
        echo "Class Controller tidak ditemukan: " . $controllerName;
        exit;
    }

    // Jalankan Controller
    $controller = new $controllerName();

    // Cek method
    if (!method_exists($controller, $methodName)) {
        http_response_code(500);
        echo "Method tidak ditemukan: " . $methodName;
        exit;
    }

    $controller->$methodName();


// ===============================
// ROUTE MAHASISWA DENGAN ID
// ===============================
} elseif (preg_match('#^/mahasiswa/([0-9]+)$#', $uri, $matches)) {

    require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

    $controller = new MahasiswaController();

    $controller->show($matches[1]);


// ===============================
// 404
// ===============================
} else {

    http_response_code(404);

    echo "404 - Halaman tidak ditemukan";
}
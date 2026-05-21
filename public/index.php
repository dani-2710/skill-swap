<?php
// Start session
session_start();

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Simple autoloader
spl_autoload_register(function($class) {
    // Convert namespace to full file path
    // e.g. App\Core\Router -> BASE_PATH/app/Core/Router.php
    $class = str_replace('App\\', 'app\\', $class);
    $file = BASE_PATH . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Load configuration
require_once BASE_PATH . '/app/config/config.php';

// Initialize router
$router = new \App\Core\Router();

// Load routes
require_once BASE_PATH . '/routes/web.php';

// Resolve the current request
if (isset($_GET['url'])) {
    $url = '/' . rtrim($_GET['url'], '/');
} else {
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    $baseDir = dirname($scriptName); // gets the root directory name e.g. /skill-swap
    
    if (strpos($requestUri, $baseDir) === 0) {
        $url = substr($requestUri, strlen($baseDir));
    } else {
        $url = $requestUri;
    }
}

if ($url === '' || $url === '/' || $url === '/public' || $url === '/public/index.php' || $url === '/index.php') {
    $url = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

$router->resolve($method, $url);

<?php
$basePath = dirname(__DIR__);

if (file_exists($basePath . '/vendor/autoload.php')) {
    require $basePath . '/vendor/autoload.php';
} else {
    spl_autoload_register(function ($class) use ($basePath) {
        $classMap = [
            'App\\Controllers\\' => 'App/controller/',
            'Framework\\' => 'Framework/',
        ];

        foreach ($classMap as $prefix => $directory) {
            if (str_starts_with($class, $prefix)) {
                $relativeClass = substr($class, strlen($prefix));
                $file = $basePath . '/' . $directory . str_replace('\\', '/', $relativeClass) . '.php';

                if (file_exists($file)) {
                    require $file;
                }
            }
        }
    });
}

require $basePath . '/helper.php';

use Framework\Router;
use Framework\Session;

Session::start();

$router = new Router();

require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route($uri);

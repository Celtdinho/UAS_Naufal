<?php
// Start session
session_start();

// Load configuration
require_once 'config/database.php';
require_once 'config/constants.php';

// Load core classes
require_once 'app/core/Database.php';
require_once 'app/core/Model.php';
require_once 'app/core/Controller.php';

// Get URL parameters
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);

// Set controller and method
$controllerName = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';
$methodName = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Load controller
$controllerPath = 'app/controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    
    // Check if controller class exists
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        
        if (method_exists($controller, $methodName)) {
            call_user_func_array([$controller, $methodName], $params);
        } else {
            // Method not found
            http_response_code(404);
            echo '<h1>404 - Method not found</h1>';
            echo '<p>Method <strong>' . $methodName . '</strong> tidak ditemukan dalam controller <strong>' . $controllerName . '</strong></p>';
        }
    } else {
        // Controller class not found
        http_response_code(404);
        echo '<h1>404 - Controller class not found</h1>';
    }
} else {
    // Controller file not found
    http_response_code(404);
    echo '<h1>404 - Page not found</h1>';
    echo '<p>Controller file <strong>' . $controllerPath . '</strong> tidak ditemukan</p>';
}
?>
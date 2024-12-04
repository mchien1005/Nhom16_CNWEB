<?php
require_once "models/Database.php";
require_once "controllers/HomeController.php";
require_once "controllers/AdminController.php";
require_once "controllers/NewsController.php";

// Lấy controller và action từ URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controller) {
    case 'home':
        $controllerObj = new HomeController();
        break;
    case 'admin':
        $controllerObj = new AdminController();
        break;
    case 'news':
        $controllerObj = new NewsController();
        break;
    default:
        die("Controller không hợp lệ!");
}

// Gọi action tương ứng
if (method_exists($controllerObj, $action)) {
    $controllerObj->$action();
} else {
    die("Action không hợp lệ!");
}

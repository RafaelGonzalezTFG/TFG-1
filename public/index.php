<?php
require_once '../controllers/Auth_Controller.php';
require_once '../controllers/Dashboard_Controller.php';
use controller\AuthController;
use controller\DashController;
use controller\UserController;

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'tienda';

switch ($action) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'dashboard':
        if (isset($_SESSION['user_id']) && ($_SESSION['rol'] == 'empleado' || $_SESSION['rol'] == 'admin')) {
            $controller = new DashController();
            $controller->index();
        } else {
            header('Location: index.php?action=login');
        }
        break;
    case 'tienda':
    default:
        require_once '../views/tienda/index.php';
        break;
}


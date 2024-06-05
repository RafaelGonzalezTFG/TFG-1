<?php
namespace controller;

require_once '../models/User_Model.php';
require_once '../models/Utils.php';
use models\User_Model;
use models\Utils;

class DashController {
    public function __construct() {
        session_start();
        // Verificar que el usuario esté logueado y tenga los permisos adecuados
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'empleado' && $_SESSION['rol'] != 'admin')) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function index() {
        $role = $_SESSION['rol'];
        require_once '../views/dashboard/dashboard_views.php';
    }


}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $DashController = new DashController();

    switch ($action) {
        case 'index':
            $DashController->index();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    /*echo 'No se especificó ninguna acción';*/
}

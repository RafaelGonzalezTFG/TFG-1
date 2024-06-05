<?php
namespace controller;

require_once '../models/User_Model.php';
require_once '../models/Utils.php';
use models\User_Model;
use models\Utils;

class UserController {
    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] != 'empleado' && $_SESSION['rol'] != 'admin')) {
            header('Location: ../views/login/login_views.php');
            exit();
        }
    }

    public function register_Admin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $codigo_activacion = Utils::generar_codigo_activacion();
            $imagen_perfil = isset($_FILES['imagen_perfil']) ? $_FILES['imagen_perfil']['name'] : null;

            if ($imagen_perfil) {
                $target_dir = __DIR__ . "/../Assets/images/uploads/";
                $target_file = $target_dir . basename($imagen_perfil);
                move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $target_file);
            }

            $userModel = new User_Model();
            $userModel->createUser($nombre, $apellido, $direccion, $telefono, $email, $password, $codigo_activacion, $imagen_perfil);

            if (Utils::enviarCorreoActivacion($email, $codigo_activacion)) {
                echo 'Registro exitoso. Por favor, revisa tu correo electrónico para activar tu cuenta.';
            } else {
                echo 'Error al enviar el correo de activación.';
            }
        } else {
            require_once '../views/login/register_views.php';
        }
    }

    public function listUsers() {
        $role = $_SESSION['rol'];
        $userModel = new User_Model();
        $usuarios = $userModel->getAllUsers();
        require_once '../views/user/user_list_views.php';
    }

    public function editUser() {
        if (isset($_GET['id'])) {
            $userModel = new User_Model();
            $usuario = $userModel->getUserById($_GET['id']);
            require_once '../views/user/edit_user_views.php';
        }
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];
            $estado = $_POST['estado'];
            $imagen_perfil = isset($_FILES['imagen_perfil']) ? $_FILES['imagen_perfil']['name'] : null;

            if ($imagen_perfil) {
                $target_dir = "../Assets/images/uploads/";
                $target_file = $target_dir . basename($imagen_perfil);
                move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $target_file);
            }

            $userModel = new User_Model();
            $userModel->updateUser($id, $nombre, $apellido, $direccion, $telefono, $email, $rol, $estado, $imagen_perfil);

            header('Location: User_Controller.php?action=listUsers');
        }
    }

    public function deleteUser() {
        if (isset($_POST['id'])) {
            $userId = $_POST['id'];
            $userModel = new User_Model();
            $userModel->deleteUser($userId);

            header('Location: User_Controller.php?action=listUsers');
        }
    }

    public function banUser() {
        if (isset($_POST['id'])) {
            $userId = $_POST['id'];
            $action = $_POST['action'];

            $userModel = new User_Model();

            if ($action == 'ban') {
                $userModel->banUser($userId);
            } else {
                $userModel->unbanUser($userId);
            }

            header('Location: User_Controller.php?action=listUsers');
        }
    }

    public function activate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['codigoActivacion'])) {
            $email = $_POST['email'];
            $codigo = $_POST['codigoActivacion'];

            $userModel = new User_Model();
            $user = $userModel->getUserByEmailAndCode($email, $codigo);

            if ($user) {
                $userModel->activateUser($email);
                echo 'Cuenta activada con éxito. Ahora puedes iniciar sesión.';
            } else {
                echo 'Código de activación incorrecto o cuenta ya activada.';
            }
        } else {
            echo 'Datos de activación no válidos.';
        }
    }
}

// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $userController = new UserController();

    switch ($action) {
        case 'listUsers':
            $userController->listUsers();
            break;
        case 'editUser':
            $userController->editUser();
            break;
        case 'updateUser':
            $userController->updateUser();
            break;
        case 'deleteUser':
            $userController->deleteUser();
            break;
        case 'banUser':
            $userController->banUser();
            break;
        case 'activate':
            $userController->activate();
            break;
        case 'register':
            $userController->register_Admin();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    echo 'No se especificó ninguna acción';
}
?>

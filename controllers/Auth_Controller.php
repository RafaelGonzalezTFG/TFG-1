<?php
namespace controller;

require_once '../models/User_Model.php';
require_once '../models/Utils.php';
use models\User_Model;
use models\Utils;

class AuthController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User_Model();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['Password'])) {
                if ($user['Activado']) {
                    session_start();
                    $_SESSION['user_id'] = $user['ID_Usuario'];
                    $_SESSION['rol'] = $user['Rol'];

                    // Redirigir según el rol del usuario
                    switch ($user['Rol']) {
                        case 'admin':
                        case 'empleado':
                            header('Location: ../controllers/Dashboard_Controller.php?action=index');
                            break;
                        case 'cliente':
                            header('Location: ../views/tienda/index.php');
                            break;
                        default:
                            header('Location: ../views/home/index.php');
                            break;
                    }
                } else {
                    echo 'Tu cuenta aún no ha sido activada.';
                }
            } else {
                echo 'Correo electrónico o contraseña incorrectos';
            }
        } else {
            require_once '../views/login/login_views.php';
        }
    }

    public function showRegister() {
        require_once '../views/login/register_views.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $codigo_activacion = Utils::generar_codigo_activacion();
            $imagen_perfil = isset($_FILES['imagen_perfil']) ? $_FILES['imagen_perfil']['name'] : null;

            // Subir imagen de perfil si existe
            if ($imagen_perfil) {
                $target_dir = "../Assets/images/uploads/";
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

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../views/login/login_views.php');
        exit();
    }
    
}


// Manejo de acciones basadas en los parámetros de URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $authController = new AuthController();

    switch ($action) {
        case 'login':
            $authController->login();
            break;
        case 'register':
            $authController->register();
            break;
        case 'showRegister':
            $authController->showRegister();
            break;
        default:
            echo 'Acción no válida';
            break;
    }
} else {
    /*echo 'No se especificó ninguna acción';*/
}


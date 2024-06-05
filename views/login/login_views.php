<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ffec4ec2ed.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Assets/css/login.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-7 d-none d-lg-block">
                <img src="../Assets/images/JPG/Login.jpg" alt="Login Image" class="img-fluid min-vh-100">
            </div>
            <div class="col-lg-5 bg-dark d-flex flex-column align-items-end min-vh-100">
                <div class="px-lg-5 pt-lg-4 pb-lg-3 p-4 mb-auto w-100">
                    <!-- Ajuste de tamaño del logo -->
                    <img src="../Assets/images/JPG/logo_nobackground.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
                </div>
                <div class="align-self-center w-100 px-lg-5 py-lg-4 p-4">
                    <h1 class="font-weight-bold mb-4">Iniciar sesión</h1>
                    <form action="../controllers/Auth_Controller.php?action=login" method="post" class="mb-5">
                        <div class="mb-4">
                            <label for="email" class="form-label font-weight-bold">Correo electrónico</label>
                            <input type="email" class="form-control bg-dark-x border-0" id="email" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label font-weight-bold">Contraseña</label>
                            <input type="password" class="form-control bg-dark-x border-0 mb-2" id="password" name="password" placeholder="Contraseña" required>
                            <a href="../controllers/Auth_Controller.php?action=showRecover" class="form-text text-muted text-decoration-none">¿Olvidaste tu contraseña?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                    </form>
                    <p class="font-weight-bold text-center text-muted">O inicia sesión con</p>
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-outline-light flex-grow-1 mr-2"><i class="fab fa-google lead mr-2"></i> Google</button>
                        <button type="button" class="btn btn-outline-light flex-grow-1 ml-2"><i class="fab fa-facebook-f lead mr-2"></i> Facebook</button>
                    </div>
                </div>
                <div class="text-center px-lg-5 pt-lg-3 pb-lg-4 p-4 mt-auto w-100">
                    <p class="d-inline-block mb-0">¿No tienes una cuenta?</p> <a href="../controllers/Auth_Controller.php?action=showRegister" class="text-light font-weight-bold text-decoration-none">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

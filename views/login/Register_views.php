<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
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
                <div class="px-lg-5 pt-lg-4 pb-lg-3 p-4 w-100">
                    <img src="../Assets/images/JPG/logo_nobackground.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
                </div>
                <div class="align-self-center w-100 px-lg-5 py-lg-4 p-4">
                    <h1 class="font-weight-bold mb-4">Registro</h1>
                    <form action="../controllers/Auth_Controller.php?action=register" method="post" class="mb-5" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="nombre" class="form-label font-weight-bold">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="mb-4">
                            <label for="apellido" class="form-label font-weight-bold">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                        </div>
                        <div class="mb-4">
                            <label for="direccion" class="form-label font-weight-bold">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
                        </div>
                        <div class="mb-4">
                            <label for="telefono" class="form-label font-weight-bold">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label font-weight-bold">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label font-weight-bold">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required minlength="8">
                        </div>
                        <div class="mb-4">
                            <label for="imagen_perfil" class="form-label font-weight-bold">Imagen de Perfil</label>
                            <input type="file" class="form-control" id="imagen_perfil" name="imagen_perfil">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
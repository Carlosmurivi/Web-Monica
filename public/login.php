<?php
include_once '../src/controllers/ControllerUsers.php';

if (ControllerUsers::checkLoggedInUser()) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['name']) && isset($_POST['password'])) {
    $user = ControllerUsers::verifyUser($_POST['name'], $_POST['password']);

    if ($user) {
        ControllerUsers::saveUser($user);
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="body">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="d-flex justify-content-center">
            <form action="login.php" method="POST" id="form"
                class="shadow bg-white rounded-4 col-12 col-xl-9 p-4 d-flex flex-wrap">
                <h1 class="col-12 text-center mb-5 fs-1 blue">Inicio de Sesión</h1>

                <div class="form-floating mb-3 col-12">
                    <input type="text" class="form-control border-blue blue" id="name" name="name" placeholder="name@example.com">
                    <label for="name">Apodo</label>
                </div>

                <div class="form-floating mb-3 col-12">
                    <input type="password" class="form-control border-blue" id="password" name="password" placeholder="Password">
                    <label for="password">Contraseña</label>
                </div>

                <button type="submit" class="button-login bg-coral col-12 mb-3 mt-4 fs-4">Enviar</button>

                <p class="text-danger"><?php echo isset($error) ? $error : ''; ?></p>
                <p class="col-12 text-center blue">¿No tienes una cuenta? <a href="registro.php"
                        class="blue">Regístrate
                        aquí</a></p>
            </form>
        </div>
    </div>
</body>

</html>
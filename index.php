<?php
require_once('db_configs.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['IniciarSesion'])) { // Nombre del botón corregido para evitar problemas con espacios
        // Obtener los datos del formulario
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Verificar si el correo existe en la tabla usuarioscandidatos
        $stmt = $conexion->prepare("SELECT id, nombre, contrasena FROM usuarioscandidatos WHERE correo = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Correo encontrado en la tabla de candidatos
            $stmt->bind_result($id, $nombre, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['userId'] = $id;
                $_SESSION['userName'] = $nombre;

                echo "<script>alert('Bienvenido de nuevo, $nombre'); window.location.href='candidato.php';</script>";
                exit;
            } else {
                echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
            }
        } else {
            // Si no se encuentra en la tabla de candidatos, verificar la tabla de empresas
            $stmt = $conexion->prepare("SELECT id, nombre_empresa, contrasena FROM empresas WHERE correo = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Correo encontrado en la tabla de empresas
                $stmt->bind_result($id, $nombre_empresa, $hashedPassword);
                $stmt->fetch();

                if (password_verify($password, $hashedPassword)) {
                    session_start();
                    $_SESSION['userId'] = $id;
                    $_SESSION['userName'] = $nombre_empresa;

                    echo "<script>alert('Bienvenido de nuevo, $nombre_empresa'); window.location.href='empresa_dashboard.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Correo no registrado.'); window.history.back();</script>";
            }
        }

        // Cerrar la conexión
        $stmt->close();
        $conexion->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>

<body style="min-height: 100vh; background-image: url(https://i.imgur.com/lum3Ci8.jpeg); background-size: cover;"
    class="is-flex is-flex-direction-column is-justify-content-center is-align-items-center">
    <div class="container box login-container is-flex is-flex-direction-column mt-30"
        style="max-width: 400px; max-height: 520px;">
        <h2 class="title is-2">Iniciar Sesión</h2>
        <form id="loginForm" method="post" action="index.php">
            <label class="label" for="email">Correo electrónico:</label>
            <input class="input is-small" type="email" id="email" name="email" required />

            <label class="label" for="password">Contraseña:</label>
            <input class="input is-small" type="password" id="password" name="password" required />

            <br>
            <button class="button is-primary" type="submit" name="IniciarSesion">Iniciar Sesión</button>
            <p class="m-3">¿No tienes una cuenta?</p>
            <button class="button is-primary is-outlined" id="btnRegister" type="button" onclick="window.location.href='registro.php'">Registrarse</button>
        </form>
    </div>
</body>

</html>

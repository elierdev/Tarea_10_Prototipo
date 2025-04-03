<?php
require_once('db_configs.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['RegistrarseCandidato'])) {
        // Extraemos y sanitizamos los datos del formulario de Candidato
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
        $name = trim($_POST['name']);

        // Verificar si el correo ya existe en la tabla usuarioscandidatos
        $stmt = $conexion->prepare("SELECT id FROM usuarioscandidatos WHERE correo = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('El correo ya está registrado.'); window.history.back();</script>";
            exit;
        }

        // Registrar nuevo candidato
        $stmt = $conexion->prepare("INSERT INTO usuarioscandidatos (nombre, correo, contrasena) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error en el registro.'); window.history.back();</script>";
        }
        $stmt->close();
    }

    if (isset($_POST['RegistrarseEmpresa'])) {
        // Extraemos y sanitizamos los datos del formulario de Empresa
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
        $companyName = trim($_POST['companyName']);
        $contact = trim($_POST['contact']);

        // Verificar si el correo ya existe en la tabla empresas
        $stmt = $conexion->prepare("SELECT id FROM empresas WHERE correo = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('El correo ya está registrado.'); window.history.back();</script>";
            exit;
        }

        // Registrar nueva empresa
        $stmt = $conexion->prepare("INSERT INTO empresas (nombre_empresa, direccion, correo, contrasena) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $companyName, $contact, $email, $password);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error en el registro.'); window.history.back();</script>";
        }
        $stmt->close();
    }

    // Cerrar la conexión
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="registro.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    
</head>


<body style="min-height: 100%; background-image: url(https://i.imgur.com/lum3Ci8.jpeg); background-size: cover;"
    class="is-flex is-flex-direction-column is-justify-content-center is-align-items-center">
    <div class="container box login-container is-flex is-flex-direction-column mt-30" style="max-width: 400px;">
        <h2 class="title is-3">Registro</h2>

        <form id="formCandidato" method="post" action="registro.php" style="display:none;">
            <label class="label">Nombre:</label>
            <input class="input is-small" type="text" id="name" name="name" required />

            <label class="label" for="email">Correo electrónico:</label>
            <input class="input is-small" type="email" id="email" name="email" required />

            <label class="label" for="password">Contraseña:</label>
            <input class="input is-small" type="password" id="password" name="password" required />

            <input class="button is-primary" type="submit" name="RegistrarseCandidato" value="Registrarse"></input>
        </form>

        <form id="formEmpresa" method="post" action="registro.php" style="display:none;">
            <label class="label">Nombre de la empresa:</label>
            <input class="input is-small" type="text" id="companyName" name="companyName" required />

            <label class="label">Dirección:</label>
            <input class="input is-small" type="text" id="contact" name="contact" required />

            <label class="label" for="email">Correo electrónico:</label>
            <input class="input is-small" type="email" id="email" name="email" required />

            <label class="label" for="password">Contraseña:</label>
            <input class="input is-small" type="password" id="password" name="password" required />

            <input class="button is-primary" type="submit" name="RegistrarseEmpresa" value="Registrarse"></input>
        </form>

        <label class="label">Tipo de registro:</label>
        <div class="control">
            <div class="select">
                <select id="userType" name="userType">
                    <option value="candidato">Candidato</option>
                    <option value="empresa">Empresa</option>
                </select>
            </div>
        </div>

        <p class="m-3">¿Ya tienes una cuenta?</p>
        <button class="button is-primary is-outlined" id="btnLogin" type="button">Iniciar Sesión</button>
    </div>

    <script>
        // Manejar la visibilidad de los formularios según el tipo de usuario seleccionado
        document.getElementById('userType').addEventListener('change', function () {
            const userType = this.value;
            if (userType === 'empresa') {
                document.getElementById('formEmpresa').style.display = 'block';
                document.getElementById('formCandidato').style.display = 'none';
            } else {
                document.getElementById('formEmpresa').style.display = 'none';
                document.getElementById('formCandidato').style.display = 'block';
            }
        });

        // Asegurarnos de que se muestre el formulario adecuado al cargar la página
        window.onload = function () {
            const userType = document.getElementById('userType').value;
            if (userType === 'empresa') {
                document.getElementById('formEmpresa').style.display = 'block';
                document.getElementById('formCandidato').style.display = 'none';
            } else {
                document.getElementById('formEmpresa').style.display = 'none';
                document.getElementById('formCandidato').style.display = 'block';
            }
        };

        document.getElementById("btnLogin").addEventListener("click", function () {
            window.location.href = "index.php";
        });
    </script>
</body>

</html>

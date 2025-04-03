<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel de Candidato</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="candidato.css" />
</head>

<body>
    <?php include_once("navbar.php"); ?>

    <!-- Contenido Principal -->
    <main class="column p-5">
        <section class="box">
            <h2 class="title is-3">Mi Perfil</h2>
            <p><strong>Nombre:</strong> Juan Pérez</p>
            <p><strong>Email:</strong> juan.perez@email.com</p>
            <p><strong>Especialidad:</strong> Desarrollo Web</p>
        </section>

        <section class="box">
            <h2 class="title is-3">Ofertas Disponibles</h2>
            <div class="columns is-multiline">
                <div class="column is-half">
                    <div class="box">
                        <h3 class="title is-4">Frontend Developer</h3>
                        <p><strong>Empresa:</strong> TechCorp</p>
                        <p><strong>Ubicación:</strong> Remoto</p>
                        <button class="button is-primary">Postularme</button>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="box">
                        <h3 class="title is-4">Diseñador UI/UX</h3>
                        <p><strong>Empresa:</strong> Creative Studio</p>
                        <p><strong>Ubicación:</strong> Rep Dom</p>
                        <button class="button is-primary">Postularme</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    </div>

    <script src="candidato.js"></script>
</body>

</html>
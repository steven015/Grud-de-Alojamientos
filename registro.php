<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Alojamientos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
        <?php
            require "./controller/autenticarController.php";
            $autenticar = new AutenticarController();

            /* Verificar si el formulario se ha enviado
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $autenticar->create();
            }*/
        ?>
        <section class="container">
            <h1>Registro de usuario</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                  
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                    <div class="mb-3">
                        <label for="rol_id" class="form-label">Rol</label>
                        <select class="form-select" id="rol_id" name="rol_id">
                <?php
                // Conexión a la base de datos y consulta de roles
                $roles = $autenticar->getRoles();
                // Iterar sobre los roles y crear opciones
                foreach ($roles as $rol) {
                    echo "<option value='" . $rol['id'] . "'>" . $rol['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
                <div class="boton">
                <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
            </form>
            <?php $autenticar->create(); ?>
        </section>
    </main>
</body>
</html>
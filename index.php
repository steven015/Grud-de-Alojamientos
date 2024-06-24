<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/style.css">
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
              // Verificar si el formulario de inicio de sesión se ha enviado
       
        ?>
        <section class="container">
        <h1>Inicio de Sesion</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                  
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <a href="registro.php" class="link">Si no tienes cuenta Regístrate</a>
                <div class="boton">
                <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
                </div>
            </form>
            <?php $autenticar->login(); ?>
        </section>
    </main>
</body>
</html>
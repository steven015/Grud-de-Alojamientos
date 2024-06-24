<?php
session_start();

            require "./controller/favoritoController.php";
            $favorito = new FavoritoController();
            $arr_favoritos = $favorito->getFavoritos();

       
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-secondary">
<nav class="navbar navbar-expand-lg  p-2 bg-dark">
        <div class="container">
            <i class="bi bi-house"></i>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="alojamientos.php" class="nav-link  text-white">Alojamientos</a>
                    </li>
                    <li class="nav-item">
                        <a href="listaFavorito.php" class="nav-link  text-white">Mis Favoritos</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])) {?>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link  text-white">Cerrar Sesión</a>
                    </li>
                   <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
    <h1 class="text-center text-white">Bienvenido a tus favoritos</h1>
    <div class="row">
        <?php
            foreach($arr_favoritos as $item){ ?>
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <img src="<?php echo $item["imagen_url"]  ?>" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item["alojamiento"]  ?></h5>
                            <p class="card-text"><?php echo $item["descripcion"]  ?></p>
                            <p class="card-text"><?php echo $item["direccion"]  ?></p>
                            
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
    </main>    



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php include ('./controller/database.php'); 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alojamientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg p-2 bg-dark">
        <div class="container">
            <i class="bi bi-house"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="alojamientos.php" class="nav-link text-white">Alojamientos</a>
                    </li>
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link text-white">Agregar Alojamiento</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white">Cerrar Sesión</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container">
    <h1 class="text-white text-center">Bienvenido aqui encontraras una variedad de hoteles de lujo</h1>
        <section class="row">
        <?php
        $db = new Database();
        $connection = $db->getConnection();

        try {
            $sql = "SELECT id, nombre, direccion, descripcion, precio, imagen_url FROM alojamientos";
            $stmt = $connection->query($sql);

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <img src="<?php echo $row["imagen_url"] ?>" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["nombre"] ?></h5>
                            <p class="card-text"><strong>Direccion: <?php echo $row["direccion"] ?></strong></p>
                            <p class="card-text"><strong>Descripcion: <?php echo $row["descripcion"] ?></strong></p>
                            <p class="card-text"><strong>Precio: <?php echo $row["precio"] ?></strong></p>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                            <?php } ?>
                        </div> <!-- Close card-body -->
                    </div> <!-- Close card -->
                </div> <!-- Close col-md-4 -->
                <?php }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        </section>       
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

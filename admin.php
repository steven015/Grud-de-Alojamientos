<?php 
// Admin Panel/Page

require_once './controller/database.php';

$db = new Database();
$connection = $db->getConnection();


// Authenticate if it's not admin or empty
session_start();          
// if( !isset($_SESSION['user_id']) && $_SESSION['rol'] !== 'admin') {
//     header("Location: login.php");
//     exit();
// }

function isAdmin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin';
}

if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    // Sanitize
    $nombre = htmlspecialchars(strip_tags($_POST['nombre']));
    $descripcion = htmlspecialchars(strip_tags($_POST['descripcion']));
    $precio = htmlspecialchars(strip_tags($_POST['precio']));
    $direccion = htmlspecialchars(strip_tags($_POST['direccion']));
    // $imagen_url = htmlspecialchars(strip_tags($_POST['imagen_url']));

    // Validar que se completen los campos
    if( empty($nombre) || empty($descripcion) || empty($direccion) || empty($precio)  ) {
        echo 'Completa todos los campos requeridos';
        exit();
    }

    // File upload handling
    if ( isset($_FILES['imagen_url']) && $_FILES['imagen_url']['error'] == 0) {
        $target = 'uploads/';
        $imagen_url = $target . basename($_FILES['imagen_url']['name']);
        $imageFileType = strtolower(pathinfo($imagen_url, PATHINFO_EXTENSION));
        $uploadOk = 1;
        

    // Check image size and format //

    $check = getimagesize($_FILES['imagen_url']['tmp_name']);
    if( $check !== false ) {
        $uploadOk = 1;
    } else {
        echo 'Asegurate de que el archivo sea una imagen';
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($imagen_url)) {
        echo 'El archivo ya existe, intenta uno diferente';
        $uploadOk = 0;
    }

    // Check file size to be less than 5mb
    if( $_FILES['imagen_url']['size'] > 5000000 ){
        echo 'El archivo es demasiado grande';
        $uploadOk = 0; 
    }

    // If ok, upload the file
    if( $uploadOk == 0 ) { // In case its false
        echo 'Hubo un error al subir el archivo';
    } else {
        if (move_uploaded_file($_FILES["imagen_url"]["tmp_name"], $imagen_url)) {
            try {
                $query = "INSERT INTO alojamientos (nombre, descripcion, direccion, precio, imagen_url) VALUES (?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($query);
                $stmt->execute([$nombre, $descripcion, $direccion,$precio, $imagen_url]);
            } catch ( PDOException $e ) {
                echo "Error: ".$e->getMessage();
            }
        } else {
            echo 'Hubo un error al subir el archivo, intenta nuevamente';
        }
    }

    } else {
        echo 'Completa todos los campos';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-secondary">
<nav class="navbar navbar-expand-lg  p-2 bg-dark">
        <div class="container">
            <i class="bi bi-house"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="vistaAdmin.php" class="nav-link text-white">Alojamientos</a>
                    </li>
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link  text-white">Agregar Alojamiento</a>
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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="form-container p-4 rounded bg-dark-subtle">
            <h1 class="text-center mb-4">Agregar Alojamiento</h1>
            <form method="POST" action="admin.php" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control bg-body-secondary rounded-3" id="nombre" name="nombre" required>
                    <div class="invalid-feedback">Por favor, ingrese el nombre del alojamiento.</div>
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control bg-body-secondary rounded-3" id="descripcion" name="descripcion" rows="3" required></textarea>
                    <div class="invalid-feedback">Por favor, ingrese una descripción.</div>
                </div>
                
                <div class="form-group">
                    <label for="direccion">Ubicación:</label>
                    <input type="text" class="form-control bg-body-secondary rounded-3" id="direccion" name="direccion" required>
                    <div class="invalid-feedback">Por favor, ingrese la ubicación.</div>
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" class="form-control bg-body-secondary rounded-3" id="precio" name="precio" step="0.01" required>
                    <div class="invalid-feedback">Por favor, ingrese el precio.</div>
                </div>
                
                <div class="form-group mt-3">
                    <label for="imagen">Imagen:</label>
                    <input type="file" class="form-control-file" id="imagen_url" name="imagen_url" required>
                    <div class="invalid-feedback">Por favor, suba una imagen.</div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary rounded-4 mt-4 p-3">Agregar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
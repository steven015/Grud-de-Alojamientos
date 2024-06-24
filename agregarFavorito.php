<?php
include ('./controller/database.php');
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['alojamiento_id'])) {
    $user_id = $_SESSION['user_id'];
    $alojamiento_id = $_POST['alojamiento_id'];

    $db = new Database();
    $connection = $db->getConnection();

    // Verificar si ya está en favoritos
    $sql = "SELECT * FROM favoritos WHERE usuario_id = :usuario_id AND alojamiento_id = :alojamiento_id";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':usuario_id', $user_id);
    $stmt->bindParam(':alojamiento_id', $alojamiento_id);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        $sql = "INSERT INTO favoritos (usuario_id, alojamiento_id) VALUES (:usuario_id, :alojamiento_id)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':usuario_id', $user_id);
        $stmt->bindParam(':alojamiento_id', $alojamiento_id);

        if ($stmt->execute()) {
            header("location: listaFavorito.php");
            
        } else {
            echo "Error al agregar a favoritos.";
        }
    } else {
        echo "El alojamiento ya está en tus favoritos.";
    }
} else {
    echo "Debe iniciar sesión para agregar a favoritos.";
}
?>

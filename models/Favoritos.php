<?php

    class Favoritos{
        public $usuario_id;
        public $alojamiento_id;
        public $connection;
        public $table_name = "favoritos";

        public function __construct($db)
        {
            $this->connection = $db;
        }

        public function readAlojamientosbyUsuario(){
            $query = "SELECT alojamientos.nombre AS alojamiento, alojamientos.descripcion, alojamientos.direccion, alojamientos.precio, alojamientos.imagen_url, usuarios.email FROM ". $this->table_name . " INNER JOIN alojamientos ON favoritos.alojamiento_id = alojamientos.id INNER JOIN usuarios on favoritos.usuario_id = usuarios.id WHERE usuarios.id = " . $_SESSION['user_id'];
            $sentence = $this->connection->prepare($query);
             $sentence->execute();
             $result = $sentence->fetchAll();
            return $result;
        }
    }
?>
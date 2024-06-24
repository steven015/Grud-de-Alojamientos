<?php
require_once './models/Favoritos.php';
require_once './controller/database.php';

class FavoritoController{
    public $favorito;
    public $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->favorito = new Favoritos($this->db);
    }

    public function getFavoritos(){
       $resultado = $this->favorito->readAlojamientosbyUsuario();
       return $resultado;
    }
}
?>
<?php
require_once './models/Autenticar.php';
require_once './controller/database.php';

class AutenticarController{
    public $sesion;
    public $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->sesion = new Autenticar($this->db);
    }

    public function create(){
        if (isset($_POST['email'], $_POST['password'], $_POST['rol_id'])) {
            $this->sesion->email = $_POST['email'];
            $this->sesion->password = $_POST['password'];
            $this->sesion->rol_id = $_POST['rol_id'];
            $result = $this->sesion->create();
            if($result){
                header("location: index.php");
            }
        }
        return false;
        
    }


    public function login() {
        if (isset($_POST['email'], $_POST['password'])) {
            $this->sesion->email = $_POST['email'];
            $this->sesion->password = $_POST['password'];
            $result = $this->sesion->read();
            foreach($result as $item){
                if($item["rol_id"] == 1){
                $_SESSION['user_id'] = $item['id'];
                 header("location: alojamientos.php");
                }else if($item["rol_id"] == 2){
                $_SESSION['user_id'] = $item['id'];
                 header("location: vistaAdmin.php");
                }else{
                    echo "credenciales invalidas";
                }
            }
        }
            
    }

    public function getRoles() {
        $query = "SELECT id, nombre FROM roles";

        // Preparar la consulta
        $stmt = $this->db->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Devolver los resultados
        return $result;
    }
}
?>
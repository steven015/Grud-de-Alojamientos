<?php

    class Autenticar{
        public $id;
        public $email;
        public $password;
        public $rol_id;
        public $connection;
        public $table_name = "usuarios";

        public function __construct($db)
        {
            $this->connection = $db;
        }

        public function create(){
            $query = " INSERT INTO ". $this->table_name. " SET email=:email, password=:password, rol_id=:rol_id";
            $sentence = $this->connection->prepare($query);

            //limpiar quita como caracteres %20 especiales que te pone html
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->rol_id = htmlspecialchars(strip_tags($this->rol_id));

            //blind
            $sentence->bindParam(":email",$this->email);
            $sentence->bindParam(":password",$this->password);
            $sentence->bindParam(":rol_id",$this->rol_id);
        

            if($sentence->execute()){
                return true;
            }
            return false;
        }


        public function read(){
            $query = "SELECT * FROM ". $this->table_name . " WHERE email = :email";
            $sentence = $this->connection->prepare($query);
            $sentence->bindParam(":email", $this->email);
             $sentence->execute();
             $result = $sentence->fetchAll();
            return $result;
        }
    }
?>
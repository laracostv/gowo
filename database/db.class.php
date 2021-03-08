<?php
    class db {

        //host
        private $host = 'localhost';

        //user
        private $usuario = 'root';
        private $senha = '';

        //databade
        private $database = 'gowo2';
        
        public function mysql_connect(){
            $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

            mysqli_set_charset($con, 'utf8');

            if(mysqli_connect_errno()){
                echo "Erro ao tentar se conectar: ".mysqli_connect_error();
            }

            return $con;
        }
    }
?>
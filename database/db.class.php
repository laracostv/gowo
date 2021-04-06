<?php
    class db {

        //host
        private $host = getenv('host_var');

        //user
        private $usuario = getenv('user_var');
        private $senha = getenv('pwd_var');

        //databade
        private $database = getenv('database_var');
        
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
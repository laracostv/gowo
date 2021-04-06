<?php
    class db {
        
        public function mysql_connect(){
            
            $host = getenv('host_var');
            $usuario = getenv('user_var');
            $senha = getenv('pwd_var');
            $database = getenv('pwd_var');

            $con = mysqli_connect($host, $usuario, $senha, $database);

            mysqli_set_charset($con, 'utf8');

            if(mysqli_connect_errno()){
                echo "Erro ao tentar se conectar: ".mysqli_connect_error();
            }

            return $con;
        }
    }
?>
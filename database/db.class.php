<?php

    class db {
        
        public function mysql_connect(){
            /*
            //heroku
            $host = getenv('host_var');
            $usuario = getenv('user_var');
            $senha = getenv('pwd_var');
            $database = getenv('database_var');
            */


            //hostgator
            $host = getenv('g_host_var');
            $usuario = getenv('g_user_var');
            $senha = getenv('g_pwd_var');
            $database = getenv('g_database_var');


            $con = mysqli_connect($host, $usuario, $senha, $database);

            mysqli_set_charset($con, 'utf8');
            
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            if(mysqli_connect_errno()){
                echo "Erro ao tentar se conectar: ".mysqli_connect_error();
            }

            return $con;
        }
    }
    
?>
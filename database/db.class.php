<?php
    class db {

        //host
        private $host = 'sh4ob67ph9l80v61.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';

        //user
        private $usuario = 'j2x5p04gc0lm3y23';
        private $senha = 'j855yql33enndrke';

        //databade
        private $database = 'lh22bw988ndpii32';
        
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
<?php
    require_once('db.class.php');
    $link = '';
    session_start();
    $userWasListed = array();
    // array que guarda a resposta da requisicao
    $response = array();

    if(isset($_SESSION['active_adress'])){
        $userActiveAddress = $_SESSION['id_usr'];

        $objDb = new db();
        $link = $objDb->mysql_connect();
        // Realiza uma consulta ao BD e obtem todos os produtos.
        $con = mysqli_query($link, "SELECT * FROM services");

        print_r($con);
        
        while ($row = mysqli_fetch_array($con, MYSQLI_ASSOC)) {

            $sql = "SELECT adNbh, adcity FROM address";
            $adrInfo = mysqli_query($link, $sql);

            print_r($row);
        }

        mysqli_close($link);
    }
?>
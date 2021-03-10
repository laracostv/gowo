<?php
    //session_start();
    require_once('db.class.php');

    $address_array = array();
    //Conecta a tabela de servicos
    $sql = "SELECT * FROM address";

    $objDb = new db();
    $link = $objDb->mysql_connect();

    $adrInfo = mysqli_query($link, $sql);
    //echo$_SESSION['id_usr'];

    if(isset($_SESSION['id_usr'])){
        $address_array["address_user"] = array();
        while($row = mysqli_fetch_array($adrInfo, MYSQLI_ASSOC)){
            $address = array();

            if($_SESSION['id_usr'] == $row['idUserAd']){
                $address['idAdress'] = $row['idAdress'];
                $address['adName'] = $row['adName'];
                $address['adCEP'] = $row['adCEP'];
                $address['adAddress'] = $row['adAddress'];
                $address['adNumber'] = $row['adNumber'];
                $address['adNbh'] = $row['adNbh'];
                $address['adCity'] = $row['adCity'];
                $address['adState'] = $row['adState'];
                $address['adComp'] = $row['adComp'];
                array_push($address_array["address_user"], $address);
            };
        }
        //echo json_encode($address_array, JSON_UNESCAPED_UNICODE);
        $address_json = json_encode($address_array, JSON_UNESCAPED_UNICODE);   
    }
?>
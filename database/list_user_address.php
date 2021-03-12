<?php
    //session_start();
    require_once('db.class.php');
    $addres_qnt = 0;
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
                $addres_qnt++;
            }
        }
        $address_array["success"] = array();
        
        if($addres_qnt == 0){
            array_push($address_array["success"], '0');
        }else{
            array_push($address_array["success"], '1');
        }
        //echo json_encode($address_array, JSON_UNESCAPED_UNICODE);

        $address_json = json_encode($address_array, JSON_UNESCAPED_UNICODE);
        //echo$address_json;
    }else{
        //caso o usuário n esteja logado
        $address_array["success"] = array();
        array_push($address_array["success"], '0');
        $address_json = json_encode($address_array, JSON_UNESCAPED_UNICODE);
    }
?>
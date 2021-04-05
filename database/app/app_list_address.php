<?php
    //session_start();
    //id user necessario

    require_once('../db.class.php');
    $addres_qnt = 0;
    $address_array = array();
    $id_usr_session = 0;
    $id_usr_session = $_GET['id_usr'];
    //Conecta a tabela de servicos
    $sql = "SELECT * FROM address";

    
    $objDb = new db();
    $link = $objDb->mysql_connect();

    $adrInfo = mysqli_query($link, $sql);


    if(isset($id_usr_session)){
        $address_array["address_user"] = array();
        while($row = mysqli_fetch_array($adrInfo, MYSQLI_ASSOC)){
            $address = array();

            if($id_usr_session == $row['idUserAd']){
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


        mysqli_close($link);
        echo json_encode($address_array, JSON_UNESCAPED_UNICODE);
        //echo$address_json;
    }else{
        //caso o usuário n esteja logado
        $address_array["success"] = array();
        array_push($address_array["success"], '0');
        echo json_encode($address_array, JSON_UNESCAPED_UNICODE);
    }
?>
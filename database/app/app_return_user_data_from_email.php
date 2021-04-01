<?php
    $link = '';
    //chave de busca --EMAIL--
    // array que guarda a resposta da requisicao
    $responseUserData = array();
    
    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();

    if(isset($_GET['email'])){
        $keyUserSet = $_GET['email'];/*
    $idUserSet = 18;
    if(isset($idUserSet)){*/
        $array_result = array();
        
        $search_image = mysqli_query($link, "SELECT idUser, usrName, usrLastName, usrEmail, usrDateN, usrCellPhone FROM users WHERE usrEmail = '$keyUserSet'");
        $array_result = $search_image->fetch_all();

        $responseUserData["idUser"] = $array_result[0][0];
        $responseUserData["usrName"] = $array_result[0][1];
        $responseUserData["usrLastName"] = $array_result[0][2];
        $responseUserData["usrEmail"] = $array_result[0][3];
        $responseUserData["usrDateN"] = $array_result[0][4];
        $responseUserData["usrCellPhone"] = $array_result[0][5];

        $responseUserData["success"] = 1;
    }else{
        $responseUserData["success"] = 0;
    }

    mysqli_close($link);
    echo json_encode($responseUserData);
?>
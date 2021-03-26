<?php
    $link = '';
    // array que guarda a resposta da requisicao
    $responseUserData = array();
    
    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();

    if(isset($_GET['id_user'])){
        $idUserSet = $_GET['id_user'];/*
    $idUserSet = 18;
    if(isset($idUserSet)){*/
        $array_result = array();
        
        $search_image = mysqli_query($link, "SELECT idUser, usrName, usrCellPhone, usrProfilePhoto FROM users WHERE idUser = '$idUserSet'");
        $array_result = $search_image->fetch_all();

        $responseUserData["idUser"] = $array_result[0][0];
        $responseUserData["usrName"] = $array_result[0][1];
        $responseUserData["usrCellPhone"] = $array_result[0][2];
        $responseUserData["usrProfilePhoto"] = $array_result[0][3];

        $responseUserData["success"] = 1;
    }else{
        $responseUserData["success"] = 0;
    }

    mysqli_close($link);
    echo json_encode($responseUserData);
?>
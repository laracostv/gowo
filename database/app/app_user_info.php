<?php
    $link = '';
    // array que guarda a resposta da requisicao
    $responseUserData = array();
    
    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();

    if(isset($_GET['id_user'])){
        $idUserSet = $_GET['id_user'];

        $search_image = mysqli_query($link, "SELECT idUsr, usrName, usrCellPhone, usrProfilePhoto FROM users WHERE idUser = '$idUserSet'");
        $responseUserData["img"] = mysqli_fetch_array($search_image);
        $responseUserData["success"] = 1;
    }else{
        $responseUserData["success"] = 0;
    }

    mysqli_close($link);
    echo json_encode($responseUserData);
?>
<?php
    $link = '';
    // array que guarda a resposta da requisicao
    $responseImg = array();
    $responseImgArr = array();
    
    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();

    if(isset($_GET['id_user'])){
        $idUserSet = $_GET['id_user'];

        $search_image = mysqli_query($link, "SELECT usrProfilePhoto FROM users WHERE idUser = '$idUserSet'");
        $responseImg["img"] = mysqli_fetch_array($search_image);
        $responseImg["success"] = 1;

        array_push($responseImgArr["userPhoto"], $responseImg);
    }else{
        $responseImgArr["success"] = 0;
    }

    mysqli_close($link);
    echo json_encode($responseImgArr);
?>
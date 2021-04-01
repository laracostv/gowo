<?php
    $link = '';
    // array que guarda a resposta da requisicao
    $responseImgJson = array();
    
    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->mysql_connect();

    if(isset($_GET['id_user'])){
        $responseImg = array();
        $idUserSet = $_GET['id_user'];

        $search_image = mysqli_query($link, "SELECT usrProfilePhoto FROM users WHERE idUser = '$idUserSet'");
        $searchImageSrc = mysqli_fetch_array($search_image);
        $responseImg["img"] = $searchImageSrc[0];
        $responseImg["success"] = 1;
    }else{
        $responseImg["success"] = 0;
    }

    mysqli_close($link);
    echo json_encode($responseImg);
?>
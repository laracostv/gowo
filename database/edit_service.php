<?php
$link = '';
// array que guarda a resposta da requisicao
$response = array();
$posi = 0;
$finded = false;
//session_start();

require_once('db.class.php');
$objDb = new db();
$link = $objDb->mysql_connect();

if(isset($_SESSION['id_usr']) && isset($_GET['service'])){

    $idUserWork = $_SESSION['id_usr'];
    $idService = $_GET['service'];
    
    $result_service = mysqli_query($link, "SELECT idService, idUserDo, sName, sDesc, sVal, sAdressId, sClass, sPhotoSrc FROM services WHERE idService = '$idService' AND idUserDo = '$_SESSION[id_usr]'");
    $result_service = mysqli_fetch_array($result_service);

    $adService = $result_service['sAdressId'];

    $result_address_service = mysqli_query($link, "SELECT idAdress, adName, adAddress, adNumber, adNbh, adCity, adState FROM address WHERE idAdress = '$adService'");
    $result_address_service = mysqli_fetch_array($result_address_service);
}

?>
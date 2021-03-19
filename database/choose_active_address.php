<?php
    require_once('db.class.php');
    session_start();

    $addressToActive = $_GET['address'];
    $_SESSION['active_adress'] = $_GET['address'];
    $userAddressId = $_SESSION['id_usr'];

    $objDb = new db();
    $link = $objDb->mysql_connect();

    $sql = "UPDATE users SET usrActiveAdress='$addressToActive' WHERE idUser = '$userAddressId'";

    mysqli_query($link, $sql);
    
    mysqli_close($link);

    header('Location: ../views/home');
?>
<?php
    require_once('../db.class.php');
    session_start();

    $addressToDelete = $_GET['address'];

    
    $objDb = new db();
    $link = $objDb->mysql_connect();

    $sql = "DELETE FROM address where idAdress = '$addressToDelete'";

    mysqli_query($link, $sql);

    if($_SESSION['active_adress'] == $addressToDelete){
        $_SESSION['active_adress'] = 0;
    }
    
    mysqli_close($link);

    header('Location: ../../views/home');
?>
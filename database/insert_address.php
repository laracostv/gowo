<?php 
    session_start();
    require_once('db.class.php');

    $adName = $_POST['adName'];
    $cep = $_POST['txtCep'];
    $address = $_POST['address'];
    $numberAdr = $_POST['numberAdr'];
    $nbh = $_POST['nbh'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    //if(isset($_GET['compl'])){
        $compl = $_POST['compl'];
    //}
    $id_usr = $_SESSION['id_usr'];

    $objDb = new db();
    $link = $objDb->mysql_connect();

    $sql = "insert into address(adName, adCep,
    adAddress, adNumber, adNbh, adCity, adState, 
    adComp, idUserAd) values
    ('$adName', '$cep', '$address', '$numberAdr',
    '$nbh', '$city', '$state', '$compl',
    '$id_usr')";
    
    if(mysqli_query($link, $sql)){
        $sql = "SELECT MAX(idAdress) FROM address WHERE idUserAd = '$id_usr'";
        var_dump($sql);
        $result_id = mysqli_query($link, $sql);
        $user_data = mysqli_fetch_array($result_id);
        $_SESSION['active_adress'] = $user_data['MAX(idAdress)'];
        $update_id_adress = $user_data['MAX(idAdress)'];

        $sql = "UPDATE users SET usrActiveAdress='$update_id_adress' WHERE idUser = '$id_usr'";
        mysqli_query($link,$sql);

        header('Location: ../views/home/?alert=2');
    }else{
        echo 'Código de erro:'.mysqli_errno( $link ).'<br>';
        echo 'Mensagem de erro:'.mysqli_error( $link ).'<br>';
    }
?>
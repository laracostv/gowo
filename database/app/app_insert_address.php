<?php 
    //essa função precisa do id do usuário!!!!!
    require_once('../db.class.php');
    $response = array();

    if (isset($_POST['adName']) && isset($_POST['txtCep']) && isset($_POST['address']) && isset($_POST['numberAdr']) && isset($_POST['nbh']) && isset($_POST['city']) && isset($_POST['compl'])) {
        
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
        $id_usr = $_POST['id_usr'];

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
            //var_dump($sql);
            $result_id = mysqli_query($link, $sql);
            $user_data = mysqli_fetch_array($result_id);
            $update_id_adress = $user_data['MAX(idAdress)'];

            $sql = "UPDATE users SET usrActiveAdress='$update_id_adress' WHERE idUser = '$id_usr'";
            mysqli_query($link,$sql);

            $response["success"] = 1;
        }else{
            $response["success"] = 0;
			$response["error"] = "Error BD: ".mysqli_error($link);
        }
    }else {
        $response["success"] = 0;
        $response["error"] = "Faltam campos";
    }

    mysqli_close($link);
    echo json_encode($response);
?>
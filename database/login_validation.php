<?php
    session_start();
    require_once('db.class.php');

    $loginUser = $_POST['user'];
    $pwdUser = md5($_POST['pwd']);

    $sql = "SELECT * FROM users WHERE usrEmail = '$loginUser' AND usrPwd = '$pwdUser'";

    $objDb = new db();
    $link = $objDb->mysql_connect();

    $result_id = mysqli_query($link, $sql);

    if($result_id){
        $user_data = mysqli_fetch_array($result_id);
        if(isset($user_data['usrEmail'])){

            $_SESSION['name'] = $user_data['usrName'];
            $_SESSION['last_name'] = $user_data['usrLastName'];
            $_SESSION['email'] = $user_data['usrEmail'];
            $_SESSION['cell'] = $user_data['usrCellPhone'];
            $_SESSION['dateN'] = $user_data['usrDateN'];
            $_SESSION['profile_photo'] = $user_data['usrProfilePhoto'];
            $_SESSION['id_usr'] = $user_data['idUser'];
            $_SESSION['active_adress'] = $user_data['usrActiveAdress'];           

            header('Location: ../views/home');
        }else{
            header('Location: ../index.php?erro=1');
        }
    }else{
        echo"Erro ao entrar entre em contato com o suporte";
    }

    
?>
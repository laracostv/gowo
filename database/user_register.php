<?php
    require_once('db.class.php');
    include_once('db.class.php');

    $name = $_POST ['name'];
    $last_name = $_POST ['last-name'];
    $email = $_POST ['email'];
    $senha = md5($_POST ['pwd']);
    $cellNumber = $_POST ['phone'];
    $dateN = $_POST ['bdate'];
    $existent_email = false;

    $objDb = new db();
    $link = $objDb->mysql_connect();

    $sql = " select * from users where usrEmail ='$email'";

    if($id_result = mysqli_query($link, $sql)){
        $data_ver_usr = mysqli_fetch_array($id_result);

        if(isset($data_ver_usr['usrEmail'])){
            $existent_email = true;
        }
    }else{
        echo 'Erro ao tentar autenticar dados';
    };

    if($existent_email){
        $get_return = '?email_exist=1';
        header('Location: ../views/initial/signup/'.$get_return);
        die();
    }

    $sql = "insert into users(usrName, usrLastName, usrEmail, usrPwd, usrCellPhone, usrDateN, usrActiveAdress)
    values ('$name', '$last_name', '$email', '$senha', '$cellNumber', '$dateN', '0')";

    if(mysqli_query($link,  $sql)){
        session_start();
        $sql = "SELECT * FROM users WHERE usrEmail = '$email' AND usrPwd = '$senha'";

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
            echo"Erro ao entrar,envie uma mensagem ao suporte";
        }
    }else{
        echo'Erro de protocolo';
    };
?>
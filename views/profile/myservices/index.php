<?php 
    session_start();

    include_once('../../../database/list_my_services.php');

    $UserServiceJsonArr = json_decode($services_json, true);
    
    $user = isset($_GET['user']) ? $_GET['user'] : 0;
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>Meus serviços</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/brand/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/brand/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/brand/icons/favicon-16x16.png">
    <link rel="manifest" href="../../../assets/brand/icons/site.webmanifest">
    <link rel="mask-icon" href="../../../assets/brand/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../../../public/css/css_reset.css">
    <link rel="stylesheet" href="../../../public/css/grid.css">
    <link rel="stylesheet" href="../../../public/css/default.css">
    <link rel="stylesheet" href="../../../public/css/views/home.css">
    <link rel="stylesheet" href="../../../public/css/views/partners.css">
    <link rel="stylesheet" href="../../../public/css/views/myservice.css">
    <!--JS-->
    <script src="../../../public/js/theme.js"></script>
    <script src="../../../public/js/navigation.js"></script>
    <script src="../../../public/js/interactions.js"></script>
    <!--ICONS-->
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>-->
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
</head>

<body>
    <!--THEME COOKIE-->
    <?php
        if (isset($_COOKIE["theme"])){
            $themeCookie = $_COOKIE['theme'];
            
            if($themeCookie == 'dark'){
                echo '<script>darkTheme();</script>';
            }
        }
    ?>
    <!--Page loader-->
    <div class="lds-ellipsis" id="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="container" style="padding: 0px;">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8 cat-header">
                <i class="fas fa-user-check"></i>
                <h2 class="cat-page">Meus serviços</h2>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2">
            </div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">
                <?php foreach($UserServiceJsonArr['services'] as $arr){
                //echo$arr['adName'];
                $aspas = "'";
                $value_print = '';

                if (isset($arr['sVal'])){
                    $value_print = $arr['sVal'];
                }
                echo'   <div class="xs-12 sm-12 md-12 lg-6 xg-6 no-decoration">
                            <a href="edit?service='.$arr['idService'].'">
                                <div class="box-list">
                                        <div class="first-box-space">
                                            <div class="img-list-service"
                                                style="
                                                background-image: url('.$aspas.'../../../assets/images/users/services/'.$arr['sPhoto'].''.$aspas.');
                                                background-size: cover;
                                                background-attachment: scroll;">
                                            </div>
                                            <div class="info-list">
                                                <p class="title-serv">'.$arr['sName'].'</p>
                                                <p class="serv-list"><i data-feather="star" style="height: 14px; width: 14px"></i> 5.0 &middot '.$arr['sClass'].'</p>
                                                <p class="serv-list-2">'.$arr['sNbh'].' - '.$arr['sCity'].'</p>
                                                <p class="serv-val">'.$value_print.'</p>
                                            </div>
                                        </div>
                                    <div class="list-cat-star">
                                        <div class="align-star">
                                            <i data-feather="edit-2" class="edit-serv"></i> editar
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    ';
            }
?>
            </div>
            <div class="xs-hide sm-hide md-2 lg-2 xg-2">
            </div>
        </div>

    </div>


    <!--NAV DESKTOP-->
    <div class="v-nav">
        <img class="profile-nav-photo" src="<?php
                    if(isset($_SESSION['profile_photo'])){
                        echo$_SESSION['profile_photo'];
                    }else{
                        echo"../../../assets/images/users/profile_photos/user.png";
                    }
                ?>"></img>
        <div class="nav-user"><?php
                    if(isset($_SESSION['name'])){
                        echo$_SESSION['name'];
                    }else{
                        echo"<a href='../../'>Entrar</a> ou <a href='../../views/initial/signup'>Cadastrar</a>";
                    }
                ?></div>
        <div class="nav-item-square" onclick="navRedSecond(1)">
            <div>
                <i data-feather="home" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Início</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedSecond(2)">
            <div>
                <i data-feather="message-square" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Chat</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedSecond(3)">
            <div>
                <center><i data-feather="bell" class="v-nav-icon"></i></center>
                <div class="v-nav-item-name">Recentes</div>
            </div>
        </div>
        <div class="nav-item-square active-v-nav" onclick="navRedSecond(4)">
            <div>
                <i data-feather="user" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Perfil</div>
            </div>
        </div>
        <img class="v-nav-brand" src="../../../assets/brand/logo-gowo-white-h120.png">
    </div>

    <script>
    function order_list_display(id) {
        if (id == 0) {
            document.getElementById('list-mobile').style.display = "none";
        }
        if (id == 1) {
            document.getElementById('list-mobile').style.display = "fixed";
        }
    }

    const list = {
        open: false,
        bottomCartBar: document.getElementsByClassName('bottom-cart-bar')[0],
        mobileDetails: document.getElementById('mobile-details-list'),
        mobileDetailsFixed: document.getElementById('mobile-details-fixed'),
        listMobile: document.getElementById('list-mobile'),
        headerDetailsListMobile: document.getElementById('header-details-list-mobile')
    }

    feather.replace();
    order_list_display(0)
    </script>
    <script>
    window.addEventListener("load", function(event) {
        document.getElementById('lds-ellipsis').style.display = 'none';
    });
    /*
    function showUI() {
        document.getElementById('mob-nav').style.display = 'block';
    }
    function hideUI() {
        document.getElementById('mob-nav').style.display = 'none';
    }*/
    </script>

</body>

</html>
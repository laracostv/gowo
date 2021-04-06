<?php 
    session_start();

    include_once('../../../database/list_worker_details.php');

    $UserServiceJsonArr = json_decode($services_json, true);
    
    $user = isset($_GET['user']) ? $_GET['user'] : 0;
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>GoWo</title>
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
            <div class="xs-12 sm-12 md-12 lg-8 xg-8 service-page-header">

            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>
    </div>
    <div class="container" style="padding: 0px;">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">
                <center>
                    <img class="img-worker"
                        src="../../../assets/images/users/profile_photos/<?php echo$user_info_array[4]; ?>">
                </center>
                <h2 class="service-page-user"><?php echo$user_info_array['usrName']; ?></h2>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2">
            </div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">
                <center>
                    <div class="options-contact">
                        <a href="mailto:<?php echo$user_info_array['usrEmail']; ?>">
                            <div class="call-button">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </a>
                        <a
                            href="https://api.whatsapp.com/send?phone=55<?php echo$user_info_array['usrCellPhone']; ?>&text=Ol%C3%A1%20<?php echo$user_info_array['usrName']; ?>%2C%20encontrei%20seu%20perfil%20no%20Gowo!">
                            <div class="chat-button">
                                <i class="fab fa-whatsapp"></i>
                                WhatsApp
                            </div>
                        </a>
                        <a href="tel:+55<?php echo$user_info_array['usrCellPhone']; ?>">
                            <div class="call-button">
                                <i class="fas fa-phone"></i>
                            </div>
                        </a>
                    </div>
                </center>
                <?php foreach($UserServiceJsonArr['services'] as $arr){
                //echo$arr['adName'];
                $aspas = "'";
                $value_print = '';

                if (isset($arr['sVal'])){
                    $value_print = $arr['sVal'];
                }
                echo'   <div class="xs-12 sm-12 md-12 lg-6 xg-6 no-decoration">
                            <a href="service?service='.$arr['idService'].'">
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
                                                <p class="serv-list">'.$arr['sClass'].'</p>
                                                <p class="serv-list-2">'.$arr['sNbh'].' - '.$arr['sCity'].'</p>
                                                <p class="serv-val">'.$value_print.'</p>
                                            </div>
                                        </div>
                                    <div class="list-cat-star">
                                        <div class="align-star">
                                            <i data-feather="star" class="star-serv"></i>5.0
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

        <div class="row">
            <?php /*
        
            foreach($CategoryServicesJsonArr['services'] as $arr){
                //echo$arr['adName'];

                echo'   <div class="xs-12 sm-12 md-12 lg-6 xg-6 no-decoration">
                            <a href="user/'.$arr['idUsr'].'">
                                <div class="box-list">
                                    <img class="img-list-service" src="../../../assets/images/users/profile_photos/'.$arr['sProfilePhoto'].'">
                                        <div class="info-list">
                                            <p class="title-list">'.$arr['userDoName'].'</p>
                                            <div class="list-cat-star">
                                                <p class="cat-list"><i data-feather="star" class="star-list"></i>5.0 &middot; '.$arr['sClass'].'</p>
                                            </div>
                                            <p class="loc-list">'.$arr['sNbh'].' - '.$arr['sCity'].'</p>
                                        </div>
                                </div>
                            </a>
                        </div>
                    ';
            }
            if(isset($CategoryServicesJsonArr['message'])){
                echo'<div class="xs-12 sm-12 md-12 lg-12 xg-12 warning-message-service">
                        <center><h2>'.$CategoryServicesJsonArr['message'].'</h2></center>
                    </div>';
            }
            */?>
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
        <div class="nav-item-square active-v-nav" onclick="navRedSecond(1)">
            <div>
                <i data-feather="home" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Início</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedSecond(2)">
            <div>
                <i data-feather="search" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Buscar</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedSecond(3)">
            <div>
                <center><i data-feather="bell" class="v-nav-icon"></i></center>
                <div class="v-nav-item-name">Recentes</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedSecond(4)">
            <div>
                <i data-feather="user" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Perfil</div>
            </div>
        </div>
        <img class="v-nav-brand" src="../../../assets/brand/logo-gowo-white-h120.png">
    </div>
    <!--
    <div class="nav-cart-circle">
        <i data-feather="briefcase" class="nav-cart-circle-icon"></i>
    </div>
    -->
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

    function open_list() {
        if (list.open === false) {
            const height = isNaN(window.innerHeight) ? window.clientHeight : window.innerHeight;
            list.bottomCartBar.style.height = `${height - 55}px`;
            list.mobileDetails.style.display = 'block';
            list.mobileDetailsFixed.style.display = 'none';
            list.listMobile.style.background = 'var(--bg-default)';
            list.open = true;

        } else {
            list.bottomCartBar.style.height = '40px';
            list.mobileDetails.style.display = 'none';
            list.mobileDetailsFixed.style.display = 'flex';
            list.mobileDetailsFixed.style.justifyContent = 'space-between';
            list.mobileDetailsFixed.style.backgroundColor = 'var(--bg-color)';
            list.listMobile.style.background = 'var(--bg-color)';
            list.open = false;
        }
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
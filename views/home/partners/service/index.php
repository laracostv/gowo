<?php 
    session_start();

    include_once('../../../../database/get_service_details.php');
    $user = isset($_GET['user']) ? $_GET['user'] : 0;
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>GoWo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../../../../assets/brand/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../assets/brand/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../assets/brand/icons/favicon-16x16.png">
    <link rel="manifest" href="../../../../assets/brand/icons/site.webmanifest">
    <link rel="mask-icon" href="../../../../assets/brand/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../../../../public/css/css_reset.css">
    <link rel="stylesheet" href="../../../../public/css/grid.css">
    <link rel="stylesheet" href="../../../../public/css/default.css">
    <link rel="stylesheet" href="../../../../public/css/views/home.css">
    <link rel="stylesheet" href="../../../../public/css/views/partners.css">
    <link rel="stylesheet" href="../../../../public/css/views/service-page.css">
    <!--JS-->
    <script src="../../../../public/js/theme.js"></script>
    <script src="../../../../public/js/navigation.js"></script>
    <script src="../../../../public/js/interactions.js"></script>
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
    <!--TAKE BAR-->
    <div class="container-fluid top-take-bar">
        <i onclick="window.history.back()" data-feather="chevron-left" class="return-arrow"></i>
        <div class="info-line-top">
            <input class="name-user-top" placeholder="<?php echo$response['service'][0]['usrName'] ?>" disabled="true">
            <input class="adr-user-top"
                placeholder="<?php echo $response['service'][0]['sNbh'].', '.$response['service'][0]['sCity'].' - '.$response['service'][0]['sState']; ?>"
                disabled="true">
        </div>
        <i data-feather="heart" class="fav-icon-top"></i>
    </div>

    <div class="container" style="padding: 0px;">
        <div class="row">
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">
                <center>
                    <div class="service-page-photo" style="
                                                background-image: url(<?php $aspas = "'"; echo $aspas.'../../../../assets/images/users/services/'.$response['service'][0]['sPhoto'].''.$aspas ?>);
                                                background-size: cover;
                                                background-attachment: scroll;
                                                background-position: center;
                                                ">
                    </div>
                </center>
                <h2 class="service-page-name"><?php echo $response['service'][0]['sName']; ?></h2>
                <div class="service-price"><?php echo $response['service'][0]['sVal']; ?></div>
                <div class="service-desc">
                    <?php echo $response['service'][0]['sDesc']; ?>
                </div>
            </div>


            <div class="xs-hide sm-hide md-hide lg-4 xg-4">
                <div class="service-user-do-box">
                    <div class="top-header">
                        <div class="worker-img" style="
                                                background-image: url(<?php $aspas = "'"; echo $aspas.'../../../../assets/images/users/profile_photos/'.$response['service'][0]['usrProfilePhotoSrc'].''.$aspas ?>);
                                                background-size: cover;
                                                background-attachment: scroll;
                                                background-position: center;
                                                ">
                        </div>
                        <div class="worker-info">
                            <div class="worker-name"><?php echo$response['service'][0]['usrName'] ?></div>
                            <div class="aval-star"><i data-feather="star" class="avv-worker"></i> 5.0 &middot 385
                                serviços prestados</div>
                        </div>
                    </div>

                    <center>
                        <div class="options-contact">
                            <a href="mailto:<?php echo$response['service'][0]['usrEmail']; ?>">
                                <div class="contact-button">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </a>
                            <a
                                href="https://api.whatsapp.com/send?phone=55<?php echo$response['service'][0]['usrCellPhone']; ?>&text=Ol%C3%A1%20<?php echo$response['service'][0]['usrName']; ?>%2C%20encontrei%20seu%20perfil%20no%20Gowo!">
                                <div class="contact-button">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                            </a>
                            <a href="tel:+55<?php echo$response['service'][0]['usrCellPhone']; ?>">
                                <div class="contact-button">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </a>
                        </div>
                    </center>

                    <!--
                    <div class="coments-service-box">
                        <div class="float-space">
                            <div class="float-header">
                                <div class="photo-float" style="
                                                background-image: url(<?php $aspas = "'"; echo $aspas.'../../../../assets/images/users/services/'.$response['service'][0]['sPhoto'].''.$aspas ?>);
                                                background-size: cover;
                                                background-attachment: scroll;
                                                background-position: center;
                                                "></div>
                                <h6 class="float-name"><?php echo $response['service'][0]['sName']; ?></h6>
                                <div class="float-stars"></div>
                            </div>
                        </div>
                    </div>
                    

                    <button style="margin-top: 0px" class="btn-default btn-complete">
                        Contratar este serviço
                    </button>
                                                                                    -->
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding: 0px;">
        <div class="row">
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">

            </div>
            <div class="xs-hide sm-hide md-hide lg-4 xg-4"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">

                <?php 
                
                ?>
            </div>
            <div class="xs-hide sm-hide md-hide lg-4 xg-4">
            </div>
        </div>

        <div class="row">
            <?php 
            
            ?>
        </div>
    </div>
    <div class="bottom-spacer"></div>
                              
    <!--TAKE BAR
    <div class="container-fluid bottom-take-bar md-show xg-hide lg-hide">
        <button class="btn-default-bottom">
            Contratar agora
        </button>
        <button class="btn-default-bottom-2">
            <i data-feather="plus" class="v-nav-icon"></i>
        </button>
    </div>
-->
    <!--NAV DESKTOP-->
    <div class="v-nav">
        <img class="profile-nav-photo" src="<?php
                    if(isset($_SESSION['profile_photo'])){
                        echo$_SESSION['profile_photo'];
                    }else{
                        echo"../../../../assets/images/users/profile_photos/user.png";
                    }
                ?>"></img>
        <div class="nav-user"><?php
                    if(isset($_SESSION['name'])){
                        echo$_SESSION['name'];
                    }else{
                        echo"<a href='../../'>Entrar</a> ou <a href='../../views/initial/signup'>Cadastrar</a>";
                    }
                ?></div>
        <div class="nav-item-square active-v-nav" onclick="navRedThird(1)">
            <div>
                <i data-feather="home" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Início</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedThird(2)">
            <div>
                <i data-feather="search" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Buscar</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedThird(3)">
            <div>
                <center><i data-feather="bell" class="v-nav-icon"></i></center>
                <div class="v-nav-item-name">Recentes</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRedThird(4)">
            <div>
                <i data-feather="user" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Perfil</div>
            </div>
        </div>
        <img class="v-nav-brand" src="../../../../assets/brand/logo-gowo-white-h120.png">
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

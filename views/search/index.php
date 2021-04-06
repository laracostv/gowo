<?php 
    session_start();
    //include_once('../../database/functions/search.php');
    
    ?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>Buscar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/brand/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/brand/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/brand/icons/favicon-16x16.png">
    <link rel="manifest" href="../../assets/brand/icons/site.webmanifest">
    <link rel="mask-icon" href="../../assets/brand/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../../public/css/css_reset.css">
    <link rel="stylesheet" href="../../public/css/grid.css">
    <link rel="stylesheet" href="../../public/css/default.css">
    <!--JS-->
    <script src="../../public/js/theme.js"></script>
    <script src="../../public/js/navigation.js"></script>
    <script src="../../public/js/interactions.js"></script>
    <!--ICONS-->
    <script src="https://unpkg.com/feather-icons"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>-->
    <script src="https://cdnjs.com/libraries/bodymovin" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_COOKIE["theme"])){
        $themeCookie = $_COOKIE['theme'];
        
        if($themeCookie == 'dark'){
            echo '<script>darkTheme();</script>';
        }
    }
?>

    <div class="container">
        <div class="row">
        </div>
    </div>

    <!--NAV DESKTOP-->
    <div class="v-nav">
        <img class="profile-nav-photo" src="<?php
                    if(isset($_SESSION['profile_photo'])){
                        echo$_SESSION['profile_photo'];
                    }else{
                        echo"../../assets/images/users/profile_photos/user.png";
                    }
                ?>"></img>
        <div class="nav-user"><?php
                    if(isset($_SESSION['name'])){
                        echo$_SESSION['name'];
                    }else{
                        echo"<a href='../../'>Entrar</a> ou <a href='../../views/initial/signup'>Cadastrar</a>";
                    }
                ?></div>
        <div class="nav-item-square" onclick="navRed(1)">
            <div>
                <i data-feather="home" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Início</div>
            </div>
        </div>
        <div class="nav-item-square active-v-nav" onclick="navRed(2)">
            <div>
                <i data-feather="search" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Buscar</div>
            </div>
        </div>
        <div class="nav-item-square " onclick="navRed(3)">
            <div>
                <center><i data-feather="bell" class="v-nav-icon"></i></center>
                <div class="v-nav-item-name">Recentes</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRed(4)">
            <div>
                <i data-feather="user" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Perfil</div>
            </div>
        </div>
        <img class="v-nav-brand" src="../../assets/brand/logo-gowo-white-h120.png">
    </div>

    <!--MOBILE BAR NAVIGATION-->

    <div class="container-fluid bottom-nav-bar xg-hide lg-hide md-show">
        <div class="row">
            <div class="md-3 center-x-y height-60" onclick="navRed(1)">
                <div>
                    <center><i data-feather="home" class="nav-icon"></i></center>
                    <div class="text-nav">Início</div>
                </div>
            </div>
            <div class="md-3 center-x-y height-60" onclick="navRed(20)">
                <div>
                    <center><i data-feather="message-square" class="nav-icon active-mob"></i></center>
                    <div class="text-nav active-mob">Chat</div>
                    <!--<div class="chat-notification">10</div>-->
                </div>
            </div>
            <div class="md-3 center-x-y height-60" onclick="navRed(3)">
                <div>
                    <center><i data-feather="bell" class="nav-icon"></i></center>
                    <div class="text-nav">Recentes</div>
                </div>
            </div>
            <div class="md-3 center-x-y height-60" onclick="navRed(4)">
                <div>
                    <center><i data-feather="user" class="nav-icon"></i></center>
                    <div class="text-nav">Perfil</div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL-->
    <div class="modal-area"
        onclick="this.style.display='none'; document.getElementById('modal-welcome').style.display='none'"></div>
    <div class="modal-box" id="modal-welcome">
        <i class="close-modal" data-feather="x" onclick="modalClose(this)"></i>
        <div style="max-width: 260px; max-height: 240px" id="welcome-lottie"></div>
        <div class="modal-title">Olá Usuário!</div>
        <p class="modal-text">Seja bem-vindo(a) a plataforma que vai revolucionar as interações de trabalho.</p>
        <div class="modal-footer">
            <button class="modal-btn">Vamos lá</button>
            <div>
                </img>
                <!--FIM DO MODAL-->

                <script>
                feather.replace();
                //open_modal('modal-welcome');
                </script>
                <script src="../../../public/js/theme.js"></script>
</body>

</html>
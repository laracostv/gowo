<?php 
    session_start();
    if(!isset($_SESSION['email'])){
            header('Location: ../../../index.php?erro=2');
    }
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>Configurações</title>
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
    <link rel="stylesheet" href="../../../public/css/views/profile.css">
    <!--JS-->
    <script src="../../../public/js/theme.js"></script>
    <script src="../../../public/js/navigation.js"></script>
    <script src="../../../public/js/interactions.js"></script>
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

    <div class="container" style="padding: 0px">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">
                <div class="header-profile">
                    <i class="header-icon-profile" data-feather="settings"></i>
                    <h2 class="text-cat-profile">Configurações</h2>
                </div>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">
                <div class="config-option">
                    <div class="title-config">
                        Editar perfil
                    </div>
                    <div class="option-click">
                        <i data-feather="edit-3" class="op-icon"></i>
                    </div>
                </div>

                <div class="config-option">
                    <div class="title-config">
                        Modo escuro
                    </div>
                    <div class="option-click">
                        <label class="switch">
                            <input id="theme_chose" type="checkbox" onchange="change_theme()">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="config-option">
                    <div class="title-config">
                        Notificações por email
                    </div>
                    <div class="option-click">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <center>
                    <div class="exit-btn" onclick="window.location.href = '../../../database/exit_session.php'">Encerrar
                        sessão</div>
                </center>
            </div>
            <div class="xs-hide sm-hide md-hide lg-1 xg-1"></div>
        </div>
        <div style="height: 120px"></div>
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
                        echo"<a href='../../../'>Entrar</a> ou <a href='../../../views/initial/signup'>Cadastrar</a>";
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
        <div class="nav-item-square active-v-nav" onclick="navRedSecond(4)">
            <div>
                <i data-feather="user" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Perfil</div>
            </div>
        </div>
        <img class="v-nav-brand" src="../../../assets/brand/logo-gowo-white-h120.png">
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
        </div>
    </div>
    <!--FIM DO MODAL-->

    <script>
    function change_theme() {
        if (document.getElementById("theme_chose").checked) {
            darkTheme()
            window.location.href = "../../../options.php?theme=1";
        } else {
            window.location.href = "../../../options.php?theme=2";
        }
    }
    feather.replace();
    </script>
    <?php
    if (isset($_COOKIE["theme"])){
        $themeCookie = $_COOKIE['theme'];
        
        if($themeCookie == 'dark'){
            echo '<script>document.getElementById("theme_chose").checked = true;</script>';
        }
    }
    ?>

</body>

</html>
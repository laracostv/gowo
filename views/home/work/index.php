<?php 
    session_start();
    if(!isset($_SESSION['email'])){
            header('Location: ../.././../index.php?erro=2');
    }
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
    <!--JS-->
    <script src="../../../public/js/theme.js"></script>
    <script src="../../../public/js/navigation.js"></script>
    <script src="../../../public/js/interactions.js"></script>
    <script src="../../../public/js/vanilla-masker.js"></script>
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
                <h2 class="cat-page">Novo serviço</h2>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-3 xg-3"></div>
            <div class="xs-12 sm-12 md-12 lg-6 xg-6">
                <br>
                <form id="partner_form" method="post">
                    <input class="normal-input" id="name" type="text"
                        placeholder="Título do serviço ex.: Faxina, Brigadeiros, Conserto de celular... " name="name"
                        required>
                    <select class="normal-input" placeholder="Categoria" name="Category" id="category" required>
                        <option value="False">Escolha uma categoria</option>
                        <option value="Automotivo">Automotivo</option>
                        <option value="Beleza">Beleza</option>
                        <option value="Comida">Comida</option>
                        <option value="Corte e Costura">Corte e Costura</option>
                        <option value="Cuidados Pet">Cuidados Pet</option>
                        <option value="Design">Design</option>
                        <option value="Fotografia">Fotografia</option>
                        <option value="Informática">Informática</option>
                        <option value="Jardinagem">Jardinagem</option>
                        <option value="Limpeza">Limpeza</option>
                        <option value="Reformas e Consertos">Reformas e Consertos</option>
                    </select>
                    <select class="normal-input" placeholder="Categoria" name="Category" id="category" required>
                        <option value="False">Lozalização base</option>
                        <option value="Automotivo">Rua Arlinda Correa de Jesus, 90, Jardim Camburi - Vitória - ES</option>
                        <option value="Beleza">Casa da Namorada</option>
                    </select>
                    <textarea class="normal-textarea" maxlength="900"
                        placeholder="Descreva sua atividade..."></textarea>
                    <input class="normal-input" type="tel" placeholder="Valor" name="value" id="val"
                        style="max-width: 150px; font-weight: 900;" required>
                    <div class="no-price">
                        <input type="checkbox" id="noPrice"><label for="noPrice">Sem valor definido</label>
                    </div>
                    <br>
                    <button class="btn-default btn-complete" onclick="input_check()">Cadastrar</button>
                </form>
            </div>
            <div class="xs-hide sm-hide md-hide lg-3 xg-3"></div>
        </div>
    </div>


    <!--NAV DESKTOP-->
    <div class="v-nav">
        <img class="profile-nav-photo" src="../../../assets/images/users/profile_photos/user.png"></img>
        <div class="nav-user">           <?php
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
        <div class="nav-item-square" onclick="navRedSecond(4)">
            <div>
                <i data-feather="user" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Perfil</div>
            </div>
        </div>
        <img class="v-nav-brand" src="../../../assets/brand/logo-gowo-white-h120.png">
    </div>

    <script>
        feather.replace();
                //open_modal('modal-welcome')
    </script>
    <script>
        window.addEventListener("load", function (event) {
            document.getElementById('lds-ellipsis').style.display = 'none';
        });
        VMasker(document.getElementById("val")).maskMoney({
            // Decimal precision -> "90"
            precision: 2,
            // Decimal separator -> ",90"
            separator: ',',
            // Number delimiter -> "12.345.678"
            delimiter: '.',
            // Money unit -> "R$ 12.345.678,90"
            unit: 'R$',
            // Money unit -> "12.345.678,90 R$"
            //suffixUnit: 'R$',
            // Force type only number instead decimal,
            // masking decimals with ",00"
            // Zero cents -> "R$ 1.234.567.890,00"
            zeroCents: false
        });
    </script>
</body>

</html>
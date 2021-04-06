<?php 
    session_start();

    include_once('../../../../database/edit_service.php');

    //$UserServiceJsonArr = json_decode($services_json, true);
    include_once('../../../../database/list_user_address.php');
    $adJsonArr = json_decode($address_json, true);
    
    $user = isset($_GET['user']) ? $_GET['user'] : 0;
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>Editar Serviço</title>
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
    <link rel="stylesheet" href="../../../../public/css/views/myservice.css">
    <!--JS-->
    <script src="../../../../public/js/theme.js"></script>
    <script src="../../../../public/js/navigation.js"></script>
    <script src="../../../../public/js/interactions.js"></script>
    <script src="../../../../public/js/vanilla-masker.js"></script>
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
                <i class="fas fa-pen"></i>
                <h2 class="cat-page">Editar Serviço</h2>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>
    </div>
    <div class="container-no-padings">
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-3 xg-3"></div>
            <div class="xs-12 sm-12 md-12 lg-6 xg-6">
                <br>
                <form id="partner_form" method="post" action="../../../../database/functions/update_service.php"
                    enctype="multipart/form-data">

                    <center>
                        <div class="fileUpload"
                            style="background-image: url('../../../../assets/images/users/services/<?php echo$result_service['sPhotoSrc'] ?>')">
                            <input type="file" name="arquivo" id="up_image" class="upload" onchange="previewFile(this);"
                                accept=".png, .jpg, .jpeg" value="<?php echo$result_service['sPhotoSrc'] ?>" />
                        </div>
                    </center>

                    <input class="normal-input" id="service_name" type="text"
                        placeholder="Título do serviço ex.: Faxina, Brigadeiros, Conserto de celular... "
                        name="service_name" value="<?php echo$result_service['sName'] ?>" required>

                    <select class="normal-input" placeholder="Categoria" name="category" id="category" required>
                        <option value="false" disabled selected><?php echo$result_service['sClass'] ?></option>
                        <option value="False" disabled>Escolha uma categoria</option>
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
                    <select class="normal-input" placeholder="Localização" name="adr" id="adr" required>
                        <option value="False" disabled>Lozalização base</option>
                        <?php 
                        echo'<option value="'.$result_address_service['idAdress'].'" disabled selected> Atual: '.$result_address_service["adName"].' | '.$result_address_service['adAddress'].', '.$result_address_service["adNumber"].', '.$result_address_service["adNbh"].' - '.$result_address_service["adCity"].'</option>';
                        
                        foreach($adJsonArr['address_user'] as $arr){
                            //echo$arr['adName'];
                            echo'<option value="'.$arr['idAdress'].'">'.$arr["adName"].' | '.$arr['adAddress'].', '.$arr["adNumber"].', '.$arr["adNbh"].' - '.$arr["adCity"].'</option>';
                        }
                        ?>
                    </select>
                    <textarea name="desc" id="desc" class="normal-textarea" maxlength="900"
                        placeholder="Descreva sua atividade..."><?php echo$result_service['sDesc'] ?></textarea>
                    <input class="normal-input" type="tel" placeholder="Valor" name="val" id="val"
                        style="max-width: 150px; font-weight: 900;" value="<?php echo$result_service['sVal']?>">
                    <div class="no-price">
                        <input type="checkbox" onclick="disable_price()" id="noPrice" name="noPrice"><label
                            for="noPrice">Sem valor
                            definido</label>
                    </div>
                    <br>
                    <button class="btn-default btn-complete" onclick="input_check()">Atualizar</button>
                </form>
            </div>
            <div class="xs-hide sm-hide md-hide lg-3 xg-3"></div>
        </div>
        <div class="height-60"></div>
    </div>


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
        <div class="nav-item-square" onclick="navRedThird(1)">
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
        <div class="nav-item-square active-v-nav" onclick="navRedThird(4)">
            <div>
                <i data-feather="user" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Perfil</div>
            </div>
        </div>
        <img class="v-nav-brand" src="../../../../assets/brand/logo-gowo-white-h120.png">
    </div>

    <script>
    feather.replace();
    </script>
    <script>
    window.addEventListener("load", function(event) {
        document.getElementById('lds-ellipsis').style.display = 'none';
    });

    var active = false;

    function disable_price() {

        if (active == false) {
            document.getElementById("val").value = '';
            document.getElementById("val").disabled = true;
            change_status(1);
        } else {
            document.getElementById("val").disabled = false;
            change_status(2);
        }

        function change_status(id) {
            if (id == 1) {
                active = true;
            } else {
                active = false;
            }
        }
    }
    </script>
    <script>
    window.addEventListener("load", function(event) {
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
    <script>
    function previewFile(input) {
        const [file] = input.files
        const preview = document.getElementById('preview')
        const reader = new FileReader()
        srcBase64 = ''

        reader.onload = e => {

            srcBase64 = e.target.result;
            document.getElementsByClassName('fileUpload')[0].style.backgroundSize = 'cover';
            document.getElementsByClassName('fileUpload')[0].style.backgroundImage = "url('" + e.target.result +
                "')";
        }

        reader.readAsDataURL(file)
    }
    </script>
</body>

</html>
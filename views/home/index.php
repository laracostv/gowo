<?php 
    session_start();
    include_once('../../database/list_user_address.php');
    include_once('../../database/list_all_local_services.php');
    
    $adJsonArr = json_decode($address_json, true);
    $adrState = $adJsonArr['success'][0];

    $localServiceJsonArr = json_decode($services_json, true);
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>GoWo</title>
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
    <link rel="stylesheet" href="../../public/css/views/home.css">
    <!--JS-->
    <script src="../../public/js/theme.js"></script>
    <script src="../../public/js/navigation.js"></script>
    <script src="../../public/js/interactions.js"></script>
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
    <div class="container">
        <div class="row" id="top-content">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2">
            </div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8 top-bar-info">
                <div>
                    <p class="text-location-ref">Nas proximidades de:</p>
                    <div class="user-location" onclick="open_modal('modal-adress', '1')">
                        <input placeholder="<?php
                            if($adrState > 0){
                                foreach($adJsonArr['address_user'] as $arr){
                                    if($arr["idAdress"] == $_SESSION['active_adress']){
                                        echo $arr["adAddress"];
                                        echo ', ';
                                        echo $arr["adNumber"];
                                    }
                                }
                            }else{
                                echo'Clique para adicionar local';
                            }
                        ?>" disabled="true" id="usr_location">
                        <i data-feather="chevron-down" class="user-location-icon"></i>
                    </div>
                </div>
                <a href="work/"><i data-feather="user-check" class="top-bar-info-icon"></i></a>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2">
            </div>
        </div>
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-2 xg-2">
            </div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8">
                <i data-feather="search" class="search-input-icon"></i>
                <input class="search_input xs-hide sm-hide md-hide lg-show xg-show"
                    placeholder="Serviço, categoria ou usuário...">
                <input class="search_input xs-show sm-show md-show lg-hide xg-hide"
                    placeholder="Serviço, categoria ou usuário..." onfocus="hideUI()" onblur="showUI()">
            </div>
            <div class="xs-hide sm-hide md-2 lg-2 xg-2">
            </div>
        </div>
    </div>
    <div class="container" id="all-content">
        <div class="row slide-category">
            <div class="xs-hide sm-hide md-2 lg-2 xg-2"></div>
            <div class="xs-12 sm-12 md-12 lg-8 xg-8 distribute-category">
                <a href="category/?category=limpeza&icon=fas%20fa-broom">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <center>
                                <div class="category-circle">
                                    <i class="fas fa-broom"></i>
                                </div>
                            </center>
                            <div class="category-title">Limpeza</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=corte%20e%20costura&icon=fas%20fa-tshirt">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div class="category-title">Corte e Costura</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=automotivo&icon=fas%20fa-car">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="category-title">Automotivo</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=beleza&icon=fas%20fa-heart">    
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="category-title">Beleza</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=cuidados%20pet&icon=fas%20fa-paw"> 
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-paw"></i>
                            </div>
                            <div class="category-title">Cuidados Pet</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=fotografia&icon=fas%20fa-camera">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-camera"></i>
                            </div>
                            <div class="category-title">Fotografia</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=comida&icon=fas%20fa-utensils">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="category-title">Comida</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=informática&icon=fas%20fa-laptop">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="category-title">Informática</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=jardinagem&icon=fas%20fa-seedling">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="category-title">Jardinagem</div>
                        </div>
                    </div>
                </a>

                <a href="category/?category=reformas%20e%20consertos&icon=fas%20fa-paint-roller">
                    <div class='middle-col-alig'>
                        <div class="category-square">
                            <div class="category-circle">
                                <i class="fas fa-paint-roller"></i>
                            </div>
                            <div class="category-title">Reformas e Consertos</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>

        <div class="row">
        <?php 
            foreach($localServiceJsonArr['services'] as $arr){
                //echo$arr['adName'];

                echo'   <div class="xs-12 sm-12 md-12 lg-6 xg-6 no-decoration">
                            <a href="user/'.$arr['idUsr'].'">
                                <div class="box-list">
                                    <img class="img-list-service" src="../../assets/images/users/profile_photos/'.$arr['userDoProfilePhoto'].'">
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
            if(isset($localServiceJsonArr['message'])){
                echo'<div class="xs-12 sm-12 md-12 lg-12 xg-12 warning-message-service">
                        <center><h2>'.$localServiceJsonArr['message'].'</h2></center>
                    </div>';
            }
            ?>
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
        <div class="nav-item-square active-v-nav" onclick="navRed(1)">
            <div>
                <i data-feather="home" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Início</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRed(2)">
            <div>
                <i data-feather="search" class="v-nav-icon"></i>
                <div class="v-nav-item-name">Buscar</div>
            </div>
        </div>
        <div class="nav-item-square" onclick="navRed(3)">
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
    <div class="nav-cart-circle">
        <i data-feather="briefcase" class="nav-cart-circle-icon"></i>
    </div>

    <!--ORDER LIST MOBILE-->
    <div class="bottom-spacer"></div>
    <div id="list-mobile" class="container-fluid bottom-cart-bar xg-hide lg-hide md-show">
        <div class="row" id="mobile-details-fixed" onclick="open_list(1)">
            <div class="md-3">
                <i data-feather="briefcase" class='m-icon-cart'></i>
                <div class="m-counter-cart">3</div>
            </div>
            <div class="md-6">
                <div class="text-cart-bottom">Ver lista</div>
            </div>
            <div class="md-3">
                <div class="m-price">R$ 19,99</div>
            </div>
        </div>
        <div id="mobile-details-list" class="mobile-details-list">
            <div id="header-details-list-mobile" class="header-details-list-mobile">
                <i class="close-mobile-details-list" data-feather="x" onclick="open_list(5)"></i>
                <i data-feather="briefcase" class='mobile-details-icon'></i>
                <div class="mobile-details-title">Sua lista</div>
            </div>
            <div class="mobile-all-orders">
                <div class="order-mobile" id="order1">
                    <div class="title-order">
                        <img class="order-place-img"
                            src="../../assets/images/users/profile_photos/cabeca-de-ideias.png">
                        <div class="order-place-name">Cabeça de Ideias</div>
                    </div>
                    <div class="desc-order">
                        <div class="mobile-order-item">Identidade Visual - Básico</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--MOBILE BAR NAVIGATION-->

    <div class="container-fluid bottom-nav-bar xg-hide lg-hide md-show" id="mob-nav">
        <div class="row">
            <div class="md-3 center-x-y height-60" onclick="navRed(1)">
                <div>
                    <center><i data-feather="home" class="nav-icon active-mob"></i></center>
                    <div class="text-nav active-mob">Início</div>
                </div>
            </div>
            <div class="md-3 center-x-y height-60" onclick="navRed(20)">
                <div>
                    <center><i data-feather="search" class="nav-icon"></i></center>
                    <div class="text-nav">Buscar</div>                   
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
    <!--MODAL Welcome-->
    <div class="modal-area"
        onclick="this.style.display='none'; document.getElementById('modal-welcome').style.display='none'"></div>
    <div class="modal-box" id="modal-welcome">
        <i class="close-modal" data-feather="x" onclick="modalClose(this, 0)"></i>
        <div style="max-width: 260px; max-height: 240px" id="welcome-lottie"></div>
        <div class="modal-title">Olá Usuário!</div>
        <p class="modal-text">Seja bem-vindo(a) a plataforma que vai revolucionar as interações de trabalho.</p>
        <div class="modal-footer">
            <button class="modal-btn">Vamos lá</button>
        </div>
    </div>
    <!--FIM DO MODAL-->

    <!--MODAL Local-->
    <div class="modal-area"
        onclick="document.getElementById('modal-adress').style.display='none'; this.style.display='none';">
    </div>
    <div class="modal-box" id="modal-adress">
        <i class="close-modal" data-feather="x" onclick="modalClose(this, 1)"></i>
        <div class="modal-title">Endereços</div>
        <div class="modal-body a-no-decoration">
        <?php 
        foreach($adJsonArr['address_user'] as $arr){
            //echo$arr['adName'];
            echo'<a href="../../database/choose_active_address.php?address='.$arr["idAdress"].'">
                    <div class="local-list">
                        <div>
                            <i data-feather="map-pin" class="pin-list-ad"></i>
                        </div>
                        <div>
                            <p class="adress-name">'.$arr["adName"].'</p>
                            <p class="st-name">'.$arr["adAddress"].', '.$arr["adNumber"].'</p>
                            <p class="ad-line1">'.$arr["adNbh"].', '.$arr["adCity"].' - '.$arr["adState"].'</p>
                            <p class="ad-line2">'.$arr["adComp"].'</p>
                        </div>
                    </div>
                </a>
                ';
        }
        ?>
        </div>
        <div class="modal-footer">
            <a href="local"><button class="modal-btn">+ Adicionar novo</button></a>
        </div>
    </div>
    <!--FIM DO MODAL-->

    <script>
        function order_list_display(id) {
            if (id == 0) {
                document.getElementById('list-mobile').style.display = "none";
            }
            if (id == 1) {
                document.getElementById('list-mobile').style.display = "block";
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
        //open_modal('modal-welcome', '0')

    </script>
    <script>
        var animation = bodymovin.loadAnimation({
            // animationData: { /* ... */ },
            container: document.getElementById('welcome-lottie'), // required
            path: '../../assets/images/ui/lottie/welcome-gears-jobs.json', // required
            renderer: 'svg', // required
            loop: true, // optional
            autoplay: true, // optional
            name: "Welcome", // optional
        });
        window.addEventListener("load", function (event) {
            document.getElementById('lds-ellipsis').style.display = 'none';
        });

        function showUI() {
            document.getElementById('mob-nav').style.display = 'block';
            showContent();
            order_list_display(1);
        }

        function hideUI() {
            document.getElementById('mob-nav').style.display = 'none';
            hideContent();
            order_list_display(0);
        }

        function hideContent() {
            document.getElementById('all-content').style.display = 'none';
            document.getElementById('top-content').style.display = 'none';
        }

        function showContent() {
            document.getElementById('all-content').style.display = 'block';
            document.getElementById('top-content').style.display = 'block';
        }

    </script>
</body>

</html>
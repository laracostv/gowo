<?php
    session_start();
    if(!isset($_SESSION['email'])){
            header('Location: ../../../index.php?erro=2');
    }
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <title>Adicionar Local</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/brand/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/brand/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/brand/icons/favicon-16x16.png">
    <link rel="manifest" href="../../../assets/brand/icons/site.webmanifest">
    <link rel="mask-icon" href="../../../assets/brand/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../../../public/css/views/home-local.css">
    <link rel="stylesheet" href="../../../public/css/css_reset.css">
    <link rel="stylesheet" href="../../../public/css/grid.css">
    <link rel="stylesheet" href="../../../public/css/default.css">
    <!--JS-->
    <script src="../../../public/js/navigation.js"></script>
    <script src="../../../public/js/interactions.js"></script>
    <script src="../../../public/js/vanilla-masker.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../../public/js/local.js"></script>
    <script src="../../../public/js/theme.js"></script>
    <!--ICONS-->
    <!--<script src="https://unpkg.com/feather-icons"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
</head>
<!--THEME COOKIE-->
<?php
        if (isset($_COOKIE["theme"])){
            $themeCookie = $_COOKIE['theme'];
            
            if($themeCookie == 'dark'){
                echo '<script>darkTheme();</script>';
            }
        }
?>

<body>

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
            <div class="xs-12 sm-12 md-12 lg-8 xg-8 area-header">
                <i data-feather="map-pin" class="feather-icon-header"></i>
                <h2 class="header-area-text">Adicionar local</h2>
            </div>
            <div class="xs-hide sm-hide md-hide lg-2 xg-2"></div>
        </div>
    </div>

    <div class="container-no-padings">
        <div class="row">
            <div class="xs-hide sm-hide md-2 lg-3 xg-3"></div>
            <div class="xs-12 sm-12 md-8 lg-6 xg-6">
                <br>
                <br>
                <form id="address_form" method="POST" action="../../../database/insert_address.php">
                    <input class="normal-input" id="txtCep" type="tel" placeholder="Digite seu CEP" name="txtCep"
                        maxlength="9" onchange="callFunctionCep()" required>
                    <div class="loading-div" id="loading-div">
                        <div class="lds-dual-ring"></div>
                    </div>
                    <div id="incorrect-cep">
                        Ops... parece que não encontramos este CEP
                    </div>

                    <!--MODAL Welcome-->
                    <div class="modal-area"
                        onclick="this.style.display='none'; document.getElementById('modal-local').style.display='none'">
                    </div>

                    <div class="modal-box" id="modal-local">
                        <i class="close-modal" data-feather="x" onclick="modalClose(this, 0)"></i>
                        <div style="max-width: 260px; max-height: 240px" id="local-lottie"></div>
                        <div class="modal-title">Adicione um apelido</div>
                        <p class="modal-text">Com um nome personalizado você identifica facilmente o
                            endereço (visível apenas para você)</p>
                        <br>
                        <input class="normal-input" id="adName" type="text"
                            placeholder="Ex: Minha casa, trabalho, faculdade..." name="adName" autocomplete="off"
                            required>
                        <div class="modal-footer">
                            <input type="submit" value="Salvar endereço" class="modal-btn"></input>
                        </div>
                    </div>

                    <div class="hidden-before-cep" id="hidden-before-cep">
                        <input class="normal-input" id="address" type="text" placeholder="Endereço" name="address"
                            required>
                        <input class="normal-input" id="number" type="tel" placeholder="Número" name="numberAdr"
                            required>
                        <input class="normal-input" id="nbh" type="text" placeholder="Bairro" name="nbh" required>
                        <input class="normal-input" id="city" type="text" placeholder="Cidade" name="city" required>
                        <select class="normal-input" name="state" id="state" required>
                            <option value="N">Estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <input class="normal-input" id="compl" type="text" placeholder="Complemento" name="compl">
                        <div class="fake-btn-default disabled-fake" id="addAddress"
                            onclick="calltoModal('modal-local', '0')">
                            Adicionar
                            endereço</div>
                    </div>
                    <p class="cep-discover" onclick="discoverCEP_input()">Não sei meu CEP</p>
                </form>

                <div class="adr_search_form">
                    <form id="address_search_form">
                        <select class="normal-select" name="state_search" id="state_search" required>
                            <option value="N">Estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <input class="normal-input" id="city_search" type="text" placeholder="Cidade" name="city_search"
                            required>
                        <input class="normal-input" id="nbh_search" type="text" placeholder="Endereço"
                            name="city_search" required>
                    </form>

                    <button class="btn-default btn-complete" disabled="true" id="btn-consult"
                        onclick="searchCEP()">Consultar</button>

                    <!--LOADER-->
                    <center>
                        <div id="point-loader">
                            <div class="lds-dual-ring"></div>
                        </div>
                    </center>
                    <!--EXIBINDO RESULTADOS ENCONTRADOS-->
                    <div class="searchResults" id="results">
                        <div class="set-text" id="result-text">RESULTADOS ENCONTRADOS</div>
                        <div class="sub-text">Clique em um endereço para cadastra-lo</div>
                        <div class="list_results" id="list_results">
                        </div>
                    </div>

                    <!--CASO NÃO ENCONTRE-->

                    <div id="error-mensage-search">
                        <center>
                            <div style="max-width: 200px; max-height: 200px" id="not-found-local"></div>
                        </center>
                        <div class="txt-error">Não encontrei :(</div>
                        <br>
                        <div class="dsc-error">Mas calma! Aqui estão algumas recomendações para você:</div>
                        <div class="dsc-error">1. Preencheu todos os campos corretamente? Não é necessário inserir a
                            referência: rua ou avenida</div>
                        <div class="dsc-error">2. O campos estão sem espaços, letras, caracteres sobrando, nada de
                            estranho?</div>
                        <div class="dsc-error">3. Preencha novamente e tenta só pra garantir ;)</div>
                        <div class="dsc-error">4. Recarregue a página</div>
                        <div class="dsc-error">5. Nos mande uma mensagem <a href="../../profile/suport"
                                style="color: #00a39b; font-weight: bold;">aqui</a></div>
                    </div>
                </div>

            </div>
            <div class="xs-hide sm-hide md-2 lg-3 xg-3"></div>
        </div>
    </div>

    <input type="button" id='myHiddenButtonEnd' visible='false' onclick="javascript:doFocus(1);" width='1px'
        style="display:none">
    <input type="button" id='myHiddenButtonNmr' visible='false' onclick="javascript:doFocus(2);" width='1px'
        style="display:none">
    <div class="height-60"></div>
    <!--NAV DESKTOP-->
    <div class="v-nav">
        <img class="profile-nav-photo" src="
                <?php
                    if(isset($_SESSION['profile_photo'])){
                        echo$_SESSION['profile_photo'];
                    }else{
                        echo"../../../assets/images/users/profile_photos/user.png";
                    }
                ?>">
        </img>
        <div class="nav-user">
            <?php
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

    <script>
    feather.replace();
    //open_modal('modal-welcome');
    window.addEventListener("load", function(event) {
        document.getElementById('lds-ellipsis').style.display = 'none';
    });
    VMasker(document.getElementById("txtCep")).maskPattern('99999-9999');

    $("#txtCep").keyup(function() {
        callFunctionCep()
    });

    var animation = bodymovin.loadAnimation({
        // animationData: { /* ... */ },
        container: document.getElementById('local-lottie'), // required
        path: '../../../assets/images/ui/lottie/lf20_sj0skmmg.json', // required
        renderer: 'svg', // required
        loop: true, // optional
        autoplay: true, // optional
        name: "local", // optional
    });

    var animation2 = bodymovin.loadAnimation({
        // animationData: { /* ... */ },
        container: document.getElementById('not-found-local'), // required
        path: '../../../assets/images/ui/lottie/map-pin-jump.json', // required
        renderer: 'svg', // required
        loop: true, // optional
        autoplay: true, // optional
        name: "local", // optional
    });
    </script>
</body>

</html>
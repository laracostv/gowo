<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/brand/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/brand/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/brand/icons/favicon-16x16.png">
    <link rel="manifest" href="../../../assets/brand/icons/site.webmanifest">
    <link rel="mask-icon" href="../../../assets/brand/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta name="../../../apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!--FONTS-->
    <!--ICON PACK-->
    <script src="https://unpkg.com/feather-icons"></script>
    <!--CSS-->
    <link rel="stylesheet" href="../../../public/css/css_reset.css">
    <link rel="stylesheet" href="../../../public/css/default.css">
    <link rel="stylesheet" href="../../../public/css/views/login.css">
    <link rel="stylesheet" href="../../../public/css/views/signup.css">
    <link rel="stylesheet" href="../../../public/css/grid.css">
    <!--JS-->
    <script src="../../../public/js/vanilla-masker.js"></script>
    <script src="../../../public/js/initial.js"></script>
</head>
<div class="container-fluid">

    <body>
        <div class="row">
            <div class="xs-hide sm-hide md-hide lg-6 xg-6 half-area-su">
                <center><a href="../../../index.html"><img class="login-logo"
                            src="../../../assets/brand/logo-gowo-white-h120.png"></a></center>
                <div class="box-slogan">
                    <div class="text-typewriter">Encontre </div>
                    <p class="text-typewriter write-red" data-period="1000"
                        data-type='[ "o serviço de limpeza", "o salão de beleza", "a estética", "o lava jato", "pedreiro", "designer", "fotógrafo", "jardineiro" ]'>
                        <span class="wrap"></span>
                    </p>
                    <div class="text-typewriter"> mais perto de você</div>
                </div>
                <img class="img-signup" src="../../../assets/images/ui/images/job_offers.svg">

            </div>
            <div class="xs-12 sm-12 md-12 lg-6 xg-6 total-height">
                <center>
                    <!--
                    <div class="mobile-option" id="mobile-option">
                        <center><a href="../../../index.html"><img class="signup-logo"
                                    src="../../../assets/brand/logo-gowo-h120.png" style="margin-bottom: 30px;"></a>
                        </center>
                        <div class="box-option" onclick="signup_mobile(1)">
                            <i data-feather="list" class="sub-obtion-icon"></i>
                            <p>Oferecer um serviço</p>
                        </div>
                        <div class="box-option" onclick="signup_mobile(2)">
                            <i data-feather="user-check" class="sub-obtion-icon"></i>
                            <p>Contratar um serviço</p>
                        </div>
                    </div>
                -->
                    <div class="signup_box" id="signup_box">
                        <div>
                            <h1>Cadastro</h1>
                            <div class="login-line"></div>
                            <form id="signup_form" method="POST" action="../../../database/user_register.php">
                                <input class="login-form" id="name" type="text" placeholder="Nome" name="name" required>
                                <input class="login-form" id="last_name" type="text" placeholder="Sobrenome"
                                    name="last-name" required>
                                <input class="login-form" id="email" type="email"
                                    onblur="validacaoEmail(signup_form.email)" placeholder="seu@email.com" name="email"
                                    required>
                                <input class="login-form" id="pasw" type="password" onkeyup="pasw_val()"
                                    placeholder="*****" name="pwd" maxlenght="32" required>
                                <div class="pwd-req" id="pwd-req">
                                    <ul>
                                        <li id="check1"><i id="icon1" data-feather="x" class="pwd-req-icon"></i><i
                                                id="checkIcon1" data-feather="check" class="pwd-req-icon"></i>6 a 32
                                            caracteres</li>
                                        <li id="check2"><i id="icon2" data-feather="x" class="pwd-req-icon"></i><i
                                                id="checkIcon2" data-feather="check" class="pwd-req-icon"></i>Letras
                                            maiúsculas e minúsculas</li>
                                        <li id="check3"><i id="icon3" data-feather="x" class="pwd-req-icon"></i><i
                                                id="checkIcon3" data-feather="check" class="pwd-req-icon"></i>Pelo menos
                                            um número</li>
                                    </ul>
                                </div>
                                <input class="login-form" type="tel" placeholder="Celular" name="phone" id="cel"
                                    required>
                                <input class="login-form" type="tel" placeholder="Data de nascimento" name="bdate"
                                    id="bdate" required>
                                <div
                                    style="display: flex; align-items: center; justify-content: center; margin-top: 15px;">
                                    <input style="display: inline-block; margin-right: 8px; margin-top: -5px"
                                        type="checkbox" name="terms" id="check_terms" required>
                                    <label class="terms-text" for="check_terms">Li e declaro que aceito os <a
                                            href="../legal/terms/">termos e condições de uso.</a></label>
                                </div>
                                <button class="login-btn-submit" onclick="input_check()">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </center>
            </div>
        </div>
</div>
<script>
    feather.replace()
    VMasker(document.getElementById("cel")).maskPattern('(99) 99999-9999');
    VMasker(document.getElementById("bdate")).maskPattern('99/99/9999')
    document.getElementById("pasw").maxLength = 32;

    var TxtType = function (el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function () {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(function () {
            that.tick();
        }, delta);
    };

    window.onload = function () {
        var elements = document.getElementsByClassName('text-typewriter');
        for (var i = 0; i < elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
                new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".text-typewriter > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };


</script>
</body>

</html>
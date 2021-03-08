<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Gowo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/brand/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/brand/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/brand/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/brand/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/brand/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!--FONTS-->
    <!--ICON PACK-->
    <script src="https://unpkg.com/feather-icons"></script>
    <!--CSS-->
    <link rel="stylesheet" href="public/css/css_reset.css">
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/grid.css">
    <link rel="stylesheet" href="public/css/views/login.css">
    <!--JS-->
</head>

<body>
    <center><img class="login-logo" src="assets/brand/logo-gowo-h120.png"></center>
    <center>
        <div class="login-box" method="post">
            <div>
                <h1>Login</h1>
                <div class="login-line"></div>
                <form id="login-form" method="post" action="database/login_validation.php">
                    <input class="login-form" type="text" placeholder="Email" name="user" required>
                    <input class="login-form" type="password" placeholder="******" name="pwd" required>
                    <input class="login-btn-submit" type="submit" value="Entrar">
                </form>
                <p class="login-signup-text">Ainda não é cadastrado?</p>
                <a href="views/initial/signup"><button class="login-signup-btn">Cadastre-se</button></a>
            </div>
        </div>
    </center>
    <script>
        feather.replace()
    </script>
</body>

</html>
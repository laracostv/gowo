<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Gowo - Foto de perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="../../../../assets/brand/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../../assets/brand/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../../assets/brand/icons/favicon-16x16.png">
    <link rel="manifest" href="../../../../assets/brand/icons/site.webmanifest">
    <link rel="mask-icon" href="../../../../assets/brand/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <meta name="../../../../apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!--FONTS-->
    <!--ICON PACK-->
    <script src="https://unpkg.com/feather-icons"></script>
    <!--CSS-->
    <link rel="stylesheet" href="../../../../public/css/css_reset.css">
    <link rel="stylesheet" href="../../../../public/css/default.css">
    <link rel="stylesheet" href="../../../../public/css/views/login.css">
    <link rel="stylesheet" href="../../../../public/css/views/signup.css">
    <link rel="stylesheet" href="../../../../public/css/grid.css">
    <link rel="stylesheet" href="../../../../public/css/views/welcome.css">
    <!--JS-->
    <script src="../../../../public/js/vanilla-masker.js"></script>
    <script src="../../../../public/js/initial.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="xs-12 sm-12 md-12 lg-12 xg-12 total-height">
                <center>
                    <div class="white_box">
                        <h1>Foto de perfil</h1>
                        <div class="confirm-line"></div>
                        <p>Que tal uma foto de perfil? Para que as pessoas possam identifica-lo facilmente na rede do
                            Gowo <b>adicione uma foto que represente você ou sua empresa</b></p>
                        <form id="partner_form" method="post" action="../../../../database/functions/insert_photo.php"
                            enctype="multipart/form-data">

                            <center>
                                <div class="fileUpload">
                                    <input type="file" name="arquivo" id="up_image" class="upload"
                                        onchange="previewFile(this);" accept=".png, .jpg, .jpeg" required />
                                </div>
                            </center>

                            <button class="login-btn-submit">Salvar foto</button>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <script>
    feather.replace()
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
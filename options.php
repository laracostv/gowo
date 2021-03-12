<?php
    $theme = $_GET['theme'];

    if($theme == 1){
        setcookie('theme', 'dark');
    }
    if($theme == 2){
        setcookie('theme', 'light');
    }
    header('Location: views/profile/settings');
?>
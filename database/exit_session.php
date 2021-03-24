<?php
    session_start();

    unset($_SESSION['name']);
    unset($_SESSION['last-name']);
    unset($_SESSION['email']);
    unset($_SESSION['cell']);
    unset($_SESSION['dateN']);
    unset($_SESSION['profile_photo']);
    unset($_SESSION['id_usr']);
    unset($_SESSION['active_adress']);          

    header('Location: ../index.php')
?>
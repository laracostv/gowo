<?php
    session_start();

    unset($_SESSION['email']);
    unset($_SESSION['name']);
    unset($_SESSION['last-name']);
    unset($_SESSION['dateN']);
    unset($_SESSION['id_usr']);

    header('Location: ../index.php')
?>
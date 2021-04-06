<?php
    require_once('../db.class.php');

    if(isset($_GET['term'])){
        $term = $_GET['term'];
        echo$term;
    }
?>
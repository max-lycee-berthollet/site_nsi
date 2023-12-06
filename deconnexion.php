<?php
    session_start();
    if (isset($_SESSION['user_id'])){
        session_destroy();
        header('Location: compte.php');
    } else {
        echo "dis donc petit filou tfk ici ?" ;
    }
?>
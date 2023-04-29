<?php
    session_start();
    if (!$_SESSION['zalogowany']){
        header("Location: ../index.html");
    }
?>
<?php

error_reporting(0);
ini_set('display_errors', 0);

include 'functions.php';
include 'pages.php';

// var_dump($_SESSION);

if(!$_SESSION){
    header('Location: login-page.php');
}

// var_dump($_GET);
// var_dump($_POST);

// var_dump($_SESSION['aantal_zakjes']);
// session_destroy();


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
        <script src="https://kit.fontawesome.com/87de323a8b.js" crossorigin="anonymous"></script>
        <script src="Js.js"></script>
    </head>

    <body>
        <div class="grid-container">
            <div class="header">
                <i class="fas fa-solid fa-bars" onclick="openHam()"></i>
                <div class="personal-info">
                    <?php echo $_SESSION['uid'] . ' - ' . floor($_SESSION['aantal_zakjes']) . ' zakjes'; ?>
                </div>
                <?php if($_SESSION['loggedIn']){loods_onwer_accessibility($conn);} ?>
            </div>

            <div class="hamburger" id="hamburger">
                <i class="fas fa-solid fa-minus" onclick="closeHam()"></i>
                <form method="GET">
                    <input type="submit" value="Main menu" name="main-menu">
                    <input type="submit" value="Gebruikers" name="gebruikers">
                    <input type="submit" value="Mijn loods" name="mijn_loods">
                </form>
            </div>
                <?php
                
                    pages($conn);

                ?>
        </div>
    </body>
</html>
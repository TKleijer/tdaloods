<?php

error_reporting(0);
ini_set('display_errors', 0);

session_start();

include 'signup.php';
include 'login.php';

if($_SESSION){
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login / signup</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1 class="header_h1">Dikke loods website (groetjes Cambrix)</h1>
        
        <div class="box_login login-page">
            <h1>LOGIN</h1>
            <form action="" method="POST">
                <input type="text" name="login_uid" placeholder="Gebruikersnaam" title="Gebruikersnaam invullen">
                <input type="password" name="login_pwd" placeholder="Wachtwoord" title="Wachtwoord invullen">
                <input type="submit" name="login_submit" value="Login" title="Inloggen">
            </form>
        </div>

        <div class="box_signup login-page">
            <h1>MAAK ACCOUNT</h1>
            <form action="" method="POST">
                <input type="text" name="signup_uid" placeholder="Gebruikersnaam" title="Gebruikersnaam invullen">
                <input type="password" name="signup_pwd" placeholder="Wachtwoord" title="Wachtwoord invullen">
                <input type="password" name="signup_pwd_repeat" placeholder="Herhaal wachtwoord" title="Wachtwoord herhalen invullen">
                <input type="submit" name="signup_submit" value="Maak account" title="Maak account">
            </form>
        </div>
    </body>
</html>
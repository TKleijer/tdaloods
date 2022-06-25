<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'loodsen';

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die('ERROR : ' . mysqli_connect_error());
}

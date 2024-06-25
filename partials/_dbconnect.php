<?php

$servername = "localhost";
$username = "root";
$passsword = "";
$database = "users";

$conn = mysqli_connect($servername, $username, $passsword, $database);

if(!$conn) {
    die("We failed to connect");
}

?>
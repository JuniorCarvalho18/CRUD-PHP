<?php
$host = "localhost";
$user = "root";
$db = "escola_db";
$pass = "";

$con = mysqli_connect($host,$user,$pass,$db );

if (!$con) {
           die("Erro de conexão: " . mysqli_connect_error() );
}
?>
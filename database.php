<?php
$servername = "localhost";
$username = "ricardooliveira";
$password = "841384";
$dbname = "volta_ao_mundo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

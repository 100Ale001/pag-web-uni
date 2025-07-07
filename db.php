<?php

$server="sql211.infinityfree.com";
$usuario="if0_38985515";
$contraseña="robinxD123";
$db="if0_38985515_chat_db";


$conn = new mysqli($server,$usuario,$contraseña,$db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>
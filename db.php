<?php

// SECCION DE LAS VARIABLES PARA CONEXION

$conn = new mysqli(/*variables*/);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>
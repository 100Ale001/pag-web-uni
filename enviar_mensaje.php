<?php
session_start(); // Inicia la sesión para acceder a variables como user_id y sala_id
require 'db.php'; // Conexión a la base de datos

// Verifica que el usuario esté autenticado y que tenga una sala activa
if (!isset($_SESSION['user_id']) || !isset($_SESSION['sala_id'])) {
    exit('No autorizado'); // Detiene el script si no está autorizado
}

$user_id = $_SESSION['user_id']; // ID del usuario que envía el mensaje
$sala_id = $_SESSION['sala_id']; // ID de la sala donde se envía el mensaje
$mensaje = trim($_POST['mensaje'] ?? ''); // El mensaje enviado, quitando espacios
$nombre_imagen = null; // Inicializa la variable de imagen como nula

// Si se subió una imagen sin errores
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagenTmp = $_FILES['imagen']['tmp_name']; // Ruta temporal del archivo
    $nombreOriginal = basename($_FILES['imagen']['name']); // Nombre original del archivo
    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION)); // Extensión en minúsculas
    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Extensiones permitidas

    // Verifica si la extensión es válida
    if (in_array($extension, $permitidas)) {
        $nuevoNombre = uniqid('img_', true) . '.' . $extension; // Nombre único para guardar la imagen
        $rutaDestino = 'uploads/' . $nuevoNombre; // Ruta final del archivo

        // Crea la carpeta 'uploads' si no existe
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        // Mueve la imagen desde la carpeta temporal al destino
        if (move_uploaded_file($imagenTmp, $rutaDestino)) {
            $nombre_imagen = $nuevoNombre; // Guarda el nuevo nombre de la imagen
        }
    }
}

// Si no se envió ni mensaje ni imagen, no se guarda nada
if ($mensaje === '' && !$nombre_imagen) {
    exit('Mensaje vacío y sin imagen'); // Termina el script
}

// Prepara la inserción en la tabla mensajes
$stmt = $conn->prepare("INSERT INTO mensajes (user_id, sala_id, mensaje, imagen, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param("iiss", $user_id, $sala_id, $mensaje, $nombre_imagen); // Asocia los valores

// Ejecuta la consulta e informa si fue exitoso o no
if ($stmt->execute()) {
    echo "OK"; // Éxito
} else {
    echo "Error: " . $stmt->error; // Muestra error si falla la consulta
}
?>

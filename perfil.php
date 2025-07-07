<?php
session_start(); // Inicia la sesión para acceder a datos del usuario
require 'db.php'; // Conecta con la base de datos

// Verifica que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Si no, redirige a la página de login
    exit;
}

$user_id = $_SESSION['user_id']; // Obtiene el ID del usuario activo

// Prepara la consulta para obtener el nombre de usuario y foto de perfil
$stmt = $conn->prepare("SELECT username, foto_perfil FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id); // Asocia el parámetro de usuario
$stmt->execute(); // Ejecuta la consulta
$result = $stmt->get_result(); // Obtiene el resultado
$usuario = $result->fetch_assoc(); // Extrae los datos del usuario
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perfil de Usuario</title> <!-- Título de la página -->
</head>
<body>
    <!-- Muestra el nombre del usuario con protección contra XSS -->
    <h2>Perfil de <?= htmlspecialchars($usuario['username']) ?></h2>

    <?php if ($usuario['foto_perfil']): ?>
        <!-- Si tiene foto, la muestra -->
        <img src="<?= htmlspecialchars($usuario['foto_perfil']) ?>" width="150" height="150"><br>
    <?php else: ?>
        <!-- Si no tiene foto, muestra un mensaje -->
        <p>No has subido una foto de perfil.</p>
    <?php endif; ?>

    <!-- Formulario para subir foto de perfil -->
    <form action="subir_foto.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="foto" accept="image/*" required> <!-- Input para archivo imagen -->
        <button type="submit">Subir Foto de Perfil</button> <!-- Botón para enviar -->
    </form>

    <!-- Formulario para subir imagen de fondo -->
    <form action="subir_fondo.php" method="POST" enctype="multipart/form-data">
        <label>Sube una imagen de fondo:</label>
        <input type="file" name="fondo"> <!-- Input para imagen de fondo -->
        <button type="submit">Guardar fondo</button> <!-- Botón para enviar -->
    </form>

    <!-- Enlace para volver a la página de inicio -->
    <a href="inicio.php">Volver al inicio</a>
</body>
</html>

<?php
session_start(); // Inicia la sesión para acceder a variables como el ID del usuario
require 'db.php'; // Conexión a la base de datos

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit;
}

// Si se envió el formulario por POST (crear sala)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']); // Obtiene y limpia el nombre de la sala
    $es_privada = isset($_POST['es_privada']) ? 1 : 0; // Verifica si es privada (checkbox)
    // Si es privada, hashea la contraseña, si no, queda en null
    $contrasena = $es_privada ? password_hash($_POST['contrasena'], PASSWORD_DEFAULT) : null;

    // Prepara la consulta para insertar la nueva sala
    $stmt = $conn->prepare("INSERT INTO salas (nombre, es_privada, contrasena, creador_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $nombre, $es_privada, $contrasena, $_SESSION['user_id']); // Asocia valores a la consulta

    if ($stmt->execute()) {
        $_SESSION['sala_id'] = $stmt->insert_id; // Guarda el ID de la nueva sala creada en la sesión
        header("Location: sala.php"); // Redirige a la sala recién creada
        exit;
    } else {
        echo "Error al crear sala: " . $stmt->error; // Muestra error si falla la creación
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Sala</title>
</head>
<body>

<!-- Botón para regresar a la página de inicio -->
<a href="inicio.php" class="button">Volver</a>

<!-- Título del formulario -->
<h2>Crear Sala</h2>

<!-- Formulario para crear una nueva sala -->
<form action="crear_sala.php" method="POST">
    <!-- Campo para el nombre de la sala -->
    <input type="text" name="nombre" required placeholder="Nombre de la sala"><br>

    <!-- Checkbox para hacer la sala privada -->
    <label>
        <input type="checkbox" name="es_privada" id="checkPrivada" onchange="togglePassword()"> Privada
    </label><br>

    <!-- Campo para ingresar la contraseña si es privada -->
    <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña (si es privada)" style="display: none;"><br>

    <!-- Botón para crear la sala -->
    <button type="submit">Crear sala</button>
</form>

<!-- Script para mostrar/ocultar el campo de contraseña al marcar el checkbox -->
<script>
function togglePassword() {
    const checkbox = document.getElementById('checkPrivada'); // Obtiene el checkbox
    const passwordInput = document.getElementById('contrasena'); // Obtiene el campo de contraseña
    passwordInput.style.display = checkbox.checked ? 'block' : 'none'; // Muestra u oculta según el estado del checkbox
}
</script>

</body>
</html>

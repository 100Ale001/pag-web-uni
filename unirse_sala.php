<?php
session_start();
// Iniciamos sesión para acceder a variables de sesión

require 'db.php';
// Incluimos la conexión a la base de datos

// Verificamos que el usuario esté logueado; si no, redirigimos a login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Procesamos el formulario solo si es una petición POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos el id de la sala enviado desde el formulario y lo convertimos a entero
    $sala_id = intval($_POST['sala_id']);

    // Obtenemos la contraseña enviada, o cadena vacía si no se envió
    $contrasena = $_POST['contrasena'] ?? '';

    // Preparamos la consulta para obtener si la sala es privada y su contraseña hasheada
    $stmt = $conn->prepare("SELECT es_privada, contrasena FROM salas WHERE id = ?");
    $stmt->bind_param("i", $sala_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si la sala existe
    if ($row = $result->fetch_assoc()) {
        // Si la sala es privada, verificamos la contraseña con password_verify
        if ($row['es_privada'] && !password_verify($contrasena, $row['contrasena'])) {
            // Si la contraseña no coincide, mostramos mensaje de error y detenemos ejecución
            echo "Contraseña incorrecta.";
            exit;
        }
        // Si todo está bien, guardamos el id de sala en sesión para usar en otras páginas
        $_SESSION['sala_id'] = $sala_id;

        // Redirigimos al usuario a la página principal de la sala
        header("Location: sala.php");
        exit;
    } else {
        // Si no se encontró la sala, mostramos mensaje de error
        echo "Sala no encontrada.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Unirse a Sala</title>
</head>
<body>
<a href="inicio.php" class="button">Volver</a>

<h2>Unirse a una Sala</h2>
<form method="POST">
    <select name="sala_id" required>
        <option value="">Selecciona una sala</option>
        <?php
        // Obtenemos todas las salas de la base de datos para listarlas en el select
        $res = $conn->query("SELECT id, nombre FROM salas");
        while ($sala = $res->fetch_assoc()) {
            // Imprimimos cada sala como opción en el select, escapando caracteres especiales
            echo "<option value='{$sala['id']}'>" . htmlspecialchars($sala['nombre']) . "</option>";
        }
        ?>
    </select><br>

    <!-- Campo para ingresar contraseña, si la sala es privada -->
    <input type="password" name="contrasena" placeholder="Contraseña (si es privada)"><br>

    <button type="submit">Unirse</button>
</form>

<a href="inicio.php">Volver</a>
</body>
</html>

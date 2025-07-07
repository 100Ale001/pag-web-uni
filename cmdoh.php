<?php
// Muestra todos los errores (útil durante el desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php'; // Conexión con la base de datos
session_start(); // Inicia la sesión

// Si se han enviado los datos por POST (login)
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username']; // Usuario ingresado
    $password = $_POST['password']; // Contraseña ingresada

    // Consulta para buscar el usuario en la tabla admin
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username); // Vincula el valor ingresado
    $stmt->execute(); // Ejecuta la consulta
    $result = $stmt->get_result(); // Obtiene los resultados

    if ($result->num_rows === 1) { // Si encontró al usuario
        $admin = $result->fetch_assoc(); // Extrae los datos

        // Verifica si la contraseña ingresada coincide con la almacenada
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['username']; // Guarda el usuario en la sesión
            header("Location: adminicio.php"); // Redirige al panel del administrador
        } else {
            echo "Contraseña incorrecta."; // Mensaje de error
        }
    } else {
        echo "Usuario no encontrado."; // Usuario no existe
    }

    $conn->close(); // Cierra la conexión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>

    <style>
        /* Estilo para el cuerpo del sitio */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Contenedor del formulario */
        .login-container {
            width: 300px;
            margin: 100px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        /* Campos de texto y contraseña */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        /* Botón de enviar */
        button {
            width: 100%;
            padding: 10px;
            background-color: #2c3e50;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

    <!-- Contenedor del formulario de login -->
    <div class="login-container">
        <h2>Login Administrador</h2>
        <!-- El formulario envía los datos al mismo archivo -->
        <form action="" method="POST">
            <label>Usuario:</label>
            <input type="text" name="username" required> <!-- Campo de texto para usuario -->

            <label>Contraseña:</label>
            <input type="password" name="password" required> <!-- Campo de texto para contraseña -->

            <button type="submit">Ingresar</button> <!-- Botón para enviar formulario -->
        </form>
    </div>

</body>
</html>

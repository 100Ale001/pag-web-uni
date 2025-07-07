<?php
session_start(); 
// Inicia la sesión para manejar variables globales como errores o datos de usuario

require 'db.php'; 
// Incluye la conexión a la base de datos para realizar consultas

// Solo procesa si el formulario fue enviado vía POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $username = trim($_POST['username']); 
    // Obtiene el nombre de usuario y elimina espacios al inicio y final

    $password = $_POST['password']; 
    // Obtiene la contraseña ingresada

    $password2 = $_POST['password2']; 
    // Obtiene la confirmación de la contraseña

    // Valida que usuario y contraseña no estén vacíos
    if ($username == '' || $password == '') {
        $error = "Completa todos los campos."; // Mensaje de error si falta algún dato
    } 
    // Valida que las contraseñas coincidan
    elseif ($password !== $password2) {
        $error = "Las contraseñas no coinciden."; // Mensaje de error si no coinciden
    } else {
        // Prepara consulta para buscar si ya existe un usuario con ese nombre
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username); // Asocia el parámetro (string)
        $stmt->execute(); // Ejecuta la consulta
        $stmt->store_result(); // Guarda el resultado para contar filas

        if ($stmt->num_rows > 0) {
            // Si encuentra algún resultado, usuario ya existe
            $error = "El usuario ya existe."; // Mensaje de error
        } else {
            // Si no existe, procede a registrar el usuario nuevo

            // Hashea la contraseña para seguridad
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            // Prepara la consulta para insertar el usuario
            $stmt2 = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
            $stmt2->bind_param("ss", $username, $pass_hash); // Asocia parámetros

            if ($stmt2->execute()) {
                // Si inserta correctamente:
                $_SESSION['user_id'] = $stmt2->insert_id; // Guarda el id del nuevo usuario
                $_SESSION['username'] = $username; // Guarda el nombre de usuario en sesión

                header("Location: login.php"); // Redirige a la página de login
                exit(); // Termina ejecución
            } else {
                // Si falla la inserción:
                $error = "Error al registrar usuario.";
            }
        }
        $stmt->close(); // Cierra la primera consulta para liberar recursos
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Registro</title>
</head>
<body>

<style>
/* Reseteo y caja modelo */
* {
    margin: 0;
    padding: 0;
    box-sizing: box-border;
}

/* Estilos para el cuerpo centrando el formulario y con fondo */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 40px;
    background-image: url(fondo/Classroom.png); /* Fondo de pantalla */
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
}

/* Estilos para el formulario */
form {
    border: 1px solid black;
    border-radius: 10px;
    padding: 5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Título del formulario */
h2 {
    font-size: 20px;
    text-transform: uppercase;
    letter-spacing: 3px;
    color: white;
}

/* Etiquetas con margen y color blanco */
label {
    margin-top: 10px;
    color: white;
}

/* Inputs estilizados */
input {
    border: 1px solid black;
    border-radius: 10px;
    padding: 13px;
    width: 400px;
}

/* Botón con estilo */
button {
    margin: 10px;
    padding: 10px;
    font-size: 18px;
    background-color: rgba(0,0,0,0.2);
    border: 0.4px solid black;
    border-radius: 10px;
    color: white;
}

/* Párrafos en blanco */
p {
    color: white;
}

/* Enlaces en blanco */
a {
    color: white;
}
</style>

<!-- Muestra el mensaje de error si está definido -->
<?php if (isset($error)): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<!-- Formulario de registro -->
<form method="POST" action="">
    <h2>Registro</h2>

    <!-- Campo para usuario -->
    <label>Usuario:<br><input type="text" name="username" required></label><br>

    <!-- Campo para contraseña -->
    <label>Contraseña:<br><input type="password" name="password" required></label><br>

    <!-- Campo para confirmar contraseña -->
    <label>Repetir Contraseña:<br><input type="password" name="password2" required></label><br><br>

    <!-- Botón para enviar el formulario -->
    <button type="submit">Registrar</button>

    <!-- Link a la página de login -->
    <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
</form>

</body>
</html>

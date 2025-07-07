<?php
session_start(); // Inicia la sesión para usar variables de sesión
if (!isset($_SESSION['admin'])) { // Verifica si el administrador ha iniciado sesión
    header("Location: login.html"); // Redirige al login si no está autenticado
    exit(); // Termina el script
}

require_once 'db.php'; // Conecta con la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres -->
    <title>Panel de Administrador</title> <!-- Título de la página -->
    <style>
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        li {
            list-style: none;
            font-size: 14px;
            margin: 5px 0;
        }

        ul {
            padding: 0;
        }

        a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }

        a:hover {
            background-color: #f0f0f0;
        }

        article {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            padding: 20px;
        }

        .seccion {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
        }

        button {
            padding: 5px 10px;
            margin-left: 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor:pointer;
        }

        h1, h2 {
            margin: 0;
        }
    </style>
</head>
<body>

<!-- Encabezado con nombre de admin y botón de cierre de sesión -->
<header>
    <ul>
        <li><h1>Bienvenido, <?php echo $_SESSION['admin']; ?></h1></li> <!-- Muestra el nombre del administrador -->
        <li><a href="logout.php">Cerrar sesión</a></li> <!-- Enlace para cerrar sesión -->
    </ul>
</header>

<section>
<article>
  <!-- Sección de Salas -->
  <div class="seccion">
    <h2>Salas Creadas</h2>
    <ul>
    <?php
    // Consulta para obtener todas las salas y sus creadores
    $result = mysqli_query($conn, "
        SELECT salas.id, salas.nombre, usuarios.username AS creador
        FROM salas
        JOIN usuarios ON salas.creador_id = usuarios.id
    ");
    // Recorre cada sala encontrada
    while ($sala = mysqli_fetch_assoc($result)) {
        // Cada iteración imprime:
        // - un enlace a la sala
        // - el nombre de la sala
        // - el nombre del creador
        // - un formulario con botón para eliminar la sala
        echo "<li>
            <a href='sala.php?id={$sala['id']}'> <!-- Enlace que lleva a la sala usando su ID -->
                Sala: {$sala['nombre']} (Creador: {$sala['creador']}) <!-- Información de la sala -->
            </a>
            <form method='POST' action='eliminar_sala.php' style='display:inline'> <!-- Formulario para eliminar -->
                <input type='hidden' name='id' value='{$sala['id']}'> <!-- ID oculto para enviar por POST -->
                <button type='submit'>Eliminar</button> <!-- Botón rojo para eliminar sala -->
            </form>
        </li>";
    }
    ?>
    </ul>
  </div>

  <!-- Sección de Usuarios -->
  <div class="seccion">
    <h2>Usuarios Registrados</h2>
    <ul>
    <?php
    // Consulta todos los usuarios de la tabla 'usuarios'
    $usuarios = mysqli_query($conn, "SELECT * FROM usuarios");
    // Recorre cada usuario encontrado
    while ($usuario = mysqli_fetch_assoc($usuarios)) {
        // En cada iteración imprime:
        // - el nombre del usuario
        // - un formulario para eliminar ese usuario
        echo "<li>
            Usuario: {$usuario['username']} <!-- Nombre del usuario registrado -->
            <form method='POST' action='eliminar_usuario.php' style='display:inline'> <!-- Formulario para eliminar -->
                <input type='hidden' name='id' value='{$usuario['id']}'> <!-- ID del usuario como campo oculto -->
                <button type='submit'>Eliminar</button> <!-- Botón rojo para eliminar usuario -->
            </form>
        </li>";
    }
    ?>
    </ul>
  </div>
</article>
</section>

</body>
</html>

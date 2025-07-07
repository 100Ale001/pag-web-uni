<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Selección de Sala</title>
    <style>
        body { 
        font-family: Arial, sans-serif; 
        text-align: center; 
        padding: 50px;
         }
        h1 {
         margin-bottom: 30px; 
         }
        a.button {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
        }
        a.button:hover {
            background-color: #0056b3;
        }

        header{
            display:flex;
            align-items:center;
            justify-content:center;
            padding:0;
            margin:0;
        }

        h1{
            position:absolute;
            left:1%;
            top:-1%;
        }


    </style>
</head>
<body>
    <header>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['username'] ?? 'Usuario') ?></h1>
    </header>

    <section>
    <br><br><a href="crear_sala.php" class="button">Crear Sala</a>
    <a href="unirse_sala.php" class="button">Unirse a Sala</a><br>
    <a href="logout.php" style="color:red;">Cerrar sesión</a>
        <br><br>

    <a href="perfil.php" style="color:red;">Perfil</a>
    </section>

</body>
</html>

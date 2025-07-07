<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hash);

    if ($stmt->num_rows == 1) {
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: inicio.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Login</title>
</head>
<body>


<style>

*{
    margin:0;
    padding:0;
    box-sizing:box-border;
}


body{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    background-image:url(fondo/Classroom.png);
    background-repeat:no-repeat;
    background-size:cover;
    background-attachment:fixed;
}

.letras{
    font-size:32px;
    text-transform:uppercase;
    padding:2rem;
    letter-spacing:3px;
    color:white;
}

form{
    border: 1px solid black;
    background-color:transparent;
    border-radius:10px;
    width:500px;
    height:400px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    padding:4px;
    margin:100px;
}

label{
    font-size:20px;
    margin:0.5rem;
    color:white;
}

input{
    border-radius:10px;
    width:400px;
    height:30px;
    margin-top:10px;
    border-style:none;
    padding:4px;

}

button{
margin:10px;
padding:10px;
background-color:rgb(0,0,0,0.2);
border-radius:10px;
width:100px;
color:white;
boder:0.4px solid black;
}

p{
color:white;
}

a{
color:white;
}
</style>




<?php if (isset($error)): ?>
<p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="">
<h2 class="letras">Iniciar sesión</h2>
    <label>Usuario:<br><input type="text" name="username" required></label><br>
    <label>Contraseña:<br><input type="password" name="password" required></label><br><br>
    <button type="submit">Entrar</button>
<p id="asd" >¿No tienes cuenta? <a id="qwe"   href="registro.php"   >Registrarse</a></p>
</form>




</body>
</html>

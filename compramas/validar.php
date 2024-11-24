<?php
session_start();
require_once('conexion.php'); 
if (isset($_POST['login'])) {
    $usuario = trim($_POST['username']); 
    $pw = trim($_POST['password']);
    try {
        $query = $conexion->prepare("SELECT * FROM usuarios WHERE nombre = :username");
        $query->bindParam(':username', $usuario, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($pw, $user['contraseña'])) {
            $_SESSION['username'] = $user['nombre'];
            echo '<script>alert("Usuario correcto"); </script>';
            echo '<script>window.location="panel.php";</script>';
            exit();
        } else {
            echo '<script>alert("Usuario o contraseña incorrectos."); </script>';
            echo '<script>window.location="iniciar.php";</script>';
            exit();
        }
    } catch (PDOException $e) {
        echo '<script>alert("Error al validar el usuario: ' . $e->getMessage() . '"); </script>';
        echo '<script>window.location="iniciar.php";</script>';
        exit();
    }
}
if (isset($_POST['terminar'])) {
    // Redirigir al formulario de inicio
    echo '<script>window.location="iniciar.php";</script>';
    exit();
}
?>
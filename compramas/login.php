<?php
session_start();
require_once 'conexion.php'; 
if (isset($_SESSION['username'])) {
    echo '<script>window.location="panel.php";</script>';
    exit();
}
$error = '';
if (isset($_POST['login'])) {
    $usuario = trim($_POST['username']);
    $password = trim($_POST['password']);
    try {
        $query = $conexion->prepare("SELECT * FROM usuarios WHERE nombre = :username");
        $query->bindParam(':username', $usuario, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['contraseña'])) {
            $_SESSION['username'] = $user['nombre'];
            echo '<script>window.location="panel.php";</script>';
            exit();
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
    } catch (PDOException $e) {
        $error = 'Error al procesar la solicitud: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Iniciar Sesión</h1>
        <?php if ($error): ?>
            <p class="text-red-500 text-center mb-4"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST" class="space-y-6">
            <div>
                <label for="username" class="block text-gray-700 font-medium mb-2">Nombre de usuario:</label>
                <input type="text" id="username" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">Contraseña:</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                Ingresar
            </button>
        </form>
    </div>
</body>
</html>
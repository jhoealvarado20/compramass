<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$sql = "SELECT * FROM zapatillas";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$zapatillas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = 1;
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
    } else {
        $stmt = $conexion->prepare("SELECT * FROM zapatillas WHERE id = :id");
        $stmt->execute(['id' => $producto_id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($producto) {
            $_SESSION['carrito'][$producto_id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad,
            ];
        }
    }
    $_SESSION['mensaje'] = "El producto con ID $producto_id se ha añadido a la compra.";
}
if (isset($_SESSION['mensaje'])) {
    echo "<div class='bg-green-100 text-green-700 p-2 rounded-md mb-4'>";
    echo htmlspecialchars($_SESSION['mensaje']);
    echo "</div>";
    unset($_SESSION['mensaje']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Zapatillas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto mt-10 px-6">
        <div class="mt-6 text-right mb-6"">
            <a href="logout.php" class="px-6 py-2 bg-red-600 hover:bg-blue-700 text-white rounded-full font-semibold transition-colors shadow-lg hover:shadow-xl">
                Cerrar Sesión
            </a>
        </div>
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">Lista de Zapatillas</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($zapatillas as $zapatilla): ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="<?= htmlspecialchars($zapatilla['foto']) ?>" alt="<?= htmlspecialchars($zapatilla['nombre']) ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($zapatilla['nombre']) ?></h2>
                        <p class="text-gray-600"><?= htmlspecialchars($zapatilla['descripcion']) ?></p>
                        <p class="mt-2 text-gray-800 font-bold"><?= htmlspecialchars($zapatilla['precio']) ?> USD</p>
                        <form method="post" class="mt-4">
                            <button type="submit" name="producto_id" value="<?= $zapatilla['id'] ?>" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 w-full">
                                Añadir a la compra
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-6 text-right">
            <a href="carrito.php" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-semibold transition-colors shadow-lg hover:shadow-xl">
                Ver carrito
            </a>
        </div>
    </div>
</body>
</html>
<?php
session_start();
require_once 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comprar'])) {
    header('Location: boleta.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto mt-10 px-6">
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">Carrito de Compras</h1>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <ul class="divide-y divide-gray-200">
                <?php
                $total = 0;
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $producto_id => $detalle) {
                        $stmt = $conexion->prepare("SELECT * FROM zapatillas WHERE id = :id");
                        $stmt->execute(['id' => $producto_id]);
                        $producto = $stmt->fetch();
                        $subtotal = $producto['precio'] * $detalle['cantidad'];
                        $total += $subtotal;
                        echo "
                            <li class='flex flex-col sm:flex-row justify-between items-center py-4'>
                                <div class='flex-1'>
                                    <h2 class='text-lg font-medium text-gray-800'>" . htmlspecialchars($producto['nombre']) . "</h2>
                                    <p class='text-sm text-gray-600'>Precio: {$producto['precio']} USD</p>
                                    <p class='text-sm text-gray-600'>Cantidad: {$detalle['cantidad']}</p>
                                </div>
                                <div class='text-right mt-4 sm:mt-0'>
                                    <p class='text-sm text-gray-600'>Subtotal:</p>
                                    <p class='text-lg font-semibold text-gray-800'>{$subtotal} USD</p>
                                </div>
                            </li>
                        ";
                    }
                } else {
                    echo "<li class='text-center py-4 text-gray-600'>No hay productos en el carrito.</li>";
                }
                ?>
            </ul>
        </div>
        <div class="mt-6 bg-white shadow-lg rounded-lg p-6 text-center">
            <p class="text-lg font-semibold text-gray-800">Total: <?= $total ?> USD</p>
            <div class="mt-4 flex flex-col sm:flex-row justify-center gap-4">
                <form method="post">
                    <button type="submit" name="comprar" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 transition duration-300 w-full sm:w-auto">
                        Comprar
                    </button>
                </form>
                <a href="panel.php" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 w-full sm:w-auto">
                    Seguir comprando
                </a>
            </div>
        </div>
    </div>
</body>
</html>
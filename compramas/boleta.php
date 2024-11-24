<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Compra</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto mt-10 px-6">
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">Boleta de Compra</h1>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800">Productos comprados:</h2>
            <ul class="divide-y divide-gray-200 mt-4">
                <?php
                $total = 0;
                if (!empty($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $item) {
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                        echo "
                            <li class='flex flex-col sm:flex-row justify-between py-4'>
                                <div class='flex-1'>
                                    <h3 class='text-lg text-gray-800'>" . htmlspecialchars($item['nombre']) . "</h3>
                                    <p class='text-sm text-gray-600'>Cantidad: {$item['cantidad']}</p>
                                    <p class='text-sm text-gray-600'>Precio unitario: {$item['precio']} USD</p>
                                </div>
                                <div class='text-right sm:text-left mt-4 sm:mt-0'>
                                    <p class='text-lg text-gray-800'>Subtotal: {$subtotal} USD</p>
                                </div>
                            </li>
                        ";
                    }
                } else {
                    echo "<p class='text-gray-600'>No hay productos en el carrito.</p>";
                }
                ?>
            </ul>
            <hr class="my-4">
            <p class="text-lg font-semibold text-gray-800 text-right">Total: <?= $total ?> USD</p>
        </div>
        <div class="mt-6 flex flex-col sm:flex-row justify-center gap-4">
            <a href="panel.php" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300 w-full sm:w-auto">
                Volver al Panel
            </a>
            <button onclick="window.print()" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 transition duration-300 w-full sm:w-auto">
                Descargar Boleta
            </button>
        </div>
    </div>
</body>
</html>
<?php
session_start();
if ($_SESSION['rol'] != 'padre') {
    header("Location: dashboard.php");
    exit();
}

// Aquí deberías obtener la lista de hijos asociados al padre
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Mis Hijos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Mis Hijos</h1>
        <!-- Código para listar los hijos del padre -->
    </div>
</body>
</html>
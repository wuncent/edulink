<?php
session_start();
if ($_SESSION['rol'] != 'administrativo') {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Lista de Procesos Administrativos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Lista de Procesos Administrativos</h1>
        <!-- Código para listar posibles procesos administrativos -->
    </div>
</body>
</html>
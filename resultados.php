<?php
session_start();
if ($_SESSION['rol'] != 'alumno' && $_SESSION['rol'] != 'padre') {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Resultados</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Resultados</h1>
        <!-- Código para listar los resultados del alumno -->
    </div>
</body>
</html>
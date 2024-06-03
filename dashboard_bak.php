<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Panel de Control</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">EduLink</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if ($rol == 'administrador') { ?>
                    <li class="nav-item"><a class="nav-link" href="#">Gestión de Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Administrar Cursos</a></li>
                <?php } elseif ($rol == 'administrativo') { ?>
                    <li class="nav-item"><a class="nav-link" href="#">Procesos Administrativos</a></li>
                <?php } elseif ($rol == 'profesor') { ?>
                    <li class="nav-item"><a class="nav-link" href="#">Mis Clases</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Calificaciones</a></li>
                <?php } elseif ($rol == 'alumno') { ?>
                    <li class="nav-item"><a class="nav-link" href="#">Mis Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Resultados</a></li>
                <?php } elseif ($rol == 'padre') { ?>
                    <li class="nav-item"><a class="nav-link" href="#">Progreso de mi Hijo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Comunicación con Profesores</a></li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Bienvenido, <?php echo $usuario; ?></h1>
        <p>Panel de control - Rol: <?php echo $rol; ?></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
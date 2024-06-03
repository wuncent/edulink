<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';
    $usuario = $_SESSION['usuario'];
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = password_hash($_POST['nueva_contrasena'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM Usuarios WHERE nombre_usuario = '$usuario'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($contrasena_actual, $user['contrasena'])) {
            $update_query = "UPDATE Usuarios SET contrasena = '$nueva_contrasena' WHERE nombre_usuario = '$usuario'";
            if ($conn->query($update_query) === TRUE) {
                echo "Contraseña cambiada con éxito.";
            } else {
                echo "Error al cambiar la contraseña.";
            }
        } else {
            echo "Contraseña actual incorrecta.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Cambiar Contraseña</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Cambiar Contraseña</h1>
        <form action="cambiar_contrasena.php" method="POST">
            <div class="form-group">
                <label for="contrasena_actual">Contraseña Actual</label>
                <input type="password" name="contrasena_actual" id="contrasena_actual" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nueva_contrasena">Nueva Contraseña</label>
                <input type="password" name="nueva_contrasena" id="nueva_contrasena" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
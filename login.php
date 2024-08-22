<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT id_empleado FROM Empleados WHERE correo = '$correo' AND password = '$password'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['id_empleado'] = $resultado->fetch_assoc()['id_empleado'];
        header("Location: index.php");
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h1>Inicio de Sesión de Empleados</h1>
    <form method="post" action="login.php">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>

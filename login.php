<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    // Consultar el empleado por correo
    $sql = "SELECT id_empleado, nombre, password FROM Empleados WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $empleado = $resultado->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $empleado['password'])) {
            // Inicio de sesión exitoso
            $_SESSION["loggedin"] = true;
            $_SESSION["id_empleado"] = $empleado["id_empleado"];
            $_SESSION["nombre"] = $empleado["nombre"];
            header("Location: index.php"); // Redirigir a la página principal
            exit();
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="login.php">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>

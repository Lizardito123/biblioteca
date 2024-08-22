<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $fecha_contratacion = $_POST["fecha_contratacion"];

    $sql = "INSERT INTO Empleados (nombre, correo, telefono, fecha_contratacion)
            VALUES ('$nombre', '$correo', '$telefono', '$fecha_contratacion')";

    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo empleado registrado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
</head>
<body>
    <h1>Registrar Empleado</h1>
    <form method="post" action="empleados.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono"><br>

        <label for="fecha_contratacion">Fecha de Contratación:</label>
        <input type="date" id="fecha_contratacion" name="fecha_contratacion" required><br>

        <input type="submit" value="Registrar Empleado">
    </form>
</body>
</html>

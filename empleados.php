<?php include('header.php'); ?>
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
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encriptar la contraseña

    $sql = "INSERT INTO Empleados (nombre, correo, telefono, fecha_contratacion, password)
            VALUES ('$nombre', '$correo', '$telefono', '$fecha_contratacion', '$password')";

    if ($conexion->query($sql) === TRUE) {
        echo "Empleado registrado con éxito.";
    } else {
        echo "Error: " . $conexion->error;
    }
}

// Obtener la lista de empleados
$sql_empleados = "SELECT id_empleado, nombre, correo, telefono, fecha_contratacion FROM Empleados";
$resultado_empleados = $conexion->query($sql_empleados);
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

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Registrar Empleado">
    </form>

    <h2>Lista de Empleados</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Fecha de Contratación</th>
        </tr>
        <?php
        if ($resultado_empleados->num_rows > 0) {
            while ($fila = $resultado_empleados->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id_empleado"] . "</td>";
                echo "<td>" . $fila["nombre"] . "</td>";
                echo "<td>" . $fila["correo"] . "</td>";
                echo "<td>" . $fila["telefono"] . "</td>";
                echo "<td>" . $fila["fecha_contratacion"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay empleados registrados.</td></tr>";
        }
        ?>
    </table>
</body>
</html>


<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    $sql = "INSERT INTO Clientes (nombre, correo, telefono)
            VALUES ('$nombre', '$correo', '$telefono')";

    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo cliente registrado con éxito";
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
    <title>Gestión de Clientes</title>
</head>
<body>
    <h1>Registrar Cliente</h1>
    <form method="post" action="clientes.php">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono"><br>

        <input type="submit" value="Registrar Cliente">
    </form>

    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>ID Cliente</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
        </tr>
        <?php
        $sql = "SELECT * FROM Clientes";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr><td>" . $fila["id_cliente"] . "</td><td>" . $fila["nombre"] . "</td><td>" . $fila["correo"] . "</td><td>" . $fila["telefono"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay clientes registrados</td></tr>";
        }
        ?>
    </table>
</body>
</html>

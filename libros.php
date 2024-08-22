<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $cantidad_disponible = $_POST["cantidad_disponible"];

    $sql = "INSERT INTO Libros (titulo, autor, cantidad_disponible)
            VALUES ('$titulo', '$autor', '$cantidad_disponible')";

    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo libro registrado con éxito";
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
    <title>Gestión de Libros</title>
</head>
<body>
    <h1>Registrar Libro</h1>
    <form method="post" action="libros.php">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>

        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required><br>

        <label for="cantidad_disponible">Cantidad Disponible:</label>
        <input type="number" id="cantidad_disponible" name="cantidad_disponible" required><br>

        <input type="submit" value="Registrar Libro">
    </form>

    <h2>Lista de Libros</h2>
    <table border="1">
        <tr>
            <th>ID Libro</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Cantidad Disponible</th>
        </tr>
        <?php
        $sql = "SELECT * FROM Libros";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr><td>" . $fila["id_libro"] . "</td><td>" . $fila["titulo"] . "</td><td>" . $fila["autor"] . "</td><td>" . $fila["cantidad_disponible"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay libros registrados</td></tr>";
        }
        ?>
    </table>
</body>
</html>


<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST["id_cliente"];
    $id_libro = $_POST["id_libro"];
    $cantidad_prestamo = isset($_POST["cantidad_prestamo"]) ? (int)$_POST["cantidad_prestamo"] : 0;  // Asegurarse de que la cantidad esté definida y sea un número entero.
    $fecha_prestamo = date("Y-m-d");

    // Verificar disponibilidad del libro
    $sql_libro = "SELECT cantidad_disponible FROM Libros WHERE id_libro = $id_libro";
    $resultado = $conexion->query($sql_libro);
    $libro = $resultado->fetch_assoc();

    if ($libro['cantidad_disponible'] >= $cantidad_prestamo && $cantidad_prestamo > 0) {
        // Registrar préstamo
        $sql_prestamo = "INSERT INTO Prestamos (id_cliente, id_libro, fecha_prestamo)
                         VALUES ('$id_cliente', '$id_libro', '$fecha_prestamo')";
        
        // Actualizar la cantidad de libros disponibles
        $sql_actualizar_libro = "UPDATE Libros 
                                 SET cantidad_disponible = cantidad_disponible - $cantidad_prestamo 
                                 WHERE id_libro = $id_libro";

        if ($conexion->query($sql_prestamo) === TRUE && $conexion->query($sql_actualizar_libro) === TRUE) {
            echo "Préstamo registrado con éxito.";
        } else {
            echo "Error: " . $conexion->error;
        }
    } else {
        echo "Lo siento, no hay suficientes copias disponibles de este libro o la cantidad solicitada es inválida.";
    }
}

// Obtener la lista de clientes
$sql_clientes = "SELECT id_cliente, nombre FROM Clientes";
$resultado_clientes = $conexion->query($sql_clientes);

// Obtener la lista de libros
$sql_libros = "SELECT id_libro, titulo FROM Libros";
$resultado_libros = $conexion->query($sql_libros);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Préstamos</title>
</head>
<body>
    <h1>Registrar Préstamo</h1>
    <form method="post" action="prestamos.php">
        <label for="id_cliente">Cliente:</label>
        <select id="id_cliente" name="id_cliente" required>
            <option value="">Seleccione un cliente</option>
            <?php
            if ($resultado_clientes->num_rows > 0) {
                while ($fila = $resultado_clientes->fetch_assoc()) {
                    echo "<option value='" . $fila["id_cliente"] . "'>" . $fila["nombre"] . "</option>";
                }
            }
            ?>
        </select><br>

        <label for="id_libro">Libro:</label>
        <select id="id_libro" name="id_libro" required>
            <option value="">Seleccione un libro</option>
            <?php
            if ($resultado_libros->num_rows > 0) {
                while ($fila = $resultado_libros->fetch_assoc()) {
                    echo "<option value='" . $fila["id_libro"] . "'>" . $fila["titulo"] . "</option>";
                }
            }
            ?>
        </select><br>

        <label for="cantidad_prestamo">Cantidad a Prestar:</label>
        <input type="number" id="cantidad_prestamo" name="cantidad_prestamo" min="1" required><br>

        <input type="submit" value="Registrar Préstamo">
    </form>
</body>
</html>

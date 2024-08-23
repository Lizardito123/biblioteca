<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $conexion->real_escape_string($_POST["id_cliente"]);
    $id_libro = $conexion->real_escape_string($_POST["id_libro"]);
    $cantidad_prestamo = isset($_POST["cantidad_prestamo"]) ? (int)$_POST["cantidad_prestamo"] : 0;
    $fecha_prestamo = $conexion->real_escape_string($_POST["fecha_prestamo"]);
    $fecha_devolucion = $conexion->real_escape_string($_POST["fecha_devolucion"]);

    // Verificar disponibilidad del libro
    $sql_libro = "SELECT cantidad_disponible FROM Libros WHERE id_libro = $id_libro";
    $resultado = $conexion->query($sql_libro);
    $libro = $resultado->fetch_assoc();

    if ($libro) {
        if ($libro['cantidad_disponible'] >= $cantidad_prestamo && $cantidad_prestamo > 0) {
            // Registrar préstamo
            $sql_prestamo = "INSERT INTO Prestamos (id_cliente, id_libro, cantidad_prestamo, fecha_prestamo, fecha_devolucion)
                             VALUES ('$id_cliente', '$id_libro', '$cantidad_prestamo', '$fecha_prestamo', '$fecha_devolucion')";
            
            // Actualizar la cantidad de libros disponibles
            $sql_actualizar_libro = "UPDATE Libros 
                                     SET cantidad_disponible = cantidad_disponible - $cantidad_prestamo 
                                     WHERE id_libro = $id_libro";

            if ($conexion->query($sql_prestamo) === TRUE && $conexion->query($sql_actualizar_libro) === TRUE) {
                echo "<div class='alert alert-success'>Préstamo registrado con éxito.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conexion->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Lo siento, no hay suficientes copias disponibles de este libro o la cantidad solicitada es inválida.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: El libro seleccionado no existe.</div>";
    }
}

// Obtener la lista de clientes
$sql_clientes = "SELECT id_cliente, nombre FROM Clientes";
$resultado_clientes = $conexion->query($sql_clientes);

// Obtener la lista de libros
$sql_libros = "SELECT id_libro, titulo FROM Libros";
$resultado_libros = $conexion->query($sql_libros);
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Préstamo</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="B1">

    <center>

        <div id="B2" class="card col-sm-4" style="margin-top: 7%;">

            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Registrar Préstamo</b></p>

                <!-- Mostrar mensajes de error o éxito -->
                <?php if (isset($mensaje)) { echo $mensaje; } ?>

                <form method="post" action="prestamos.php">
                    <div class="mb-3">
                        <label for="id_cliente" class="form-label">Cliente:</label>
                        <select id="id_cliente" name="id_cliente" class="form-select" required>
                            <option value="">Seleccione un cliente</option>
                            <?php
                            if ($resultado_clientes->num_rows > 0) {
                                while ($fila = $resultado_clientes->fetch_assoc()) {
                                    echo "<option value='" . $fila["id_cliente"] . "'>" . $fila["nombre"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_libro" class="form-label">Libro:</label>
                        <select id="id_libro" name="id_libro" class="form-select" required>
                            <option value="">Seleccione un libro</option>
                            <?php
                            if ($resultado_libros->num_rows > 0) {
                                while ($fila = $resultado_libros->fetch_assoc()) {
                                    echo "<option value='" . $fila["id_libro"] . "'>" . $fila["titulo"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad_prestamo" class="form-label">Cantidad a Prestar:</label>
                        <input type="number" id="cantidad_prestamo" name="cantidad_prestamo" class="form-control" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_prestamo" class="form-label">Fecha de Préstamo:</label>
                        <input type="date" id="fecha_prestamo" name="fecha_prestamo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_devolucion" class="form-label">Fecha de Devolución:</label>
                        <input type="date" id="fecha_devolucion" name="fecha_devolucion" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Préstamo</button>
                </form>
                <form action="index.php">
                    <div class="col-6">
                        <br><button type="submit" class="btn btn-secondary btn-block"> <- Volver</button>
                        <br>
                    </div>
                </form>
            </div>

        </div>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

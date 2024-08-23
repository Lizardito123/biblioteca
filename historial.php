<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el historial de préstamos
$sql_historial = "SELECT Clientes.nombre AS nombre_cliente, Libros.titulo AS nombre_libro, 
                  Prestamos.cantidad_prestamo, Prestamos.fecha_prestamo, Prestamos.fecha_devolucion 
                  FROM Prestamos 
                  JOIN Clientes ON Prestamos.id_cliente = Clientes.id_cliente 
                  JOIN Libros ON Prestamos.id_libro = Libros.id_libro 
                  ORDER BY Prestamos.fecha_prestamo DESC";

$resultado_historial = $conexion->query($sql_historial);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Préstamos</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body id="B1">
    <center>
        <div class="card col-sm-8" style="margin-top: 7%;">
            <div class="card-body">
                <h3 class="card-title">Historial de Préstamos</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Libro</th>
                            <th>Cantidad</th>
                            <th>Fecha de Préstamo</th>
                            <th>Fecha de Devolución</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultado_historial->num_rows > 0) {
                            while ($fila = $resultado_historial->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$fila['nombre_cliente']}</td>
                                    <td>{$fila['nombre_libro']}</td>
                                    <td>{$fila['cantidad_prestamo']}</td>
                                    <td>{$fila['fecha_prestamo']}</td>
                                    <td>{$fila['fecha_devolucion']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay registros de préstamos.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form action="login.php">
                    <div class="col-6">
                        <br><button type="submit" class="btn btn-secondary btn-block"> <- Volver</button><br>
                    </div>
                </form>
            </div>
        </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

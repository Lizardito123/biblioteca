<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Manejar eliminación de libro
if (isset($_GET['eliminar'])) {
    $id_libro = $conexion->real_escape_string($_GET['eliminar']);
    $sql_eliminar = "DELETE FROM Libros WHERE id_libro = $id_libro";

    if ($conexion->query($sql_eliminar) === TRUE) {
        echo "<div class='alert alert-success'>Libro eliminado con éxito.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar libro: " . $conexion->error . "</div>";
    }
}

// Obtener la lista de libros
$sql_libros = "SELECT * FROM Libros";
$resultado_libros = $conexion->query($sql_libros);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body id="B1">
    <center>
        <div class="card col-sm-8" style="margin-top: 7%;">
            <div class="card-body">
                <h3 class="card-title">Gestión de Libros</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Libro</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Cantidad Disponible</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultado_libros->num_rows > 0) {
                            while ($fila = $resultado_libros->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$fila['id_libro']}</td>
                                    <td>{$fila['titulo']}</td>
                                    <td>{$fila['autor']}</td>
                                    <td>{$fila['cantidad_disponible']}</td>
                                    <td>
                                        <a href='editarL.php?id_libro={$fila['id_libro']}' class='btn btn-warning'>Editar</a>
                                        <a href='libros.php?eliminar={$fila['id_libro']}' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este libro?\");'>Eliminar</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay libros registrados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <form action="index.php">
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

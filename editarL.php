<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener detalles del libro para edición
$libro = null; // Inicializar la variable
if (isset($_GET['id_libro'])) {
    $id_libro = $conexion->real_escape_string($_GET['id_libro']);
    $sql_libro = "SELECT * FROM Libros WHERE id_libro = $id_libro";
    $resultado_libro = $conexion->query($sql_libro);

    if ($resultado_libro->num_rows == 1) {
        $libro = $resultado_libro->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Libro no encontrado.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>ID de libro no proporcionado.</div>";
    exit();
}


?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body id="B1">
    <center>
        <div class="card col-sm-4" style="margin-top: 7%;">
            <div class="card-body login-card-body">
                <h3 class="card-title">Editar Libro</h3>
                <form method="post" action="uno.php">
                    <input type="hidden" name="id_libro" value="<?php echo $libro['id_libro']; ?>">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo isset($libro['titulo']) ? $libro['titulo'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor:</label>
                        <input type="text" id="autor" name="autor" class="form-control" value="<?php echo isset($libro['autor']) ? $libro['autor'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad_disponible" class="form-label">Cantidad Disponible:</label>
                        <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="form-control" value="<?php echo isset($libro['cantidad_disponible']) ? $libro['cantidad_disponible'] : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Libro</button>
                </form>
                <form action="libros.php">
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

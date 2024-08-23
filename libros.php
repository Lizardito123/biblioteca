<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $conexion->real_escape_string($_POST["titulo"]);
    $autor = $conexion->real_escape_string($_POST["autor"]);
    $cantidad_disponible = $conexion->real_escape_string($_POST["cantidad_disponible"]);

    // Insertar el nuevo libro
    $sql = "INSERT INTO Libros (titulo, autor, cantidad_disponible)
            VALUES ('$titulo', '$autor', '$cantidad_disponible')";

    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo libro registrado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Libro</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="B1">

    <center>

        <div id="B2" class="card col-sm-4" style="margin-top: 7%;">

            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Registrar Libro</b></p>
                <form method="post" action="libros.php">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>

                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor:</label>
                        <input type="text" class="form-control" id="autor" name="autor" required>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad_disponible" class="form-label">Cantidad Disponible:</label>
                        <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Libro</button>
                </form>
                <form action="login.php">
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

    <div class="container mt-5">
        <h2>Lista de Libros</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Libro</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Cantidad Disponible</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $conexion->real_escape_string($_POST["nombre"]);
    $correo = $conexion->real_escape_string($_POST["correo"]);
    $telefono = $conexion->real_escape_string($_POST["telefono"]);

    // Insertar el nuevo cliente
    $sql = "INSERT INTO Clientes (nombre, correo, telefono)
            VALUES ('$nombre', '$correo', '$telefono')";

    if ($conexion->query($sql) === TRUE) {
        echo "Nuevo cliente registrado con éxito";
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
    <title>Registrar Cliente</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="B1">

    <center>

        <div id="B2" class="card col-sm-4" style="margin-top: 7%;">

            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Registrar Cliente</b></p>
                <form method="post" action="clientes.php">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Cliente</button>
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

    <div class="container mt-5">
        <h2>Lista de Clientes</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
</body>

</html>

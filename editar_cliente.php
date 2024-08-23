<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Inicializar la variable $cliente para evitar errores
$cliente = null;

// Obtener detalles del cliente para edición
if (isset($_GET['id_cliente'])) {
    $id_cliente = $conexion->real_escape_string($_GET['id_cliente']);
    $sql_cliente = "SELECT * FROM Clientes WHERE id_cliente = $id_cliente";
    $resultado_cliente = $conexion->query($sql_cliente);

    if ($resultado_cliente->num_rows == 1) {
        $cliente = $resultado_cliente->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Cliente no encontrado.</div>";
        exit();
    }
}

// Manejar actualización del cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $conexion->real_escape_string($_POST["id_cliente"]);
    $nombre = $conexion->real_escape_string($_POST["nombre"]);
    $email = $conexion->real_escape_string($_POST["correo"]);
    $telefono = $conexion->real_escape_string($_POST["telefono"]);

    $sql_actualizar = "UPDATE Clientes SET nombre='$nombre', correo='$email', telefono='$telefono' WHERE id_cliente=$id_cliente";

    if ($conexion->query($sql_actualizar) === TRUE) {
        echo "<div class='alert alert-success'>Cliente actualizado con éxito.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar cliente: " . $conexion->error . "</div>";
    }

    // Actualizar la variable $cliente para que refleje los cambios recientes
    $sql_cliente = "SELECT * FROM Clientes WHERE id_cliente = $id_cliente";
    $resultado_cliente = $conexion->query($sql_cliente);
    if ($resultado_cliente->num_rows == 1) {
        $cliente = $resultado_cliente->fetch_assoc();
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body id="B1">
    <center>
        <div class="card col-sm-4" style="margin-top: 7%;">
            <div class="card-body login-card-body">
                <h3 class="card-title">Editar Cliente</h3>

                <?php if ($cliente): ?>
                <form method="post" action="editar_cliente.php?id_cliente=<?php echo $cliente['id_cliente']; ?>">
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="correo" class="form-control" value="<?php echo htmlspecialchars($cliente['correo']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                </form>
                <?php else: ?>
                    <div class="alert alert-danger">Cliente no encontrado.</div>
                <?php endif; ?>

                <form action="editar.php">
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

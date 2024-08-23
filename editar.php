<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Manejar eliminación de cliente
if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
    $id_cliente = $conexion->real_escape_string($_GET['eliminar']);
    $sql_eliminar = "DELETE FROM Clientes WHERE id_cliente = $id_cliente";

    if ($conexion->query($sql_eliminar) === TRUE) {
        // Redirigir a la misma página después de eliminar
        header("Location: clientes.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar cliente: " . $conexion->error . "</div>";
    }
}

// Obtener la lista de clientes
$sql_clientes = "SELECT * FROM Clientes";
$resultado_clientes = $conexion->query($sql_clientes);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body id="B1">
    <center>
        <div class="card col-sm-8" style="margin-top: 7%;">
            <div class="card-body">
                <h3 class="card-title">Gestión de Clientes</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Cliente</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultado_clientes->num_rows > 0) {
                            while ($fila = $resultado_clientes->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$fila['id_cliente']}</td>
                                    <td>{$fila['nombre']}</td>
                                    <td>{$fila['correo']}</td>
                                    <td>{$fila['telefono']}</td>
                                    <td>
                                        <a href='editar_cliente.php?id_cliente={$fila['id_cliente']}' class='btn btn-warning'>Editar</a>
                                        </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No hay clientes registrados.</td></tr>";
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

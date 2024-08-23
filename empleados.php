<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["telefono"]) && isset($_POST["fecha_contratacion"]) && isset($_POST["password"])) {
        $nombre = $conexion->real_escape_string($_POST["nombre"]);
        $correo = $conexion->real_escape_string($_POST["correo"]);
        $telefono = $conexion->real_escape_string($_POST["telefono"]);
        $fecha_contratacion = $conexion->real_escape_string($_POST["fecha_contratacion"]);
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $sql_check = "SELECT id_empleado FROM Empleados WHERE correo = '$correo'";
        $resultado_check = $conexion->query($sql_check);

        if ($resultado_check->num_rows > 0) {
            echo "Error: El correo ya está registrado.";
        } else {
            $sql = "INSERT INTO Empleados (nombre, correo, telefono, fecha_contratacion, password)
                    VALUES ('$nombre', '$correo', '$telefono', '$fecha_contratacion', '$password')";

            if ($conexion->query($sql) === TRUE) {
                // Redirigir al login después del registro exitoso
                header("Location: login.php");
                exit(); // Asegura que el script se detenga después de la redirección
            } else {
                echo "Error: " . $conexion->error;
            }
        }
    } else {
        echo "Error: Datos del formulario incompletos.";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="B1" class="d-flex justify-content-center align-items-center" style="height: 100vh;">

    <div id="B2" class="card col-sm-3" style="padding: 20px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);">
        <div class="card-body login-card-body">
            <h2 class="text-center mb-4"><b>Crear Cuenta</b></h2>
            <form method="post" action="empleados.php">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="fecha_contratacion" class="form-label">Fecha de Contratación:</label>
                    <input type="date" id="fecha_contratacion" name="fecha_contratacion" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Crear Cuenta</button>
                </div>
            </form>

            <form action="login.php" class="text-center mt-3">
                <button type="submit" class="btn btn-secondary">Volver</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
    
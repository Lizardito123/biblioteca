<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    // Consultar el empleado por correo
    $sql = "SELECT id_empleado, nombre, password FROM Empleados WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $empleado = $resultado->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $empleado['password'])) {
            // Inicio de sesión exitoso
            $_SESSION["loggedin"] = true;
            $_SESSION["id_empleado"] = $empleado["id_empleado"];
            $_SESSION["nombre"] = $empleado["nombre"];
            header("Location: index.php"); // Redirigir a la página principal
            exit();
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INICIO</title>
    <link rel="stylesheet" href="estilos11.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="A1">

    <center>

        <div id="A2" class="card col-sm-3" style="margin-top: 7%;">

            <div class="card-body login-card-body">

                <?php
if(isset($_GET['error'])){
    

    
    echo "<div class='alert alert-danger alert-dismissible'>";

    echo "<h5><i class='icon fas fa-ban'></i> Alert!</h5>";
    echo $_GET['error'];
    echo "</div>";
    } ?>










                <p class="login-box-msg"> <b>INICIO DE SESION</b></p>
                <form action="" method="post">
                    <div class="input-group mb-3">

                        <input type="email" name="correo" class="form-control" placeholder="Ingrese su correo" required>


                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>

                    </div>
                    <div class="row">
                        <center>
                       
                            
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">INICIAR SESION</button>
                            </div>

                        </center>
                    </div>
                </form>
                <form action="empleados.php" method="post">
                    <div class="social-auth-links text-center mb-3">
                        <br>
                        
                        <button type="submit" class="btn btn-primary btn-block">CREAR CUENTA NUEVA</button>

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
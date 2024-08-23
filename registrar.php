<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRAR USUARIO</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="B1">

    <center>

        <div id="B2" class="card col-sm-3" style="margin-top: 7%;">

            <div class="card-body login-card-body">
                <p class="login-box-msg"> <b>CREAR CUENTA  </b></p>
                <form action="registro.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="nickname" class="form-control" placeholder="Usuario" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="correo" class="form-control" placeholder="Correo" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="row">
                        
                        <center>
                        
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">CREAR CUENTA</button><br>
                            </div>


                        </center>
                    </div>
                </form>
                <form action="index.php">
                <div class="col-6">
                    <br><button type="submit" class="btn btn-primary btn-block"> <- </button>
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
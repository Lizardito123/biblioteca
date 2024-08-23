<!doctype html>


<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="estilos22.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .nav-item {
            background: rgba(255, 255, 255, 0.425); /* Fondo rojo */
    
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px; /* Espacio entre los cuadros */
            text-align: center; /* Centrar el texto */
            width: 100%; /* Ancho completo del contenedor */
            max-width: 300px; /* Máximo ancho del cuadro */
        }
        .nav-link {
            color: #000000 !important; /* Letras negras */
            font-size: 1.2em; /* Aumentar el tamaño de la fuente */
            display: block; /* Asegurar que el enlace ocupe todo el cuadro */
        }
        .nav-link:hover {
            color: #333333 !important; /* Letras negras más oscuras al pasar el mouse */
        }
        body {
            background-color: #f8f9fa; /* Color de fondo general para mayor contraste */
        }
    </style>
</head>

<body id="B1">

<div class="container">
        <h1 class="text-center mb-4">Bienvenido a la Biblioteca</h1>
        <nav class="navbar navbar-expand-lg">
            <ul class="navbar-nav d-flex flex-column align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="empleados.php">Registro de Empleados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clientes.php">Registro de Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="libros.php">Registros de Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="prestamos.php">Realizar Prestamos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="historial.php">Historial de Prestamos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editar.php">Gestion de Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edit.php">Gestion de Libros</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
$conexion = new mysqli("localhost", "root", "", "bibli");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_libro = $conexion->real_escape_string($_POST["id_libro"]);
    $titulo = $conexion->real_escape_string($_POST["titulo"]);
    $autor = $conexion->real_escape_string($_POST["autor"]);
    $cantidad_disponible = (int)$_POST["cantidad_disponible"];

    $sql_actualizar = "UPDATE Libros SET titulo='$titulo', autor='$autor', cantidad_disponible=$cantidad_disponible WHERE id_libro=$id_libro";

    if ($conexion->query($sql_actualizar) === TRUE) {
        echo "<div class='alert alert-success'>Libro actualizado con éxito.</div>";
        header("Location: edit.php"); // Redirigir a la página principal de libros después de actualizar
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar libro: " . $conexion->error . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Método no permitido.</div>";
    exit();
}

$conexion->close();
?>

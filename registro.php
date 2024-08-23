<?php
include "conexion.php";
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$nickname = $_POST['nickname'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña']; //    CONTRASEÑA
$sql = $conn -> query("INSERT INTO usu(nombre,apellido,nickname,correo,contraseña) VALUES('$nombre', '$apellido', '$nickname', '$correo', '$contraseña')");
header('Location:index.php');

?>
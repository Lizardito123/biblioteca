<?php
$conexion = new mysqli("localhost", "root", "", "bibli");
$id=$_GET['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editor = $_POST['editor'];
$año = $_POST['año'];

$sql = $conn -> query("DELETE FROM Clientes WHERE id= '$id' ");
header('Location:editar.php');
?>
<?php
$conexion = new mysqli("localhost", "root", "", "bibli");
$id=$_GET['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editor = $_POST['editor'];


$sql = $conn -> query("DELETE FROM Libros WHERE id= '$id' ");
header('Location:edit.php');
?>
<?php
session_start();
include "conexion.php";
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];



$sql = "SELECT * FROM usu WHERE correo ='$correo' AND contraseña = '$contraseña'";
$resultado = mysqli_query($conn, $sql);
if(mysqli_num_rows($resultado) === 1){
    $row = mysqli_fetch_assoc($resultado);
    if($row['correo'] ===$correo && $row['contraseña'] === $contraseña){
        $_SESSION['nickname'] = $row['nickname'];
        $_SESSION['id'] = $row['id'];
        header("Location: interfaz.php");
    
    }else{
        header("Location: index.php?error=Correo/contraseña incorrecta");
        
    }
}else{
    header("Location: index.php?error=Correo/contraseña incorrecta");
}

?>
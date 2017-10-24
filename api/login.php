<?php

if(isset($_POST['logout'])) {
   session_start();
   session_destroy();
 }
 else {

 session_start();

include 'conexion.php';

 $usuario = mysqli_query($conexion, "select * from usuarios where password='$_REQUEST[password]' AND usuario='$_REQUEST[usuario]'") or
   die("Problemas en el select:".mysqli_error($conexion));

   if ($reg=mysqli_fetch_array($usuario)) {
       $_SESSION['logged'] = "logged";
       $_SESSION['usuario'] = $reg['usuario'];
       $_SESSION['email'] = $reg['email'];
       echo "<script>window.location='index.php';</script>";
   } else {
     echo "Usuario o password incorrectos";
   }


 }

?>

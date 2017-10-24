<?php

include 'conexion.php';

if($_POST['type_user'] == "solucel") {
    mysqli_query($conexion, "INSERT INTO usuarios (usuario, password, telefono, email, direccion)  VALUES
    ('$_POST[usuario_solucel]', '$_POST[password_solucel]', '4327-0110', 'info@solucel.com.ar', 'Florida 537')");

  }  else {
   $upload_image=$_FILES["myimage"]["name"];
   $folder="../img/logos/";

   move_uploaded_file($_FILES["myimage"]["tmp_name"], "$folder".$_FILES["myimage"]["name"]);
   mysqli_query($conexion, "INSERT INTO usuarios (usuario, password, telefono, email, direccion, logo)
    VALUES ('$_POST[usuario_otro]', '$_POST[password_otro]', '$_POST[tel_otro]', '$_POST[email_otro]', '$_POST[direccion_otro]', '$upload_image')");
}


 ?>

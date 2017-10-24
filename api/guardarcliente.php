<?php

include 'conexion.php';

mysqli_query($conexion, "INSERT INTO clientes (nombre, apellido, telefono, email)  VALUES
('$_POST[nombre]', '$_POST[apellido]', '$_POST[telefono]', '$_POST[email]')");

 ?>

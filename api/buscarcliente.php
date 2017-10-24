<?php

include 'conexion.php';

$consulta = mysqli_query($conexion, "SELECT * FROM clientes
WHERE nombre='$_POST[nombre]' AND apellido='$_POST[apellido]'");

$reg = mysqli_fetch_array($consulta);

if(mysqli_num_rows($consulta) > 0) {
  $response = array(
      'status'   => 'ok',
      'mensaje'   => 'Se ha encontrado al cliente '.$reg['nombre']." ".$reg['apellido'].'',
      'telefono'   => $reg['telefono'],
      'email'   => $reg['email']
  );
} else {
  $response = array(
      'status'   => 'error',
      'mensaje'   => 'No se ha encontrado ningun cliente con este nombre'
  );
}

echo(json_encode($response));
exit();

 ?>

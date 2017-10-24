<?php

include 'conexion.php';

mysqli_query($conexion, "INSERT INTO recibos (razon_social, cuit, direccion, formapago)  VALUES
('$_POST[razonsocial]', '$_POST[cuit]', '$_POST[direccion]', '$_POST[forma_pago]')");

$id_recibo = mysqli_insert_id($conexion);

$concepto = $_POST['concepto'];
$valor = $_POST['valor'];

foreach( $concepto as $key => $c ) {
  mysqli_query($conexion, "INSERT INTO conceptos (concepto) VALUES
  ('$c')");

  $last_id = mysqli_insert_id($conexion);

  mysqli_query($conexion, "INSERT INTO contenido_recibos (id_recibo, id_concepto, valor) VALUES
  ('$id_recibo', '$last_id', '$valor[$key]')");

}

 ?>

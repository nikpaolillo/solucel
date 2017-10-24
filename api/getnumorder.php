<?php

$conexion = mysqli_connect("cloud4g.maxtechglobal.com", "solucel", "maxteam.S0lu", "solucel_solucel") or
die("Problemas con la conexión");

$id = mysqli_query($conexion, "SELECT * from nuevaorden where orden=(SELECT max(orden) FROM nuevaorden)");
$ordenes = mysqli_query($conexion, "select * from nuevaorden");

$id = mysqli_fetch_array($id);

$orden = $id['orden'] + 1 ;
$letra  = $id['letra'];

$mensaje = $letra.$orden;

echo $mensaje;
 ?>

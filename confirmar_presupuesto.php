<?php

$conexion = mysqli_connect("cloud4g.maxtechglobal.com", "solucel", "maxteam.S0lu", "solucel_solucel") or
die("Problemas con la conexión");

$orden = $_POST['id'];
$letra = substr($orden,0,1);
$num = substr($orden,1);

if($_POST['respuesta'] == "si") {
  mysqli_query($conexion, "UPDATE nuevaorden
                        SET confirmado=1
                      WHERE letra='$letra' AND orden='$num'");
} else {
  mysqli_query($conexion, "UPDATE nuevaorden
                        SET confirmado=2
                      WHERE letra='$letra' AND orden='$num'");
}

$destinatario = "info@solucel.com.ar";
$headers ="From:Maxtechglobal <info@maxtechglobal.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$asunto = "Confirmacion de presupuesto orden Nº$_POST[id]";

$mensaje = "<html><body>";
$mensaje .= "<h1>Confirmacion de presupuesto en Solucel</h1>";
$mensaje .= "<p>http://www.solucel.com.ar/app/search.php?id=$_POST[id]</p>";
$asunto = "Confirmacion de presupuesto orden Nº$_POST[id]";

$mensaje = "<html><body>";
$mensaje .= "<h1>Confirmacion de presupuesto en Solucel</h1>";
$mensaje .= "<p>http://www.solucel.com.ar/app/search.php?id=$_POST[id]</p>";
$mensaje .="</body></html>";

mail($destinatario,$asunto,$mensaje,$headers);



 ?>

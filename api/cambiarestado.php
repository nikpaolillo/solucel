<?php

include "conexion.php";

mysqli_query($conexion, "update nuevaorden
                      set estado='$_POST[estado]'
                    where id='$_POST[id]'");

mysqli_query($conexion, "update nuevaorden
                set valor='$_POST[valor]'
                where id='$_POST[id]'");

mysqli_query($conexion, "update nuevaorden
                set detalle='$_POST[detalle]'
                where id='$_POST[id]'");

  $destinatario = $_POST['email'];
  $solucel = "info@solucel.com.ar";
  $headers ="From:Solucel <info@solucel.com.ar>\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  $mensaje = "<html><body>";
  $mensaje .= "<h1>Orden de reparacion en Solucel</h1>";
  $mensaje .= "<p>El estado en tu orden de solucel ha cambiado a: $_POST[estado]</p>";
  $mensaje .= "<p>Para ver el detalle de su orden ingrese a: http://www.solucel.com.ar/serviciotecnico (Es necesario numero de orden y email).</p>";
  $mensaje .="</body></html>";

  mail($destinatario,$asunto,$mensaje,$headers);

 ?>

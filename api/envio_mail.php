<?php
$destinatario ="info@maxtechglobal.com";
$solucel = "info@solucel.com.ar";
$headers ="From:Maxtechglobal <info@maxtechglobal.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$name = $_POST["name"];
$titulo = $_POST["titulo"];
$asunto ="Pedido de carga Solucel para $name";
$cantidad_ml = $_POST["cantidad_ml"];
$cantidad_web = $_POST["cantidad_web"];
$precio = $_POST["precio"];
$precio_oferta = $_POST["precio_oferta"];
$garantia = $_POST["garantia"];
$enoferta = $_POST["enoferta"];
$url = $_POST["url"];
$descript = $_POST["descript"];
$claves = $_POST["claves"];
$linksimg = $_POST["linksimg"];

$mensaje = "<html><body>";
$mensaje .= "<h1>$titulo</h1>";
$mensaje .= "<p>Nombre del Pructo : $name</p><p>Titulo ML : $titulo</p>Cantidad ML : $cantidad_ml
<p>Cantidad WEB : $cantidad_web</p><p>Precio : $precio</p><p>Precio oferta : $precio_oferta</p><p>Garantia : $garantia</p>
<p>Poner en oferta : $enoferta</p><p>url : $url</p><p>Descrpcion : $descript</p><p>Palabras claves : $claves</p><p>Imagenes: $linksimg</p>";
$mensaje .="</body></html>";

$mensaje2 = "<html><body>";
$mensaje2 .= "<h1>Su pedido por el Articulo <span style='font-style:oblique'>$titulo</span>, ya esta en proceso de carga</h1>";
$mensaje2 .= "<img src='img/logo_MT.JPG'>";
$mensaje2 .= "<p>www.maxtechglobal.com | info@maxtechglobal.com</p>";
$mensaje2 .= "</body></html>";
mail($destinatario,$asunto,$mensaje,$headers);
mail($solucel,$asunto,$mensaje2,$headers);
echo "<center><h1>Formulario enviado correctamente</h1></center>";

 ?>

 <script type="text/javascript">
   setTimeout(function(){ location.href="formulario.html"; }, 2000);
 </script>

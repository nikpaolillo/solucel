<?php

//Archivo de conexión a la base de datos
include 'conexion.php';

//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";

if($consultaBusqueda == "vacio") {


        $ordenes = mysqli_query($conexion, "select * from nuevaorden ORDER BY orden DESC LIMIT 10");

        echo '<h2 class="headertabla">Ordenes</h2>
        <div class="table-responsive">
          <table class="ui unstackable red table">
            <thead>
              <tr>
                <th>Orden</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Clave de bloqueo</th>
                <th>Diagnostico</th>
                <th>Valor</th>
                <th>Detalle</th>
                <th>Estado</th>
                <th>Visitas</th>
              </tr>
            </thead>
            <tbody>';
                while($reg = mysqli_fetch_array($ordenes)) {
                  echo "<tr class='clickable-row' data-href='search.php?id=$reg[id]' data-estado='$reg[estado]' data-id='$reg[id]'>";
                  echo "<td>$reg[letra]$reg[orden]</td>";
                  echo "<td>$reg[fechacreacion]</td>";
                  echo "<td>$reg[nombre]</td>";
                  echo "<td>$reg[email]</td>";
                  echo "<td>$reg[telefono]</td>";
                  echo "<td>$reg[marca]</td>";
                  echo "<td>$reg[modelo]</td>";
                  echo "<td>$reg[serie]</td>";
                  echo "<td>$reg[clavebloqueo]</td>";
                  echo "<td>$reg[diagnostico]</td>";
                  echo "<td>$reg[valor]</td>";
                  echo "<td>$reg[detalle]</td>";
                  echo "<td class='estado'>$reg[estado]</td>";
                  echo "<td>$reg[visitas]</td>";
                  echo "</tr>";
                }
            echo '</tbody>
          </table>
        </div>';

} else {



//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

//Selecciona todo de la tabla mmv001
//donde el nombre sea igual a $consultaBusqueda,
//o el apellido sea igual a $consultaBusqueda,
//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
  $orden = $consultaBusqueda;
  $letra = substr($orden,0,1);
  $num = substr($orden,1);

  $consulta = mysqli_query($conexion, "SELECT * FROM nuevaorden
  WHERE letra='$letra' AND orden='$num' OR nombre LIKE '%$consultaBusqueda%' OR telefono LIKE '%$consultaBusqueda%' OR email LIKE '%$consultaBusqueda%'
  OR marca LIKE '%$consultaBusqueda%' OR modelo LIKE '%$consultaBusqueda%' OR serie LIKE '%$consultaBusqueda%' OR clavebloqueo LIKE '%$consultaBusqueda%'
  OR diagnostico LIKE '%$consultaBusqueda%' OR valor LIKE '%$consultaBusqueda%' OR detalle LIKE '%$consultaBusqueda%'");



//Obtiene la cantidad de filas que hay en la consulta
$filas = mysqli_num_rows($consulta);

//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
if ($filas === 0) {
  $mensaje = "<center><p>No hay ninguna orden con estas caracteristicas</p></center>";
} else {
  //Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje

  //La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
  $mensaje .= '<h2>Resultados para '.$consultaBusqueda.'</h2>
  <div class="table-responsive">
    <table class="ui unstackable red table">
      <thead>
        <tr>
          <th>Orden</th>
          <th>Fecha</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Telefono</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Serie</th>
          <th>Clave de bloqueo</th>
          <th>Diagnostico</th>
          <th>Valor</th>
          <th>Detalle</th>
          <th>Estado</th>
          <th>Visitas</th>
        </tr>
      </thead>
      <tbody>';
  while($resultados = mysqli_fetch_array($consulta)) {
    $id = $resultados['id'];
    $orden = $resultados['letra'].$resultados['orden'];
    $fecha = $resultados['fechacreacion'];
    $nombre = $resultados['nombre'];
    $email = $resultados['email'];
    $telefono = $resultados['telefono'];
    $marca = $resultados['marca'];
    $modelo = $resultados['modelo'];
    $serie = $resultados['serie'];
    $clavebloqueo = $resultados['clavebloqueo'];
    $diagnostico = $resultados['diagnostico'];
    $valor = $resultados['valor'];
    $detalle = $resultados['detalle'];
    $estado = $resultados['estado'];
    $visitas = $resultados['visitas'];
    //Output
    $mensaje .= '
              <tr class="clickable-row" data-estado="$reg[estado]" data-id="$reg[id]" data-href="search.php?id='.$id.'">
              <td>'.$orden.'</td>
              <td>'.$fecha.'</td>
              <td>'.$nombre.'</td>
              <td>'.$email.'</td>
              <td>'.$telefono.'</td>
              <td>'.$marca.'</td>
              <td>'.$modelo.'</td>
              <td>'.$serie.'</td>
              <td>'.$clavebloqueo.'</td>
              <td>'.$diagnostico.'</td>
              <td>'.$valor.'</td>
              <td>'.$detalle.'</td>
              <td class="estado">'.$estado.'</td>
              <td>'.$visitas.'</td>
              </tr>
        ';

  };//Fin while $resultados

  $mensaje .= '</tbody>
</table>
</div>';

}; //Fin else $filas

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;

}
?>

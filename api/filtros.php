<?php


//Archivo de conexión a la base de datos
include 'conexion.php';

unset($sql);

$cantidad = $_POST['cantidad'];
$estado = $_POST['estado'];



if ($estado !== "Sin filtro") {
    $sql[] = " estado = '$estado' ";
}
if ($cantidad !== "Sin filtro") {
    $sql[] = " $cantidad ";
}


$query = "SELECT * FROM nuevaorden";

if (!empty($sql)) {
  if($estado == "Sin filtro") {
    $query .= ' ORDER BY orden DESC LIMIT ' . implode(' LIMIT ', $sql);
  } else {
    $query .= ' WHERE ' . implode(' LIMIT ', $sql);
  }
}


$ordenes = mysqli_query($conexion, $query);


echo '<div class="table-responsive">
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
          echo "<tr onclick=\"clicka('search.php?id=$reg[id]')\" data-estado='$reg[estado]' data-id='$reg[id]'>";
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

 ?>

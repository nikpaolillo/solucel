<?php

include 'conexion.php';

$orden = $_POST['orden'];
$letra = substr($orden,0,1);
$num = substr($orden,1);
$email = $_POST['email'];

$count_ordenes = mysqli_query($conexion, "SELECT * FROM nuevaorden where letra='$letra' AND orden='$num' AND email='$email'");
$rows_ordenes = mysqli_num_rows($count_ordenes);

if($rows_ordenes == 0) {
  echo "Incorrecto";
} else {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Busqueda</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../app/js/semantic.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/76ff5bbde3.js"></script>
    <link rel="stylesheet" href="../app/css/semantic.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../app/css/demo.css" />
		<link rel="stylesheet" href="../app/css/sky-forms.css" />
		<link rel="stylesheet" href="../app/css/sky-forms-blue.css" />

    <style>
      @import url(http://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

      .alertedit {
        padding: 20px;
        background-color: #6abc6e;
        color: white;
        margin-top:40px;
        display:none;
        font-size:18px;
      }
    </style>

    <script type="text/javascript">
      function confirmarPresu(id, resp) {
        $.post("confirmar_presupuesto.php", {orden: id, respuesta: resp }, function(mensaje) {
          $(".btn-danger").hide();
          $(".btn-success").hide();
          $(".alertedit").show();
        });
      }
    </script>
    <?php

    $conexion = mysqli_connect("cloud4g.maxtechglobal.com", "solucel", "maxteam.S0lu", "solucel_solucel") or
    die("Problemas con la conexión");

    $orden = $_POST['orden'];
    $letra = substr($orden,0,1);
    $num = substr($orden,1);
    $email = $_POST['email'];



    $ordenes = mysqli_query($conexion, "SELECT * FROM nuevaorden where letra='$letra' AND orden='$num' AND email='$email'");
    $ordenes = mysqli_fetch_array($ordenes);

    $visitas = mysqli_query($conexion, "SELECT visitas FROM nuevaorden where letra='$letra' AND orden='$num' AND email='$email'");

    $visitas = mysqli_fetch_array($visitas);

    $visitas = $visitas['visitas'] + 1;

    mysqli_query($conexion, "UPDATE nuevaorden
                          SET visitas='$visitas'
                        where letra='$letra' AND orden='$num'");

     ?>

  </head>
  <body class="bg-blue">
    <div class="container" style="text-align:center;">
      <div style="margin-top:150px" class="table-responsive">
        <table style="color:black;font-family:'Open Sans'" class="ui unstackable red table">
          <thead>
            <tr>
              <th><?php echo $ordenes['nombre']; echo " "; echo $ordenes['apellido']; ?></th>
              <th>#<?php echo $ordenes['letra'].$ordenes['orden']; ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Marca y modelo:</td>
              <td><?php echo $ordenes['marca']; echo " "; echo $ordenes['modelo']; ?></td>
            </tr>
            <tr>
              <td>Diagnostico:</td>
              <td><?php echo $ordenes['diagnostico']; ?></td>
            </tr>
            <tr>
              <td style="font-weight:bold">Valor:</td>
              <td style="font-weight:bold"><?php echo $ordenes['valor']; ?></td>
            </tr>
            <tr>
              <td>Detalle:</td>
              <td><?php echo $ordenes['detalle']; ?></td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td><?php echo $ordenes['estado']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <label class="input">
        <?php
          if($ordenes['estado'] == "Confirmar presupuesto" AND $ordenes['confirmado'] == 0) { ?>
            <button type="button" class="btn btn-success btn-block" style="margin-top:20px" onclick="confirmarPresu('<?php echo $_POST['orden'] ?>', 'si');">Confirmar presupuesto</button>
            <button type="button" class="btn btn-danger btn-block" style="margin-top:20px" onclick="confirmarPresu('<?php echo $_POST['orden'] ?>', 'no');">No acepto el presupuesto</button>
            <?php
          }
         ?>
        <div class="alertedit"><i class="fa fa-check fa-fw" aria-hidden="true"></i> Gracias por aceptar el presupuesto de Solucel. <br> Su equipo comenzara con el proceso de reparacion.</div>
      </label>
    </div>
  </body>
</html>
<?php } ?>

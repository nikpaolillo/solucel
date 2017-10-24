<?php

  $conexion = mysqli_connect("cloud4g.maxtechglobal.com", "solucel", "maxteam.S0lu", "solucel_solucel") or
    die("Problemas con la conexión");

    if($_POST['tipo'] == "manual") {
      if($_POST['nombre'] == "" && $_POST['telefono'] == "") {
        echo "Debe rellenar todos los datos para ingresar la orden";
      } else {
        echo "Orden ingresada exitosamente!";
        $orden = $_POST['numorder'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $serie = $_POST['serie'];
        $clavebloqueo = $_POST['clave'];
        $diagnostico = $_POST['diagnostico'];
        $valor = $_POST['valor'];
        $detalle = $_POST['detalle'];
        $atendidopor = $_POST['atendidopor'];

      mysqli_query($conexion, "insert into nuevaorden(letra,orden,nombre,telefono,email,apellido,marca,modelo,serie,clavebloqueo,diagnostico,valor,detalle,atendidopor,estado) values
                    ('M', '$orden', '$nombre', '$telefono', '$email', '$apellido', '$marca', '$modelo', '$serie', '$clavebloqueo', '$diagnostico', '$valor', '$detalle', '$atendidopor','Sin revisar')");
      }
    } else {
      $datos = mysqli_query($conexion, "SELECT orden from nuevaorden ORDER BY orden DESC LIMIT 1");

      $ordenanterior = mysqli_fetch_array($datos);

      $abc = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W',
      'X', 'Y', 'Z');

      $orden = $ordenanterior['orden'] + 1;


      if($orden > 99999) {
        $numletra = next($abc);
      } else {
        $numletra = current($abc);
      }

      $letra = $numletra;

      if($_POST['nombre'] == "" && $_POST['telefono'] == "") {
        echo "Debe rellenar todos los datos para ingresar la orden";
      } else {
        echo "Orden ingresada exitosamente!";
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $serie = $_POST['serie'];
        $clavebloqueo = $_POST['clave'];
        $diagnostico = $_POST['diagnostico'];
        $valor = $_POST['valor'];
        $detalle = $_POST['detalle'];
        $atendidopor = $_POST['atendidopor'];

      mysqli_query($conexion, "insert into nuevaorden(letra,orden,nombre,telefono,email,apellido,marca,modelo,serie,clavebloqueo,diagnostico,valor,detalle,atendidopor,estado) values
                    ('$letra', '$orden', '$nombre', '$telefono', '$email', '$apellido', '$marca', '$modelo', '$serie', '$clavebloqueo', '$diagnostico', '$valor', '$detalle', '$atendidopor','Sin revisar')");
      }

    }


 ?>

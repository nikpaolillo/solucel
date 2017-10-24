function login() {
  var parametros = {
          "usuario" : $("#usuario").val(),
          "password" : $("#password").val()
  };
  $.ajax({
          data:  parametros,
          url:   'api/login.php',
          type:  'post',
          success:  function (response) {
                  $("#mensajeRespuesta").html(response);
          }
  });
}

function enter(e) {
  if (e.keyCode ==13){
    login();
  }
}

function logout(){
 var parametros = {
          "logout" : "desc"
  };
  $.ajax({
          data:  parametros,
          url:   'api/login.php',
          type:  'post',
          success:  function (response) {
                   location.href='login.html';
          }
  });
  }


  function cambiarestado(id) {
    $.post("api/cambiarestado.php", {estado: $(".selectestado option:selected" ).text(), valor: $("#valor").val(), id: id, email: $("#email").val(), detalle: $("#detalle").val() }, function(mensaje) {
      $("html, body").animate({ scrollTop: $(document).height() }, 1000);
      $(".alertedit").show();
      });
  }

  function colores() {
    $(".estado").each(function(){
      if ($(this).text() == "Sin revisar") {
        $(this).parent().addClass("estado_sinrevisar");
      }
      else if ($(this).text() == "Sin arreglo") {
        $(this).parent().addClass("estado_sinarreglo");
      }
      else if ($(this).text() == "Reparado") {
        $(this).parent().addClass("estado_reparado");
      }
      else if ($(this).text() == "En proceso") {
        $(this).parent().addClass("estado_enproceso");
      }
      else if ($(this).text() == "Confirmar presupuesto") {
        $(this).parent().addClass("estado_presupuesto");
      }
    })
  }


  jQuery(document).ready(function($) {
  $(".clickable-row").click(function() {
      window.document.location = $(this).data("href");
  });

  colores();
  $('#nombre').focus();

});

function printOrder() {
if (window.print) {
  window.print();
}
  }

function filtrar() {
    $.post("api/filtros.php", {estado: $("#filtro_estado").val(), cantidad: $("#filtro_cantidad").val()}, function(mensaje) {
      $("#resultadoBusqueda").html(mensaje);
      colores();
    });
}

function procesarbusqueda() {
    $.post("api/procesarbusqueda.php", {orden: $("#orden").val(), email: $("#email").val()}, function(mensaje) {
      if(mensaje == "Incorrecto") {
        $("#mensaje").css("display", "inline");
      } else {
        $(".container").html(mensaje);
      }

    });
}
function printOrder() {
if (window.print) {
  window.print();
  location.reload();
}
  }

function nuevaorden(tipo) {
  var parametros = {
          "tipo" : tipo,
          "numorder" : $("#numorder").val(),
          "nombre" : $("#nombre").val(),
          "apellido" : $("#apellido").val(),
          "telefono" : $("#telefono").val(),
          "email" : $("#email").val(),
          "marca" : $("#marca").val(),
          "modelo" : $("#modelo").val(),
          "serie" : $("#serie").val(),
          "clave" : $("#clave").val(),
          "valor" : $("#valor").val(),
          "diagnostico" : $("#diagnostico").val(),
          "detalle" : $("#detalle").val(),
          "atendidopor" : $("#quien").val()
  };
  $.ajax({
          data:  parametros,
          url:   'api/procesarorden.php',
          type:  'post',
          success:  function (response) {
            alert(response);
            printOrder();
          }
  });
}

function searchCliente() {
  $.ajax({
          url:   'api/buscarcliente.php',
          type:  'POST',
          dataType: 'json',
          data: {nombre: $("#nombre").val(), apellido: $("#apellido").val()},
          success:  function (data) {
            if(data.status == "ok") {
              $(".alertclient").show();
              $("#mensaje_alert").text(data.mensaje);
              $("#telefono").val(data.telefono);
              $("#email").val(data.email);
            }
          },
          error: function(data) {
            alert(JSON.stringify(data, null, 4));
            alert(JSON.stringify(data.telefono, null, 4));
          }
  });
}

function vaciarCliente() {
  $("#telefono").val("");
  $("#email").val("");
}

function guardarCliente() {
  var parametros = {
          "nombre" : $("#nombre").val(),
          "apellido" : $("#apellido").val(),
          "telefono" : $("#telefono").val(),
          "email" : $("#email").val()
  };
  $.ajax({
          data:  parametros,
          url:   'api/guardarcliente.php',
          type:  'post',
          success:  function (response) {
            
          }
  });
}

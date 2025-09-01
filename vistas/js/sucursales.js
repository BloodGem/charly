/*=============================================
EDITAR PRODUCTO
=============================================*/
$( document ).ready(function() {

var id_sucursal = $("#id_sucursal").val();

 var datos = new FormData();
  datos.append("id_sucursal", id_sucursal);

  $.ajax({
    url: "ajax/sucursales.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        $("#id_sucursal").val(respuesta["id_sucursal"]);
        $("#actualCcerE").val(respuesta["ccer"]);
        $("#actualCkeyE").val(respuesta["ckey"]);
        $("#actualClaveE").val(respuesta["id_sucursal"]);
        $("#editarRfcE").val(respuesta["rfc"]);
        $("#editarNombreE").val(respuesta["nombre"]);
        $("#editarEmailE").val(respuesta["email"]);
        $("#editarTelefono1E").val(respuesta["telefono1"]);
        $("#editarTelefono2E").val(respuesta["telefono2"]);
        $("#editarDireccionE").val(respuesta["direccion"]);
        $("#editarNoInteriorE").val(respuesta["no_interior"]);
        $("#editarNoExteriorE").val(respuesta["no_exterior"]);
        $("#editarColoniaE").val(respuesta["colonia"]);
        $("#editarCodigoPostalE").val(respuesta["codigo_postal"]);
        $("#editarCiudadE").val(respuesta["ciudad"]);
        $("#editarIdEstadoE").val(respuesta["id_estado"]);
        $("#editarIdRegimenE").val(respuesta["id_regimen"]);
        $("#editarSitioWebE").val(respuesta["sitio_web"]);
        $("#actualLogoE").val(respuesta["logo"]);
        $("#actualFondoInicioE").val(respuesta["fondo_inicio"]);

      }

  })


});





  




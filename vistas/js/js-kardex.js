function activaTablaProductos() {

                $("#tablaProductos").DataTable({
      "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargandovistas.",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  },
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
        order: [[2, 'asc']],
    });
  }




  function activaTablaKardex() {

                $("#tablaKardex").DataTable({
      "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargandovistas.",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  },
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
        order: [[0, 'asc']],
    });
  }

/*=============================================
BUSCADOR DE PRODUCTOS
=============================================*/
function buscarAhoraProductos(buscarProductos) {
        var parametros = {"buscarProductos":buscarProductos};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorProductosKardex.php',
        success: function(data) {
        document.getElementById("incrustarTablaProductos").innerHTML = data;

        activaTablaProductos();
        }
        });
        }




        $(document).on("change", "#buscarProductos", function(){

    var buscar = $(this).val();

    buscarAhoraProductos(buscar);

});





$('#no_rango').on('change', function() {

  var id_sucursal = $("#id_sucursal").val();
  var no_rango = $("#no_rango>option:selected").val();
  var id_producto = $("#id_producto").val();
  document.getElementById("incrustarRangoFecha").innerHTML = "";
  if(no_rango == 9){

                    document.getElementById("incrustarRangoFecha").innerHTML =
                    '<div class="form-group">'+
                      '<label>Date range button:</label>'+
                      '<div class="input-group">'+
                        '<div class="input-group-prepend">'+
                          '<span class="input-group-text">'+
                            '<i class="far fa-calendar-alt"></i>'+
                          '</span>'+
                        '</div>'+
                        '<input type="text" class="form-control float-right" id="rango_fecha" name="rango_fecha">'+
                      '</div>'+
                    '</div>';

                    $('#rango_fecha').daterangepicker();

                    var rango_fecha = $('#rango_fecha').val();

                    if(id_producto !== "" && no_rango !== ""){
                      $("#btnCardBusqueda").trigger('click');
    document.getElementById("incrustarTablaKardex").innerHTML = "";
  document.getElementById("incrustarTablaProductos").innerHTML = "";
    document.getElementById("incrustarTablaKardex").innerHTML = '<center><img src="recursos/general/cargando2-gif.gif" alt="Cargando..."></center>';
  }

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_producto":id_producto, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaKardex.php',
        success: function(data) {
        document.getElementById("incrustarTablaKardex").innerHTML = data;

        
        activaTablaKardex();
      
    
        }

        });


  }else{

    if(id_producto !== "" && no_rango !== ""){
      $("#btnCardBusqueda").trigger('click');
    document.getElementById("incrustarTablaKardex").innerHTML = "";
  document.getElementById("incrustarTablaProductos").innerHTML = "";
    document.getElementById("incrustarTablaKardex").innerHTML = '<center><img src="recursos/general/cargando2-gif.gif" alt="Cargando..."></center>';
  }

    
    var parametros = {"no_rango":no_rango, "id_producto":id_producto, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaKardex.php',
        success: function(data) {
        document.getElementById("incrustarTablaKardex").innerHTML = data;

        activaTablaKardex();
    
      
    
        }

        });

  }

  //mostrarGafico(parametros);
});









$(document).on('click', '.seleccionarProducto', function() {

  var id_sucursal = $("#id_sucursal").val();
  var no_rango = $("#no_rango>option:selected").val();
  var id_producto = $(this).attr('id_producto');
  var descripcion = $(this).attr('descripcion');
  var clave_producto = $(this).attr('clave_producto');
  $("#id_producto").val(id_producto);
  $("#clave_producto").val(clave_producto);
  $("#descripcion_producto").val(descripcion);
  $("#textoProductoSeleccionado").text(clave_producto+' ---> '+descripcion);
  document.getElementById("incrustarTablaProductos").innerHTML = "";
  
  
  if(no_rango == 9){
                    var rango_fecha = $('#rango_fecha').val();

   if(id_producto !== "" && no_rango !== ""){
    $("#btnCardBusqueda").trigger('click');
    document.getElementById("incrustarTablaKardex").innerHTML = "";
    document.getElementById("incrustarTablaKardex").innerHTML = '<center><img src="recursos/general/cargando2-gif.gif" alt="Cargando..."></center>';
  }

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_producto":id_producto, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaKardex.php',
        success: function(data) {
        document.getElementById("incrustarTablaKardex").innerHTML = data;

        activaTablaKardex();
    
      
    
        }

        });


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    if(id_producto !== "" && no_rango !== ""){
      $("#btnCardBusqueda").trigger('click');
    document.getElementById("incrustarTablaKardex").innerHTML = "";
    document.getElementById("incrustarTablaKardex").innerHTML = '<center><img src="recursos/general/cargando2-gif.gif" alt="Cargando..."></center>';
  }

    
    var parametros = {"no_rango":no_rango, "id_producto":id_producto, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaKardex.php',
        success: function(data) {
        document.getElementById("incrustarTablaKardex").innerHTML = data;

        activaTablaKardex();
    
      
    
        }

        });

  }

  //mostrarGafico(parametros);
});












$(document).on("click", ".applyBtn", function(){

var id_sucursal = $("#id_sucursal").val();
var no_rango = $("#no_rango>option:selected").val();
var id_producto = $("#id_producto").val();


  var rango_fecha = $('#rango_fecha').val();

  if(id_producto !== "" && no_rango !== ""){
    $("#btnCardBusqueda").trigger('click');
    document.getElementById("incrustarTablaKardex").innerHTML = "";
  document.getElementById("incrustarTablaProductos").innerHTML = "";
    document.getElementById("incrustarTablaKardex").innerHTML = '<center><img src="recursos/general/cargando2-gif.gif" alt="Cargando..."></center>';
  }

                    
var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_producto":id_producto, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaKardex.php',
        success: function(data) {
        document.getElementById("incrustarTablaKardex").innerHTML = data;

        activaTablaKardex();
    
      
    
        }

        });

        //mostrarGafico(parametros);

});







/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFReporteEspecificoProductos", function(){


                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var id_producto = $("#id_producto").val();
                var descripcion_producto = $("#descripcion_producto").val();

                if(id_producto == "" || no_rango == ""){
                  return;
                }else{
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-especifico-productos.php?id_producto="+id_producto+"&descripcion_producto="+descripcion_producto+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteEspecificoProductos", function(){


                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var id_producto = $("#id_producto").val();
                var descripcion_producto = $("#descripcion_producto").val();




                if(id_producto == "" || no_rango == ""){
                  return;
                }else{
                                  
                  window.open("vistas/modulos/reportesExcel/excel-reporte-especifico-productos.php?id_producto="+id_producto+"&descripcion_producto="+descripcion_producto+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha, "_blank");

              }
                
        });
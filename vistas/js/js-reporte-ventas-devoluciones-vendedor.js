function activaTablaReporteVentasDevolucionesVendedor() {

                $("#tablaReporteVentasDevolucionesVendedor").DataTable({
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
        order: [1, 'asc']
    });
  }





 


$('#no_rango').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var nombre_sucursal = $("#nombre_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = "";
  document.getElementById("incrustarRangoFecha").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== ""){
    document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }

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

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasDevolucionesVendedor.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = data;

        
    activaTablaReporteVentasDevolucionesVendedor();
      
    
        }

        });


  }else{

    
    var parametros = {"no_rango":no_rango, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasDevolucionesVendedor.php',
        
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = data;

        
    activaTablaReporteVentasDevolucionesVendedor();
      
    
        }

        });

  }
});









$('#id_sucursal').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var nombre_sucursal = $("#id_sucursal").text();
  $("#nombreSucursal").val(nombre_sucursal);
  document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== ""){
    document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasDevolucionesVendedor.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = data;

        
    activaTablaReporteVentasDevolucionesVendedor();
      
    
        }

        });


  }else{

    
    var parametros = {"no_rango":no_rango, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasDevolucionesVendedor.php',
        success: function(data) {
          //$("#cargando").show();
        document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = data;

        
    activaTablaReporteVentasDevolucionesVendedor();
      
    
        }

        });

  }
});












$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== ""){
    document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }


                    var rango_fecha = $('#rango_fecha').val();

                    
var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasDevolucionesVendedor.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasDevolucionesVendedor").innerHTML = data;

        
    activaTablaReporteVentasDevolucionesVendedor();
      
    
        }

        });

});










/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFReporteVentasDevolucionesVendedor", function(){

                var no_rango = $("#no_rango").val();

                var id_sucursal = $("#id_sucursal").val();

                var rango_fecha = $('#rango_fecha').val();


                if(no_rango == "" || id_sucursal == ""){
                  return;
                }else if(no_rango !== "" || id_sucursal !== ""){
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-ventas-devoluciones-vendedor.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteVentasDevolucionesVendedor", function(){

                var no_rango = $("#no_rango").val();

                var id_sucursal = $("#id_sucursal").val();

                var rango_fecha = $('#rango_fecha').val();

                if(no_rango == "" || id_sucursal == ""){
                  return;
                }else if(no_rango !== "" || id_sucursal !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/reportesExcel/excel-reporte-ventas-devoluciones-vendedor.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");

                }


                
        });
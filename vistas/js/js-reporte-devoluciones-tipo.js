
function activaTablaReporteDevolucionesTipo() {

                $("#tablaReporteDevolucionesTipo").DataTable({
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
        order: [[0, 'desc']],
    });
  }









function incrustarTablaReporteDevolucionesTipo(parametros){

  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteDevolucionesTipo.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = data;

        
    activaTablaReporteDevolucionesTipo();
      
    
        }

        });

}













$('#no_rango').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = "";
  document.getElementById("incrustarRangoFecha").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
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

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        
incrustarTablaReporteDevolucionesTipo(parametros);

  }else{

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteDevolucionesTipo(parametros);

  }
});







$('#id_sucursal').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteDevolucionesTipo(parametros);


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteDevolucionesTipo(parametros);

  }
});









$('#tipo').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteDevolucionesTipo(parametros);


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteDevolucionesTipo(parametros);

  }
});










$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteDevolucionesTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
       incrustarTablaReporteDevolucionesTipo(parametros);

});













/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFReporteDevolucionesTipo", function(){


                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();
                
                var nombre_sucursal = $("#nombre_sucursal").val();

                var id_sucursal = $("#id_sucursal").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  


                if(tipo == "FC"){
                window.open("extensiones/tcpdf/examples/pdf-reporte-devoluciones-tipo-factura.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");
                  }else{
                window.open("extensiones/tcpdf/examples/pdf-reporte-devoluciones-tipo.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");

                  }
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteDevolucionesTipo", function(){

                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();

                var id_sucursal = $("#id_sucursal").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  if(tipo == "FC"){
                    window.open("vistas/modulos/reportesExcel/excel-reporte-devoluciones-tipo-factura.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");
                  }else{
                    window.open("vistas/modulos/reportesExcel/excel-reporte-devoluciones-tipo.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");

                  }
                  
              }


                


                
        });










        /*=============================================
        DESCARGAR PDF
        =============================================*/
        $(document).on("click", ".btnDescargarPDF", function(){

                var id_devolucion = $(this).attr("id_devolucion");

                var rfc = $(this).attr("rfc");


                if(id_devolucion == "" || rfc == ""){
                  return;
                }else if(id_devolucion !== "" || rfc !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/botonesDescarga/descargar-pdf.php?id_devolucion="+id_devolucion+"&rfc="+rfc, "_blank");

                }


                
        });









        /*=============================================
        DERCARGAR XML
        =============================================*/
        $(document).on("click", ".btnDescargarXML", function(){

                var id_devolucion = $(this).attr("id_devolucion");

                var rfc = $(this).attr("rfc");


                if(id_devolucion == "" || rfc == ""){
                  return;
                }else if(id_devolucion !== "" || rfc !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/botonesDescarga/descargar-xml.php?id_devolucion="+id_devolucion+"&rfc="+rfc, "_blank");

                }


                
        });

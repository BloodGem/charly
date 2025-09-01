
function activaTablaReporteVentasTipo() {

                $("#tablaReporteVentasTipo").DataTable({
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









function incrustarTablaReporteVentasTipo(parametros){

  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasTipo.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = data;

        
    activaTablaReporteVentasTipo();
      
    
        }

        });

}













$('#no_rango').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = "";
  document.getElementById("incrustarRangoFecha").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
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
        
incrustarTablaReporteVentasTipo(parametros);

  }else{

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteVentasTipo(parametros);

  }
});







$('#id_sucursal').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteVentasTipo(parametros);


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteVentasTipo(parametros);

  }
});









$('#tipo').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteVentasTipo(parametros);


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteVentasTipo(parametros);

  }
});










$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteVentasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
       incrustarTablaReporteVentasTipo(parametros);

});













/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFReporteVentasTipo", function(){


                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();
                
                var nombre_sucursal = $("#nombre_sucursal").val();

                var id_sucursal = $("#id_sucursal").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  


                if(tipo == "FC"){
                window.open("extensiones/tcpdf/examples/pdf-reporte-ventas-tipo-factura.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");
                  }else{
                window.open("extensiones/tcpdf/examples/pdf-reporte-ventas-tipo.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");

                  }
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteVentasTipo", function(){

                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();

                var id_sucursal = $("#id_sucursal").val();

                var nombre_sucursal = $("#nombre_sucursal").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  if(tipo == "FC"){
                    window.open("vistas/modulos/reportesExcel/excel-reporte-ventas-tipo-factura.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");
                  }else{
                    window.open("vistas/modulos/reportesExcel/excel-reporte-ventas-tipo.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");

                  }
                  
              }


                


                
        });










        /*=============================================
        DESCARGAR PDF
        =============================================*/
        $(document).on("click", ".btnDescargarPDF", function(){

                var id_venta = $(this).attr("id_venta");

                var rfc = $(this).attr("rfc");


                if(id_venta == "" || rfc == ""){
                  return;
                }else if(id_venta !== "" || rfc !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/botonesDescarga/descargar-pdf.php?id_venta="+id_venta+"&rfc="+rfc, "_blank");

                }


                
        });









        /*=============================================
        DERCARGAR XML
        =============================================*/
        $(document).on("click", ".btnDescargarXML", function(){

                var id_venta = $(this).attr("id_venta");


                if(id_venta == ""){
                  return;
                }else if(id_venta !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/descargarArchivo.php?no_archivo=3&id_venta="+id_venta, "_blank");

                }


                
        });










/*=============================================
        DERCARGAR XML
        =============================================*/
        $(document).on("click", ".btnDescargarPDF", function(){

                var id_venta = $(this).attr("id_venta");

                if(id_venta == ""){
                  return;
                }else if(id_venta !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/descargarArchivo.php?no_archivo=2&id_venta="+id_venta, "_blank");

                }


                
        });
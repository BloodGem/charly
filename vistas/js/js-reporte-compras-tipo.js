
function activaTablaReporteComprasTipo() {

                $("#tablaReporteComprasTipo").DataTable({
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









function incrustarTablaReporteComprasTipo(parametros){

  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteComprasTipo.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = data;

        
    activaTablaReporteComprasTipo();
      
    
        }

        });

}












$(document).on("change", "#no_rango", function(){

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = "";
  document.getElementById("incrustarRangoFecha").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo !== ""){
    document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
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
        
incrustarTablaReporteComprasTipo(parametros);

  }else{

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteComprasTipo(parametros);

  }
});






$(document).on("change", "#id_sucursal", function(){

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteComprasTipo(parametros);


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteComprasTipo(parametros);

  }
});








$(document).on("change", "#tipo", function(){

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo !== ""){
    document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteComprasTipo(parametros);


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        incrustarTablaReporteComprasTipo(parametros);

  }
});










$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && tipo!== ""){
    document.getElementById("incrustarTablaReporteComprasTipo").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
       incrustarTablaReporteComprasTipo(parametros);

});













/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", "#btnExportarPDFReporteComprasTipo", function(){


                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();
      

                var id_sucursal = $("#id_sucursal").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  


                if(tipo == 1){
                window.open("extensiones/tcpdf/examples/pdf-reporte-compras-tipo-factura.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");
                  }else{
                window.open("extensiones/tcpdf/examples/pdf-reporte-compras-tipo.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");

                  }
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", "#btnExportarEXCELReporteComprasTipo", function(){

                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();

                var id_sucursal = $("#id_sucursal").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  if(tipo == 1){
                    window.open("vistas/modulos/reportesExcel/excel-reporte-compras-tipo-factura.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");
                  }else{
                    window.open("vistas/modulos/reportesExcel/excel-reporte-compras-tipo.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal, "_blank");

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

                var rfc = $(this).attr("rfc");


                if(id_venta == "" || rfc == ""){
                  return;
                }else if(id_venta !== "" || rfc !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/botonesDescarga/descargar-xml.php?id_venta="+id_venta+"&rfc="+rfc, "_blank");

                }


                
        });

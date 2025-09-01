


function activaTablaReporteVentasFormaPago() {

                $("#tablaReporteVentasFormaPago").DataTable({
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























$('#no_rango').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var forma_pago = $("#forma_pago>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = "";
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

var parametros = {"forma_pago":forma_pago, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasFormaPago.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = data;

        
    activaTablaReporteVentasFormaPago();
      
    
        }

        });


  }else{

    
    var parametros = {"forma_pago":forma_pago, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasFormaPago.php',
        success: function(data) {

        document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = data;

        
    activaTablaReporteVentasFormaPago();
      
    
        }

        });

  }
});







$('#id_sucursal').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var forma_pago = $("#forma_pago>option:selected").val();
  var nombre_sucursal = $("#id_sucursal>option:selected").text();
  $("#nombreSucursal").val(nombre_sucursal);
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = "";
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"forma_pago":forma_pago, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasFormaPago.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = data;

        
    activaTablaReporteVentasFormaPago();
      
    
        }

        });


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"forma_pago":forma_pago, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasFormaPago.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = data;

        
    activaTablaReporteVentasFormaPago();
      
    
        }

        });

  }
});









$('#forma_pago').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var forma_pago = $("#forma_pago>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = "";
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"forma_pago":forma_pago, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasFormaPago.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = data;

        
    activaTablaReporteVentasFormaPago();
      
    
        }

        });


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"forma_pago":forma_pago, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasFormaPago.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = data;

        
    activaTablaReporteVentasFormaPago();
      
    
        }

        });

  }
});










$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
  var forma_pago = $("#forma_pago>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = "";
  

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"forma_pago":forma_pago, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasFormaPago.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasFormaPago").innerHTML = data;

        
    activaTablaReporteVentasFormaPago();
                    
      
    
        }

        });

});













/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", "#btnExportarPDFReporteVentasFormaPago", function(){


                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var forma_pago = $("#forma_pago>option:selected").val();
                var nombre_forma_pago = $("#forma_pago>option:selected").text();
                var nombre_sucursal = $("#id_sucursal>option:selected").text();

                var id_sucursal = $("#id_sucursal").val();


                if(forma_pago == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-ventas-forma-pago.php?forma_pago="+forma_pago+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal+"&nombre_forma_pago="+nombre_forma_pago, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", "#btnExportarEXCELReporteVentasFormaPago", function(){

                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var forma_pago = $("#forma_pago>option:selected").val();
                var nombre_forma_pago = $("#forma_pago>option:selected").text();
                var nombre_sucursal = $("#id_sucursal>option:selected").text();


                var id_sucursal = $("#id_sucursal").val();


                if(forma_pago == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{

            
                  
                  window.open("vistas/modulos/reportesExcel/excel-reporte-ventas-forma-pago.php?forma_pago="+forma_pago+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal+"&nombre_forma_pago="+nombre_forma_pago, "_blank");

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

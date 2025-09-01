function activaTablaReporteDevolucionesVendedor() {

                $("#tablaReporteDevolucionesVendedor").DataTable({
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










 function incrustarTablaReporteDevolucionesVendedor(parametros){

  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteDevolucionesVendedor.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteDevolucionesVendedor").innerHTML = data;

        
    activaTablaReporteDevolucionesVendedor();
      
    
        }

        });

 }









$('#no_rango').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();

  document.getElementById("incrustarRangoFecha").innerHTML = "";
  document.getElementById("incrustarTablaReporteDevolucionesVendedor").innerHTML = "";
  

  if(no_rango !== "" && id_vendedor !== ""){
    document.getElementById("incrustarTablaReporteDevolucionesVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
    
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

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_vendedor":id_vendedor};
        
  incrustarTablaReporteDevolucionesVendedor(parametros);

  

  }else{

    
    var parametros = {"no_rango":no_rango, "id_vendedor":id_vendedor};

        incrustarTablaReporteDevolucionesVendedor(parametros);

        

  }
});









$('#id_vendedor').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var nombre_usuario = $("#id_vendedor>option:selected").text();
  $("#nombreSucursal").val(nombre_usuario);
  document.getElementById("incrustarTablaReporteDevolucionesVendedor").innerHTML = "";
  

  if(no_rango !== "" && id_vendedor !== ""){
    document.getElementById("incrustarTablaReporteDevolucionesVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
    
  }

  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_vendedor":id_vendedor};

        incrustarTablaReporteDevolucionesVendedor(parametros);

        


  }else{

    document.getElementById("incrustarRangoFecha").innerHTML = "";

    
    var parametros = {"no_rango":no_rango, "id_vendedor":id_vendedor};
        
        incrustarTablaReporteDevolucionesVendedor(parametros);


        

  }
});












$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
var id_vendedor = $("#id_vendedor>option:selected").val();
  document.getElementById("incrustarTablaReporteDevolucionesVendedor").innerHTML = "";
  

  if(no_rango !== "" && id_vendedor !== ""){
    document.getElementById("incrustarTablaReporteDevolucionesVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
    
  }



                    var rango_fecha = $('#rango_fecha').val();

                    
var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_vendedor":id_vendedor};
        
        incrustarTablaReporteDevolucionesVendedor(parametros);


        

});










/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFReporteDevolucionesVendedor", function(){

                var no_rango = $("#no_rango").val();

                var id_vendedor = $("#id_vendedor>option:selected").val();

                var nombre_usuario = $("#id_vendedor>option:selected").text();

                var rango_fecha = $('#rango_fecha').val();


                if(no_rango == "" || id_vendedor == ""){
                  return;
                }else if(no_rango !== "" && id_vendedor !== ""){
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-devoluciones-vendedor.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_vendedor="+id_vendedor+"&nombre_usuario="+nombre_usuario, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteDevolucionesVendedor", function(){

                var no_rango = $("#no_rango").val();

               var id_vendedor = $("#id_vendedor>option:selected").val();

                var nombre_usuario = $("#id_vendedor>option:selected").text();

                var rango_fecha = $('#rango_fecha').val();

                if(no_rango == "" || id_vendedor == ""){
                  return;
                }else if(no_rango !== "" && id_vendedor !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/reportesExcel/excel-reporte-devoluciones-vendedor.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_vendedor="+id_vendedor, "_blank");

                }


                
        });










/*=============================================
        EXPORTAR PDF VENTAS DE PRODUCTOS POR VENDEDORES GENERALES
        =============================================*/
        $(document).on("click", "#btnExportarPDFReporteDevolucionesProductosVendedoresGenerales", function(){

                var no_rango = $("#no_rango").val();

                var rango_fecha = $('#rango_fecha').val();


                if(no_rango == ""){
                  return;
                }else if(no_rango !== ""){
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-devoluciones-productos-vendedores-generales.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha, "_blank");
              }
        });





        $(document).on("click", "#btnExportarEXCELReporteDevolucionesProductosVendedoresGenerales", function(){

                var no_rango = $("#no_rango").val();

                var rango_fecha = $('#rango_fecha').val();

                if(no_rango == ""){
                  return;
                }else if(no_rango !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/reportesExcel/excel-reporte-devoluciones-productos-vendedores-generales.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha, "_blank");

                }


                
        });
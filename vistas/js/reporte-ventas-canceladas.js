


function activaTablaReporteVentasCanceladas() {

                $("#tablaReporteVentasCanceladas").DataTable({
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
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal>option:selected").val();
  document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = "";
  document.getElementById("incrustarRangoFechaReporteVentasCanceladas").innerHTML = "";
  if(no_rango == 9){

                    document.getElementById("incrustarRangoFechaReporteVentasCanceladas").innerHTML =
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
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasCanceladas.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = data;

        
    activaTablaReporteVentasCanceladas();
      
    
        }

        });


  }else{

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasCanceladas.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = data;

        
    activaTablaReporteVentasCanceladas();
      
    
        }

        });

  }
});







$('#id_sucursal').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  var nombre_sucursal = $("#id_sucursal>option:selected").text();
  $("#nombreSucursal").val(nombre_sucursal);
  var id_sucursal = $("#id_sucursal>option:selected").val();
  document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = "";
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasCanceladas.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = data;

        
    activaTablaReporteVentasCanceladas();
      
    
        }

        });


  }else{

    document.getElementById("incrustarRangoFechaReporteVentasCanceladas").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasCanceladas.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = data;

        
    activaTablaReporteVentasCanceladas();
      
    
        }

        });

  }
});









$('#tipo').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal>option:selected").val();
  document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = "";
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasCanceladas.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = data;

        
    activaTablaReporteVentasCanceladas();
      
    
        }

        });


  }else{

    document.getElementById("incrustarRangoFechaReporteVentasCanceladas").innerHTML = "";

    
    var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasCanceladas.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = data;

        
    activaTablaReporteVentasCanceladas();
      
    
        }

        });

  }
});










$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
  var tipo = $("#tipo>option:selected").val();
  
  var id_sucursal = $("#id_sucursal>option:selected").val();
  document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = "";
  

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"tipo":tipo, "no_rango":no_rango, "rango_fecha":rango_fecha, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasCanceladas.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasCanceladas").innerHTML = data;

        
    activaTablaReporteVentasCanceladas();
                    
      
    
        }

        });

});













/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFReporteVentasCanceladas", function(){


                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();
                
                var nombre_sucursal = $("#nombreSucursal").val();

                var id_sucursal = $("#id_sucursal>option:selected").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  

                window.open("extensiones/tcpdf/examples/ventas-canceladas.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteVentasCanceladas", function(){

                var rango_fecha = $('#rango_fecha').val();

                var no_rango = $("#no_rango>option:selected").val();
                var tipo = $("#tipo>option:selected").val();
                

                var id_sucursal = $("#id_sucursal>option:selected").val();

                var nombre_sucursal = $("#nombreSucursal").val();


                if(tipo == "" || no_rango == "" || id_sucursal == ""){
                  return;
                }else{
                  
                  window.open("vistas/modulos/reportesExcel/ventas-canceladas.php?tipo="+tipo+"&no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");

              }


                


                
        });
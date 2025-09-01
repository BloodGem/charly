function activaTablaVentasClientes() {

                $("#tablaVentasClientes").DataTable({
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
  var id_cliente = $("#id_cliente>option:selected").val();
  document.getElementById("incrustarTablaVentasClientes").innerHTML = "";
  document.getElementById("incrustarRangoFechaVentasClientes").innerHTML = "";
  if(no_rango == 7){

                    document.getElementById("incrustarRangoFechaVentasClientes").innerHTML =
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

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_cliente":id_cliente};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultaArchivo/consultaVentasClientes.php',
        success: function(data) {
        document.getElementById("incrustarTablaVentasClientes").innerHTML = data;

        
    activaTablaVentasClientes();
      
    
        }

        });


  }else{

    
    var parametros = {"no_rango":no_rango, "id_cliente":id_cliente};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultaArchivo/consultaVentasClientes.php',
        success: function(data) {
        document.getElementById("incrustarTablaVentasClientes").innerHTML = data;

        
    activaTablaVentasClientes();
      
    
        }

        });

  }
});









$('#id_cliente').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_cliente = $("#id_cliente>option:selected").val();
  var nombre_cliente = $("#id_cliente>option:selected").text();
  $("#nombreCliente").val(nombre_cliente);
  document.getElementById("incrustarTablaVentasClientes").innerHTML = "";
  
  if(no_rango == 7){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_cliente":id_cliente};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultaArchivo/consultaVentasClientes.php',
        success: function(data) {
        document.getElementById("incrustarTablaVentasClientes").innerHTML = data;

        
    activaTablaVentasClientes();
      
    
        }

        });


  }else{

    document.getElementById("incrustarRangoFechaVentasClientes").innerHTML = "";

    
    var parametros = {"no_rango":no_rango, "id_cliente":id_cliente};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultaArchivo/consultaVentasClientes.php',
        success: function(data) {
        document.getElementById("incrustarTablaVentasClientes").innerHTML = data;

        
    activaTablaVentasClientes();
      
    
        }

        });

  }
});












$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
var id_cliente = $("#id_cliente>option:selected").val();
  document.getElementById("incrustarTablaVentasClientes").innerHTML = "";


                    var rango_fecha = $('#rango_fecha').val();

                    
var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_cliente":id_cliente};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultaArchivo/consultaVentasClientes.php',
        success: function(data) {
        document.getElementById("incrustarTablaVentasClientes").innerHTML = data;

        
    activaTablaVentasClientes();
      
    
        }

        });

});










/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFVentasClientes", function(){

                var no_rango = $("#no_rango").val();

                var id_cliente = $("#id_cliente").val();

                var nombre_cliente = $("#nombreCliente").val();

                var rango_fecha = $('#rango_fecha').val();


                if(no_rango == ""){
                  return;
                }else if(no_rango !== ""){
                  

                window.open("extensiones/tcpdf/examples/ventas-clientes.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_cliente="+id_cliente+"&nombre_cliente="+nombre_cliente, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELVentasClientes", function(){

                var no_rango = $("#no_rango").val();

                var id_cliente = $("#id_cliente").val();

                var nombre_cliente = $("#nombreCliente").val();

                var rango_fecha = $('#rango_fecha').val();

                if(no_rango == ""){
                  return;
                }else if(no_rango !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/reportesExcel/ventas-clientes.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_cliente="+id_cliente+"&nombre_cliente="+nombre_cliente, "_blank");

                }


                
        });

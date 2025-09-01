function activaTablaReporteProductosSinMovimiento() {

                $("#tablaReporteProductosSinMovimiento").DataTable({
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
        order: [0, 'desc']
    });
  }





 


$('#no_meses').on('change', function() {

  var no_meses = $("#no_meses").val();
  var id_sucursal = $("#id_sucursal").val();

  document.getElementById("incrustarTablaReporteProductosSinMovimiento").innerHTML = "";
  document.getElementById("incrustarRangoFecha").innerHTML = "";

  if(no_meses !== "" && id_sucursal !== ""){
    document.getElementById("incrustarTablaReporteProductosSinMovimiento").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }

  

    
    var parametros = {"no_meses":no_meses, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteProductosSinMovimiento.php',
        
        success: function(data) {
        document.getElementById("incrustarTablaReporteProductosSinMovimiento").innerHTML = data;

        
    activaTablaReporteProductosSinMovimiento();
      
    
        }

        });

  
});










/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarPDFReporteProductosSinMovimiento", function(){

                var no_meses = $("#no_meses").val();

                var id_sucursal = $("#id_sucursal").val();


                if(no_meses == "" || id_sucursal == ""){
                  return;
                }else if(no_meses !== "" || id_sucursal !== ""){
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-productos-sin-movimiento.php?no_meses="+no_meses+"&id_sucursal="+id_sucursal, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteProductosSinMovimiento", function(){

                var no_meses = $("#no_meses").val();

                var id_sucursal = $("#id_sucursal").val();

                if(no_meses == "" || id_sucursal == ""){
                  return;
                }else if(no_meses !== "" || id_sucursal !== ""){
                  //alert(no_meses);

                window.open("vistas/modulos/reportesExcel/excel-reporte-productos-sin-movimiento.php?no_meses="+no_meses+"&id_sucursal="+id_sucursal, "_blank");

                }


                
        });
function activaTablaReporteDeProductosPorAnaquel() {

                $("#tablaReporteDeProductosPorAnaquel").DataTable({
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
        order: [2, 'asc']
    });
  }











  function incrustarTablaReporteDeProductosPorAnaquel(){

    var anaquel = $("#anaquel").val();
  var id_sucursal = $("#id_sucursal").val();
  document.getElementById("incrustarTablaReporteDeProductosPorAnaquel").innerHTML = "";

  if(id_sucursal !== "" && anaquel !== ""){
    document.getElementById("incrustarTablaReporteDeProductosPorAnaquel").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
  

    
    var parametros = {"id_sucursal":id_sucursal, "anaquel":anaquel};

  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteDeProductosPorAnaquel.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteDeProductosPorAnaquel").innerHTML = data;

        
        activaTablaReporteDeProductosPorAnaquel();
      
    
        }

        });

}










$('#id_sucursal').on('change', function() {

        incrustarTablaReporteDeProductosPorAnaquel();

  
});











$('#anaquel').on('keyup', function() {

        incrustarTablaReporteDeProductosPorAnaquel();

  
});










$('#btnRefrescarTablaReporteDeProductosPorAnaquel').on('click', function() {

  
        incrustarTablaReporteDeProductosPorAnaquel();

  
});










  /*=============================================
        EXPORTAR PDF
        =============================================*/
        $(document).on("click", "#btnExportarPDFReporteDeProductosPorAnaquel", function(){

                var id_sucursal = $("#id_sucursal").val();

                var anaquel = $("#anaquel").val();

                if(id_sucursal == ""){
                  return;
                }else if(id_sucursal !== ""){
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-productos-anaquel.php?id_sucursal="+id_sucursal+"&anaquel="+anaquel, "_blank");
              }
        });

/*=============================================
        GENERAR EXCEL DEL RESUTRIDO
        =============================================*/
        $(document).on("click", "#btnExportarEXCELReporteDeProductosPorAnaquel", function(){

                var anaquel = $("#anaquel").val();
                var id_sucursal = $("#id_sucursal").val();


                if(id_sucursal == ""){
                  return;
                }else if(id_sucursal !== ""){
                  
                  window.open("vistas/modulos/reportesExcel/excel-reporte-productos-anaquel.php?id_sucursal="+id_sucursal+"&anaquel="+anaquel, "_blank");

              }


                


                
        });
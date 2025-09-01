function activaTablaReporteProductosSinExistencias() {

                $("#tablaReporteProductosSinExistencias").DataTable({
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



$( document ).ready(function() {

    activaTablaReporteProductosSinExistencias();
});









/*=============================================
        GENERAR EXCEL DEL RESUTRIDO
        =============================================*/
        $(document).on("click", "#btnExportarEXCELReporteProductosSinExistencias", function(){

                var id_resurtido = $(this).attr("id_resurtido");


                if(id_resurtido == ""){
                  return;
                }else{
                  
                  window.open("vistas/modulos/reportesExcel/excel-reporte-productos-sin-existencias.php", "_blank");

              }


                


                
        });
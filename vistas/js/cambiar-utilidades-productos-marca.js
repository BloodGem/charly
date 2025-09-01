function activaTablaProductosMarca() {

                $("#tablaProductosMarca").DataTable({
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
    id_marca = $("#id_marca_get").val();

    $("#id_marca").val(id_marca);

    if(id_marca !== ""){
    document.getElementById("incrustarTablaProductosMarca").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }

    
    var parametros = {"id_marca":id_marca};
        incrustarTablaProductosMarca(parametros);
});










function incrustarTablaProductosMarca(parametros){
  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaExistenciasProductosMarcaCUPM.php',
        success: function(data) {
        document.getElementById("incrustarTablaProductosMarca").innerHTML = data;

        
    activaTablaProductosMarca();
      
    
        }

        });
}







 


$(document).on("change", "#id_marca", function(){

  var id_marca = $("#id_marca>option:selected").val();
  
  document.getElementById("incrustarTablaProductosMarca").innerHTML = "";

  if(id_marca !== ""){
    document.getElementById("incrustarTablaProductosMarca").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }

    
    var parametros = {"id_marca":id_marca};
        incrustarTablaProductosMarca(parametros);

  
});










$(document).on("click", "#btnCUPM", function(){

  var id_marca = $("#id_marca>option:selected").val();

  $("#modalCUPM").modal("show");

  $("#idMarcaCUPM").val(id_marca);

});










$(document).on("click", "#btnSubmitCUPM", function(){

  document.forms["formularioCUPM"].submit();

});
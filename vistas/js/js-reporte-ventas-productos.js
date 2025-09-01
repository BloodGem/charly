function activaTablaReporteVentasProductos() {

                $("#tablaReporteVentasProductos").DataTable({
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




function incrustarTablaReporteVentasProductos(parametros){
  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteVentasProductos.php',
        
        success: function(data) {
        document.getElementById("incrustarTablaReporteVentasProductos").innerHTML = data;

        
    activaTablaReporteVentasProductos();
      
    
        }

        });
}
 


  $(document).on("change", "#fechaInicial", function(){

  var fecha1 = $("#fechaInicial").val();
  var fecha2 = $("#fechaFinal").val();
  var id_sucursal = $("#id_sucursal").val();

  document.getElementById("incrustarTablaReporteVentasProductos").innerHTML = "";


  if(fecha1 !== "" && fecha2 !== "" && id_sucursal !== ""){
    document.getElementById("incrustarTablaReporteVentasProductos").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
 
    var parametros = {"fecha1":fecha1, "fecha2":fecha2, "id_sucursal":id_sucursal};
        
    incrustarTablaReporteVentasProductos(parametros);
  
});










  $(document).on("change", "#fechaFinal", function(){

  var fecha1 = $("#fechaInicial").val();
  var fecha2 = $("#fechaFinal").val();
  var id_sucursal = $("#id_sucursal").val();

  document.getElementById("incrustarTablaReporteVentasProductos").innerHTML = "";


  if(fecha1 !== "" && fecha2 !== "" && id_sucursal !== ""){
    document.getElementById("incrustarTablaReporteVentasProductos").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
 
    var parametros = {"fecha1":fecha1, "fecha2":fecha2, "id_sucursal":id_sucursal};
        
    incrustarTablaReporteVentasProductos(parametros);
  
});










  $(document).on("change", "#id_sucursal", function(){

  var fecha1 = $("#fechaInicial").val();
  var fecha2 = $("#fechaFinal").val();
  var id_sucursal = $("#id_sucursal").val();

  document.getElementById("incrustarTablaReporteVentasProductos").innerHTML = "";


  if(fecha1 !== "" && fecha2 !== "" && id_sucursal !== ""){
    document.getElementById("incrustarTablaReporteVentasProductos").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }
 
    var parametros = {"fecha1":fecha1, "fecha2":fecha2, "id_sucursal":id_sucursal};
        
    incrustarTablaReporteVentasProductos(parametros);
  
});










/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        /*$(document).on("click", ".btnExportarPDFReporteVentasProductos", function(){

                var fecha1 = $("fechaInicial").val();

                var id_sucursal = $("#id_sucursal").val();

                var nombre_sucursal = $("#nombre_sucursal").val();

                var rango_fecha = $('#rango_fecha').val();


                if(fecha1 == "" || id_sucursal == ""){
                  return;
                }else if(fecha1 !== "" || id_sucursal !== ""){
                  

                window.open("extensiones/tcpdf/examples/ventas_sucursales.php?fecha1="+fecha1+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&nombre_sucursal="+nombre_sucursal, "_blank");
              }
        });*/



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnExportarEXCELReporteVentasProductos", function(){

                var fecha1 = $("#fechaInicial").val();

                var fecha2 = $("#fechaFinal").val();

                var id_sucursal = $("#id_sucursal").val();


                if(fecha1 == "" || fecha2 == "" || id_sucursal == ""){
                  return;
                }else if(fecha1 !== "" || fecha2 !== "" || id_sucursal !== ""){
                  //alert(fecha1);

                window.open("vistas/modulos/reportesExcel/excel-reporte-ventas-productos.php?fecha1="+fecha1+"&fecha2="+fecha2+"&id_sucursal="+id_sucursal, "_blank");

                }


                
        });
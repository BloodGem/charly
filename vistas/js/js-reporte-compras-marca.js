function activaTablaReporteComprasMarca() {

                $("#tablaReporteComprasMarca").DataTable({
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










function incrustarTablaReporteComprasMarca(parametros){
  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultasReportes/consultaReporteComprasMarca.php',
        success: function(data) {
        document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = data;

        
    activaTablaReporteComprasMarca();
      
    
        }

        });
}










function incrustarSelectProveedoresReporteComprasMarca(parametros){
  $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/selects/selectProveedoresReporteComprasMarca.php',
        success: function(data) {
        document.getElementById("incrustarSelectProveedoresReporteComprasMarca").innerHTML = data;

        
          $("#id_proveedor").select2();
      
    
        }

        });
}







 


$('#no_rango').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_proveedor = $("#id_proveedor>option:selected").val();

  document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = "";
  document.getElementById("incrustarRangoFecha").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== "" && id_proveedor !== ""){
    document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
    
  }


  document.getElementById("incrustarSelectProveedoresReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== ""){
    var parametrosSelect = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal};
    incrustarSelectProveedoresReporteComprasMarca(parametrosSelect);
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

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
        
  incrustarTablaReporteComprasMarca(parametros);

  }else{

    
    var parametros = {"no_rango":no_rango, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
        incrustarTablaReporteComprasMarca(parametros);

  }
});










$('#id_marca').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_proveedor = $("#id_proveedor>option:selected").val();
  
  document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== "" && id_proveedor !== ""){
    document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }


  document.getElementById("incrustarSelectProveedoresReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== ""){
    var parametrosSelect = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal};
    incrustarSelectProveedoresReporteComprasMarca(parametrosSelect);
  }

  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
  incrustarTablaReporteComprasMarca(parametros);


  }else{

    
    var parametros = {"no_rango":no_rango, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
        incrustarTablaReporteComprasMarca(parametros);

  }
});









$('#id_sucursal').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_proveedor = $("#id_proveedor>option:selected").val();
  
  document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== "" && id_proveedor !== ""){
    document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }


  document.getElementById("incrustarSelectProveedoresReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== ""){
    var parametrosSelect = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal};
    incrustarSelectProveedoresReporteComprasMarca(parametrosSelect);
  }
  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
    incrustarTablaReporteComprasMarca(parametros);


  }else{

    
    var parametros = {"no_rango":no_rango, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
        incrustarTablaReporteComprasMarca(parametros);

  }
});












$(document).on("click", ".applyBtn", function(){

var no_rango = $("#no_rango>option:selected").val();
var id_marca = $("#id_marca>option:selected").val();
var id_sucursal = $("#id_sucursal").val();
var id_proveedor = $("#id_proveedor>option:selected").val();

  document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== "" && id_proveedor !== ""){
    document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }


  document.getElementById("incrustarSelectProveedoresReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== ""){
    var parametrosSelect = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal};
    incrustarSelectProveedoresReporteComprasMarca(parametrosSelect);
  }


                    var rango_fecha = $('#rango_fecha').val();

                    
var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
        incrustarTablaReporteComprasMarca(parametros);

});









$(document).on("change", "#id_proveedor", function(){

  var no_rango = $("#no_rango>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_proveedor = $("#id_proveedor>option:selected").val();
  
  document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = "";

  if(no_rango !== "" && id_marca !== "" && id_sucursal !== "" && id_proveedor !== ""){
    document.getElementById("incrustarTablaReporteComprasMarca").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }



  
  if(no_rango == 9){

                    

                    var rango_fecha = $('#rango_fecha').val();

var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
  incrustarTablaReporteComprasMarca(parametros);


  }else{

    
    var parametros = {"no_rango":no_rango, "id_marca":id_marca, "id_sucursal":id_sucursal, "id_proveedor":id_proveedor};
        incrustarTablaReporteComprasMarca(parametros);

  }
});









/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", "#btnExportarPDFReporteComprasMarca", function(){

                var no_rango = $("#no_rango>option:selected").val();
                var id_marca = $("#id_marca>option:selected").val();
                var id_sucursal = $("#id_sucursal").val();
                var id_proveedor = $("#id_proveedor>option:selected").val();

                var rango_fecha = $('#rango_fecha').val();


                if(no_rango == "" && id_marca == "" && id_sucursal == ""){
                  return;
                }else if(no_rango !== "" && id_marca !== "" && id_sucursal !== ""){
                  

                window.open("extensiones/tcpdf/examples/pdf-reporte-compras-generales-marca.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&id_marca="+id_marca+"&id_proveedor="+id_proveedor, "_blank");
              }
        });



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", "#btnExportarEXCELReporteComprasMarca", function(){

                var no_rango = $("#no_rango>option:selected").val();
                var id_marca = $("#id_marca>option:selected").val();
                var id_sucursal = $("#id_sucursal").val();
                var id_proveedor = $("#id_proveedor>option:selected").val();

                var rango_fecha = $('#rango_fecha').val();

                if(no_rango == "" && id_marca == "" && id_sucursal == ""){
                  return;
                }else if(no_rango !== "" && id_marca !== "" && id_sucursal !== ""){
                  //alert(no_rango);

                window.open("vistas/modulos/reportesExcel/excel-reporte-compras-marca.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&id_marca="+id_marca+"&id_proveedor="+id_proveedor, "_blank");

                }


                
        });
function activaTablaReporteVentasMarcaVendedor() {

  $("#tablaReporteVentasMarcaVendedor").DataTable({
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










function incrustarTablaReporteVentasMarcaVendedor(parametros){
  $.ajax({
    data:parametros,
    type: 'POST',
    url: 'vistas/modulos/consultasReportes/consultaReporteVentasMarcaVendedor.php',
    success: function(data) {
      document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = data;


      activaTablaReporteVentasMarcaVendedor();
      

    }

  });
}










function incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros){
  document.getElementById("incrustarSelectVendedoresReporteVentasMarcaVendedor").innerHTML = "";
  $.ajax({
    data:parametros,
    type: 'POST',
    url: 'vistas/modulos/selects/selectVendedoresReporteVentasMarcaVendedor.php',
    success: function(data) {
      document.getElementById("incrustarSelectVendedoresReporteVentasMarcaVendedor").innerHTML = data;


      $("#id_vendedor").select2();
      

    }

  });
}










$('#no_rango').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();

  document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = "";
  document.getElementById("incrustarRangoFecha").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && id_vendedor !== "" && id_marca !== ""){
    document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
    
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

    var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};

    incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros);
    incrustarTablaReporteVentasMarcaVendedor(parametros);

  }else{


    var parametros = {"no_rango":no_rango, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};

    incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros);

    incrustarTablaReporteVentasMarcaVendedor(parametros);

  }
});










$('#id_marca').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();
  
  document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && id_vendedor !== "" && id_marca !== ""){
    document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }



  
  if(no_rango == 9){



    var rango_fecha = $('#rango_fecha').val();

    var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};

    incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros);
    
    incrustarTablaReporteVentasMarcaVendedor(parametros);


  }else{


    var parametros = {"no_rango":no_rango, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};

    incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros);
    
    incrustarTablaReporteVentasMarcaVendedor(parametros);

  }
});









$('#id_sucursal').on('change', function() {

  var no_rango = $("#no_rango>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();
  
  document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && id_vendedor !== "" && id_marca !== ""){
    document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }


  if(no_rango == 9){

    var rango_fecha = $('#rango_fecha').val();

    var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};

    incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros);

    incrustarTablaReporteVentasMarcaVendedor(parametros);


  }else{


    var parametros = {"no_rango":no_rango, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};

    incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros);

    incrustarTablaReporteVentasMarcaVendedor(parametros);

  }
});












$(document).on("click", ".applyBtn", function(){

  var no_rango = $("#no_rango>option:selected").val();
  var id_sucursal = $("#id_sucursal").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();

  document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && id_vendedor !== "" && id_marca !== ""){
    document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }



  var rango_fecha = $('#rango_fecha').val();


  var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};

  incrustarSelectVendedoresReporteVentasMarcaVendedor(parametros);

  incrustarTablaReporteVentasMarcaVendedor(parametros);

});









$(document).on("change", "#id_vendedor", function(){

  var no_rango = $("#no_rango>option:selected").val();
  
  var id_sucursal = $("#id_sucursal").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var id_marca = $("#id_marca>option:selected").val();
  
  document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = "";

  if(no_rango !== "" && id_sucursal !== "" && id_vendedor !== "" && id_marca !== ""){
    document.getElementById("incrustarTablaReporteVentasMarcaVendedor").innerHTML = '<center><img class="cargando" src="vistas/img/plantilla/cargando2.gif" alt="Cargando..."></center>';
  }



  
  if(no_rango == 9){



    var rango_fecha = $('#rango_fecha').val();

    var parametros = {"no_rango":no_rango, "rango_fecha":rango_fecha, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};
    incrustarTablaReporteVentasMarcaVendedor(parametros);


  }else{


    var parametros = {"no_rango":no_rango, "id_sucursal":id_sucursal, "id_vendedor":id_vendedor, "id_marca":id_marca};
    incrustarTablaReporteVentasMarcaVendedor(parametros);

  }
});









/*=============================================
        IMPRIMIR NOTA
        =============================================*/
$(document).on("click", "#btnExportarPDFReporteVentasMarcaVendedor", function(){

  var no_rango = $("#no_rango>option:selected").val(); 
  var id_sucursal = $("#id_sucursal").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var rango_fecha = $('#rango_fecha').val();
  var id_marca = $("#id_marca>option:selected").val();


  if(no_rango == "" && id_vendedor == "" && id_sucursal == "" && id_marca == ""){
    return;
  }else if(no_rango !== "" && id_vendedor !== "" && id_sucursal !== "" && id_marca !== ""){


    window.open("extensiones/tcpdf/examples/pdf-reporte-ventas-marca-vendedor.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&id_vendedor="+id_vendedor+"&id_marca="+id_marca, "_blank");
  }
});



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
$(document).on("click", "#btnExportarEXCELReporteVentasMarcaVendedor", function(){

  var no_rango = $("#no_rango>option:selected").val(); 
  var id_sucursal = $("#id_sucursal").val();
  var id_vendedor = $("#id_vendedor>option:selected").val();
  var rango_fecha = $('#rango_fecha').val();
  var id_marca = $("#id_marca>option:selected").val();

  if(no_rango == "" && id_vendedor == "" && id_sucursal == "" && id_marca == ""){
    return;
  }else if(no_rango !== "" && id_vendedor !== "" && id_sucursal !== "" && id_marca !== ""){
                  //alert(no_rango);

    window.open("vistas/modulos/reportesExcel/excel-reporte-ventas-marca-vendedor.php?no_rango="+no_rango+"&rango_fecha="+rango_fecha+"&id_sucursal="+id_sucursal+"&id_vendedor="+id_vendedor+"&id_marca="+id_marca, "_blank");

  }



});
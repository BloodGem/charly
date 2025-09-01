function activaTablaPartidasDevolucionCompra() {

                $("#tablaPartidasDevolucionCompra").DataTable({
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
        order: [[2, 'asc']],
    });
  }










  function buscarAhoraDevolucionesCompras(buscarDevolucionesCompras) {
                var parametros = {"buscarDevolucionesCompras":buscarDevolucionesCompras};
                $.ajax({
                        data:parametros,
                        type: 'POST',
                        url: 'vistas/modulos/buscadores/buscadorDevolucionesCompras.php',
                        success: function(data) {
                                document.getElementById("incrustarTablaDevolucionesCompras").innerHTML = data;
                        }
                });
        }










        $(document).on("click", ".btnVerPartidasDevolucionCompra", function(){

          //$(".close").hide();

    $("#buscarDevolucionesCompras").attr("teclaEsc", "no");

        var id_devolucion_compra = $(this).attr("id_devolucion_compra");
alert
var datos =  {"id_devolucion_compra": id_devolucion_compra};


$.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerPartidasDevolucionCompra.php',
        success: function(data) {

        $("#modalVerPartidasDevolucionCompra").modal("show");

        document.getElementById("incrustarTablaPartidasDevolucionCompra").innerHTML = data;
        activaTablaPartidasDevolucionCompra();
        }
        });

})










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarDevolucionesCompras").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarDevolucionesCompras").val("");
            $("#buscarDevolucionesCompras").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarDevolucionesCompras").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarDevolucionesCompras").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaDevolucionCompra").trigger('click');
        //$(".close").hide();
        $("#buscarDevolucionesCompras").attr("teclaEsc", "no");

        

    }
});








//AL PRESIONAR F4 PARA VER PARTIDAS DE LA DEVOLUCION
$(document).keydown(function(event) {
    if (event.which === 115)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerPartidasDevolucionCompra").trigger("click"); 

        //$(".close").hide();

        $("#buscarDevolucionesCompras").attr("teclaEsc", "no");

    }

        

    }
});










//AL PRESIONAR F6 PARA REIMPRIMIR UNA VENTA
$(document).keydown(function(event) {
    if (event.which === 117)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

            var contador_actual = $(foco).attr("contador");

            $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnReimprimirTicket").trigger("click"); 

            //$(".close").hide();

            $("#buscarDevolucionesCompras").attr("teclaEsc", "no");

        }

        

    }
});










//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarDevolucionesCompras").attr("teclaEsc");
        if(buscador_esc == "si"){
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("guardaFoco1"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);

            //alert("contador actual: "+contador_actual);

            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
        }else{

            setTimeout(function() { 

            //alert("si hay foco");


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            const verifica_foco_mas = document.getElementsByClassName("guardaFoco"+contador_mas);

            var foco_mas = verifica_foco_mas[0];

            const verifica_foco_menos = document.getElementsByClassName("guardaFoco"+contador_menos);

            var foco_menos = verifica_foco_menos[0];

            $(foco).removeClass("foco");

            $(foco).parent().parent().removeAttr("style");

            $(foco_menos).parent().parent().removeAttr("style");

            $(foco_mas).parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco_mas).addClass('foco');
            $(foco_mas).focus();
            //$(foco).focus();

            }, 100);
        }
        
        //alert('Ctrl + flecha abajo!');
        }

    }
});









//AL PRESIONAR CTRL + FLECHA ARRIBA
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 38)
    {
        var buscador_esc = $("#buscarDevolucionesCompras").attr("teclaEsc");
        if(buscador_esc == "si"){
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("guardaFoco1"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);

            //alert("contador actual: "+contador_actual);

            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
        }else{

            setTimeout(function() { 

            //alert("si hay foco");


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            const verifica_foco_mas = document.getElementsByClassName("guardaFoco"+contador_mas);

            var foco_mas = verifica_foco_mas[0];

            const verifica_foco_menos = document.getElementsByClassName("guardaFoco"+contador_menos);

            var foco_menos = verifica_foco_menos[0];

            $(foco).removeClass("foco");

            $(foco).parent().parent().removeAttr("style");

            $(foco_mas).parent().parent().removeAttr("style");

            $(foco_menos).parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco_menos).addClass('foco');
            $(foco_menos).focus();
            //$(foco).focus();

            }, 100);
        }
        
        //alert('Ctrl + flecha abajo!');
    }
    }
});










$(document).on("click", ".btnExportarPDFDevolucionCompra", function(){

  var id_devolucion_compra = $(this).attr("id_devolucion_compra");

  if(id_devolucion_compra == ""){
    return;
  }else if(id_devolucion_compra !== ""){


    window.open("extensiones/tcpdf/examples/pdf-devolucion-compra.php?id_devolucion_compra="+id_devolucion_compra, "_blank");
  }
});
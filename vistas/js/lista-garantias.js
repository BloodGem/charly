function activaTablaPartidasVentaSeleccionada() {

                $("#tablaPartidasVentaSeleccionada").DataTable({
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










  function activaTablaPartidasCompraSeleccionada() {

                $("#tablaPartidasCompraSeleccionada").DataTable({
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










  function buscarAhoraGarantias(buscarGarantias) {
                var parametros = {"buscarGarantias":buscarGarantias};
                $.ajax({
                        data:parametros,
                        type: 'POST',
                        url: 'vistas/modulos/buscadores/buscadorGarantias.php',
                        success: function(data) {
                                document.getElementById("incrustarTablaGarantias").innerHTML = data;
                        }
                });
        }










        $(document).on("click", ".btnVerPartidasGarantia", function(){

          //$(".close").hide();

    $("#buscarGarantias").attr("teclaEsc", "no");

        var id_garantia = $(this).attr("id_garantia");

var datos =  {"id_garantia": id_garantia};


$.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerPartidasGarantia.php',
        success: function(data) {

        $("#modalVerPartidasGarantia").modal("show");

        document.getElementById("incrustarTablaPartidasGarantia").innerHTML = data;
        activaTablaPartidasGarantia();
        }
        });

})










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarGarantias").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarGarantias").val("");
            $("#buscarGarantias").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarGarantias").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarGarantias").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaGarantia").trigger('click');
        //$(".close").hide();
        $("#buscarGarantias").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerPartidasGarantia").trigger("click"); 

        //$(".close").hide();

        $("#buscarGarantias").attr("teclaEsc", "no");

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

            $("#buscarGarantias").attr("teclaEsc", "no");

        }

        

    }
});










//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarGarantias").attr("teclaEsc");
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
        var buscador_esc = $("#buscarGarantias").attr("teclaEsc");
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










$(document).on("click", "#btnCrearNuevaGarantiaVenta", function(){ 

    //$(".close").hide();

    $("#buscarGarantias").attr("teclaEsc", "no");

    $("#modalCrearGarantiaVenta").modal("show");

});










$(document).on("change", "#nuevoIdVentaGarantia", function(){ 

    var id_venta = $("#nuevoIdVentaGarantia").val();

    var datos = new FormData();
    
    datos.append("id_venta", id_venta);

    $.ajax({

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(id_venta == respuesta['id']){

                $("#nuevoIdVentaGarantia").attr("style", "background-color: green; color: white;");

                $("#nuevoIdProductoVentaSeleccionado").val("");

                $("#nuevoIdProductoVentaSeleccionado").removeAttr("style");

    $("#mostrarClaveProductoVentaSeleccionado").val("");

    $("#nuevoPrecioNetoProductoVentaSeleccionado").val("");

    $("#nuevaCantidadProductoVentaSeleccionado").removeAttr("cantidad_disponible");
            }else{
                $("#nuevoIdVentaGarantia").attr("style", "background-color: red; color: white;");
            }

            
        }

    });
});




$(document).on("click", "#btnVerPartidasVentaSeleccionada", function(){ 

    //$(".close").hide();

    $("#buscarGarantias").attr("teclaEsc", "no");

    var id_venta = $("#nuevoIdVentaGarantia").val();

    var datos =  {"id_venta": id_venta};

    $.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/partidasVentaSeleccionadaGarantia.php',
        success: function(data) {

            $("#modalPartidasVentaSeleccionada").modal("show");

            document.getElementById("incrustarTablaPartidasVentaSeleccionada").innerHTML = data;
            activaTablaPartidasVentaSeleccionada();
        }
    });
    
});










$(document).on("click", ".btnSeleccionaProductoVenta", function(){ 

    var id_producto = $(this).attr("id_producto");

    var clave_producto = $(this).attr("clave_producto");

    var cantidad_disponible = $(this).attr("cantidad_disponible");

    var precio_neto = $(this).attr("precio_neto");

    if(cantidad_disponible == 0){
        Swal.fire({
                    icon: 'error',
                    title: 'No hay cantidad disponible',
                    showConfirmButton: true
                    });

        return;
    }else{
    
    $("#nuevoIdProductoVentaSeleccionado").val(id_producto);

    $("#nuevoIdProductoVentaSeleccionado").attr("style", "background-color: green; color: green;");

    $("#mostrarClaveProductoVentaSeleccionado").val(clave_producto);

    $("#nuevoPrecioNetoProductoVentaSeleccionado").val(precio_neto);

    $("#nuevaCantidadProductoVentaSeleccionado").attr("cantidad_disponible", cantidad_disponible);

    $(".close").trigger('click'); 
    }
    
});










$(document).on("change", "#nuevaCantidadProductoVentaSeleccionado", function(){ 
    var cantidad = $("#nuevaCantidadProductoVentaSeleccionado").val();
    var cantidad_disponible = $("#nuevaCantidadProductoVentaSeleccionado").attr("cantidad_disponible");

    if(cantidad > cantidad_disponible){
        Swal.fire({
                    icon: 'warning',
                    title: 'Cantidad insuficiente',
                    text: 'La cantidad disponible es: '+cantidad_disponible+'',
                    showConfirmButton: true
                    });

        $("#nuevaCantidadProductoVentaSeleccionado").val(cantidad_disponible);
    }

});


$(document).on("keyup", "#nuevaCantidadProductoVentaSeleccionado", function(){ 
    var cantidad = $("#nuevaCantidadProductoVentaSeleccionado").val();
    var cantidad_disponible = $("#nuevaCantidadProductoVentaSeleccionado").attr("cantidad_disponible");

    if(cantidad > cantidad_disponible){
        Swal.fire({
                    icon: 'warning',
                    title: 'Cantidad insuficiente',
                    text: 'La cantidad disponible es: '+cantidad_disponible+'',
                    showConfirmButton: true
                    });

        $("#nuevaCantidadProductoVentaSeleccionado").val(cantidad_disponible);
    }
});




















$(document).on("click", "#btnCrearNuevaGarantiaCompra", function(){ 

    //$(".close").hide();

    $("#buscarGarantias").attr("teclaEsc", "no");

    $("#modalCrearGarantiaCompra").modal("show");

});





function traerProveedorGarantia(id_proveedor) {

    var datos = new FormData();
    
    datos.append("id_proveedor", id_proveedor);

    $.ajax({

        url:"ajax/proveedores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $("#mostrarNombreProveedor").val(respuesta['nombre']);

        }

    });
}




$(document).on("change", "#nuevoIdCompraGarantia", function(){ 

    var id_compra = $("#nuevoIdCompraGarantia").val();

    var datos = new FormData();
    
    datos.append("id_compra2", id_compra);

    $.ajax({

        url:"ajax/compras.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(id_compra == respuesta['id']){

                $("#nuevoIdCompraGarantia").attr("style", "background-color: green; color: white;");

                $("#nuevoIdProductoCompraSeleccionado").val("");

                $("#nuevoIdProductoCompraSeleccionado").removeAttr("style");

    $("#mostrarClaveProductoCompraSeleccionado").val("");

    $("#nuevoPrecioNetoProductoCompraSeleccionado").val("");

    $("#nuevaCantidadProductoCompraSeleccionado").removeAttr("cantidad_disponible");

        traerProveedorGarantia(respuesta['id_proveedor']);
    
            }else{
                $("#nuevoIdCompraGarantia").attr("style", "background-color: red; color: white;");
            }

            
        }

    });
});




$(document).on("click", "#btnVerPartidasCompraSeleccionada", function(){ 

    //$(".close").hide();

    $("#buscarGarantias").attr("teclaEsc", "no");

    var id_compra = $("#nuevoIdCompraGarantia").val();

    var datos =  {"id_compra": id_compra};

    $.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/partidasCompraSeleccionadaGarantia.php',
        success: function(data) {

            $("#modalPartidasCompraSeleccionada").modal("show");

            document.getElementById("incrustarTablaPartidasCompraSeleccionada").innerHTML = data;
            activaTablaPartidasCompraSeleccionada();
        }
    });
    
});










$(document).on("click", ".btnSeleccionaProductoCompra", function(){ 

    var id_producto = $(this).attr("id_producto");

    var clave_producto = $(this).attr("clave_producto");

    var cantidad_disponible = $(this).attr("cantidad_disponible");

    var precio_neto = $(this).attr("precio_neto");

    if(cantidad_disponible == 0){
        Swal.fire({
                    icon: 'error',
                    title: 'No hay cantidad disponible',
                    showConfirmButton: true
                    });

        return;
    }else{
    
    $("#nuevoIdProductoCompraSeleccionado").val(id_producto);

    $("#nuevoIdProductoCompraSeleccionado").attr("style", "background-color: green; color: green;");

    $("#mostrarClaveProductoCompraSeleccionado").val(clave_producto);

    $("#nuevoPrecioNetoProductoCompraSeleccionado").val(precio_neto);

    $("#nuevaCantidadProductoCompraSeleccionado").attr("cantidad_disponible", cantidad_disponible);

    $(".close").trigger('click'); 
    }
    
});










$(document).on("change", "#nuevaCantidadProductoCompraSeleccionado", function(){ 
    var cantidad = $("#nuevaCantidadProductoCompraSeleccionado").val();
    var cantidad_disponible = $("#nuevaCantidadProductoCompraSeleccionado").attr("cantidad_disponible");

    if(cantidad > cantidad_disponible){
        Swal.fire({
                    icon: 'warning',
                    title: 'Cantidad insuficiente',
                    text: 'La cantidad disponible es: '+cantidad_disponible+'',
                    showConfirmButton: true
                    });

        $("#nuevaCantidadProductoCompraSeleccionado").val(cantidad_disponible);
    }

});


$(document).on("keyup", "#nuevaCantidadProductoCompraSeleccionado", function(){ 
    var cantidad = $("#nuevaCantidadProductoCompraSeleccionado").val();
    var cantidad_disponible = $("#nuevaCantidadProductoCompraSeleccionado").attr("cantidad_disponible");

    if(cantidad > cantidad_disponible){
        Swal.fire({
                    icon: 'warning',
                    title: 'Cantidad insuficiente',
                    text: 'La cantidad disponible es: '+cantidad_disponible+'',
                    showConfirmButton: true
                    });

        $("#nuevaCantidadProductoCompraSeleccionado").val(cantidad_disponible);
    }
});










$(document).on("click", ".btnAutorizarGarantia", function(){ 

    var id_garantia = $(this).attr("id_garantia");

    $("#autorizarGarantia").val(id_garantia);


    $("#modalAutorizarGarantia").modal("show");

    setTimeout(function() { 
        $("#btnCancelarAutorizarGarantia").focus();
    }, 150);

});










$(document).on("click", ".btnConfirmarGarantia", function(){ 

    var id_garantia = $(this).attr("id_garantia");

    $("#confirmarGarantia").val(id_garantia);


    $("#modalConfirmarGarantia").modal("show");

    setTimeout(function() { 
        $("#btnCancelarConfirmarGarantia").focus();
    }, 150);

});










$(document).on("click", ".btnSubmitAutorizarGarantia", function(){ 

    var tipo_cambio = $(this).attr("tipo_cambio");

    $("#tipoCambio").val(tipo_cambio);

    document.forms["formularioConfirmarGarantia"].submit();


});






$(document).on("click", ".btnEditarGarantiaProveedor", function(){ 

    var id_garantia = $(this).attr("id_garantia");

    $("#editarGarantiaProveedor").val(id_garantia);

    var datos = new FormData();
    
    datos.append("id_garantia", id_garantia);

    $.ajax({

        url:"ajax/garantias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            $("#modalEditarGarantiaProveedor").modal("show");

            $("#editarFechaEnvio").val(respuesta['fecha_envio']);
            $("#editarFechaRegreso").val(respuesta['fecha_regreso']);
            $("#editarValidaGarantia").val(respuesta['valida_garantia']);
            $("#editarObservaciones").val(respuesta['observaciones']);

        }

    });


    


});










$(document).on("click", ".btnConfirmar2Garantia", function(){ 

    var id_garantia = $(this).attr("id_garantia");

    $("#confirmar2Garantia").val(id_garantia);


    $("#modalConfirmar2Garantia").modal("show");

    setTimeout(function() { 
        $("#btnNoConfirmar2Garantia").focus();
    }, 150);


});










$(document).on("click", ".btnVerInformacionGarantia", function(){ 

    //$(".close").hide();

    $("#buscarGarantias").attr("teclaEsc", "no");

    var id_garantia = $(this).attr("id_garantia");

    var datos =  {"id_garantia": id_garantia};

    $.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaInformacionGarantia.php',
        success: function(data) {

            $("#modalInformacionGarantia").modal("show");

            document.getElementById("incrustarInformacionGarantia").innerHTML = data;
        }
    });
    
});
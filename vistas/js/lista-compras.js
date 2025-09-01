function activaTablaCompras() {

                $("#tablaCompras").DataTable({
      "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "No se encontraron resultados",
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
      "responsive": false, 
      "lengthChange": false, 
      "autoWidth": true,
      "scrollX": true,
        order: [[1, 'desc']],
    });
  }










function activaTablaPartidasCompra() {

                $("#tablaPartidasCompra").DataTable({
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





/*=============================================
BOTON EDITAR COMPRA
=============================================*/
$(document).on("click", ".btnEditarCompra", function(){

        var id_compra = $(this).attr("id_compra");

        window.location = "index.php?ruta=editar-compra&id_compra="+id_compra;


})








  function buscarAhoraCompras(buscarCompras) {

    document.getElementById("incrustarTablaCompras").innerHTML = "";

        var parametros = {"buscarCompras":buscarCompras};
        $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadores/buscadorCompras.php',
                success: function(data) {
                        document.getElementById("incrustarTablaCompras").innerHTML = data;

                        activaTablaCompras();
                }
        });
}










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarCompras").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarCompras").val("");
            $("#buscarCompras").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarCompras").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarCompras").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaCompra").trigger('click');
        //$(".close").hide();
        $("#buscarCompras").attr("teclaEsc", "no");

        

    }
});








//AL PRESIONAR F2 PARA EDITAR
$(document).keydown(function(event) {
    if (event.which === 113)
    {

        event.preventDefault();

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarCompra").trigger("click"); 

  

    }

        

    }
});





//AL PRESIONAR F4 VER PARTIDAS DE COMPRA
$(document).keydown(function(event) {
    if (event.which === 115)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerPartidasCompra").trigger("click"); 

        //$(".close").hide();

        $("#buscarCompras").attr("teclaEsc", "no");

    }

        

    }
});










//AL PRESIONAR F5 PARA CONFIRMAR COMPRA
$(document).keydown(function(event) {
    if (event.which === 116)
    {
        event.preventDefault();

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnConfirmarCompra").trigger("click"); 

   

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarCompras").attr("teclaEsc");
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
        var buscador_esc = $("#buscarCompras").attr("teclaEsc");
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










$(document).on("click", ".btnVerPartidasCompra", function(){



        var id_compra = $(this).attr("id_compra");

var datosCompra =  {"id_compra": id_compra};


$.ajax({
        data:datosCompra,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerPartidasCompra.php',
        success: function(traerPartidasCompra) {

        $("#modalVerPartidasCompra").modal("show");

        document.getElementById("incrustarTablaPartidasCompra").innerHTML = traerPartidasCompra;
        activaTablaPartidasCompra();
        }
        });

});











/*CONFIRMAMOS UNA COMPRA*/
$(document).on("click", ".btnConfirmarCompra", function(){

    var id_compra = $(this).attr("id_compra");

    $("#confirmarCompra").val(id_compra);

    $("#modalConfirmarCompra").modal("show");


});











/*CONFIRMAMOS UNA COMPRA*/
$(document).on("click", ".btnCancelarCompra", function(){

    var id_compra = $(this).attr("id_compra");

    $("#cancelarCompra").val(id_compra);

    $("#modalCancelarCompra").modal("show");


});
















/*CONFIRMAMOS UNA COMPRA*/
$(document).on("click", "#btnSubmitConfirmarCompra", function(){

    var id_compra = $("#confirmarCompra").val();

        

        var id_compra2 = new FormData();

        id_compra2.append("id_compra2", id_compra);


        $.ajax({

            url:"ajax/compras.ajax.php",
            method: "POST",
            data: id_compra2,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(traerCompra){

                var estatus_compra = parseInt(traerCompra['estatus']);


                if (estatus_compra !== 0) {

                    Swal.fire({
                    icon: 'error',
                    title: 'Esta compra ya ha tenido movimiento',
                    showConfirmButton: false,
                    timer: 2000
                    }).then(function(result){
                        return;
                    });
                }else{

                    var mostrarProveedor = new FormData();

                    mostrarProveedor.append("id_proveedor", traerCompra['id_proveedor']);

                    $.ajax({
                        url:"ajax/proveedores.ajax.php",
                        method: "POST",
                        data: mostrarProveedor,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function(traerProveedor){

                            if(traerProveedor['dias_credito'] == 0 || traerProveedor['dias_credito'] == null){

                                $("#es_credito").val(0);

                                document.forms["formularioConfirmarCompra"].submit();

                            }else{
                                Swal.fire({
                                  title: "¿La compra será a crédito?",
                                  showDenyButton: true,
                                  showCancelButton: false,
                                  confirmButtonText: "Si",
                                  denyButtonText: `No`
                                }).then((result) => {
                                  if (result.isConfirmed) {
                                    $("#es_credito").val(1);

                                    document.forms["formularioConfirmarCompra"].submit();
                                  } else if (result.isDenied) {
                                    $("#es_credito").val(0);

                                    document.forms["formularioConfirmarCompra"].submit();
                                  }
                                });
                            }

                        }
                    });

                }//ESTE ES EL ELSE DE SI LA COMPRA AUN NO HA SIDO CONFIRMADA
            }
        });//TERMINA EL PROCESO DE VERIFICAR SI EL PROVEEDOR TIENE DIAS DE CREDITO, ESTE ES EL SEGUNDO PASO




  

});











$(document).on("click", ".btnGenerarPDFCompraAdministracion", function(){

    var id_compra = $(this).attr("id_compra");

    window.open("extensiones/tcpdf/examples/pdf-compra-administracion.php?id_compra="+id_compra, "_blank");

});





$(document).on("click", ".btnGenerarPDFCompraAlmacen", function(){

    var id_compra = $(this).attr("id_compra");

    window.open("extensiones/tcpdf/examples/pdf-compra-almacen.php?id_compra="+id_compra, "_blank");

});










$(document).on("click", "#btnCrearNuevaCompra", function(){

    Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres crear una nueva compra?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                      document.forms["formularioCrearCompra"].submit();

                    }

                  });//SWAL.FIRE DE CONFIRMACION

});










$(document).on("click", "#btnCrearCompraXML", function(){

    $("#modalCrearCompraXML").modal("show");

});










$(document).on("click", "#btnSubmitCrearCompraXML", function(){

    Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres crear una nueva compra?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                      document.forms["formularioCrearCompraXML"].submit();

                    }

                  });//SWAL.FIRE DE CONFIRMACION

});




















function incrustarDatosInformativosProductoSucursal(parametros) {

    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaDatosInformativosProductoSucursal.php',
        success: function(data) {
        document.getElementById("incrustarDatosInformativosProductoSucursal").innerHTML = data;

    
        }


        });


}










$(document).on("click", "#btnEditarExistenciasProducto", function(){


  var id_producto = $(this).attr("id_producto");

  var datos = new FormData();
  datos.append("id_producto", id_producto);

  $.ajax({
    url: "ajax/existencias-sucursales.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){

        $("#modalEditarExistenciasProducto").modal("show");

        $("#mostrarDescripcionCortaProducto").val(respuesta["descripcion_corta"]);
        $("#btnSumbitEditarExistenciasProducto").attr("id_producto", id_producto);
        $("#btnSumbitEditarExistenciasProducto").attr("id_sucursal", respuesta["id_sucursal"]);
        $("#mostrarPrecioCompra").val(respuesta["precio_compra"]);
        var precio_compra_iva = (respuesta["precio_compra"]*1.16).toFixed(2);
        $("#mostrarPrecioCompraIva").val(precio_compra_iva);
        $("#mostrarStock").val(respuesta["stock"]);
        $("#editarPrecio1").val(respuesta["precio1"]);
        $("#editarUtilidad1").val(respuesta["utilidad1"]);
        $("#editarPrecio2").val(respuesta["precio2"]);
        $("#editarUtilidad2").val(respuesta["utilidad2"]);
        $("#editarPrecio3").val(respuesta["precio3"]);
        $("#editarUtilidad3").val(respuesta["utilidad3"]);
        $("#editarNivelMaximo").val(respuesta["nivel_maximo"]);
        $("#mostrarNivelMedio").val(respuesta["nivel_medio"]);
        $("#editarNivelMinimo").val(respuesta["nivel_minimo"]);
        $("#editarUbicacion").val(respuesta["ubicacion"]);
        
        var parametros = {"id_producto":id_producto};
        incrustarDatosInformativosProductoSucursal(parametros);

    }

});


});










function sacarNivelMedioEditar() {

    var nivel_minimo = $("#editarNivelMinimo").val();
    var nivel_maximo = $("#editarNivelMaximo").val();
    
    var nivel_medio = Math.round((Number(nivel_maximo) + Number(nivel_minimo))/2);

    $("#mostrarNivelMedio").val(nivel_medio);
    
    
    
}





$("#editarNivelMaximo").change(function(){

    sacarNivelMedioEditar();


})




$("#editarNivelMinimo").change(function(){

    sacarNivelMedioEditar();


})


//CAMBIO DE UTILIDAD 1
$("#editarPrecio1").change(function(){

    var precio1 = $("#editarPrecio1").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad1 = (precio1/(precioCompra*1.16)).toFixed(4);

        $("#editarUtilidad1").val(utilidad1);
    }



})



//CAMBIO DE PRECIO 1
$("#editarUtilidad1").change(function(){

    var utilidad1 = $("#editarUtilidad1").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio1 = ((precioCompra*utilidad1)*1.16).toFixed(0);

        $("#editarPrecio1").val(precio1);
    }




})


//CAMBIO DE UTILIDAD 2
$("#editarPrecio2").change(function(){

    var precio2 = $("#editarPrecio2").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad2 = (precio2/(precioCompra*1.16)).toFixed(4);

        $("#editarUtilidad2").val(utilidad2);
    }



})



//CAMBIO DE PRECIO 2
$("#editarUtilidad2").change(function(){

    var utilidad2 = $("#editarUtilidad2").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio2 = ((precioCompra*utilidad2)*1.16).toFixed(2);

        $("#editarPrecio2").val(precio2);
    }




})

//CAMBIO DE UTILIDAD 3
$("#editarPrecio3").change(function(){

    var precio3 = $("#editarPrecio3").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad3 = (precio3/(precioCompra*1.16)).toFixed(4);

        $("#editarUtilidad3").val(utilidad3);
    }



})



//CAMBIO DE PRECIO 3
$("#editarUtilidad3").change(function(){

    var utilidad3 = $("#editarUtilidad3").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio3 = ((precioCompra*utilidad3)*1.16).toFixed(2);

        $("#editarPrecio3").val(precio3);
    }




})














$("#editarPrecio1").keyup(function(){

    var precio1 = $("#editarPrecio1").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad1 = (precio1/(precioCompra*1.16)).toFixed(4);

        $("#editarUtilidad1").val(utilidad1);
    }



})



//CAMBIO DE PRECIO 1
$("#editarUtilidad1").keyup(function(){

    var utilidad1 = $("#editarUtilidad1").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio1 = ((precioCompra*utilidad1)*1.16).toFixed(0);

        $("#editarPrecio1").val(precio1);
    }




})


//CAMBIO DE UTILIDAD 2
$("#editarPrecio2").keyup(function(){

    var precio2 = $("#editarPrecio2").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad2 = (precio2/(precioCompra*1.16)).toFixed(4);

        $("#editarUtilidad2").val(utilidad2);
    }



})



//CAMBIO DE PRECIO 2
$("#editarUtilidad2").keyup(function(){

    var utilidad2 = $("#editarUtilidad2").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio2 = ((precioCompra*utilidad2)*1.16).toFixed(2);

        $("#editarPrecio2").val(precio2);
    }




})

//CAMBIO DE UTILIDAD 3
$("#editarPrecio3").keyup(function(){

    var precio3 = $("#editarPrecio3").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad3 = (precio3/(precioCompra*1.16)).toFixed(4);

        $("#editarUtilidad3").val(utilidad3);
    }



})



//CAMBIO DE PRECIO 3
$("#editarUtilidad3").keyup(function(){

    var utilidad3 = $("#editarUtilidad3").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio3 = ((precioCompra*utilidad3)*1.16).toFixed(2);

        $("#editarPrecio3").val(precio3);
    }




})






function validarUbicacionVaciaEditar() {
    if($("#editarUbicacion").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una ubicación del producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarUbicacion").focus();
        
        validar_ubicacion_vacia_editar = 0;
        
        return validar_ubicacion_vacia_editar;
        
        
    }else{

        validar_ubicacion_vacia_editar = 1;
        return validar_ubicacion_vacia_editar;
        
    }
    
}






function validarNivelMaximoVacioEditar() {
    var nivel_maximo_actual = $("#editarNivelMaximo").attr("nivelMaximoActual");
    if($("#editarNivelMaximo").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el nivel máximo de existencias',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarNivelMaximo").val(nivel_maximo_actual);
        
        $("#editarNivelMaximo").focus();
        
        validar_nivel_maximo_vacio_editar = 0;
        
        return validar_nivel_maximo_vacio_editar;
        
        
    }else{

        validar_nivel_maximo_vacio_editar = 1;
        return validar_nivel_maximo_vacio_editar;
        
    }
    
}




// VALIDA QUE EL NIVEL MINIMO NO SEA MAYOR AL NIVEL MAXIMO
function validarNivelMaximoMinimoEditar() {

    var nivel_minimo = $("#editarNivelMinimo").val();
    var nivel_maximo = $("#editarNivelMaximo").val();
    
    if(Number(nivel_maximo) < Number(nivel_minimo)){

        Swal.fire({
            icon: 'error',
            title: 'El nivel mínimo no puede ser mayor al nivel máximo',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarNivelMaximo").focus();
        
        validar_nivel_maximo_minimo_editar = 0;
        
        return validar_nivel_maximo_minimo_editar;
        
        
    }else if(Number(nivel_maximo) === Number(nivel_minimo)){

        Swal.fire({
            icon: 'error',
            title: 'El nivel mínimo no puede ser igual al nivel máximo',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarNivelMaximo").focus();
        
        validar_nivel_maximo_minimo_editar = 0;
        
        return validar_nivel_maximo_minimo_editar;
        
        
    }else{

        validar_nivel_maximo_minimo_editar = 1;
        return validar_nivel_maximo_minimo_editar;
        
    }
    
}










function validarNivelMinimoVacioEditar() {
    var nivel_minimo_actual = $("#editarNivelMinimo").attr("nivelMinimoActual");
    if($("#editarNivelMinimo").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el nivel mínimo de existencias',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarNivelMinimo").val(nivel_minimo_actual);
        
        $("#editarNivelMinimo").focus();
        
        validar_nivel_minimo_vacio_editar = 0;
        
        return validar_nivel_minimo_vacio_editar;
        
        
    }else{

        validar_nivel_minimo_vacio_editar = 1;
        return validar_nivel_minimo_vacio_editar;
        
    }
    
}





function validarPrecio1VacioEditar() {
    var precio1_actual = $("#editarPrecio1").attr("precio1Actual");
    if($("#editarPrecio1").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el primer precio del producto',
            text: 'De lo contrario introduzca la primera utilidad del producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarPrecio1").val(precio1_actual);
        
        $("#editarPrecio1").focus();
        
        validar_precio1_vacio_editar = 0;
        
        return validar_precio1_vacio_editar;
        
        
    }else{

        validar_precio1_vacio_editar = 1;
        return validar_precio1_vacio_editar;
        
    }
    
}





function validarPrecio2VacioEditar() {

    var precio2_actual = $("#editarPrecio2").attr("precio2Actual");
    
    if($("#editarPrecio2").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el segundo precio del producto',
            text: 'De lo contrario introduzca la segunda utilidad del producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarPrecio2").val(precio2_actual);
        
        $("#editarPrecio2").focus();
        
        validar_precio2_vacio_editar = 0;
        
        return validar_precio2_vacio_editar;
        
        
    }else{

        validar_precio2_vacio_editar = 1;
        return validar_precio2_vacio_editar;
        
    }
    
}





function validarPrecio3VacioEditar() {

   var precio3_actual = $("#editarPrecio3").attr("precio3Actual");

   if($("#editarPrecio3").val() === ""){

    Swal.fire({
        icon: 'error',
        title: 'Debe introducir el tercer precio del producto',
        text: 'De lo contrario introduzca la tercera utilidad del producto',
        showConfirmButton: false,
        timer: 2000
    });

    $("#editarPrecio3").val(precio3_actual);

    $("#editarPrecio3").focus();

    validar_precio3_vacio_editar = 0;

    return validar_precio3_vacio_editar;


}else{

    validar_precio3_vacio_editar = 1;
    return validar_precio3_vacio_editar;

}

}






function validarUtilidad1VaciaEditar() {

    var utilidad1_actual = $("#editarUtilidad1").attr("utilidad1Actual");
    
    if($("#editarUtilidad1").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir la primera utilidad del producto',
            text: 'De lo contrario introduzca el primer precio del producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarUtilidad1").val(utilidad1_actual);
        
        $("#editarUtilidad1").focus();
        
        validar_utilidad1_vacia_editar = 0;
        
        return validar_utilidad1_vacia_editar;
        
        
    }else{

        validar_utilidad1_vacia_editar = 1;
        return validar_utilidad1_vacia_editar;
        
    }
    
}





function validarUtilidad2VaciaEditar() {

    var utilidad2_actual = $("#editarUtilidad2").attr("utilidad2Actual");
    
    if($("#editarUtilidad2").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir la segunda utilidad del producto',
            text: 'De lo contrario introduzca el segundo precio del producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarUtilidad2").val(utilidad2_actual);
        
        $("#editarUtilidad2").focus();
        
        validar_utilidad2_vacia_editar = 0;
        
        return validar_utilidad2_vacia_editar;
        
        
    }else{

        validar_utilidad2_vacia_editar = 1;
        return validar_utilidad2_vacia_editar;
        
    }
    
}





function validarUtilidad3VaciaEditar() {

    var utilidad3_actual = $("#editarUtilidad3").attr("utilidad3Actual");
    
    if($("#editarUtilidad3").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir la tercera utilidad del producto',
            text: 'De lo contrario introduzca el terecer precio del producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarUtilidad3").val(utilidad3_actual);
        
        $("#editarUtilidad3").focus();
        
        validar_utilidad3_vacia_editar = 0;
        
        return validar_utilidad3_vacia_editar;
        
        
    }else{

        validar_utilidad3_vacia_editar = 1;
        return validar_utilidad3_vacia_editar;
        
    }
    
}










$(document).on("click", "#btnSumbitEditarExistenciasProducto", function(){

    $(this).blur();
    
    //validar_ubicacion_vacia_editar = validarUbicacionVaciaEditar();
    //alert(validar_ubicacion_vacia_editar);

    validar_utilidad3_vacia_editar = validarUtilidad3VaciaEditar();
    //alert(validar_utilidad3_vacia_editar);
    
    validar_utilidad2_vacia_editar = validarUtilidad2VaciaEditar();
    //alert(validar_utilidad2_vacia_editar);
    
    validar_utilidad1_vacia_editar = validarUtilidad1VaciaEditar();
    //alert(validar_utilidad1_vacia_editar);
    
    validar_precio3_vacio_editar = validarPrecio3VacioEditar();
    //alert(validar_precio3_vacio_editar);
    
    validar_precio2_vacio_editar = validarPrecio2VacioEditar();
    //alert(validar_precio2_vacio_editar);
    
    validar_precio1_vacio_editar = validarPrecio1VacioEditar();
    //alert(validar_precio1_vacio_editar);
    
    //validar_nivel_minimo_vacio_editar = validarNivelMinimoVacioEditar();
    //alert(validar_nivel_minimo_vacio_editar);
    
    //validar_nivel_maximo_minimo_editar = validarNivelMaximoMinimoEditar();
    //alert(validar_nivel_maximo_minimo_editar);
    
    //validar_nivel_maximo_vacio_editar = validarNivelMaximoVacioEditar();
    //alert(validar_nivel_maximo_vacio_editar);
    

    if(validar_utilidad3_vacia_editar !== 0 && 
        validar_utilidad2_vacia_editar !== 0 && 
        validar_utilidad1_vacia_editar !== 0 && 
        validar_precio3_vacio_editar !== 0 && 
        validar_precio2_vacio_editar !== 0 && 
        validar_precio1_vacio_editar !== 0){



    var id_producto = $("#btnSumbitEditarExistenciasProducto").attr("id_producto");


    var ubicacion = $("#editarUbicacion").val();

    var nivel_minimo = $("#editarNivelMinimo").val();
    var nivel_medio = $("#mostrarNivelMedio").val();
    var nivel_maximo = $("#editarNivelMaximo").val();

    var precio1 = $("#editarPrecio1").val();
    var utilidad1 = $("#editarUtilidad1").val();

    var precio2 = $("#editarPrecio2").val();
    var utilidad2 = $("#editarUtilidad2").val();

    var precio3 = $("#editarPrecio3").val();
    var utilidad3 = $("#editarUtilidad3").val();
    

    var datos = new FormData();
    datos.append("editarExistenciasProductoModulo", id_producto);

    datos.append("ubicacion", ubicacion);

    datos.append("nivel_minimo", nivel_minimo);
    datos.append("nivel_medio", nivel_medio);
    datos.append("nivel_maximo", nivel_maximo);

    datos.append("precio1", precio1);
    datos.append("utilidad1", utilidad1);

    datos.append("precio2", precio2);
    datos.append("utilidad2", utilidad2);

    datos.append("precio3", precio3);
    datos.append("utilidad3", utilidad3);

    $.ajax({
        async: false,
        url:"ajax/existencias-sucursales.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){
            if(respuesta == 1){
                Swal.fire({
            icon: 'success',
            title: 'El producto se ha editado con éxito',
            showConfirmButton: true
        });
            }else if(respuesta == 0){
                Swal.fire({
            icon: 'warning',
            title: 'No se ha podido editar el producto',
            showConfirmButton: true
        });
            }else{
                Swal.fire({
            icon: 'error',
            title: 'Error indefinido',
            text: 'comuníquese con soporte',
            showConfirmButton: true
        });
            }
        }

    })

}

});










function actualizarProductoES2(columna, valor, id_producto, id_sucursal) {

var datos = new FormData();
    datos.append("actualizarProductoES2", id_producto);
    datos.append("columna", columna);
    datos.append("valor", valor);
    datos.append("id_sucursal", id_sucursal);


    return $.ajax({
        url:"ajax/existencias-sucursales.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
    });
}










$(document).on("change", "#mostrarPrecioCompraIva", function(){

    var precio_compra = $(this).val();

    precio_compra = (precio_compra / 1.16).toFixed(2);

    $("#mostrarPrecioCompra").val(precio_compra);

    var id_producto = $("#btnSumbitEditarExistenciasProducto").attr("id_producto");

    var id_sucursal = $("#btnSumbitEditarExistenciasProducto").attr("id_sucursal");

    var respuesta = actualizarProductoES2("precio_compra", precio_compra, id_producto, id_sucursal);

    $("#editarUtilidad1").trigger("change");
    $("#editarUtilidad2").trigger("change");
    $("#editarUtilidad3").trigger("change");

});




$(document).on("keyup", "#mostrarPrecioCompraIva", function(){

    var precio_compra = $(this).val();

    precio_compra = (precio_compra / 1.16).toFixed(2);

    $("#mostrarPrecioCompra").val(precio_compra);

    var id_producto = $("#btnSumbitEditarExistenciasProducto").attr("id_producto");

    var id_sucursal = $("#btnSumbitEditarExistenciasProducto").attr("id_sucursal");

    var respuesta = actualizarProductoES2("precio_compra", precio_compra, id_producto, id_sucursal);

    $("#editarUtilidad1").trigger("change");
    $("#editarUtilidad2").trigger("change");
    $("#editarUtilidad3").trigger("change");

});











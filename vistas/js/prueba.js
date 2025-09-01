$('#nuevoIdProveedor').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});



function numerosSinDecimales()
{
    var tecla = event.key;
    if (['.','e'].includes(tecla))
       event.preventDefault()
}










function buscarProductosCompras(buscarProductosCompras) {

    id_proveedor = $("#nuevoIdProveedor").val();

    var catalogo_completo = $("#verCatalogoCompleto").is(":checked");
    if (!catalogo_completo) {
        var parametros = {"buscarProductosCompras":buscarProductosCompras, "id_proveedor":id_proveedor, "ver_catalogo_completo":0};
    }else{
        var parametros = {"buscarProductosCompras":buscarProductosCompras, "id_proveedor":id_proveedor, "ver_catalogo_completo":1};
    }

    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorProductosCompras.php',
        success: function(data) {
            document.getElementById("incrustarTablaProductosCompras").innerHTML = data;
        }
    });
}




$(document).on("change", "#buscarProductosCompras", function(){
    var busqueda = $("#buscarProductosCompras").val();
    buscarProductosCompras(busqueda);
});   






//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarProductosCompras").attr("teclaEsc");
        if(buscador_esc == "si"){
        //$("#buscarProductosCompras").val("");
            $("#buscarProductosCompras").focus();
        }else{
            $(".close").trigger('click');

            $("#buscarProductosCompras").attr("teclaEsc", "si");

        }

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarProductosCompras").attr("teclaEsc");
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
        var buscador_esc = $("#buscarProductosCompras").attr("teclaEsc");
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






$( document ).ready(function() {
// SUMAR TOTAL DE PRECIOS

    calculaDescuento();

    recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});






id_proveedor = $("#nuevoIdProveedor").val();

$("#nuevoIdProveedor2").val(id_proveedor);

descuento = $("#nuevoDescuentoCompra").val();

var contador = 0;


/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(document).on("click", ".agregarProducto", function(){

    var id_producto = $(this).attr("id_producto");

    if(myArr.includes(id_producto) == true){

        $(this).removeClass("btn-primary agregarProducto");

        $(this).addClass("btn-default");

    }else{

       myArr.push(id_producto);

       //console.log(myArr); 

       $(this).removeClass("btn-primary agregarProducto");

       $(this).addClass("btn-default");

       var descuento = $("#nuevoDescuentoCompra").val();

       var id_compra = $("#id_compra").val();


       var datos = new FormData();
       datos.append("id_compra", id_compra);
       datos.append("id_producto", id_producto);
       datos.append("descuento", descuento);

       $.ajax({
        url:"ajax/compras.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            //console.log(respuesta);

            var json = JSON.parse(JSON.stringify(respuesta));


          var producto = json[0];
          var id_partcom = json[1];


            var descripcion_corta = producto["descripcion_corta"];

            var clave_producto = producto["clave_producto"];

                        //alert(descripcion_corta);

            var stock = producto["stock"];

                        //alert(stock);


                        //alert(descuentoFamilia);



                        //alert(descuento);


                        //alert(descuentoFamilia);



            var precioOriginal = Number(producto["precio_compra"]);

                                //alert(precioOriginal);

            var precio_mas_iva = precioOriginal * 1.16;

            var precio_compra = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));

            var precio_compra_sin_iva = precioOriginal -(precioOriginal * (Number(descuento) / Number(100)));

            precio_compra_sin_iva = precio_compra_sin_iva.toFixed(2);
            precio_compra = precio_compra.toFixed(2);
                                //alert(precio_compra);

                                //precio_compra = Number(precio_compra) -(Number(precio_compra) * (Number(descuentoFamilia) / Number(100)));

                                //alert(precio_compra);



            contador = contador + 1;


            $(".nuevoProducto").append('<tr id="tr'+id_partcom+'">'+
              '<td class="partcom">'+
              '<button type="button" class="btn btn-xs btn-danger quitarProducto" id_producto="'+id_producto+'" id_partcom="'+id_partcom+'" accesskey="q"><i class="fa fa-times"></i></button>'+
              '</td>'+
              '<td>'+
              '<p style="font-size:14px;">'+clave_producto+'</p>'+
              '</td>'+
              '<td>'+
              '<p style="font-size:14px;">'+descripcion_corta+'</p>'+
              '</td>'+
              '<td class="tdPrecioCompraActual">'+
              '<input type="number" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control" value="'+precioOriginal+'" disabled>'+
              '</td>'+
              '<td class="ingresoCostoCompra">'+
              '<input type="number" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control nuevoCostoCompra" name="nuevoCostoCompra" value="'+precioOriginal+'" step="any" required>'+
              '</td>'+
              '<td class="ingresoCantidad">'+
              '<input type="number" style="height:21px; width:75px; font-size:18px;" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto'+contador+'" name="nuevaCantidadProducto'+contador+'" onkeydown="numerosSinDecimales()" min="1" value="1" step="1" required>'+
              '</td>'+
              '<td class="ingresoDescuento">'+
              '<input type="number" style="height:21px; width:75px; font-size:18px;" class="form-control nuevoDescuentoProducto" name="nuevoDescuentoProducto" value="'+descuento+'" descuento="'+descuento+'" min="0" max="100" step="any">'+
              '</td>'+
              '<td class="ingresoPrecioSinIva">'+
              '<div class="input-group mb-3">'+
              '<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control nuevoPrecioProductoSinIva" value="'+precio_compra_sin_iva+'" readonly tabindex="-1">'+
              '</div>'+
              '</td>'+
              '<td class="ingresoPrecio">'+
              '<div class="input-group mb-3">'+
              '<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control nuevoPrecioProducto" precioOriginal="'+precioOriginal+'" precioReal="'+precio_compra+'" value="'+precio_compra+'" readonly tabindex="-1">'+
              '</div>'+
              '</td>'+
              '</tr>');

            $("#nuevaCantidadProducto"+contador).focus();

                // SUMAR TOTAL DE PRECIOS

            sumarTotalPrecios();


                // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarProductos();

                // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

            $(".nuevoPrecioProducto").number(true, 2);

                        /*$("#buscarProductosCompras").val("");

                        $("#buscarProductosCompras").onkeyup(buscarProductosCompras($('#buscarProductosCompras').val()));*/
        }
});//AJAX




}




});









$("#verCatalogoCompleto").on('change', function() {

    var busqueda = $("#buscarProductosCompras").val();
    buscarProductosCompras(busqueda);    

        //document.getElementById("buscarProductosCompras").onkeyup();


});










function actualizar_partida_compra(id_partcom, cantidad, descuento, precio_unitario, precio, total) {

    var datos = new FormData();
    datos.append("guardaDatosPartidaCompra", id_partcom);
    datos.append("cantidad", cantidad);
    datos.append("descuento", descuento);
    datos.append("precio_unitario", precio_unitario);
    datos.append("precio", precio);
    datos.append("total", total);


    $.ajax({
        url:"ajax/compras.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

            console.log(respuesta);

        }
    });
}







$("#nuevoIdProveedor").on('change', function() {

    /*var descuento = $("#nuevoIdProveedor>option:selected").attr("descuento");

    $("#descuento1").val(descuento);

    calculaDescuento();*/

    id_proveedor = $("#nuevoIdProveedor").val();

    $("#nuevoIdProveedor2").val(id_proveedor);

   /* myArr = [];
    listaProductos = [];


    $("#listaProductos").val("");


    removeAllChilds('a');



        //document.getElementById("buscarProductosCompras").onkeyup();

    $("#totalCompra").val("");
    $("#nuevoTotalCompra").val("");*/



});



function removeAllChilds(a)
{
    a=document.getElementById(a);
    while(a.hasChildNodes())
        a.removeChild(a.firstChild);    
}



$(".listaProductosCompras").on("draw.dt", function(){
    console.log("tabla");
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioCompra").on("click", "button.quitarProducto", function(){

    var partida = $(this).parent().parent();

    var id_producto = $(this).attr("id_producto");

    var id_partcom = $(this).attr("id_partcom");


    var datos = new FormData();
    datos.append("eliminarPartidaCompra", id_partcom);

    $.ajax({
        url:"ajax/compras.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

            console.log(respuesta);

            if(respuesta == 1){

                var posicion = myArr.indexOf(id_producto);

                myArr.splice(posicion, 1);


                partida.remove();




                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

                $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


                if($(".nuevoProducto").children().length == 0){

                    $("#listaProductos").val("");
                    $("#nuevoTotalCompra").attr("total",0);
                    $("#nuevoTotalCompra").val(0);
                    $("#totalCompra").val(0);
                    $("#nuevoImpuestoCompra").val(0);




                }else{
             // SUMAR TOTAL DE PRECIOS

                    sumarTotalPrecios();   


                // AGRUPAR PRODUCTOS EN FORMATO JSON

                    listarProductos();
                }

            }else{

            }

        }
    });





});












/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioCompra").on("keyup", "input.nuevaCantidadProducto", function(){

    var partcom = $(this).parent().parent().children(".partcom").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var precio_compra_sin_iva = $(this).parent().parent().children(".ingresoPrecioSinIva").children().children(".nuevoPrecioProductoSinIva");

    var input_costo_compra = $(this).parent().parent().children(".ingresoCostoCompra").children(".nuevoCostoCompra");

    var cantidad = $(this).val();

    if(cantidad <= 0){
        cantidad = 1;
        $(this).val(cantidad);
    }

    var descuento = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDescuentoProducto");

    descuento = descuento.val();

    var precio_mas_iva = input_costo_compra.val() * 1.16;

    var precio_sin_iva = input_costo_compra.val();



    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));


    precioFinal = precioProductoDescuento * cantidad;
    precioFinal = precioFinal.toFixed(2);
    precio_compra.val(precioFinal);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinalSinIva = precioProductoSinIvaDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinalSinIva);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, precioFinal);

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});





$(".formularioCompra").on("click", "input.nuevaCantidadProducto", function(){

    var partcom = $(this).parent().parent().children(".partcom").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var precio_compra_sin_iva = $(this).parent().parent().children(".ingresoPrecioSinIva").children().children(".nuevoPrecioProductoSinIva");

    var input_costo_compra = $(this).parent().parent().children(".ingresoCostoCompra").children(".nuevoCostoCompra");

    var cantidad = $(this).val();

    if(cantidad <= 0){
        cantidad = 1;
        $(this).val(cantidad);
    }

    var descuento = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDescuentoProducto");

    descuento = descuento.val();

    var precio_mas_iva = input_costo_compra.val() * 1.16;

    var precio_sin_iva = input_costo_compra.val();



    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));


    precioFinal = precioProductoDescuento * cantidad;
    precioFinal = precioFinal.toFixed(2);
    precio_compra.val(precioFinal);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinalSinIva = precioProductoSinIvaDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinalSinIva);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, precioFinal);

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});















/*=============================================
MODIFICAR EL DESCUENTO POR PRODUCTO
=============================================*/

$(".formularioCompra").on("keyup", "input.nuevoDescuentoProducto", function(){

    var partcom = $(this).parent().parent().children(".partcom").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");
    
    var precio_compra = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    
    var precio_compra_sin_iva = $(this).parent().parent().children(".ingresoPrecioSinIva").children().children(".nuevoPrecioProductoSinIva");
    
    var input_costo_compra = $(this).parent().parent().children(".ingresoCostoCompra").children(".nuevoCostoCompra");
    
    var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    cantidad = cantidad.val();

    var descuento = $(this).val();

    var descuento_global_compra = $("#nuevoDescuentoCompra").val();

    if(descuento < 0){
        $(this).val(descuento_global_compra);
        descuento = descuento_global_compra
    }else if(descuento > 100){
        $(this).val(descuento_global_compra);
        descuento = descuento_global_compra
    }

    var precio_mas_iva = input_costo_compra.val() * 1.16;

    var precio_sin_iva = input_costo_compra.val();



    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));





    precioFinal = precioProductoDescuento * cantidad;
    precioFinal = precioFinal.toFixed(2);
    precio_compra.val(precioFinal);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinalSinIva = precioProductoSinIvaDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinalSinIva);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, precioFinal);
        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

        // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});





/*=============================================
MODIFICAR EL DESCUENTO POR PRODUCTO
=============================================*/

$(".formularioCompra").on("click", "input.nuevoDescuentoProducto", function(){

    var partcom = $(this).parent().parent().children(".partcom").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    var precio_compra_sin_iva = $(this).parent().parent().children(".ingresoPrecioSinIva").children().children(".nuevoPrecioProductoSinIva");
    var input_costo_compra = $(this).parent().parent().children(".ingresoCostoCompra").children(".nuevoCostoCompra");

    var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    var descuento = $(this).val();

    var descuento_global_compra = $("#nuevoDescuentoCompra").val();

    if(descuento < 0){
        $(this).val(descuento_global_compra);
        descuento = descuento_global_compra
    }else if(descuento > 100){
        $(this).val(descuento_global_compra);
        descuento = descuento_global_compra
    }

    var precio_mas_iva = input_costo_compra.val() * 1.16;

    var precio_sin_iva = input_costo_compra.val();




    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));

    cantidad = cantidad.val();

    precioFinal = precioProductoDescuento * cantidad;
    precioFinal = precioFinal.toFixed(2);
    precio_compra.val(precioFinal);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinalSinIva = precioProductoSinIvaDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinalSinIva);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, precioFinal);
        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

        // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});




















/*=============================================
MODIFICAR EL DESCUENTO POR PRODUCTO
=============================================*/

$(".formularioCompra").on("keyup", "input.nuevoCostoCompra", function(){

    var partcom = $(this).parent().parent().children(".partcom").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        //precio_compra.attr("precioOriginal", $(this).val());

    var precio_compra_sin_iva = $(this).parent().parent().children(".ingresoPrecioSinIva").children().children(".nuevoPrecioProductoSinIva");


    var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto").val();

        //alert("este es la cantidad de productos:   "+cantidad);


    var descuento = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDescuentoProducto").val();

    if($(this).val() < 0){
        $(this).val(0);
    }


    var precio_mas_iva = $(this).val() * 1.16;
    var precio_sin_iva = $(this).val();






    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));


    precioFinal = precioProductoDescuento * cantidad;
    precioFinal = precioFinal.toFixed(2);
    precio_compra.val(precioFinal);
    precio_compra.attr("precioReal", precioProductoDescuento);





    precioFinalSinIva = precioProductoSinIvaDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinalSinIva);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);



   
    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, precioFinal);

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});





$(".formularioCompra").on("click", "input.nuevoCostoCompra", function(){

    var partcom = $(this).parent().parent().children(".partcom").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var precio_compra_sin_iva = $(this).parent().parent().children(".ingresoPrecioSinIva").children().children(".nuevoPrecioProductoSinIva");


        //precio_compra.attr("precioOriginal", $(this).val());


    var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto").val();

        //alert("este es la cantidad de productos:   "+cantidad);


    var descuento = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDescuentoProducto").val();

    if($(this).val() < 0){
        $(this).val(0);
    }


    var precio_mas_iva = $(this).val() * 1.16;
    var precio_sin_iva = $(this).val();




    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva -(precio_sin_iva * (Number(descuento) / Number(100)));


    precioFinal = precioProductoDescuento * cantidad;
    precioFinal = precioFinal.toFixed(2);
    precio_compra.val(precioFinal);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinalSinIva = precioProductoSinIvaDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinalSinIva);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);



    /*alert("partida: "+id_partcom);
    alert("cantidad: "+cantidad);
    alert("descuento: "+descuento);
    alert("precio: "+precio_mas_iva);
    alert("precio final: "+precioFinal);*/
    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, precioFinal);

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});









$(document).on("keyup", "#descuento1", function(){
    calculaDescuento();

    recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});
$(document).on("keyup", "#descuento2", function(){
    calculaDescuento();

    recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});

$(document).on("keyup", "#descuento3", function(){
    calculaDescuento();

    recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});

$(document).on("keyup", "#descuento4", function(){
    calculaDescuento();

    recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});

$(document).on("keyup", "#descuento5", function(){
    calculaDescuento();

    recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});



/*=============================================
CALCULA EL DESCUENTO
=============================================*/
function calculaDescuento(){
    var descuento1 = $("#descuento1").val();
    var descuento2 = $("#descuento2").val();
    var descuento3 = $("#descuento3").val();
    var descuento4 = $("#descuento4").val();
    var descuento5 = $("#descuento5").val();

    $("#nuevoDescuento1Compra").val(descuento1);
    $("#nuevoDescuento2Compra").val(descuento2);
    $("#nuevoDescuento3Compra").val(descuento3);
    $("#nuevoDescuento4Compra").val(descuento4);
    $("#nuevoDescuento5Compra").val(descuento5);

/*descuento1 = (descuento1/100).toFixed(2);
descuento2 = (descuento2/100).toFixed(2);
descuento3 = (descuento3/100).toFixed(2);
descuento4 = (descuento4/100).toFixed(2);
descuento5 = (descuento5/100).toFixed(2);*/

    descuento1 = (descuento1/100);
    descuento2 = (descuento2/100);
    descuento3 = (descuento3/100);
    descuento4 = (descuento4/100);
    descuento5 = (descuento5/100);


    var descuento_general = 1 - ( (1 - descuento1) * (1 - descuento2) * (1 - descuento3) * (1 - descuento4) * (1 - descuento5));

    descuento_general = (descuento_general * 100).toFixed(2);

    $("#nuevoDescuentoCompra").val(descuento_general);

//$(".nuevoDescuentoProducto").val(descuento_general);


}







function recalcularPrecios(){


    var costCom = $(".nuevoCostoCompra");

    var descripcion = $(".quitarProducto");

    var cant = $(".nuevaCantidadProducto");

    var desc = $(".nuevoDescuentoProducto");

    var precio = $(".nuevoPrecioProducto");

    var precio_sin = $(".nuevoPrecioProductoSinIva");

    for(var i = 0; i < descripcion.length; i++){



        var cantidad = $(cant[i]).val();

        var descuento = $(desc[i]).val();

        var costo_compra = $(costCom[i]).val();

            //alert("cantidad: "+cantidad);
            //alert("descuento: "+descuento);
            //alert("costo compra: "+costo_compra);

        var precio_mas_iva = costo_compra * 1.16;
        var precio_sin_iva = costo_compra;

            //alert("precio sin iva: "+precio_sin_iva);
            //alert("Precio mas iva: "+precio_mas_iva);
        

        var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
        var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));

            //alert("precio sin iva con descuento: "+precioProductoSinIvaDescuento);
            //alert("Precio mas iva con descuento: "+precioProductoDescuento);

        var precioFinal = precioProductoDescuento * cantidad;
        precioFinal = precioFinal.toFixed(2);

            //alert("total: "+precioFinal);

        var input_precio = $(precio[i]);

        input_precio.val(precioFinal);
        input_precio.attr("precioReal", precioProductoDescuento);


        var input_precio_sin = $(precio_sin[i]);

        var precioFinalSinIva = precioProductoSinIvaDescuento.toFixed(2);
        input_precio_sin.val(precioFinalSinIva);
        input_precio_sin.attr("precioRealSinIva", precioProductoSinIvaDescuento);


                /*listaProductos.push({ "id" : $(descripcion[i]).attr("id_producto"),
                      "costoCompra" : $(costoCompra[i]).val(),
                      "cantidad" : $(cantidad[i]).val(),
                      "descuento" : $(descuento[i]).val(),
                      "p_s_i" : $(precio_sin_iva[i]).val(),
                      "precio" : $(precio[i]).attr("precioReal"),
                      "total" : $(precio[i]).val()})*/

    }





}





/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

    var precioItem = $(".nuevoPrecioProducto");

    var arraySumaPrecio = [];  

    for(var i = 0; i < precioItem.length; i++){

     arraySumaPrecio.push(Number($(precioItem[i]).val()));


 }



 function sumaArrayPrecios(total, numero){

    return total + numero;

}

var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

$("#nuevoTotalCompra").val(sumaTotalPrecio);
$("#totalCompra").val(sumaTotalPrecio);
$("#nuevoTotalCompra").attr("total",sumaTotalPrecio);


}




/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalCompra").number(true, 2);






/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

    var listaProductos = [];

    var costoCompra = $(".nuevoCostoCompra");

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");

    var descuento = $(".nuevoDescuentoProducto");

    var precio = $(".nuevoPrecioProducto");

    var precio_sin_iva = $(".nuevoPrecioProductoSinIva");

    for(var i = 0; i < descripcion.length; i++){

        listaProductos.push({ "id" : $(descripcion[i]).attr("id_producto"),
          "costoCompra" : $(costoCompra[i]).val(),
          "cantidad" : $(cantidad[i]).val(),
          "descuento" : $(descuento[i]).val(),
          "p_s_i" : $(precio_sin_iva[i]).val(),
          "precio" : $(precio[i]).attr("precioReal"),
          "total" : $(precio[i]).val()})

    }
    console.log("listaProductos", listaProductos);

    $("#listaProductos").val(JSON.stringify(listaProductos)); 

}










$(document).on("click", ".btnLigarProducto", function(){

    $("#modalProductos").modal("show");

    multiclave = $(this).attr("multiclave");

    id_partcom = $(this).attr("id_partcom");

    $("#nuevaMulticlave").val(multiclave);

    $("#nuevaMulticlave").attr("id_partcom", id_partcom);
});










$(document).on("change", "#buscarProductos", function(){
    var busqueda = $("#buscarProductos").val();
    buscarProductos(busqueda);
}); 










function buscarProductos(buscarProductos) {

    document.getElementById("incrustarTablaProductos").innerHTML = "";

    var parametros = {"buscarProductos":buscarProductos};

    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorProductosSencillo.php',
        success: function(data) {
            document.getElementById("incrustarTablaProductos").innerHTML = data;
        }
    });
}










$(document).on("click", ".btnSeleccionarProducto", function(){

    var id_producto = $(this).attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var multiclave = $("#nuevaMulticlave").val();

    var id_partcom = $("#nuevaMulticlave").attr("id_partcom");

    Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres asignar la clave a este producto?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                      var datos = new FormData();
                       datos.append("crearMulticlaveProducto", id_producto);
                       datos.append("multiclave", multiclave);

                       $.ajax({
                        async: false,
                        url:"ajax/productos.ajax.php",
                        method:"POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){

                            if(respuesta == 1){


                Swal.fire({
            icon: 'success',
            title: 'La multiclave se ha guardado con éxito',
            showConfirmButton: true
        });


                var datos2 = new FormData();
                datos2.append("actualizarPartcom", id_partcom);
                datos2.append("columna", "id_producto");
                datos2.append("valor", id_producto);

                $.ajax({
                        url:"ajax/partcom.ajax.php",
                        method: "POST",
                        data: datos2,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta2){
                            if(respuesta2 == "ok"){
                                var datos3 = new FormData();
                datos3.append("mostrarProductoES2", id_producto);
                datos3.append("id_sucursal", id_sucursal);

                $.ajax({
                        url:"ajax/existencias-sucursales.ajax.php",
                        method: "POST",
                        data: datos3,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType:"json",
                        success:function(traerProducto){

                            $("#tr"+id_partcom).children(".tdClaveProducto").html("<p style='font-size:14px;'>"+traerProducto['clave_producto']+"</p>");
                            $("#tr"+id_partcom).children(".tdDescripcionProducto").html("<p style='font-size:14px;'>"+traerProducto['descripcion_corta']+"</p>");
                            $("#tr"+id_partcom).children(".tdPrecioCompraActual").html('<input type="number" class="form-control" style="height:21px; width:100px; text-align: right; font-size:18px;" value="'+traerProducto['precio_compra']+'" disabled>');

                            $("#modalProductos").modal("hide");
                            document.getElementById("incrustarTablaProductos").innerHTML = "";
                            $("#buscarProductos").val("");
                        }
                    });
                            }
                        }
                    });


            }else if(respuesta == 0){
                Swal.fire({
            icon: 'warning',
            title: 'No se ha podido crear la multiclave',
            showConfirmButton: true
        });
            }else if(respuesta == 2){
                Swal.fire({
            icon: 'warning',
            title: 'Esta multiclave ya la tiene el producto',
            showConfirmButton: true
        });
            }

                        }
                    });

                    }

                  });//SWAL.FIRE DE CONFIRMACION

});




$(document).keydown(function(event) {
    //CREAR VENTA F8
    if (event.which === 120)
    {
        event.preventDefault();

        window.location = 'lista-compras';

    }
});

document.querySelectorAll('input').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C';
  event.target.style.color = '#FFFFFF';   
  });
});

document.querySelectorAll('input').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('select').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C';
  event.target.style.color = '#FFFFFF';    
  });
});

document.querySelectorAll('select').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('button').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C'; 
  event.target.style.color = '#FFFFFF';    
  });
});

document.querySelectorAll('button').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('textarea').forEach((input) => {
    input.addEventListener('focusin', (event) => {
  event.target.style.background = '#E74C3C'; 
  event.target.style.color = '#FFFFFF';    
  });
});

document.querySelectorAll('textarea').forEach((input) => {
    input.addEventListener('focusout', (event) => {
  event.target.style.background = '';
  event.target.style.color = '#000000';     
  });
});


$('#nuevoIdProveedor').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});


var id_proveedor = $("#nuevoIdProveedor>option:selected").val();

$("#nuevoIdProveedor2").val(id_proveedor);

var descuento = $("#nuevoDescuentoCompra").val();

var contador = $("#listaProductos").attr("contador");

var contador_multiplo = contador * 3;

var particion = (100/contador_multiplo);

var progreso = 0;

var contador_progresion = 0;


// A $( document ).ready() block.
$( document ).ready(function() {

    var cambiar_precios = $("#cambiar_precios").val();

    if(cambiar_precios == 0){

        $(".utilidad1").trigger("change");
        $(".utilidad2").trigger("change");
        $(".utilidad3").trigger("change");
    }

    sumarTotalPrecios();

    listarProductos();

    $(".nuevoPrecioProducto").number(true, 2);




    







});



function barraProgresion()
{
    //alert("contador progresion: "+contador_progresion);

    contador_progresion = contador_progresion + 1;

    //alert("contador progresion + 1: "+contador_progresion);

    //alert("progreso: "+progreso);

    progreso = progreso + particion;

    //alert("progreso + "+particion+": "+progreso);

    if(contador_progresion == contador_multiplo){
        $("#barraProgresion").attr("style", "width: 100%;");
        contador_progresion = 0;
        progreso = 0;

        setTimeout(function() { 
            $("#barraProgresion").removeAttr("style");
        }, 600);
        
    }else{

        $("#barraProgresion").attr("style", "width: "+progreso+"%;");

        
    }


}



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

            console.log(respuesta);

            var json = JSON.parse(JSON.stringify(respuesta));


          var producto = json[0];
          var id_partcom = json[1];


            var descripcion_corta = producto["descripcion_corta"];

            var clave_producto = producto["clave_producto"];

                        //alert(descripcion_corta);

            var stock = producto["stock"];

            var precio1 = producto["precio1"];

            var utilidad1 = producto["utilidad1"];

            var precio2 = producto["precio2"];

            var utilidad2 = producto["utilidad2"];

            var precio3 = producto["precio3"];

            var utilidad3 = producto["utilidad3"];

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




$(".nuevoProducto").append('<div class="row" id="div'+id_partcom+'">'+
    '<div class="col-lg-6 col-12 divPrimeraParte">'+
        '<div class="row rowPrimeraParte">'+
            '<div class="col-lg-1 col-12 divQuitarProducto">'+
                '<button type="button" class="btn btn-xs btn-danger quitarProducto" id_producto="'+id_producto+'" id_partcom="'+id_partcom+'" accesskey="q">'+
                    '<i class="fa fa-times"></i>'+
                '</button>'+
            '</div>'+
            '<div class="col-lg-2 col-12 divClaveProducto">'+
                '<label>Clave</label><p>'+clave_producto+'</p>'+
            '</div>'+
            '<div class="col-lg-9 col-12 divDescripcion">'+
                '<label>Descripción</label><p>'+descripcion_corta+'</p>'+
            '</div>'+
            '<div class="col-lg-2 col-6 divPrecio1">'+
                '<label>Precio 1</label>'+
                '<input type="number" class="form-control precio1" value="'+precio1+'">'+
            '</div>'+
            '<div class="col-lg-2 col-6 divUtilidad1">'+
                '<label>Utilidad 1</label>'+
                '<input type="number" class="form-control utilidad1" value="'+utilidad1+'">'+
            '</div>'+
            '<div class="col-lg-2 col-6 divPrecio2">'+
                '<label>Precio 2</label>'+
                '<input type="number" class="form-control precio2" value="'+precio2+'">'+
            '</div>'+
            '<div class="col-lg-2 col-6 divUtilidad2">'+
                '<label>Utilidad 2</label>'+
                '<input type="number" class="form-control utilidad2" value="'+utilidad2+'">'+
            '</div>'+
            '<div class="col-lg-2 col-6 divPrecio3">'+
                '<label>Precio 3</label>'+
                '<input type="number" class="form-control precio3" value="'+precio3+'">'+
            '</div>'+
            '<div class="col-lg-2 col-6 divUtilidad3">'+
                '<label>Utilidad 3</label>'+
                '<input type="number" class="form-control utilidad3" value="'+utilidad3+'">'+
            '</div>'+
        '</div>'+
    '</div>'+
    '<div class="col-lg-6 col-12 divSegundaParte">'+
        '<div class="row rowSegundaParte">'+
                '<div class="col-lg-6 col-12 divPrecioActual">'+
                '<label>Último Precio Sin iva</label>'+
                '<input type="number" class="form-control" value="'+precioOriginal+'" disabled>'+
            '</div>'+
            '<div class="col-lg-6 col-12 divPrecioCompra">'+
                '<label>Precio factura sin iva</label>'+
                '<input type="number" class="form-control nuevoCostoCompra" name="nuevoCostoCompra" value="'+precioOriginal+'" step="any" required>'+
            '</div>'+
            '<div class="col-lg-3 col-6 divCantidad">'+
                '<label>Canidad</label>'+
                '<input type="number" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto'+contador+'" name="nuevaCantidadProducto'+contador+'" onkeydown="numerosSinDecimales()" min="1" value="1" step="1" required>'+
            '</div>'+
            '<div class="col-lg-3 col-6 divDescuento">'+
                '<label>Descuento</label>'+
                '<input type="number" class="form-control nuevoDescuentoProducto" name="nuevoDescuentoProducto" value="'+descuento+'" descuento="'+descuento+'" step="any">'+
            '</div>'+
            '<div class="col-lg-3 col-6 divPrecioUnitario">'+
                '<label>Precio Unitario con iva.</label>'+
                '<input type="text" class="form-control nuevoPrecioProductoSinIva" value="'+precio_compra+'" readonly tabindex="-1">'+
            '</div>'+
            '<div class="col-lg-3 col-6 divTotalProducto">'+
                '<label>Total</label>'+
                '<input type="text" class="form-control nuevoPrecioProducto" precioOriginal="'+precioOriginal+'" precioReal="'+precio_compra+'" value="'+precio_compra+'" readonly tabindex="-1">'+
            '</div>'+
        '</div>'+
    '</div>'+
'</div>'+
'<hr id="hr'+id_partcom+'" style="height:1px;border:none;color:#333;background-color:#333;">');

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

    var partida = $(this).parent().parent().parent().parent();

    var id_producto = $(this).attr("id_producto");

    var id_partcom = $(this).attr("id_partcom");

    var hr = $("#hr"+id_partcom);


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

                hr.remove();




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

    var partcom = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divTotalProducto").children(".nuevoPrecioProducto");

    var precio_compra_sin_iva = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva");

    var input_costo_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioCompra").children(".nuevoCostoCompra");

    var cantidad = $(this).val();

    if(cantidad <= 0){
        cantidad = 1;
        $(this).val(cantidad);
    }

    var descuento = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divDescuento").children(".nuevoDescuentoProducto");

    descuento = descuento.val();

    var precio_mas_iva = input_costo_compra.val() * 1.16;

    var precio_sin_iva = input_costo_compra.val();



    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));


    totalProducto = precioProductoDescuento * cantidad;
    totalProducto = totalProducto.toFixed(2);
    precio_compra.val(totalProducto);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinal = precioProductoDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinal);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, totalProducto);

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});











$(".formularioCompra").on("change", "input.nuevaCantidadProducto", function(){

    var partcom = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divTotalProducto").children(".nuevoPrecioProducto");

    var precio_compra_sin_iva = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva");

    var input_costo_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioCompra").children(".nuevoCostoCompra");

    var cantidad = $(this).val();

    if(cantidad <= 0){
        cantidad = 1;
        $(this).val(cantidad);
    }

    var descuento = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divDescuento").children(".nuevoDescuentoProducto");

    descuento = descuento.val();

    var precio_mas_iva = input_costo_compra.val() * 1.16;

    var precio_sin_iva = input_costo_compra.val();



    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));


    totalProducto = precioProductoDescuento * cantidad;
    totalProducto = totalProducto.toFixed(2);
    precio_compra.val(totalProducto);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinal = precioProductoDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinal);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, totalProducto);

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});





















/*=============================================
MODIFICAR EL DESCUENTO POR PRODUCTO
=============================================*/

$(".formularioCompra").on("keyup", "input.nuevoDescuentoProducto", function(){

    var partcom = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");
    
    var precio_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divTotalProducto").children(".nuevoPrecioProducto");
    
    var precio_compra_sin_iva = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva");
    
    var input_costo_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioCompra").children(".nuevoCostoCompra");
    
    var cantidad = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divCantidad").children(".nuevaCantidadProducto");

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





    totalProducto = precioProductoDescuento * cantidad;
    totalProducto = totalProducto.toFixed(2);
    precio_compra.val(totalProducto);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinal = precioProductoDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinal);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, totalProducto);
        // SUMAR TOTAL DE PRECIOS
        // 
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").children(".utilidad1").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").children(".utilidad2").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").children(".utilidad3").trigger("change");

    sumarTotalPrecios();

        // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});













$(".formularioCompra").on("change", "input.nuevoDescuentoProducto", function(){

    var partcom = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");
    
    var precio_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divTotalProducto").children(".nuevoPrecioProducto");
    
    var precio_compra_sin_iva = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva");
    
    var input_costo_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioCompra").children(".nuevoCostoCompra");
    
    var cantidad = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divCantidad").children(".nuevaCantidadProducto");

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





    totalProducto = precioProductoDescuento * cantidad;
    totalProducto = totalProducto.toFixed(2);
    precio_compra.val(totalProducto);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinal = precioProductoDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinal);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, totalProducto);
        // SUMAR TOTAL DE PRECIOS
        // 
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").children(".utilidad1").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").children(".utilidad2").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").children(".utilidad3").trigger("change");

    sumarTotalPrecios();

        // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});























/*=============================================
MODIFICAR EL DESCUENTO POR PRODUCTO
=============================================*/

$(".formularioCompra").on("keyup", "input.nuevoCostoCompra", function(){

    var partcom = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divTotalProducto").children(".nuevoPrecioProducto");

        //precio_compra.attr("precioOriginal", $(this).val());

    var precio_compra_sin_iva = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva");


    var cantidad = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divCantidad").children(".nuevaCantidadProducto").val();

        //alert("este es la cantidad de productos:   "+cantidad);


    var descuento = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divDescuento").children(".nuevoDescuentoProducto").val();

    if($(this).val() < 0){
        $(this).val(0);
    }


    var precio_mas_iva = $(this).val() * 1.16;
    var precio_sin_iva = $(this).val();






    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));


    totalProducto = precioProductoDescuento * cantidad;
    totalProducto = totalProducto.toFixed(2);
    precio_compra.val(totalProducto);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinal = precioProductoDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinal);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, totalProducto);


    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").children(".utilidad1").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").children(".utilidad2").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").children(".utilidad3").trigger("change");

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});












$(".formularioCompra").on("change", "input.nuevoCostoCompra", function(){

    var partcom = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto");

    var id_partcom = partcom.attr("id_partcom");

    var precio_compra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divTotalProducto").children(".nuevoPrecioProducto");

        //precio_compra.attr("precioOriginal", $(this).val());

    var precio_compra_sin_iva = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva");


    var cantidad = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divCantidad").children(".nuevaCantidadProducto").val();

        //alert("este es la cantidad de productos:   "+cantidad);


    var descuento = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divDescuento").children(".nuevoDescuentoProducto").val();

    if($(this).val() < 0){
        $(this).val(0);
    }


    var precio_mas_iva = $(this).val() * 1.16;
    var precio_sin_iva = $(this).val();






    var precioProductoDescuento = precio_mas_iva -(precio_mas_iva * (Number(descuento) / Number(100)));
    var precioProductoSinIvaDescuento = precio_sin_iva - (precio_sin_iva * (Number(descuento) / Number(100)));


    totalProducto = precioProductoDescuento * cantidad;
    totalProducto = totalProducto.toFixed(2);
    precio_compra.val(totalProducto);
    precio_compra.attr("precioReal", precioProductoDescuento);



    precioFinal = precioProductoDescuento.toFixed(2);
    precio_compra_sin_iva.val(precioFinal);
    precio_compra_sin_iva.attr("precioRealSinIva", precioProductoSinIvaDescuento);


    actualizar_partida_compra(id_partcom, cantidad, descuento, precio_sin_iva, precioProductoDescuento, totalProducto);


    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").children(".utilidad1").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").children(".utilidad2").trigger("change");
    $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").children(".utilidad3").trigger("change");

// SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});







$(document).on("click", "#btnInsertarDecuento", function(){

    var descuento_general = $("#nuevoDescuentoCompra").val();
    $(".nuevoDescuentoProducto").val(descuento_general);
    
    $(".nuevoDescuentoProducto").trigger("change");

});



$(document).on("keyup", "#descuento1", function(){
    calculaDescuento();

    //recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});
$(document).on("keyup", "#descuento2", function(){
    calculaDescuento();

    //recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});

$(document).on("keyup", "#descuento3", function(){
    calculaDescuento();

    //recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});

$(document).on("keyup", "#descuento4", function(){
    calculaDescuento();

    //recalcularPrecios();

        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
});

$(document).on("keyup", "#descuento5", function(){
    calculaDescuento();

    //recalcularPrecios();

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

    $("#nuevoDescuentoGeneralCompra").val(descuento_general);
    

    
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
    //console.log("listaProductos", listaProductos);

    $("#listaProductos").val(JSON.stringify(listaProductos)); 

}










$(document).on("click", ".btnLigarProducto", function(){

    $("#modalProductos").modal("show");

    setTimeout(function() { 

        $("#buscarProductos").focus();

    }, 300);
    

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
                       datos.append("multiplo_entrega", 1);
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

                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto", id_producto);

                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divClaveProducto").html("<label>Clave</label><p style='font-size:14px;'>"+traerProducto['clave_producto']+"</p>");
                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divDescripcion").html("<label>Descripción</label><p style='font-size:14px;'>"+traerProducto['descripcion_corta']+"</p>");
                            $("#div"+id_partcom).children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioActual").html('<label>Último Precio</label><input type="number" class="form-control" value="'+traerProducto['precio_compra']+'" disabled>');
                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio1").html('<label>Precio 1</label><input type="number" class="form-control precio1" value="'+traerProducto['precio1']+'">');
                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").html('<label>Utilidad 1</label><input type="number" class="form-control utilidad1" value="'+traerProducto['utilidad1']+'">');
                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio2").html('<label>Precio 2</label><input type="number" class="form-control precio2" value="'+traerProducto['precio2']+'">');
                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").html('<label>Utilidad 2</label><input type="number" class="form-control utilidad2" value="'+traerProducto['utilidad2']+'">');
                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio3").html('<label>Precio 3</label><input type="number" class="form-control precio3" value="'+traerProducto['precio3']+'">');
                            $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").html('<label>Utilidad 3</label><input type="number" class="form-control utilidad3" value="'+traerProducto['utilidad3']+'">');

                            setTimeout(function() {
                                $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").children(".utilidad1").trigger("change");
                                $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").children(".utilidad2").trigger("change");
                                $("#div"+id_partcom).children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").children(".utilidad3").trigger("change");
                            }, 700);
                            

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































//CAMBIO DE UTILIDAD 1
$(document).on("change", ".precio1", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var precio1 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputUtilidad1 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").children(".utilidad1");

    if(precioCompra != '' || precioCompra != 0){

        //var precioCompraIva = precioCompra * 1.16;

        //var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(2);

        //var utilidad1 = ((precio1/(precioCompra*1.16))-1).toFixed(2);

        var utilidad1 = ((precio1/(precioCompra))).toFixed(4);

        inputUtilidad1.val(utilidad1);


        actualizarProductoES2("precio1", precio1, id_producto, id_sucursal);
        actualizarProductoES2("utilidad1", utilidad1, id_producto, id_sucursal);
        
    }



});



//CAMBIO DE PRECIO 1
$(document).on("change", ".utilidad1", function(){

    //alert("cambio");

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var utilidad1 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputPrecio1 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio1").children(".precio1");

    if(precioCompra != '' || precioCompra != 0){

        //var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);

        //var precio1 =((precioCompra*1.16)+((precioCompra*1.16))*(utilidad1 - 1)).toFixed(0);

        var precio1 =((precioCompra)*(utilidad1)).toFixed(0);

        inputPrecio1.val(precio1);

        actualizarProductoES2("precio1", precio1, id_producto, id_sucursal).done(function(data){
            var respuestaU1 = data; // Do something with the data when it is ready
            if(respuestaU1 == 1){
                barraProgresion();
            }
        });

        //var respuestaU1 = actualizarProductoES2("precio1", precio1, id_producto, id_sucursal);

        
        actualizarProductoES2("utilidad1", utilidad1, id_producto, id_sucursal);

    }




});


//CAMBIO DE UTILIDAD 2
$(document).on("change", ".precio2", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var precio2 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputUtilidad2 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").children(".utilidad2");

    if(precioCompra != '' || precioCompra != 0){

        //var precioCompraIva = precioCompra * 1.16;

        //var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);
        
        //var utilidad2 = ((precio2/(precioCompra*1.16))-1).toFixed(2);

        var utilidad2 = ((precio2/(precioCompra))).toFixed(4);

        inputUtilidad2.val(utilidad2);

        actualizarProductoES2("precio2", precio2, id_producto, id_sucursal);
        actualizarProductoES2("utilidad2", utilidad2, id_producto, id_sucursal);

    }



});



//CAMBIO DE PRECIO 2
$(document).on("change", ".utilidad2", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var utilidad2 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputPrecio2 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio2").children(".precio2");

    if(precioCompra != '' || precioCompra != 0){

        //var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(2);

        //var precio2 =((precioCompra*1.16)+((precioCompra*1.16))*(utilidad2 - 1)).toFixed(2);

        var precio2 =((precioCompra)*(utilidad2)).toFixed(2);

        inputPrecio2.val(precio2);

        actualizarProductoES2("precio2", precio2, id_producto, id_sucursal).done(function(data){
            var respuestaU2 = data; // Do something with the data when it is ready
            if(respuestaU2 == 1){
                barraProgresion();
            }
        });

        actualizarProductoES2("utilidad2", utilidad2, id_producto, id_sucursal);


    }




});

//CAMBIO DE UTILIDAD 3
$(document).on("change", ".precio3", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var precio3 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputUtilidad3 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").children(".utilidad3");

    if(precioCompra != '' || precioCompra != 0){

        //var precioCompraIva = precioCompra * 1.16;

        //var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);
        
        //var utilidad3 = ((precio3/(precioCompra*1.16))-1).toFixed(2);

        var utilidad3 = ((precio3/(precioCompra))).toFixed(4);

        inputUtilidad3.val(utilidad3);

        actualizarProductoES2("precio3", precio3, id_producto, id_sucursal);
        actualizarProductoES2("utilidad3", utilidad3, id_producto, id_sucursal);

    }



});



//CAMBIO DE PRECIO 3
$(document).on("change", ".utilidad3", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var utilidad3 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputPrecio3 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio3").children(".precio3");

    if(precioCompra != '' || precioCompra != 0){

        //var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(2);
        
        //var precio3 =((precioCompra*1.16)+((precioCompra*1.16))*(utilidad3 - 1)).toFixed(2);

        var precio3 =((precioCompra)*(utilidad3)).toFixed(2);

        inputPrecio3.val(precio3);

        
        actualizarProductoES2("precio3", precio3, id_producto, id_sucursal).done(function(data){
            var respuestaU3 = data; // Do something with the data when it is ready
            if(respuestaU3 == 1){
                barraProgresion();
            }
        });
        actualizarProductoES2("utilidad3", utilidad3, id_producto, id_sucursal);

        
    }




});












//CAMBIO DE UTILIDAD 1
$(document).on("keyup", ".precio1", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var precio1 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputUtilidad1 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad1").children(".utilidad1");

    if(precioCompra != '' || precioCompra != 0){

        //var precioCompraIva = precioCompra * 1.16;

        //var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(2);

        //var utilidad1 = ((precio1/(precioCompra*1.16))-1).toFixed(2);

        var utilidad1 = ((precio1/(precioCompra))).toFixed(4);

        inputUtilidad1.val(utilidad1);


        actualizarProductoES2("precio1", precio1, id_producto, id_sucursal);
        actualizarProductoES2("utilidad1", utilidad1, id_producto, id_sucursal);
        
    }



});



//CAMBIO DE PRECIO 1
$(document).on("keyup", ".utilidad1", function(){

    //alert("cambio");

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var utilidad1 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputPrecio1 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio1").children(".precio1");

    if(precioCompra != '' || precioCompra != 0){

        //var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);

        //var precio1 =((precioCompra*1.16)+((precioCompra*1.16))*(utilidad1 - 1)).toFixed(0);

        var precio1 =((precioCompra)*(utilidad1)).toFixed(0);

        inputPrecio1.val(precio1);

        actualizarProductoES2("precio1", precio1, id_producto, id_sucursal);
        actualizarProductoES2("utilidad1", utilidad1, id_producto, id_sucursal);
    }




});


//CAMBIO DE UTILIDAD 2
$(document).on("keyup", ".precio2", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var precio2 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputUtilidad2 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad2").children(".utilidad2");

    if(precioCompra != '' || precioCompra != 0){

        //var precioCompraIva = precioCompra * 1.16;

        //var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);
        
        //var utilidad2 = ((precio2/(precioCompra*1.16))-1).toFixed(2);

        var utilidad2 = ((precio2/(precioCompra))).toFixed(4);

        inputUtilidad2.val(utilidad2);

        actualizarProductoES2("precio2", precio2, id_producto, id_sucursal);
        actualizarProductoES2("utilidad2", utilidad2, id_producto, id_sucursal);

    }



});



//CAMBIO DE PRECIO 2
$(document).on("keyup", ".utilidad2", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var utilidad2 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputPrecio2 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio2").children(".precio2");

    if(precioCompra != '' || precioCompra != 0){

        //var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(2);

        //var precio2 =((precioCompra*1.16)+((precioCompra*1.16))*(utilidad2 - 1)).toFixed(2);

        var precio2 =((precioCompra)*(utilidad2)).toFixed(2);

        inputPrecio2.val(precio2);

        actualizarProductoES2("precio2", precio2, id_producto, id_sucursal);
        actualizarProductoES2("utilidad2", utilidad2, id_producto, id_sucursal);

    }




});

//CAMBIO DE UTILIDAD 3
$(document).on("keyup", ".precio3", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var precio3 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputUtilidad3 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divUtilidad3").children(".utilidad3");

    if(precioCompra != '' || precioCompra != 0){

        //var precioCompraIva = precioCompra * 1.16;

        //var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);
        
        //var utilidad3 = ((precio3/(precioCompra*1.16))-1).toFixed(2);

        var utilidad3 = ((precio3/(precioCompra))).toFixed(4);

        inputUtilidad3.val(utilidad3);

        actualizarProductoES2("precio3", precio3, id_producto, id_sucursal);
        actualizarProductoES2("utilidad3", utilidad3, id_producto, id_sucursal);

    }



});



//CAMBIO DE PRECIO 3
$(document).on("keyup", ".utilidad3", function(){

    var id_producto = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");

    var id_sucursal = $("#id_sucursal").val();

    var utilidad3 = $(this).val();

    var precioCompra = $(this).parent().parent().parent().parent().children(".divSegundaParte").children(".rowSegundaParte").children(".divPrecioUnitario").children(".nuevoPrecioProductoSinIva").val();

    var inputPrecio3 = $(this).parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divPrecio3").children(".precio3");

    if(precioCompra != '' || precioCompra != 0){

        //var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(2);
        
        //var precio3 =((precioCompra*1.16)+((precioCompra*1.16))*(utilidad3 - 1)).toFixed(2);

        var precio3 =((precioCompra)*(utilidad3)).toFixed(2);

        inputPrecio3.val(precio3);

        actualizarProductoES2("precio3", precio3, id_producto, id_sucursal);
        actualizarProductoES2("utilidad3", utilidad3, id_producto, id_sucursal);
        
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










function validarProveedorVacio() {

if($("#nuevoIdProveedor2").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Introduzca un proveedor a esta compra',
        showConfirmButton: false,
        timer: 2000
        });

        $("#nuevoIdProveedor").focus();
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}











function validarTipoCompraVacio() {
if($("#editarTipoCompra").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe elegir un tipo de compra',
        showConfirmButton: false,
        timer: 2000
        });

        $("#editarTipoCompra").focus();
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}










function validarNoFacturaVacio() {

    var tipo_compra = $("#editarTipoCompra").val();

    //alert(tipo_compra);
    if(tipo_compra == 1){

        //alert($("#editarNoFacturaCompra").val());
        if($("#editarNoFacturaCompra").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Introduzca el número de factura',
        showConfirmButton: false,
        timer: 2000
        });

        $("#editarNoFacturaCompra").focus();
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    }else{
    
    return 1;
    }





    
    
    
}








function validarListaProductosVacia() {
if($("#listaProductos").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'No hay productos en esta compra',
        text: 'No se puede guardar la compra',
        showConfirmButton: true
        });

        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}










$(document).keydown(function(event) {
    //CREAR VENTA F8
    if (event.which === 119)
    {
        event.preventDefault();

        $("#btnSubmitGuardarCompra").trigger('click');

    }
});








$(document).on("click", "#btnSubmitGuardarCompra", function(){

    $(this).blur();

    var validar_lista_productos_vacia = validarListaProductosVacia();

    var validar_proveedor_vacio = validarProveedorVacio();

    var validar_tipo_venta_vacio = validarTipoCompraVacio();

    var validar_no_factura_vacio = validarNoFacturaVacio();
    

    if(validar_proveedor_vacio !== 0 && validar_tipo_venta_vacio !== 0 && validar_no_factura_vacio !== 0 && validar_lista_productos_vacia !== 0){
        
        document.forms["formularioCompra"].submit();
    }

});










$(document).on("click", ".inputMarca", function(){

    var id_marca = $(this).attr("id_marca");
    var divMarca = $(this).parent().parent();
    divMarca.empty();

    var parametros = {"id_marca":id_marca};

    $.ajax({
    data:parametros,
    type: 'POST',
    url: 'vistas/modulos/selects/selectMarcas.php',
    success: function(data) {
      divMarca.append(data);

      $(".seleccionarMarca").select2();
    }

  });

    
});












$(document).on("change", ".seleccionarMarca", function(){

    var id_producto = $(this).parent().parent().parent().parent().parent().children(".divPrimeraParte").children(".rowPrimeraParte").children(".divQuitarProducto").children(".quitarProducto").attr("id_producto");
    var id_marca = $(this).val();

    var datos = new FormData();
    datos.append("columna", "id_marca");
    datos.append("valor", id_marca);
    datos.append("actualizarProducto", id_producto);

    $.ajax({
        async: false,
        url:"ajax/productos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){
            console.log(respuesta);
        }

    });
    
});
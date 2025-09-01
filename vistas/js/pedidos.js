
function buscarAhoraPedidos(buscarPedidos) {
        var parametros = {"buscarPedidos":buscarPedidos};
        $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadorPedidos.php',
                success: function(data) {
                        document.getElementById("listaPedidos").innerHTML = data;
                }
        });
}



function buscarProductosPedidos(buscarProductosPedidos) {

        var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");


        var parametros = {"buscarProductosPedidos":buscarProductosPedidos, "no_precio":no_precio};
        $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadorProductosPedidos.php',
                success: function(data) {
                        document.getElementById("listaProductosPedidos").innerHTML = data;
                }
        });
}

id_cliente = $("#nuevoIdCliente").val();

$("#nuevoIdCliente2").val(id_cliente);

descuento = $("#nuevoIdCliente>option:selected").attr("descuento");

$("#nuevoDescuentoPedido").val(descuento);


        /*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(".listaProductosPedidos tbody").on("click", "button.agregarProducto", function(){

        var id_producto = $(this).attr("id_producto");

        if(myArr.includes(id_producto) == true){

                $(this).removeClass("btn-primary agregarProducto");

                $(this).addClass("btn-default");

        }else{

         myArr.push(id_producto);

         console.log(myArr); 

         $(this).removeClass("btn-primary agregarProducto");

         $(this).addClass("btn-default");



         var datos = new FormData();
         datos.append("id_producto", id_producto);

         $.ajax({

                url:"ajax/pedidos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){

                        var descripcion_corta = respuesta["descripcion_corta"];
                        var stock = respuesta["stock"];

                        var descuentoFamilia = respuesta["descuento"];

                        var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                        var descuento = $("#nuevoDescuentoPedido").val();

                        var descuentoFamilia = respuesta["descuento"];

                        if(no_precio == 1){

                                var precioOriginal = Number(respuesta["precio1"]);

                                var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
                                    precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));

                        }else if(no_precio == 2){
                                var precioOriginal = Number(respuesta["precio2"]);

                                var precio1 = Number(respuesta["precio2"]) -(Number(respuesta["precio2"]) * (Number(descuento) / Number(100)));
precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                        }else if(no_precio == 3){

                                var precioOriginal = Number(respuesta["precio3"]);

                                var precio1 = Number(respuesta["precio3"]) -(Number(respuesta["precio3"]) * (Number(descuento) / Number(100)));
precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                        }else{

                                var precioOriginal = Number(respuesta["precio1"]);

                                var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                        }





                        $(".nuevoProducto").append('<div class="row">'+
                              '<div class="col-1">'+
                              '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                              '</div>'+
                              '<div class="col-5">'+
                              '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'" readonly>'+
                              '</div>'+
                              '<div class="col-2 ingresoCantidad">'+
                              '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                              '</div>'+
                              '<div class="col-1 ingresoDescuento">'+
                              '<input type="number" class="form-control nuevoDescuentoProducto" name="nuevoDescuentoProducto" value="'+descuento+'" descuento="'+descuento+'">'+
                              '</div>'+
                              '<div class="col-3 ingresoPrecio">'+
                              '<div class="input-group mb-3">'+
                              '<input type="text" class="form-control nuevoPrecioProducto" descuentoFamilia="'+descuentoFamilia+'" precioOriginal="'+precioOriginal+'" precioReal="'+precio1+'" value="'+precio1+'" readonly>'+
                              '<div class="input-group-append">'+
                              '<span class="input-group-text">$</span>'+
                              '</div>'+
                              '</div>'+
                              '</div>');

                // SUMAR TOTAL DE PRECIOS

                        sumarTotalPrecios()


                // AGRUPAR PRODUCTOS EN FORMATO JSON

                        listarProductos()

                // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                        $(".nuevoPrecioProducto").number(true, 2);
                }
});//AJAX

document.getElementById("buscar3").val("").onkeyup();


}




});


$("#nuevoIdCliente").on('change', function() {

        var descuento = $("#nuevoIdCliente>option:selected").attr("descuento");

        $("#nuevoDescuentoPedido").val(descuento);

        id_cliente = $("#nuevoIdCliente").val();

        $("#nuevoIdCliente2").val(id_cliente);

        myArr = [];
        listaProductos = [];


        $("#listaProductos").val("");


        removeAllChilds('a');



        document.getElementById("buscar3").onkeyup();

        $("#totalPedido").val("");
        $("#nuevoTotalPedido").val("");



})



function removeAllChilds(a)
{
       var a=document.getElementById(a);
       while(a.hasChildNodes())
            a.removeChild(a.firstChild);    
}



$(".listaProductosPedidos").on("draw.dt", function(){
        console.log("tabla")
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioPedido").on("click", "button.quitarProducto", function(){

        var id_producto = $(this).attr("id_producto");

        var posicion = myArr.indexOf(id_producto);

        myArr.splice(posicion, 1);

        console.log(myArr); 

        $(this).parent().parent().remove();

        


        $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


        if($(".nuevoProducto").children().length == 0){

                $("#listaProductos").val("");
                $("#nuevoTotalPedido").attr("total",0);
                $("#nuevoTotalPedido").val(0);
                $("#totalPedido").val(0);
                $("#nuevoImpuestoPedido").val(0);

                
                

        }else{
             // SUMAR TOTAL DE PRECIOS

                sumarTotalPrecios();   


                // AGRUPAR PRODUCTOS EN FORMATO JSON

                listarProductos();
        }



});












/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioPedido").on("change", "input.nuevaCantidadProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        /*var precioFinal = $(this).val() * precio1.val();

                precio1.val(precioFinal);*/


        var descuento = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDescuentoProducto");

        descuento = descuento.val();

                //alert("este es el descuento:   "+descuento);

        var descuentoFamilia = precio1.attr("descuentoFamilia");

                //alert("este es el descuento de la familia:   "+descuentoFamilia);

        var precioProductoDescuento = precio1.attr("precioOriginal") - (precio1.attr("precioOriginal") * (Number(descuento) / Number(100)));

                //alert("Este es el valor del producto con descuento:    "+precioProductoDescuento);

        var precioProductoDescuentoDescuentoFamilia = precioProductoDescuento - (precioProductoDescuento * (Number(descuentoFamilia) / Number(100)));

                //alert("Este es el valor del producto con descuento y con descuento de familia:    "+precioProductoDescuentoDescuentoFamilia);

        cantidad = $(this).val();

                //alert("este es la cantidad por la que se va a multiplicar:    "+cantidad);

        precioFinal = precioProductoDescuentoDescuentoFamilia * cantidad;

                //alert("Este es el total del producto con descuento por la cantidad:    "+precioFinal);

        precio1.val(precioFinal);
        precio1.attr("precioReal", precioProductoDescuentoDescuentoFamilia);


// SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();
});



/*=============================================
MODIFICAR EL DESCUENTO POR PRODUCTO
=============================================*/

$(".formularioPedido").on("change", "input.nuevoDescuentoProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

        var descuento = $(this).val();

        //alert("este es el descuento:   "+descuento);

        var descuentoFamilia = precio1.attr("descuentoFamilia");

                //alert("este es el descuento de la familia:   "+descuentoFamilia);


        var precioProductoDescuento = precio1.attr("precioOriginal") -(precio1.attr("precioOriginal") * (Number(descuento) / Number(100)));

//alert("Este es el valor del producto con descuento:    "+precioProductoDescuento);

        var precioProductoDescuentoDescuentoFamilia = precioProductoDescuento - (precioProductoDescuento * (Number(descuentoFamilia) / Number(100)));

                //alert("Este es el valor del producto con descuento y con descuento de familia:    "+precioProductoDescuentoDescuentoFamilia);

        cantidad = cantidad.val();
//alert("este es la cantidad por la que se va a multiplicar:    "+cantidad);


        precioFinal = precioProductoDescuentoDescuentoFamilia * cantidad;

                //alert("Este es el total del producto con descuento por la cantidad:    "+precioFinal);

        precio1.val(precioFinal);

        precio1.attr("precioReal", precioProductoDescuentoDescuentoFamilia);


// SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();
});


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


$("#nuevoTotalPedido").val(sumaTotalPrecio);
$("#totalPedido").val(sumaTotalPrecio);
$("#nuevoTotalPedido").attr("total",sumaTotalPrecio);


}




/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalPedido").number(true, 2);






        /*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

        var listaProductos = [];

        var descripcion = $(".nuevaDescripcionProducto");

        var cantidad = $(".nuevaCantidadProducto");

        var precio = $(".nuevoPrecioProducto");

        for(var i = 0; i < descripcion.length; i++){

                listaProductos.push({ "id" : $(descripcion[i]).attr("id_producto"),
                      "cantidad" : $(cantidad[i]).val(),
                      "precio" : $(precio[i]).attr("precioReal"),
                      "total" : $(precio[i]).val()})

        }
        console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}


/*Editar usuario*/
$(document).on("click", ".btnVerSeguimientoVenta", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/


        var datos = new FormData();
        datos.append("id_venta",id_venta); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta, respuesta2){

                        $("#mostrarNombreCliente").val(respuesta["nombre"]);
                        $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                        $("#mostrarIdVenta").val(respuesta["id"]);
                        $("#mostrarSaldoInicial").val(respuesta["total"]);
                        $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                        $(".btnCrearAbono").attr("id_venta",respuesta["id"]);

                }
        });


var id_venta3 =  {"id_venta3": $(this).attr("id_venta")};

$.ajax({
        data:id_venta3,
        type: 'POST',
        url: 'vistas/modulos/consultaSeguimiento.php',
        success: function(data) {
        document.getElementById("listaSeguimiento").innerHTML = data;
        }
        });

})





/*Editar usuario*/
$(document).on("click", ".btnCrearAbono", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta2 = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/

        var datos = new FormData();
        datos.append("id_venta2",id_venta2); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                        $("#nuevoIdVenta").val(respuesta["id"]);
                        $("#nuevoIdCliente").val(respuesta["id_cliente"]);
                        $("#saldoActual").val(respuesta["saldo_actual"]);


                }
        });


})



function buscarAhoraVentas(buscarVentas) {
        var parametros = {"buscarVentas":buscarVentas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorVentas.php',
        success: function(data) {
        document.getElementById("listaVentas").innerHTML = data;
        }
        });
        }



function buscar_ahora3(buscar3) {

var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

//var no_precio = 1;


        var parametros = {"buscar3":buscar3, "no_precio":no_precio};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador3.php',
        success: function(data) {
        document.getElementById("listaProductos3").innerHTML = data;
        }
        });
        }




/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(".listaProductosVentas tbody").on("click", "button.agregarProducto", function(){

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

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

                var descripcion_corta = respuesta["descripcion_corta"];
                var stock = respuesta["stock"];

                var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                if(no_precio == 1){

                        var precio1 = respuesta["precio1"];

                    }else if(no_precio == 2){

                        var precio1 = respuesta["precio2"];
                    
                    }else if(no_precio == 3){
                       
                        var precio1 = respuesta["precio3"];
                    
                    }else{
                        var precio1 = respuesta["precio1"];

                }


                    


                /*$(".nuevoProducto").append('<div class="row">'+
                  '<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                   '<div class="col-2 ingresoPrecio">'+
                    '<div class="input-group mb-3">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
                  '<div class="input-group-append">'+
                    '<span class="input-group-text">$</span>'+
                  '</div>'+
                '</div>'+
                  '</div>');*/




$(".nuevoProducto").append('<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                  '<div class="col-3">'+
                    '<div class="input-group">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
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
        }
       

         

});



$(".listaProductosVentas").on("draw.dt", function(){
        console.log("tabla")
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioVenta").on("click", "button.quitarProducto", function(){

var id_producto = $(this).attr("id_producto");

var posicion = myArr.indexOf(id_producto);

myArr.splice(posicion, 1);

console.log(myArr); 

        $(this).parent().parent().remove();

        


                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


if($(".nuevoProducto").children().length == 0){

$("#nuevoTotalVenta").attr("total",0);
         $("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoImpuestoVenta").val(0);
               
                
                

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

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

        var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

        if(Number($(this).val()) > Number($(this).attr("stock"))){

                /*=============================================
                SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
                =============================================*/

                $(this).val(1);

                var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

                var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

                Swal.fire({
  icon: 'error',
  title: 'Superas el stock',
  showConfirmButton: false,
  timer: 700
})
        }

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

        
        $("#nuevoTotalVenta").val(sumaTotalPrecio);
        $("#totalVenta").val(sumaTotalPrecio);
        $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}





/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalVenta").number(true, 2);




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
                                                          "descripcion" : $(descripcion[i]).val(),
                                                          "cantidad" : $(cantidad[i]).val(),
                                                          "stock" : $(cantidad[i]).attr("nuevoStock"),
                                                          "precio" : $(precio[i]).attr("precioReal"),
                                                          "total" : $(precio[i]).val()})

        }
console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}















































/*Editar usuario*/
$(document).on("click", ".btnVerSeguimientoVenta", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/


        var datos = new FormData();
        datos.append("id_venta",id_venta); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        
        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){



                        $("#mostrarNombreCliente").val(respuesta["nombre"]);
                        $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                        $("#mostrarIdVenta").val(respuesta["id"]);
                        $("#mostrarSaldoInicial").val(respuesta["total"]);
                        $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                        $(".btnCrearAbono").attr("id_venta",respuesta["id"]);

                }
        });


var id_venta3 =  {"id_venta3": $(this).attr("id_venta")};

$.ajax({
        data:id_venta3,
        type: 'POST',
        url: 'vistas/modulos/consultaSeguimiento.php',
        success: function(data) {
        document.getElementById("listaSeguimiento").innerHTML = data;
        }
        });

})





/*Editar usuario*/
$(document).on("click", ".btnCrearAbono", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta2 = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/

        var datos = new FormData();
        datos.append("id_venta2",id_venta2); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                        $("#nuevoIdVenta").val(respuesta["id"]);
                        $("#nuevoIdCliente").val(respuesta["id_cliente"]);
                        $("#saldoActual").val(respuesta["saldo_actual"]);


                }
        });


})





function buscarAhoraVentas(buscarVentas) {
        var parametros = {"buscarVentas":buscarVentas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorVentas.php',
        success: function(data) {
        document.getElementById("listaVentas").innerHTML = data;
        }
        });
        }



function buscar_ahora3(buscar3) {

var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");


//var no_precio = 1;


        var parametros = {"buscar3":buscar3, "no_precio":no_precio};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador3.php',
        success: function(data) {
        document.getElementById("listaProductos3").innerHTML = data;
        }
        });
        }



        /*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(".listaProductosVentas tbody").on("click", "button.agregarProducto", function(){

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

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

                var descripcion_corta = respuesta["descripcion_corta"];
                var stock = respuesta["stock"];

                var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                if(no_precio == 1){

                        var precio1 = respuesta["precio1"];

                    }else if(no_precio == 2){

                        var precio1 = respuesta["precio2"];
                    
                    }else if(no_precio == 3){
                       
                        var precio1 = respuesta["precio3"];
                    
                    }else{
                        var precio1 = respuesta["precio1"];

                };


                $(".nuevoProducto").append('<div class="row">'+
                  '<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                   '<div class="col-3 ingresoPrecio">'+
                    '<div class="input-group mb-3">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
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

     $("#buscar3").val("").focus().onKeyUp(buscar_ahora3($('#buscar3').val()));

      


        }
       

         

});

$("#nuevoIdCliente").on('change', function() {
    myArr = [];
    listaProductos = [];

    
$("#listaProductos").val(""); 

function removeAllChilds(a)
 {
 var a=document.getElementById(a);
 while(a.hasChildNodes())
    a.removeChild(a.firstChild);    
 }
 removeAllChilds('a');

})



$(".listaProductosVentas").on("draw.dt", function(){
        console.log("tabla")
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioVenta").on("click", "button.quitarProducto", function(){

var id_producto = $(this).attr("id_producto");

var posicion = myArr.indexOf(id_producto);

myArr.splice(posicion, 1);

console.log(myArr); 

        $(this).parent().parent().remove();

        


                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


if($(".nuevoProducto").children().length == 0){

$("#nuevoTotalVenta").attr("total",0);
         $("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoImpuestoVenta").val(0);
               
                
                

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

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

        var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

        if(Number($(this).val()) > Number($(this).attr("stock"))){

                /*=============================================
                SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
                =============================================*/

                $(this).val(1);

                var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

                var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

                Swal.fire({
  icon: 'error',
  title: 'Superas el stock',
  showConfirmButton: false,
  timer: 700
})
        }

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

        
        $("#nuevoTotalVenta").val(sumaTotalPrecio);
        $("#totalVenta").val(sumaTotalPrecio);
        $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}




/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalVenta").number(true, 2);






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
                                                          "descripcion" : $(descripcion[i]).val(),
                                                          "cantidad" : $(cantidad[i]).val(),
                                                          "precio" : $(precio[i]).attr("precioReal"),
                                                          "total" : $(precio[i]).val()})

        }
console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}






















/*Editar usuario*/
$(document).on("click", ".btnVerSeguimientoVenta", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/


        var datos = new FormData();
        datos.append("id_venta",id_venta); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta, respuesta2){

                        $("#mostrarNombreCliente").val(respuesta["nombre"]);
                        $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                        $("#mostrarIdVenta").val(respuesta["id"]);
                        $("#mostrarSaldoInicial").val(respuesta["total"]);
                        $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                        $(".btnCrearAbono").attr("id_venta",respuesta["id"]);

                }
        });


var id_venta3 =  {"id_venta3": $(this).attr("id_venta")};

$.ajax({
        data:id_venta3,
        type: 'POST',
        url: 'vistas/modulos/consultaSeguimiento.php',
        success: function(data) {
        document.getElementById("listaSeguimiento").innerHTML = data;
        }
        });

})





/*Editar usuario*/
$(document).on("click", ".btnCrearAbono", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta2 = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/

        var datos = new FormData();
        datos.append("id_venta2",id_venta2); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                        $("#nuevoIdVenta").val(respuesta["id"]);
                        $("#nuevoIdCliente").val(respuesta["id_cliente"]);
                        $("#saldoActual").val(respuesta["saldo_actual"]);


                }
        });


})



function buscarAhoraVentas(buscarVentas) {
        var parametros = {"buscarVentas":buscarVentas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorVentas.php',
        success: function(data) {
        document.getElementById("listaVentas").innerHTML = data;
        }
        });
        }



function buscar_ahora3(buscar3) {

var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

//var no_precio = 1;


        var parametros = {"buscar3":buscar3, "no_precio":no_precio};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador3.php',
        success: function(data) {
        document.getElementById("listaProductos3").innerHTML = data;
        }
        });
        }




        /*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(".listaProductosVentas tbody").on("click", "button.agregarProducto", function(){

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

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

                var descripcion_corta = respuesta["descripcion_corta"];
                var stock = respuesta["stock"];

                var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                if(no_precio == 1){

                        var precio1 = respuesta["precio1"];

                    }else if(no_precio == 2){

                        var precio1 = respuesta["precio2"];
                    
                    }else if(no_precio == 3){
                       
                        var precio1 = respuesta["precio3"];
                    
                    }else{
                        var precio1 = respuesta["precio1"];

                }


                    


                /*$(".nuevoProducto").append('<div class="row">'+
                  '<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                   '<div class="col-2 ingresoPrecio">'+
                    '<div class="input-group mb-3">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
                  '<div class="input-group-append">'+
                    '<span class="input-group-text">$</span>'+
                  '</div>'+
                '</div>'+
                  '</div>');*/




$(".nuevoProducto").append('<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                  '<div class="col-3">'+
                    '<div class="input-group">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
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
        }
       

         

});



$(".listaProductosVentas").on("draw.dt", function(){
        console.log("tabla")
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioVenta").on("click", "button.quitarProducto", function(){

var id_producto = $(this).attr("id_producto");

var posicion = myArr.indexOf(id_producto);

myArr.splice(posicion, 1);

console.log(myArr); 

        $(this).parent().parent().remove();

        


                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


if($(".nuevoProducto").children().length == 0){

$("#nuevoTotalVenta").attr("total",0);
         $("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoImpuestoVenta").val(0);
               
                
                

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

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

        var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

        if(Number($(this).val()) > Number($(this).attr("stock"))){

                /*=============================================
                SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
                =============================================*/

                $(this).val(1);

                var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

                var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

                Swal.fire({
  icon: 'error',
  title: 'Superas el stock',
  showConfirmButton: false,
  timer: 700
})
        }

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

        
        $("#nuevoTotalVenta").val(sumaTotalPrecio);
        $("#totalVenta").val(sumaTotalPrecio);
        $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}





/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalVenta").number(true, 2);




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
                                                          "descripcion" : $(descripcion[i]).val(),
                                                          "cantidad" : $(cantidad[i]).val(),
                                                          "stock" : $(cantidad[i]).attr("nuevoStock"),
                                                          "precio" : $(precio[i]).attr("precioReal"),
                                                          "total" : $(precio[i]).val()})

        }
console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}









































































/*Editar usuario*/
$(document).on("click", ".btnVerSeguimientoVenta", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/


        var datos = new FormData();
        datos.append("id_venta",id_venta); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        
        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){



                        $("#mostrarNombreCliente").val(respuesta["nombre"]);
                        $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                        $("#mostrarIdVenta").val(respuesta["id"]);
                        $("#mostrarSaldoInicial").val(respuesta["total"]);
                        $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                        $(".btnCrearAbono").attr("id_venta",respuesta["id"]);

                }
        });


var id_venta3 =  {"id_venta3": $(this).attr("id_venta")};

$.ajax({
        data:id_venta3,
        type: 'POST',
        url: 'vistas/modulos/consultaSeguimiento.php',
        success: function(data) {
        document.getElementById("listaSeguimiento").innerHTML = data;
        }
        });

})





/*Editar usuario*/
$(document).on("click", ".btnCrearAbono", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta2 = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/

        var datos = new FormData();
        datos.append("id_venta2",id_venta2); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                        $("#nuevoIdVenta").val(respuesta["id"]);
                        $("#nuevoIdCliente").val(respuesta["id_cliente"]);
                        $("#saldoActual").val(respuesta["saldo_actual"]);


                }
        });


})





function buscarAhoraVentas(buscarVentas) {
        var parametros = {"buscarVentas":buscarVentas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorVentas.php',
        success: function(data) {
        document.getElementById("listaVentas").innerHTML = data;
        }
        });
        }



function buscar_ahora3(buscar3) {

var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");


//var no_precio = 1;


        var parametros = {"buscar3":buscar3, "no_precio":no_precio};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador3.php',
        success: function(data) {
        document.getElementById("listaProductos3").innerHTML = data;
        }
        });
        }



        /*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(".listaProductosVentas tbody").on("click", "button.agregarProducto", function(){

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

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

                var descripcion_corta = respuesta["descripcion_corta"];
                var stock = respuesta["stock"];

                var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                if(no_precio == 1){

                        var precio1 = respuesta["precio1"];

                    }else if(no_precio == 2){

                        var precio1 = respuesta["precio2"];
                    
                    }else if(no_precio == 3){
                       
                        var precio1 = respuesta["precio3"];
                    
                    }else{
                        var precio1 = respuesta["precio1"];

                };


                $(".nuevoProducto").append('<div class="row">'+
                  '<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                   '<div class="col-3 ingresoPrecio">'+
                    '<div class="input-group mb-3">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
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

     $("#buscar3").val("").focus().onKeyUp(buscar_ahora3($('#buscar3').val()));

      


        }
       

         

});

$("#nuevoIdCliente").on('change', function() {
    myArr = [];
    listaProductos = [];

    
$("#listaProductos").val(""); 

function removeAllChilds(a)
 {
 var a=document.getElementById(a);
 while(a.hasChildNodes())
    a.removeChild(a.firstChild);    
 }
 removeAllChilds('a');

});



$(".listaProductosVentas").on("draw.dt", function(){
        console.log("tabla")
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioVenta").on("click", "button.quitarProducto", function(){

var id_producto = $(this).attr("id_producto");

var posicion = myArr.indexOf(id_producto);

myArr.splice(posicion, 1);

console.log(myArr); 

        $(this).parent().parent().remove();

        


                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


if($(".nuevoProducto").children().length == 0){

$("#nuevoTotalVenta").attr("total",0);
         $("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoImpuestoVenta").val(0);
               
                
                

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

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

        var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

        if(Number($(this).val()) > Number($(this).attr("stock"))){

                /*=============================================
                SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
                =============================================*/

                $(this).val(1);

                var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

                var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

                Swal.fire({
  icon: 'error',
  title: 'Superas el stock',
  showConfirmButton: false,
  timer: 700
})
        }

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

        
        $("#nuevoTotalVenta").val(sumaTotalPrecio);
        $("#totalVenta").val(sumaTotalPrecio);
        $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}




/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalVenta").number(true, 2);






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
                                                          "descripcion" : $(descripcion[i]).val(),
                                                          "cantidad" : $(cantidad[i]).val(),
                                                          "precio" : $(precio[i]).attr("precioReal"),
                                                          "total" : $(precio[i]).val()})

        }
console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}













































/*Editar usuario*/
$(document).on("click", ".btnVerSeguimientoVenta", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/


        var datos = new FormData();
        datos.append("id_venta",id_venta); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        
        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){



                        $("#mostrarNombreCliente").val(respuesta["nombre"]);
                        $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                        $("#mostrarIdVenta").val(respuesta["id"]);
                        $("#mostrarSaldoInicial").val(respuesta["total"]);
                        $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                        $(".btnCrearAbono").attr("id_venta",respuesta["id"]);

                }
        });


var id_venta3 =  {"id_venta3": $(this).attr("id_venta")};

$.ajax({
        data:id_venta3,
        type: 'POST',
        url: 'vistas/modulos/consultaSeguimiento.php',
        success: function(data) {
        document.getElementById("listaSeguimiento").innerHTML = data;
        }
        });

})





/*Editar usuario*/
$(document).on("click", ".btnCrearAbono", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta2 = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/

        var datos = new FormData();
        datos.append("id_venta2",id_venta2); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                        $("#nuevoIdVenta").val(respuesta["id"]);
                        $("#nuevoIdCliente").val(respuesta["id_cliente"]);
                        $("#saldoActual").val(respuesta["saldo_actual"]);


                }
        });


})


function buscarAhoraVentas(buscarVentas) {
        var parametros = {"buscarVentas":buscarVentas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorVentas.php',
        success: function(data) {
        document.getElementById("listaVentas").innerHTML = data;
        }
        });
        }



function buscar_ahora3(buscar3) {

var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");


//var no_precio = 1;


        var parametros = {"buscar3":buscar3, "no_precio":no_precio};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador3.php',
        success: function(data) {
        document.getElementById("listaProductos3").innerHTML = data;
        }
        });
        }




        /*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(".listaProductosVentas tbody").on("click", "button.agregarProducto", function(){

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

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

                var descripcion_corta = respuesta["descripcion_corta"];
                var stock = respuesta["stock"];

                var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                if(no_precio == 1){

                        var precio1 = respuesta["precio1"];

                    }else if(no_precio == 2){

                        var precio1 = respuesta["precio2"];
                    
                    }else if(no_precio == 3){
                       
                        var precio1 = respuesta["precio3"];
                    
                    }else{
                        var precio1 = respuesta["precio1"];

                }


                    


                $(".nuevoProducto").append('<div class="row">'+
                  '<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                   '<div class="col-3 ingresoPrecio">'+
                    '<div class="input-group mb-3">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
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

     $("#buscar3").val("").focus().onKeyUp(buscar_ahora3($('#buscar3').val()));


        }
       

         

});


$("#nuevoIdCliente").on('change', function() {

    myArr = [];
    listaProductos = [];

    
$("#listaProductos").val("");


 removeAllChilds('a');



     document.getElementById("buscar3").onkeyup();

     $("#totalVenta").val("");
     $("#nuevoTotalVenta").val("");



})



function removeAllChilds(a)
 {
 var a=document.getElementById(a);
 while(a.hasChildNodes())
    a.removeChild(a.firstChild);    
 }



$(".listaProductosVentas").on("draw.dt", function(){
        console.log("tabla")
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioVenta").on("click", "button.quitarProducto", function(){

var id_producto = $(this).attr("id_producto");

var posicion = myArr.indexOf(id_producto);

myArr.splice(posicion, 1);

console.log(myArr); 

        $(this).parent().parent().remove();

        


                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


if($(".nuevoProducto").children().length == 0){

$("#nuevoTotalVenta").attr("total",0);
         $("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoImpuestoVenta").val(0);
               
                
                

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

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

        var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

        if(Number($(this).val()) > Number($(this).attr("stock"))){

                /*=============================================
                SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
                =============================================*/

                $(this).val(1);

                var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

                var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

                Swal.fire({
  icon: 'error',
  title: 'Superas el stock',
  showConfirmButton: false,
  timer: 700
})
        }

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

        
        $("#nuevoTotalVenta").val(sumaTotalPrecio);
        $("#totalVenta").val(sumaTotalPrecio);
        $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}




/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalVenta").number(true, 2);






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
                                                          "descripcion" : $(descripcion[i]).val(),
                                                          "cantidad" : $(cantidad[i]).val(),
                                                          "precio" : $(precio[i]).attr("precioReal"),
                                                          "total" : $(precio[i]).val()})

        }
console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}



































//ESTE ES EL BUENO DE LA PRIMERA VERSIÓN DE LA VENTA

/*Editar usuario*/
$(document).on("click", ".btnVerSeguimientoVenta", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/


        var datos = new FormData();
        datos.append("id_venta",id_venta); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        
        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){



                        $("#mostrarNombreCliente").val(respuesta["nombre"]);
                        $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                        $("#mostrarIdVenta").val(respuesta["id"]);
                        $("#mostrarSaldoInicial").val(respuesta["total"]);
                        $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                        $(".btnCrearAbono").attr("id_venta",respuesta["id"]);

                }
        });


var id_venta3 =  {"id_venta3": $(this).attr("id_venta")};

$.ajax({
        data:id_venta3,
        type: 'POST',
        url: 'vistas/modulos/consultaSeguimiento.php',
        success: function(data) {
        document.getElementById("listaSeguimiento").innerHTML = data;
        }
        });

})





/*Editar usuario*/
$(document).on("click", ".btnCrearAbono", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
                                                                                tiene la clase brnEditarUsuario se ejecute el script*/

        var id_venta2 = $(this).attr("id_venta"); /*Aqui le decimos que la variable id_suario va a ser igual al atributo id_usuario el cual le asignamos
                                                                                                        el id del usuario*/

        var datos = new FormData();
        datos.append("id_venta2",id_venta2); /*Aquí le decimos segun yo que busque los datos por
                                                                                        el atributo pos id_usuario el cual su valor será
                                                                                        id_usuario el cual le pasamos el id del usuario*/
        

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){

                        $("#nuevoIdVenta").val(respuesta["id"]);
                        $("#nuevoIdCliente").val(respuesta["id_cliente"]);
                        $("#saldoActual").val(respuesta["saldo_actual"]);


                }
        });


})


function buscarAhoraVentas(buscarVentas) {
        var parametros = {"buscarVentas":buscarVentas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorVentas.php',
        success: function(data) {
        document.getElementById("listaVentas").innerHTML = data;
        }
        });
        }



function buscar_ahora3(buscar3) {

var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");


//var no_precio = 1;


        var parametros = {"buscar3":buscar3, "no_precio":no_precio};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador3.php',
        success: function(data) {
        document.getElementById("listaProductos3").innerHTML = data;
        }
        });
        }




        /*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
$(".listaProductosVentas tbody").on("click", "button.agregarProducto", function(){

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

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

                var descripcion_corta = respuesta["descripcion_corta"];
                var stock = respuesta["stock"];

                var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                if(no_precio == 1){

                        var precio1 = respuesta["precio1"];

                    }else if(no_precio == 2){

                        var precio1 = respuesta["precio2"];
                    
                    }else if(no_precio == 3){
                       
                        var precio1 = respuesta["precio3"];
                    
                    }else{
                        var precio1 = respuesta["precio1"];

                }


                    


                $(".nuevoProducto").append('<div class="row">'+
                  '<div class="col-1">'+
                    '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                  '</div>'+
                  '<div class="col-6">'+
                    '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'">'+
                  '</div>'+
                  '<div class="col-2">'+
                    '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                  '</div>'+
                   '<div class="col-3 ingresoPrecio">'+
                    '<div class="input-group mb-3">'+
                  '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio1+'" value="'+precio1+'">'+
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

     $("#buscar3").val("").focus().onKeyUp(buscar_ahora3($('#buscar3').val()));


        }
       

         

});


$("#nuevoIdCliente").on('change', function() {

    myArr = [];
    listaProductos = [];

    
$("#listaProductos").val("");


 removeAllChilds('a');



     document.getElementById("buscar3").onkeyup();

     $("#totalVenta").val("");
     $("#nuevoTotalVenta").val("");



})



function removeAllChilds(a)
 {
 var a=document.getElementById(a);
 while(a.hasChildNodes())
    a.removeChild(a.firstChild);    
 }



$(".listaProductosVentas").on("draw.dt", function(){
        console.log("tabla")
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioVenta").on("click", "button.quitarProducto", function(){

var id_producto = $(this).attr("id_producto");

var posicion = myArr.indexOf(id_producto);

myArr.splice(posicion, 1);

console.log(myArr); 

        $(this).parent().parent().remove();

        


                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


if($(".nuevoProducto").children().length == 0){

$("#listaProductos").val("");
$("#nuevoTotalVenta").attr("total",0);
         $("#nuevoTotalVenta").val(0);
$("#totalVenta").val(0);
$("#nuevoImpuestoVenta").val(0);
               
                
                

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

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

        var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

        var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

        var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

        if(Number($(this).val()) > Number($(this).attr("stock"))){

                /*=============================================
                SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
                =============================================*/

                $(this).val(1);

                var nuevoStock = Number($(this).attr("stock")) - $(this).val();

        $(this).attr("nuevoStock", nuevoStock);

                var precioFinal = $(this).val() * precio1.attr("precioReal");

                precio1.val(precioFinal);

                Swal.fire({
  icon: 'error',
  title: 'Superas el stock',
  showConfirmButton: false,
  timer: 700
})
        }

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

        
        $("#nuevoTotalVenta").val(sumaTotalPrecio);
        $("#totalVenta").val(sumaTotalPrecio);
        $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}




/*=============================================
PONER FORMATO AL PRECIO DE LOS PRODUCTOS
=============================================*/

$("#nuevoTotalVenta").number(true, 2);






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
                                                          "descripcion" : $(descripcion[i]).val(),
                                                          "cantidad" : $(cantidad[i]).val(),
                                                          "precio" : $(precio[i]).attr("precioReal"),
                                                          "total" : $(precio[i]).val()})

        }
console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}


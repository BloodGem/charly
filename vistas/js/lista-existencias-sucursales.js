$( document ).ready(function() {
    clave_producto = $("#buscarProductosExistenciasSucursales").val();
    if(clave_producto !== ""){
        buscarAhoraProductosExistenciasSucursales(clave_producto);
    }
});



/*=============================================
BOTON EDITAR PRODUCTO
=============================================*/
$(document).on("click", ".btnEditarProducto", function(){

    

    $("#buscarProductosExistenciasSucursales").attr("teclaEsc", "no");
    
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
          
        $("#mostrarDescripcionCortaProducto").val(respuesta["descripcion_corta"]);
        $("#id_producto").val(respuesta["id_producto"]);
        $("#mostrarPrecioCompra").val(respuesta["precio_compra"]);
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
        


      }

  });


});










function buscarProductoES(id_producto){
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
          
        $("#mostrarDescripcionCortaProducto").val(respuesta["descripcion_corta"]);
        $("#id_producto").val(respuesta["id_producto"]);
        $("#mostrarPrecioCompra").val(respuesta["precio_compra"]);
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
        


      }

  });
}










/*=============================================
BUSCADOR DE PRODUCTOS
=============================================*/
function buscarAhoraProductosExistenciasSucursales(buscarProductosExistenciasSucursales) {
        var parametros = {"buscarProductosExistenciasSucursales":buscarProductosExistenciasSucursales};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorExistenciasSucursales.php',
        success: function(data) {
        document.getElementById("incrustarTablaProductosExistenciasSucursales").innerHTML = data;
        }
        });
        }



        $(document).on("change", "#buscarProductosExistenciasSucursales", function(){

    var buscar = $(this).val();

    buscarAhoraProductosExistenciasSucursales(buscar);

});










        //AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarProductosExistenciasSucursales").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarProductosExistenciasSucursales").val("");
            $("#buscarProductosExistenciasSucursales").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarProductosExistenciasSucursales").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarProductosExistenciasSucursales").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F3 PARA EDITAR
$(document).keydown(function(event) {
    if(event.which === 114){

        event.preventDefault();

        $("#buscarProductosExistenciasSucursales").attr("teclaEsc", "no");

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

                var contador_actual = $(foco).attr("contador");

                $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarProducto").trigger("click"); 
        }
    }
});










//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarProductosExistenciasSucursales").attr("teclaEsc");
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
        var buscador_esc = $("#buscarProductosExistenciasSucursales").attr("teclaEsc");
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




















$(document).keydown(function(event) {
    //ABRIR IMAGENES F2
    if (event.which === 113)
    {

        $("#buscarProductosExistenciasSucursales").attr("teclaEsc","no");

        const verifica_foco = document.getElementsByClassName("foco");
        setTimeout(function() { 
            var foco = verifica_foco[0];




            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);


            //alert("contador mas: "+contador_mas);
            
            
            $(foco).parent().parent().children(".imagenes").children(".imagen1").trigger('click');
            $(foco).attr("cont","1");

            id_producto = $(foco).parent().parent().children(".imagenes").children(".imagen1").attr("id_producto");
            no_imagen = $(foco).parent().parent().children(".imagenes").children(".imagen1").attr("no_imagen");
            $("#btnCambiarImagenProducto").attr("id_producto", id_producto);
            $("#btnCambiarImagenProducto").attr("no_imagen", no_imagen);
            $("#btnCambiarImagenProducto").attr("contador", contador_actual);
        }, 100);

    }
});










$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 37)
    {
       var buscador_esc = $("#buscarProductosExistenciasSucursales").attr("teclaEsc");
       if(buscador_esc == "no"){
         const verifica_foco = document.getElementsByClassName("foco");
         var foco = verifica_foco[0];
         setTimeout(function() { 


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            const verifica_foco_mas = document.getElementsByClassName("guardaFoco"+contador_mas);

            var foco_mas = verifica_foco_mas[0];

            const verifica_foco_menos = document.getElementsByClassName("guardaFoco"+contador_menos);

            var foco_menos = verifica_foco_menos[0];

            var img = $(foco).attr("cont");

            var cont_img = parseInt(img) - 1;

            $(foco).attr("cont", cont_img);

            $("#btnCambiarImagenProducto").attr("no_imagen", cont_img);

             $("#btnCambiarImagenProducto").attr("contador", contador_actual);

            if(cont_img == 0){


                $(foco).removeClass("foco");

                $(foco).parent().parent().removeAttr("style");

                $(foco_mas).parent().parent().removeAttr("style");

                $(foco_menos).attr("cont", "3");

                $(foco_menos).parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                $(foco_menos).addClass('foco');

                $(foco_menos).focus();

                id_producto = $(foco_menos).parent().parent().children(".imagenes").children(".imagen1").attr("id_producto");
                $("#btnCambiarImagenProducto").attr("id_producto", id_producto);

                $("#btnCambiarImagenProducto").attr("no_imagen", 3);

                 $("#btnCambiarImagenProducto").attr("contador", contador_menos);

            }
        }, 100); 

     }
 }

});










$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 39)
    {
       var buscador_esc = $("#buscarProductosExistenciasSucursales").attr("teclaEsc");
       if(buscador_esc == "no"){
         const verifica_foco = document.getElementsByClassName("foco");
         var foco = verifica_foco[0];
         setTimeout(function() { 


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            const verifica_foco_mas = document.getElementsByClassName("guardaFoco"+contador_mas);

            var foco_mas = verifica_foco_mas[0];

            const verifica_foco_menos = document.getElementsByClassName("guardaFoco"+contador_menos);

            var foco_menos = verifica_foco_menos[0];

            var img = $(foco).attr("cont");

            var cont_img = parseInt(img) + 1;


            $(foco).attr("cont", cont_img);

            $("#btnCambiarImagenProducto").attr("no_imagen", cont_img);

            $("#btnCambiarImagenProducto").attr("contador", contador_actual);

            if(cont_img == 4){


                $(foco).removeClass("foco");

                $(foco).parent().parent().removeAttr("style");

                $(foco_menos).parent().parent().removeAttr("style");

                $(foco_mas).attr("cont", "1");

                $(foco_mas).parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                $(foco_mas).addClass('foco');

                $(foco_mas).focus();

                id_producto = $(foco_mas).parent().parent().children(".imagenes").children(".imagen1").attr("id_producto");
                $("#btnCambiarImagenProducto").attr("id_producto", id_producto);

                $("#btnCambiarImagenProducto").attr("no_imagen", 1);

                 $("#btnCambiarImagenProducto").attr("contador", contador_mas);

            }
        }, 100); 

     }
 }

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

$(document).on("change", "#editarPrecio1", function(){

        var precio1 = $("#editarPrecio1").val();

        var precioCompra = $("#mostrarPrecioCompra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

       //var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(4);
       
       var utilidad1 = ((precio1/(precioCompra * 1.16))).toFixed(4);

        $("#editarUtilidad1").val(utilidad1);
}



});



//CAMBIO DE PRECIO 1
$(document).on("change", "#editarUtilidad1", function(){

        var utilidad1 = $("#editarUtilidad1").val();

        var precioCompra = $("#mostrarPrecioCompra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);

            var precio1 =((precioCompra * 1.16)*(utilidad1)).toFixed(0);

        $("#editarPrecio1").val(precio1);
        }


        

});


//CAMBIO DE UTILIDAD 2
$(document).on("change", "#editarPrecio2", function(){

        var precio2 = $("#editarPrecio2").val();

        var precioCompra = $("#mostrarPrecioCompra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad2 = ((precio2/(precioCompra * 1.16))).toFixed(4);

        $("#editarUtilidad2").val(utilidad2);
}



});



//CAMBIO DE PRECIO 2
$(document).on("change", "#editarUtilidad2", function(){

        var utilidad2 = $("#editarUtilidad2").val();

        var precioCompra = $("#mostrarPrecioCompra").val();

        if(precioCompra != '' || precioCompra != 0){
            
            //var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(0);

            var precio2 =((precioCompra * 1.16)*(utilidad2)).toFixed(2);

        $("#editarPrecio2").val(precio2);
        }


        

});

//CAMBIO DE UTILIDAD 3
$(document).on("change", "#editarPrecio3", function(){

        var precio3 = $("#editarPrecio3").val();

        var precioCompra = $("#mostrarPrecioCompra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad3 = ((precio3/(precioCompra * 1.16))).toFixed(4);

        $("#editarUtilidad3").val(utilidad3);
}



});



//CAMBIO DE PRECIO 3
$(document).on("change", "#editarUtilidad3", function(){

        var utilidad3 = $("#editarUtilidad3").val();

        var precioCompra = $("#mostrarPrecioCompra").val();

        if(precioCompra != '' || precioCompra != 0){
            
            //var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(0);

            var precio3 =((precioCompra * 1.16)*(utilidad3)).toFixed(2);

        $("#editarPrecio3").val(precio3);
        }


        

});




















$(document).on("keyup", "#editarPrecio1", function(){

        var precio1 = $("#editarPrecio1").val();

        var precioCompra = $("#mostrarPrecioCompra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

       //var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(4);
       
       var utilidad1 = ((precio1/(precioCompra * 1.16))).toFixed(4);

        $("#editarUtilidad1").val(utilidad1);
}



});



//CAMBIO DE PRECIO 1
$(document).on("keyup", "#editarUtilidad1", function(){

        var utilidad1 = $("#editarUtilidad1").val();

        var precioCompra = $("#mostrarPrecioCompra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);

            var precio1 =((precioCompra * 1.16)*(utilidad1)).toFixed(0);

        $("#editarPrecio1").val(precio1);
        }


        

});


//CAMBIO DE UTILIDAD 2
$(document).on("keyup", "#editarPrecio2", function(){

        var precio2 = $("#editarPrecio2").val();

        var precioCompra = $("#mostrarPrecioCompra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad2 = ((precio2/(precioCompra * 1.16))).toFixed(4);

        $("#editarUtilidad2").val(utilidad2);
}



});



//CAMBIO DE PRECIO 2
$(document).on("keyup", "#editarUtilidad2", function(){

        var utilidad2 = $("#editarUtilidad2").val();

        var precioCompra = $("#mostrarPrecioCompra").val();

        if(precioCompra != '' || precioCompra != 0){
            
            //var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(0);

            var precio2 =((precioCompra * 1.16)*(utilidad2)).toFixed(2);

        $("#editarPrecio2").val(precio2);
        }


        

});

//CAMBIO DE UTILIDAD 3
$(document).on("keyup", "#editarPrecio3", function(){

        var precio3 = $("#editarPrecio3").val();

        var precioCompra = $("#mostrarPrecioCompra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad3 = ((precio3/(precioCompra * 1.16))).toFixed(4);

        $("#editarUtilidad3").val(utilidad3);
}



});



//CAMBIO DE PRECIO 3
$(document).on("keyup", "#editarUtilidad3", function(){

        var utilidad3 = $("#editarUtilidad3").val();

        var precioCompra = $("#mostrarPrecioCompra").val();

        if(precioCompra != '' || precioCompra != 0){
            
            //var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(0);

            var precio3 =((precioCompra * 1.16)*(utilidad3)).toFixed(2);

        $("#editarPrecio3").val(precio3);
        }


        

});




















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

        if(Number(nivel_maximo) == 0 && Number(nivel_minimo) == 0){

            validar_nivel_maximo_minimo_editar = 1;
        return validar_nivel_maximo_minimo_editar;

        }else{
            Swal.fire({
        icon: 'error',
        title: 'El nivel mínimo no puede ser igual al nivel máximo',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarNivelMaximo").focus();
        
        validar_nivel_maximo_minimo_editar = 0;
        
        return validar_nivel_maximo_minimo_editar;
        }
        
        
        
        
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










/*$(document).on("click", "#btnEditarProducto", function(){
    
    $(this).blur();
    
    validar_ubicacion_vacia_editar = validarUbicacionVaciaEditar();
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
    
    validar_nivel_minimo_vacio_editar = validarNivelMinimoVacioEditar();
    //alert(validar_nivel_minimo_vacio_editar);
    
    validar_nivel_maximo_minimo_editar = validarNivelMaximoMinimoEditar();
    //alert(validar_nivel_maximo_minimo_editar);
    
    validar_nivel_maximo_vacio_editar = validarNivelMaximoVacioEditar();
    //alert(validar_nivel_maximo_vacio_editar);
    

    if(validar_ubicacion_vacia_editar !== 0 && 
    validar_utilidad3_vacia_editar !== 0 && 
    validar_utilidad2_vacia_editar !== 0 && 
    validar_utilidad1_vacia_editar !== 0 && 
    validar_precio3_vacio_editar !== 0 && 
    validar_precio2_vacio_editar !== 0 && 
    validar_precio1_vacio_editar !== 0 && 
    validar_nivel_minimo_vacio_editar !== 0 && 
    validar_nivel_maximo_minimo_editar !== 0 && 
    validar_nivel_maximo_vacio_editar !== 0){
        
    document.forms["formularioEditarProducto"].submit();
        
    }
    
});*/











$(document).on("click", "#btnEditarProducto", function(){

    $(this).blur();
    
    validar_ubicacion_vacia_editar = validarUbicacionVaciaEditar();
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
    
    validar_nivel_minimo_vacio_editar = validarNivelMinimoVacioEditar();
    //alert(validar_nivel_minimo_vacio_editar);
    
    validar_nivel_maximo_minimo_editar = validarNivelMaximoMinimoEditar();
    //alert(validar_nivel_maximo_minimo_editar);
    
    validar_nivel_maximo_vacio_editar = validarNivelMaximoVacioEditar();
    //alert(validar_nivel_maximo_vacio_editar);
    

    if(validar_ubicacion_vacia_editar !== 0 && 
    validar_utilidad3_vacia_editar !== 0 && 
    validar_utilidad2_vacia_editar !== 0 && 
    validar_utilidad1_vacia_editar !== 0 && 
    validar_precio3_vacio_editar !== 0 && 
    validar_precio2_vacio_editar !== 0 && 
    validar_precio1_vacio_editar !== 0 && 
    validar_nivel_minimo_vacio_editar !== 0 && 
    validar_nivel_maximo_minimo_editar !== 0 && 
    validar_nivel_maximo_vacio_editar !== 0){



    var id_producto = $("#id_producto").val();


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
        }).then(function(result){
            buscarProductoES(id_producto);
            $("#buscarProductosExistenciasSucursales").onchage(buscarAhoraProductosExistenciasSucursales($('#buscarProductosExistenciasSucursales').val()));
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










$(document).on("click", ".aEditarUbicacionProductoEUPES", function(){
    event.preventDefault();
    var id_producto = $(this).attr("id_producto");
    var clave_producto = $(this).attr("clave_producto");
    $("#btnSubmitEUPES").attr("clave_producto",clave_producto);
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

            console.log(respuesta);

            $("#modalEditarUbicacionProductoEUPES").modal("show");

            $("#mostrarUbicacionActualProductoEUPES").val(respuesta['ubicacion']);
            $("#mostrarIdProductoEUPES").val(id_producto);
            
        }
    });
});



function convertir_mayusculas(e){
    e.value = e.value.toUpperCase();
}




$(document).on("click", "#btnSubmitEUPES", function(){



                        var id_producto = $("#mostrarIdProductoEUPES").val();
                        var nueva_ubicacion = $("#nuevaUbicacionProductoEUPES").val();

                        var actualizaProductoES = new FormData();

                        actualizaProductoES.append("actualizarProductoES", id_producto);
                        actualizaProductoES.append("valor", nueva_ubicacion);
                        actualizaProductoES.append("columna", "ubicacion");


                        $.ajax({
                            url:"ajax/existencias-sucursales.ajax.php",
                            method: "POST",
                            data: actualizaProductoES,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(respuesta){
                                if(respuesta == 1){
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Se ha cambiado la ubicación al producto correctamente',
                                    showConfirmButton: true
                                    }).then(function(result){

                                        var clave_producto = $("#btnSubmitEUPES").attr("clave_producto");

                                        $("#buscarProductosExistenciasSucursales").val(clave_producto);

                                        $(".close").trigger('click');

                                        $("#buscarProductosExistenciasSucursales").onchage(buscarAhoraProductosExistenciasSucursales($('#buscarProductosExistenciasSucursales').val()));

                                        
                                    });
                                }else{
                                    Swal.fire({
                                    icon: 'warning',
                                    title: 'No se le ha podido cambiar ubicación al producto',
                                    showConfirmButton: true
                                    }).then(function(result){
                                        $(".close").trigger('click');
                                    });
                                }
                            }
                        });

        });










/*=============================================
        IMPRIMIR NOTA
        =============================================*/
$(document).on("click", "#btnExportarEXCELListaPreciosSucursal", function(){
 
    window.open("vistas/modulos/exportesExcel/excel-lista-precios-sucursal.php", "_blank");
  
});










$(document).on("click", "#btnCambiarImagenProducto", function(){
 
    var no_imagen = $(this).attr("no_imagen");
    var id_producto = $(this).attr("id_producto");
    var contador = $(this).attr("contador");

    $("#modalCambiarImagenProducto").modal("show");

    $(".ekko-lightbox").attr("style", "z-index: -1;");

    $("#cambiarImagenProducto").val(id_producto);
    $("#cambiarImagenProducto").attr("no_imagen", no_imagen);
    $("#cambiarImagenProducto").attr("contador", contador);
  
});




$(document).on("click", "#btnSubirImagenProducto", function(){

    var contador = $("#cambiarImagenProducto").attr("contador");
    var no_imagen = $("#cambiarImagenProducto").attr("no_imagen");
    var id_producto = $("#cambiarImagenProducto").val();

    var imagen = $("#nuevaImagenProducto")[0].files[0];

    var datos = new FormData();
    datos.append("subirImagenProducto", id_producto);
    datos.append("no_imagen", no_imagen);
    datos.append("imagen", imagen);

    $.ajax({
        async: false,
        url:"ajax/productos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){


            if(respuesta != 0){

                if(no_imagen == 1){

                    $(".contador"+contador).children(".imagenes").children(".imagen1").children(".img-fluid").attr("src", respuesta);
                }

                $(".contador"+contador).children(".imagenes").children(".imagen"+no_imagen).attr("href", respuesta);
                


                $(".ekko-lightbox-item.fade.in.show").empty();
                $(".ekko-lightbox-item.fade.in.show").append('<img src="http://localhost/guerrero/'+respuesta+'" class="img-fluid" style="width: 100%;">');

                $("#modalCambiarImagenProducto").modal("hide");
                $(".ekko-lightbox").attr("style", "display: block;");

            }

        }
    });


    
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










$(document).on("change", "#mostrarPrecioCompra", function(){

    var precio_compra = $(this).val();


    var id_producto = $("#id_producto").val();

    var id_sucursal = $("#idSucursalLES").val();

    var respuesta = actualizarProductoES2("precio_compra", precio_compra, id_producto, id_sucursal);

    $("#editarUtilidad1").trigger("change");
    $("#editarUtilidad2").trigger("change");
    $("#editarUtilidad3").trigger("change");

});




$(document).on("keyup", "#mostrarPrecioCompra", function(){

    var precio_compra = $(this).val();


    var id_producto = $("#id_producto").val();

    var id_sucursal = $("#idSucursalLES").val();

    var respuesta = actualizarProductoES2("precio_compra", precio_compra, id_producto, id_sucursal);

    $("#editarUtilidad1").trigger("change");
    $("#editarUtilidad2").trigger("change");
    $("#editarUtilidad3").trigger("change");

});
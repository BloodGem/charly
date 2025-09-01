











function buscarProductosAjustesInventario(buscarProductosAjustesInventario) {

        var parametros = {"buscarProductosAjustesInventario":buscarProductosAjustesInventario};
        $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadores/buscadorProductosAjustesInventario.php',
                success: function(data) {
                        document.getElementById("incrustarTablaProductosAjustesInventario").innerHTML = data;
                }
        });
}










$(document).on("change", "#buscarProductosAjustesInventario", function(){
    var busqueda = $("#buscarProductosAjustesInventario").val();
    buscarProductosAjustesInventario(busqueda);
});  









//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarProductosAjustesInventario").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarProductosAjustesInventario").val("");
            $("#buscarProductosAjustesInventario").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarProductosAjustesInventario").attr("teclaEsc", "si");

        }

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarProductosAjustesInventario").attr("teclaEsc");
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
        var buscador_esc = $("#buscarProductosAjustesInventario").attr("teclaEsc");
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

         console.log(myArr); 

         $(this).removeClass("btn-primary agregarProducto");

         $(this).addClass("btn-default");

         var datos = new FormData();
         datos.append("id_producto", id_producto);

         $.ajax({

                url:"ajax/ajustes-inventario.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){

                        console.log(respuesta);

                        var clave_producto = respuesta["clave_producto"];
                        var descripcion_corta = respuesta["descripcion_corta"];


                       

                                contador = contador + 1;


                        $(".nuevoProducto").append('<div class="row">'+
                              '<div class="col-1">'+
                              '<button type="button" class="btn btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                              '</div>'+
                              '<div class="col-3">'+
                              '<input type="text" class="form-control nuevaClaveProducto" placeholder="" value="'+clave_producto+'" readonly tabindex="-1">'+
                              '</div>'+
                              '<div class="col-6">'+
                              '<input type="text" class="form-control nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'" readonly tabindex="-1">'+
                              '</div>'+
                              '<div class="col-2 ingresoCantidad">'+
                              '<input type="number" style="text-align: right;" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto'+contador+'" name="nuevaCantidadProducto'+contador+'" min="1" value="1" step="1" required>'+
                              '</div>');

                        $("#nuevaCantidadProducto"+contador).focus();



                // AGRUPAR PRODUCTOS EN FORMATO JSON

                        listarProductos();



                        $("#buscarProductosAjustesInventario").val("");

                        $("#buscarProductosAjustesInventario").onkeyup(buscarProductosAjustesInventario($('#buscarProductosAjustesInventario').val()));
                }
});//AJAX




}




});





function removeAllChilds(a)
{
        a=document.getElementById(a);
       while(a.hasChildNodes())
            a.removeChild(a.firstChild);    
}



$(".listaProductosAjustesInventario").on("draw.dt", function(){
        console.log("tabla");
})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/


$(".formularioAjusteInventario").on("click", "button.quitarProducto", function(){

        var id_producto = $(this).attr("id_producto");

        var posicion = myArr.indexOf(id_producto);

        myArr.splice(posicion, 1);

        console.log(myArr); 

        $(this).parent().parent().remove();

        


        $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


        if($(".nuevoProducto").children().length == 0){

                $("#listaProductos").val("");

                
                

        }else{

                // AGRUPAR PRODUCTOS EN FORMATO JSON

                listarProductos();
        }



});












/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(document).on("keyup", ".nuevaCantidadProducto", function(){


                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();
});





$(document).on("click", ".nuevaCantidadProducto", function(){


                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();
});











        /*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

        var listaProductos = [];


        var descripcion = $(".nuevaDescripcionProducto");

        var cantidad = $(".nuevaCantidadProducto");

        for(var i = 0; i < descripcion.length; i++){

                listaProductos.push({ "id_producto" : $(descripcion[i]).attr("id_producto"),
                      "cantidad" : $(cantidad[i]).val()})

        }
        console.log("listaProductos", listaProductos);

        $("#listaProductos").val(JSON.stringify(listaProductos)); 

}










function validarTipoAjusteVacio() {
if($("#tipoAjusteEntrada").prop("checked") == false && $("#tipoAjusteSalida").prop("checked") == false){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe seleccionar un tipo de ajuste',
        text: 'Entrada o Salida',
        showConfirmButton: true
        });
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}





function validarListaProductosVacia() {
if($("#listaProductos").val() == "" || $("#listaProductos").val() == "[]"){
        
        Swal.fire({
        icon: 'error',
        title: 'No ha seleccionado ningún producto para este ajuste',
        showConfirmButton: true
        });
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}






$(document).on("click", "#btnSubmitCrearAjusteInventario", function(){

    $(this).blur();
    
    validar_tipo_aujuste_inventario_vacio = validarTipoAjusteVacio();

    validar_lista_productos_vacia = validarListaProductosVacia();

    if(validar_tipo_aujuste_inventario_vacio !== 0 && validar_lista_productos_vacia !== 0){

        var tipo_ajuste = $("#tipoAjusteEntrada").prop("checked");

        if(tipo_ajuste == false){

        Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres crear un ajuste de tipo SALIDA?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
          background: 'red',
          color: 'white'
      }).then((result) => {


        if(result.isConfirmed) {
            document.forms["formularioAjusteInventario"].submit();
        }

    });

  }else{
    Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres crear un ajuste de tipo ENTRADA?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
          background: 'green',
          color: 'white'
      }).then((result) => {


        if(result.isConfirmed) {
            document.forms["formularioAjusteInventario"].submit();
        }

    });
  }
        
        
    }

});










function validarListaProductosVaciaEditar() {
if($("#listaProductos").val() == "" || $("#listaProductos").val() == "[]"){
        
        Swal.fire({
        icon: 'error',
        title: 'No ha seleccionado ningún producto para este ajuste',
        showConfirmButton: true
        });
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}









$(document).on("click", "#btnSubmitEditarAjusteInventario", function(){

    $(this).blur();
    
    validar_lista_productos_vacia = validarListaProductosVaciaEditar();

    if(validar_lista_productos_vacia !== 0){

        var tipo_ajuste = $("#tipoAjusteEntrada").prop("checked");

        if(tipo_ajuste == false){

        Swal.fire({
          title: 'Estas segur@?',
          text: "Deseas guardar cambios? este es un ajuste de tipo SALIDA",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
          background: 'red',
          color: 'white'
      }).then((result) => {


        if(result.isConfirmed) {
            document.forms["formularioEditarAjusteInventario"].submit();
        }

    });

  }else{
    Swal.fire({
          title: 'Estas segur@?',
          text: "QDeseas guardar cambios? este es un ajuste de tipo ENTRADA",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No',
          background: 'green',
          color: 'white'
      }).then((result) => {


        if(result.isConfirmed) {
            document.forms["formularioEditarAjusteInventario"].submit();
        }

    });
  }
        
        
    }

});











                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();

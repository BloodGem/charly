/*$('#nuevoIdProveedor1').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});

$('#nuevoIdProveedor2').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});

$('#nuevoIdProveedor3').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});

$('#nuevoIdFamilia').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca la familia aquí...');
});*/

$('#nuevoIdMarca').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca la marca aquí...');
});









/*listarAutosProducto();

        var myArr = [];
        
        

        var numAuto = $("#listaAutosProducto").attr("numAuto"); 

        var numAuto = $("#listaAutosProducto").attr("numAuto"); 

        $(document).on("click", ".btnAgregarAuto", function(){

            

            var datos = new FormData();
    datos.append("traerAutosModulo", "ok");

    $.ajax({

        url:"ajax/autos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            
            numAuto = Number(numAuto) + 1;

            myArr.push(numAuto);
            
                $(".nuevoAuto").append('<div class="row">'+
            '<div class="col-1">'+
            '<button type="button" class="btn btn-sm btn-danger quitarAuto" numAuto="'+numAuto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
            '</div>'+
            '<div class="col-8">'+
            '<select class="form-control select2 nuevaClaveSatAuto" id="nombreAuto'+numAuto+'" name="nombreAuto" style="width: 100%;" required>'+
            '<option value="">Seleccione el auto</option>'+
            '</select>'+
            '</div>'+
            '<div class="col-1">'+
            '<input type="number" class="form-control nuevoAnoInicio" id="nombreAuto'+numAuto+'" name="anoInicio" required>'+
            '</div>'+
            '<div class="col-1">'+
            '<center>-</center>'+
            '</div>'+
            '<div class="col-1">'+
            '<input type="number" class="form-control nuevoAnoFinal" id="nombreAuto'+numAuto+'" name="anoFinal" required>'+
            '</div>'+
            '</div>');

            $("#listaAutosProducto").attr("numAuto", numAuto);                           


            


             respuesta.forEach(funcionForEach);

             function funcionForEach(item, index){


                    $("#nombreAuto"+numAuto).append(

                        '<option value="'+item.id_auto+'">'+item.auto+' '+item.submarca+' '+item.motor+'</option>'
                    )

                 
                          

             }

    
             $("#nombreAuto"+numAuto).select2();//Hago que el select 2 funcione ya que si quito esta linra de codigo no funciona

            listarAutosProducto();

        }

    })




    });










        $(document).on("click", "button.quitarAuto", function(){


                $(this).parent().parent().remove();
                

                listarAutosProducto();



        });









        $(document).on("change", "select.nuevaClaveSatAuto", function(){

                listarAutosProducto();
        });




        $(document).on("change", ".nuevoAnoInicio", function(){

                listarAutosProducto();
        });






        $(document).on("change", ".nuevoAnoFinal", function(){

                listarAutosProducto();
        });








        function listarAutosProducto(){

            var listaAutosProducto = [];

            var nombre_auto = $(".nuevaClaveSatAuto");

            var ano_inicial = $(".nuevoAnoInicio");

            var ano_final = $(".nuevoAnoFinal");

                for(var i = 0; i < nombre_auto.length; i++){

                    listaAutosProducto.push({ "id_auto" : $(nombre_auto[i]).val(),
                        "ano_inicial" : $(ano_inicial[i]).val(),
                        "ano_final" : $(ano_final[i]).val()

                });


                }

                $("#listaAutosProducto").val(JSON.stringify(listaAutosProducto)); 

        }*/










//VALIDAR QUE LA CLAVE DEL PRODUCTO LOCAL NO ESTE VACIA
function validarClaveProductoVacioCrear() {
if($("#nuevaClaveProducto").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una clave para el producto',
        showConfirmButton: false,
        timer: 2000
        })
        
        
        $("#nuevaClaveProducto").focus();
        
        
        validar_clave_producto_vacio_crear = 0;
        
        return validar_clave_producto_vacio_crear;
        
        
    }else{
    
    validar_clave_producto_vacio_crear = 1;
    return validar_clave_producto_vacio_crear;
    }
    
    
    
}





function validarClaveSatVaciaCrear() {
    if($("#nuevaClaveSat").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una clave de SAT para el producto',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevaClaveSat").focus();
        
        validar_clave_sat_vacia_crear = 0;
        
        return validar_clave_sat_vacia_crear;
        
        
    }else{
        
        validar_clave_sat_vacia_crear = 1;
        return validar_clave_sat_vacia_crear;
        
    }
    
}





function validarCveUnidadVaciaCrear() {
    if($("#nuevaCveUnidad").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una clave de unidad para el producto ante el SAT',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevaCveUnidad").focus();
        
        validar_cve_unidad_vacio_crear = 0;
        
        return validar_cve_unidad_vacio_crear;
        
        
    }else{
        
        validar_cve_unidad_vacio_crear = 1;
        return validar_cve_unidad_vacio_crear;
        
    }
    
}





function validarUnidadVaciaCrear() {
    if($("#nuevaUnidad").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una clave de unidad local ',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevaUnidad").focus();
        
        validar_unidad_vacia_crear = 0;
        
        return validar_unidad_vacia_crear;
        
        
    }else{
        
        validar_unidad_vacia_crear = 1;
        return validar_unidad_vacia_crear;
        
    }
    
}





function validarDescripcionCortaVaciaCrear() {
    if($("#nuevaDescripcionCorta").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una descripción corta',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevaDescripcionCorta").focus();
        
        validar_descripcion_corta_vacia_crear = 0;
        
        return validar_descripcion_corta_vacia_crear;
        
        
    }else{
        
        validar_descripcion_corta_vacia_crear = 1;
        return validar_descripcion_corta_vacia_crear;
        
    }
    
}










/*=============================================
    VERIFICAR SI LA CLAVE DE PRODUCTO EXISTE
    =============================================*/     
        
    function validarClaveProductoExistenteCrear() {
        
        
        var clave_producto = $("#nuevaClaveProducto").val();

        var datos = new FormData();
        datos.append("validarClaveProducto", clave_producto);

     $.ajax({
        async: false,
        url:"ajax/productos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_clave_producto_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevaClaveProducto").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta clave de producto ya existe, introduce otra',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#nuevaClaveProducto").val("");
                
                $("#nuevaClaveProducto").focus();
                
                validar_clave_producto_existente_crear = 0;

            }

        }

    })
    
    return validar_clave_producto_existente_crear;
    }











/*function validarIdProveedor1VacioCrear() {
    if($("#nuevoIdProveedor1").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe seleccionar almenos el primer proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevoIdProveedor1").focus();
        
        validar_id_proveedor1_vacio_crear = 0;
        
        return validar_id_proveedor1_vacio_crear;
        
        
    }else{
        
        validar_id_proveedor1_vacio_crear = 1;
        return validar_id_proveedor1_vacio_crear;
        
    }
    
}*/




/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADA
=============================================*/

$(document).on("change", "#nuevaClaveProducto", function(){
    
    validar_clave_producto_existente_crear = validarClaveProductoExistenteCrear();
    

});











/*function validarAutosVacios() {
    
    var numAuto = $("#listaAutosProducto").attr("numAuto");
    
    if(numAuto !== 0){
        
        var conteo = 0;
        
        for(var i = 1; i <= numAuto; i++){
            
            
            if($("#nombreAuto"+i).val() !== ""){ 
                
                conteo = conteo + 1;
                
            }else{
                
                Swal.fire({
                    icon: 'error',
                    title: 'Debe seleccionar un auto por partida',
                    showConfirmButton: false,
                    timer: 2000
                    });
                    
                    $("#nombreAuto"+i).focus();
            }
        }
        
        if(numAuto == conteo){
            validar_autos_vacios = 1;
            return validar_autos_vacios;
        }else{
            
            
                    
            validar_autos_vacios = 0;
            return validar_autos_vacios;
        }
            
    }else{
        validar_autos_vacios = 1;
        return validar_autos_vacios;
    }
    
}*/










        $(document).on("click", "#btnCrearProducto", function(){
    
    $(this).blur();
    
    //validar_autos_vacios = validarAutosVacios();
    //alert("Que tal los autos del producto? "+validar_autos_vacios);
    
    //validar_id_proveedor1_vacio_crear = validarIdProveedor1VacioCrear();
    //alert("El proveedor 1 del producto esta vacio? "+validar_id_proveedor1_vacio_crear);
    
    validar_descripcion_corta_vacia_crear = validarDescripcionCortaVaciaCrear();
    //alert("La descripción corta del producto esta vacio? "+validar_descripcion_corta_vacia_crear);
    
    validar_unidad_vacia_crear = validarUnidadVaciaCrear();
    //alert("La unidad del producto esta vacia? "+validar_unidad_vacia_crear);
    
    validar_cve_unidad_vacio_crear = validarCveUnidadVaciaCrear();
    //alert("La clave de unidad del producto esta vacio? "+validar_cve_unidad_vacio_crear);
    
    validar_clave_sat_vacia_crear = validarClaveSatVaciaCrear();
    //alert("La clave del sat esta vacia? "+validar_clave_sat_vacia_crear);
    
    validar_clave_producto_existente_crear = validarClaveProductoExistenteCrear();
    //alert("La clave del producto ya existe?"+validar_clave_producto_existente_crear);
    
    validar_clave_producto_vacio_crear = validarClaveProductoVacioCrear();
    //alert("La clave del producto esta vacio? "+validar_clave_producto_vacio_crear);
    

    if(validar_clave_producto_existente_crear !== 0 &&
    validar_clave_producto_vacio_crear !== 0 && 
    validar_clave_sat_vacia_crear !== 0 && 
    validar_cve_unidad_vacio_crear !== 0 && 
    validar_unidad_vacia_crear !== 0 && 
    validar_descripcion_corta_vacia_crear !== 0/* &&
    validar_id_proveedor1_vacio_crear !== 0 && 
    validar_autos_vacios !== 0*/){
        
    document.forms["formularioNuevoProducto"].submit();
        
    }
    
});










/*=============================================
ESTE SIRVE PARA CREAR UNA MARCA
=============================================*/     

function validarMarcaExistenteCrear() {


    var marca = $("#nuevaMarca").val();

    var datos = new FormData();
    datos.append("validarMarca", marca);

    $.ajax({
        async: false,
        url:"ajax/marcas.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){


            if(respuesta[0] === undefined){
                validar_marca_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevaMarca").parent().after(Swal.fire({
                    icon: 'error',
                    title: 'Esta marca ya existe, introduce otra',
                    showConfirmButton: false,
                    timer: 2000
                }));

                $("#nuevaMarca").val("");
                
                validar_marca_existente_crear = 0;

            }

        }

    })
    
    return validar_marca_existente_crear;
}




$(document).on("change", "#nuevaMarca", function(){

    validar_marca_existente_crear = validarMarcaExistenteCrear();
    

});




$(document).on("click", "#btnCrearMarca", function(){

    validar_marca_existente_crear = validarMarcaExistenteCrear();
    

    if(validar_marca_existente_crear !== 0){

        var marca = $("#nuevaMarca").val();

        var datos = new FormData();
        datos.append("crearMarcaModulo", marca);

        $.ajax({
            async: false,
            url:"ajax/marcas.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){

                if(respuesta[0] === undefined){


                   Swal.fire({icon: 'error',
                       title: 'Ha habido un error, intente de nuevo, si no, comuniquese con soporte',
                       showConfirmButton: false,
                       timer: 2000
                   });


               }
               else if(respuesta[0] !== undefined){

                Swal.fire({
                    icon: 'success',
                    title: 'La marca '+respuesta[1]+' ha sido creada con éxito',
                    text: 'La marca se agregará a la lista de marcas',
                    showConfirmButton: false,
                    timer: 3000
                });

                var newOption = new Option(respuesta[1], respuesta[0], false, false);
                $('#nuevoIdMarca').append(newOption).trigger('change');

                $("#nuevoIdMarca").val(respuesta[0]);

                $('#modalCrearMarca').modal('hide');


                




            }

        }

    })
    }



});





/*$(document).on("change", "#nuevoIdFamilia", function(){
    document.getElementById("incrustarSelectSubfamiliasFamilia").innerHTML = "";
    var id_familia = $("#nuevoIdFamilia>option:selected").val();
    if(id_familia !== ""){
        
    var parametros = {"id_familia":id_familia};
    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/selects/selectSubfamiliasFamilia.php',
        success: function(data) {
            document.getElementById("incrustarSelectSubfamiliasFamilia").innerHTML = data;
            $("#nuevoIdSubfamilia").select2();
        }
    });
}else{
    document.getElementById("incrustarSelectSubfamiliasFamilia").innerHTML = '<input type="hidden" class="form-control" id="nuevoIdSubfamilia" name="nuevoIdSubfamilia" value="" style="width: 100%;">';
}
});


function validarFamiliaExistenteCrear() {


    var familia = $("#nuevaFamilia").val();

    var datos = new FormData();
    datos.append("validarFamilia", familia);

    $.ajax({
        async: false,
        url:"ajax/familias.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){


            if(respuesta[0] === undefined){
                validar_familia_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevaFamilia").parent().after(Swal.fire({
                    icon: 'error',
                    title: 'Esta familia ya existe, introduce otra',
                    showConfirmButton: false,
                    timer: 2000
                }));

                $("#nuevaFamilia").val("");
                
                validar_familia_existente_crear = 0;

            }

        }

    })
    
    return validar_familia_existente_crear;
}




$(document).on("change", "#nuevaFamilia", function(){

    validar_familia_existente_crear = validarFamiliaExistenteCrear();
    

});




$(document).on("click", "#btnCrearFamilia", function(){


    validar_familia_existente_crear = validarFamiliaExistenteCrear();
    

    if(validar_familia_existente_crear !== 0){

        var familia = $("#nuevaFamilia").val();



        var datos = new FormData();
        datos.append("crearFamiliaModulo", familia);

        $.ajax({
            async: false,
            url:"ajax/familias.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(respuesta){

                if(respuesta[0] === undefined){


                   Swal.fire({icon: 'error',
                       title: 'Ha habido un error, intente de nuevo, si no, comuniquese con soporte',
                       showConfirmButton: false,
                       timer: 2000
                   });


               }
               else if(respuesta[0] !== undefined){

                Swal.fire({
                    icon: 'success',
                    title: 'La familia '+respuesta[1]+' ha sido creada con éxito',
                    text: 'La familia se agregará a la lista de familias',
                    showConfirmButton: false,
                    timer: 3000
                });

                var newOption = new Option(respuesta[1], respuesta[0], false, false);
                $('#nuevoIdFamilia').append(newOption).trigger('change');

                $("#nuevoIdFamilia").val(respuesta[0]);


                $('#modalCrearFamilia').modal('hide');


                




            }

        }

    })
    }



});*/











function sacarNivelMedioEditar() {

    var nivel_minimo = $("#nivel_minimo").val();
    var nivel_maximo = $("#nivel_maximo").val();
    
    var nivel_medio = Math.round((Number(nivel_maximo) + Number(nivel_minimo))/2);
        
    $("#nivel_medio").val(nivel_medio);
    
    
    
}





$("#nivel_maximo").change(function(){

    sacarNivelMedioEditar();
        

})




$("#nivel_minimo").change(function(){

    sacarNivelMedioEditar();
        

})


//CAMBIO DE UTILIDAD 1
$("#precio1").change(function(){

        var precio1 = $("#precio1").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(2);

        $("#utilidad1").val(utilidad1);
}



})



//CAMBIO DE PRECIO 1
$("#utilidad1").change(function(){

        var utilidad1 = $("#utilidad1").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){
            var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);

        $("#precio1").val(precio1);
        }


        

})


//CAMBIO DE UTILIDAD 2
$("#precio2").change(function(){

        var precio2 = $("#precio2").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);

        $("#utilidad2").val(utilidad2);
}



})



//CAMBIO DE PRECIO 2
$("#utilidad2").change(function(){

        var utilidad2 = $("#utilidad2").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){
            var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(0);

        $("#precio2").val(precio2);
        }


        

})

//CAMBIO DE UTILIDAD 3
$("#precio3").change(function(){

        var precio3 = $("#precio3").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);

        $("#utilidad3").val(utilidad3);
}



})



//CAMBIO DE PRECIO 3
$("#utilidad3").change(function(){

        var utilidad3 = $("#utilidad3").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){
            var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(0);

        $("#precio3").val(precio3);
        }


        

})










function buscarAhoraProductos(buscarProductos) {

                var parametros = {"buscarProductos":buscarProductos};
                $.ajax({
                        data:parametros,
                        type: 'POST',
                        url: 'vistas/modulos/buscadores/buscadorProductosCompuesto.php',
                        success: function(data) {
                                document.getElementById("incrustarTablaProductos").innerHTML = data;
                        }
                });
        }










$(document).on("change", "#buscarProductos", function(){

    var busqueda = $(this).val();

    buscarAhoraProductos(busqueda);

});












/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var productosCompuestoArr = [];

var contador = 0;
$(document).on("click", ".agregarProducto", function(){

    var id_producto = $(this).attr("id_producto");


    if(productosCompuestoArr.includes(id_producto) == true){

        $(this).removeClass("btn-primary agregarProducto");

        $(this).addClass("btn-default");

    }else{

        $(this).removeClass("btn-primary agregarProducto");

        $(this).addClass("btn-default");

        var datos = new FormData();
        datos.append("id_producto", id_producto);


        $.ajax({

            url:"ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){

                console.log(respuesta);


                productosCompuestoArr.push(id_producto);
                var descripcion_corta = respuesta["descripcion_corta"];
                var clave_producto = respuesta["clave_producto"];

                contador = contador + 1;

                $(".nuevoProductoCompuesto").append('<div class="row">'+
                '<div class="col-lg-1 col-12">'+
                '<button type="button" class="btn btn-xs btn-danger quitarProducto" id_producto="'+id_producto+'"><i class="fa fa-times"></i></button>'+
                '</div>'+
                '<div class="col-lg-2 col-12">'+
                '<input type="text" class="form-control form-control-sm nuevaClaveProducto" placeholder="" name="claveProducto" value="'+clave_producto+'" tabindex="-1" readonly>'+
                '</div>'+
                '<div class="col-lg-7 col-12">'+
                '<input type="text" class="form-control form-control-sm nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'" tabindex="-1" readonly>'+
                '</div>'+
                '<div class="col-lg-2 col-12">'+
                '<input type="number" class="form-control form-control-sm nuevaCantidadProducto" name="cantidadProducto" value="1">'+
                '</div>'+
                '</div>'+
                '<hr>');


                // AGRUPAR PRODUCTOS EN FORMATO JSON

                listarProductosCompuesto();

                $("#buscarProductos").val("");

                $("#buscarProductos").focus();

                document.getElementById("incrustarTablaProductos").innerHTML = "";                    

                                  
            }
        });//AJAX
    }
});










$(document).on("keyup", ".nuevaCantidadProducto", function(){

    listarProductosCompuesto();

});










$(document).on("change", ".nuevaCantidadProducto", function(){

    listarProductosCompuesto();

});











/*=============================================
        QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
        =============================================*/


        $(document).on("click", ".quitarProducto", function(){

                var id_producto = $(this).attr("id_producto");

                var posicion = myArr.indexOf(id_producto);

                myArr.splice(posicion, 1);

                $(this).parent().parent().remove();

                


                $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

                $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


                if($(".nuevoProductoCompuesto").children().length == 0){

                        $("#listaProductosCompuesto").val("");

                }else{ 


                        // AGRUPAR PRODUCTOS EN FORMATO JSON

                        listarProductosCompuesto();

                        
                }



        });










/*=============================================
 LISTAR TODOS LOS PRODUCTOS
=============================================*/

        function listarProductosCompuesto(){

                var listaProductosCompuesto = [];

                var descripcion = $(".nuevaDescripcionProducto");

                var cantidad = $(".nuevaCantidadProducto");

                for(var i = 0; i < descripcion.length; i++){

                        listaProductosCompuesto.push({ "id_producto" : $(descripcion[i]).attr("id_producto"),
                            "cantidad" : $(cantidad[i]).val()});

                }
                console.log("listaProductosCompuesto", listaProductosCompuesto);

                $("#listaProductosCompuesto").val(JSON.stringify(listaProductosCompuesto)); 

        }
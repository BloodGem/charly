/*$('#editarIdProveedor1').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});


$('#editarIdProveedor2').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});


$('#editarIdProveedor3').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});


$('#editarIdFamilia').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca la familia aquí...');
});*/


$('#editarIdMarca').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca la marca aquí...');
});








/*listarAutosProducto();



var nombres_autos = [];*/




$('.tablaProductos').DataTable({
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

}})



function numerosSinDecimales()
{
    var tecla = event.key;
    if (['.','e'].includes(tecla))
       event.preventDefault()
}



/*var myArr = [];



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


            


            // AGREGAR LOS PRODUCTOS AL SELECT 

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















$(document).on("click", "#btnCrearMarcaPE", function(){

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
                $('#editarIdMarca').append(newOption).trigger('change');

                $("#editarIdMarca").val(respuesta[0]);

                $('#modalCrearMarca').modal('hide');


                




            }

        }

    })
    }



});









/*
$(document).on("change", "#editarIdFamilia", function(){
    document.getElementById("incrustarSelectSubfamiliasFamilia").innerHTML = "";
    var id_familia = $("#editarIdFamilia>option:selected").val();
    if(id_familia !== ""){
        var parametros = {"id_familia":id_familia};
        $.ajax({
            data:parametros,
            type: 'POST',
            url: 'vistas/modulos/selects/selectSubfamiliasFamilia.php',
            success: function(data) {
                document.getElementById("incrustarSelectSubfamiliasFamilia").innerHTML = data;
                $("#editarIdSubfamilia").select2();
            }
        });
    }else{
        document.getElementById("incrustarSelectSubfamiliasFamilia").innerHTML = '<input type="hidden" class="form-control" id="nuevoIdSubfamilia" name="nuevoIdSubfamilia" value="" style="width: 100%;">';
    }
});










$(document).on("click", "#btnCrearFamiliaPE", function(){


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
                $('#editarIdFamilia').append(newOption).trigger('change');

                $("#editarIdFamilia").val(respuesta[0]);

                $('#modalCrearFamilia').modal('hide');


                




            }

        }

    })
    }



});




$(document).on("change", "#nuevaMarca", function(){

    validar_marca_existente_crear = validarMarcaExistenteCrear();
    

});*/






$(document).on("change", "#nuevaFamilia", function(){

    validar_familia_existente_crear = validarFamiliaExistenteCrear();
    

});









/*function buscar_ahora2(buscar2) {
        var parametros = {"buscar2":buscar2};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador2.php',
        success: function(data) {
        document.getElementById("listaProductosVentas").innerHTML = data;
        }
        });
        }*/







/*=============================================
VALIDACIONES
=============================================*/








     /*=============================================
    VERIFICAR SI LA FAMILIA EXISTE
    =============================================*/     

function validarClaveProductoExistenteEditar() {
    var clave_producto = $("#editarClaveProducto").val();
    var clave_producto_actual = $("#editarClaveProducto").attr("claveProductoActual");


    if(clave_producto === clave_producto_actual){

        validar_clave_producto_existente_editar = 1;
        return validar_clave_producto_existente_editar;
        
    }
    else if(clave_producto !== clave_producto_actual){

        var datos = new FormData();
        datos.append("validarClaveProducto", clave_producto);

        $.ajax({
            url:"ajax/productos.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            async : false,
            dataType: "json",
            success:function(respuesta){

                if(respuesta[0] === undefined){



                    validar_clave_producto_existente_editar = 1;

                }

                else if(respuesta[0] !== undefined){

                    $("#editarClaveProducto").parent().after(Swal.fire({
                        icon: 'error',
                        title: 'Esta clave de producto ya existe, introduce otra',
                        showConfirmButton: false,
                        timer: 2000
                    }));

                    $("#editarClaveProducto").focus();
                    validar_clave_producto_existente_editar = 0;
                    $("#editarClaveProducto").attr("placeholder",clave_producto_actual);

                }

            }

        })

        return validar_clave_producto_existente_editar;

    }

}














/*=============================================
VALIDACIONES PARA LA EDICION
=============================================*/


function validarClaveProductoVacioEditar() {

    var clave_producto_actual = $("#editarClaveProducto").attr("claveProductoActual");
    
    if($("#editarClaveProducto").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una clave para el producto',
            showConfirmButton: false,
            timer: 2000
        })
        
        $("#editarClaveProducto").val(clave_producto_actual);
        
        $("#editarClaveProducto").focus();
        
        
        validar_clave_producto_vacio_editar = 0;
        
        return validar_clave_producto_vacio_editar;
        
        
    }else{

        validar_clave_producto_vacio_editar = 1;
        return validar_clave_producto_vacio_editar;
    }
    
    
    
}





function validarClaveSatVaciaEditar() {

    var clave_sat_actual = $("#editarClaveSat").attr("claveSatActual");
    
    if($("#editarClaveSat").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una clave de SAT para el producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarClaveSat").val(clave_sat_actual);
        
        $("#editarClaveSat").focus();
        
        validar_clave_sat_vacia_editar = 0;
        
        return validar_clave_sat_vacia_editar;
        
        
    }else{

        validar_clave_sat_vacia_editar = 1;
        return validar_clave_sat_vacia_editar;
        
    }
    
}





function validarCveUnidadVaciaEditar() {
    var cve_unidad_actual = $("#editarCveUnidad").attr("cveUnidadActual");
    if($("#editarCveUnidad").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una clave de unidad para el producto ante el SAT',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarCveUnidad").val(cve_unidad_actual);
        
        $("#editarCveUnidad").focus();
        
        validar_cve_unidad_vacio_editar = 0;
        
        return validar_cve_unidad_vacio_editar;
        
        
    }else{

        validar_cve_unidad_vacio_editar = 1;
        return validar_cve_unidad_vacio_editar;
        
    }
    
}





function validarUnidadVaciaEditar() {
    var unidad_actual = $("#editarUnidad").attr("unidadActual");
    if($("#editarUnidad").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una clave de unidad local ',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarUnidad").val(unidad_actual);
        
        $("#editarUnidad").focus();
        
        validar_unidad_vacia_editar = 0;
        
        return validar_unidad_vacia_editar;
        
        
    }else{

        validar_unidad_vacia_editar = 1;
        return validar_unidad_vacia_editar;
        
    }
    
}





function validarDescripcionCortaVaciaEditar() {
    if($("#editarDescripcionCorta").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una descripción corta',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarDescripcionCorta").focus();
        
        validar_descripcion_corta_vacia_editar = 0;
        
        return validar_descripcion_corta_vacia_editar;
        
        
    }else{

        validar_descripcion_corta_vacia_editar = 1;
        return validar_descripcion_corta_vacia_editar;
        
    }
    
}






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




/*function validarIdProveedor1VacioEditar() {
    if($("#editarIdProveedor1").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe seleccionar almenos el primer proveedor',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarIdProveedor1").focus();
        
        validar_id_proveedor1_vacio_editar = 0;
        
        return validar_id_proveedor1_vacio_editar;
        
        
    }else{

        validar_id_proveedor1_vacio_editar = 1;
        return validar_id_proveedor1_vacio_editar;
        
    }
    
}/*














/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarClaveProducto", function(){

    validar_clave_producto_existente_editar = validarClaveProductoExistenteEditar();

    
});



/*
function validarAutosVacios() {

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


















$(document).on("click", "#btnEditarProducto", function(){

    $(this).blur();
    
    //validar_autos_vacios = validarAutosVacios();
    //alert(validar_autos_vacios);
    
    
    //validar_id_proveedor1_vacio_editar = validarIdProveedor1VacioEditar();
    //alert(validar_id_proveedor1_vacio_editar);
    
    validar_descripcion_corta_vacia_editar = validarDescripcionCortaVaciaEditar();
    //alert(validar_descripcion_corta_vacia_editar);
    
    validar_unidad_vacia_editar = validarUnidadVaciaEditar();
    //alert(validar_unidad_vacia_editar);
    
    validar_cve_unidad_vacio_editar = validarCveUnidadVaciaEditar();
    //alert(validar_cve_unidad_vacio_editar);
    
    validar_clave_sat_vacia_editar = validarClaveSatVaciaEditar();
    //alert(validar_clave_sat_vacia_editar);
    
    validar_clave_producto_existente_editar = validarClaveProductoExistenteEditar();
    //alert(validar_clave_producto_existente_editar);
    
    validar_clave_producto_vacio_editar = validarClaveProductoVacioEditar();
    //alert(validar_clave_producto_vacio_editar);
    

    if(validar_clave_producto_existente_editar !== 0 &&
        validar_clave_producto_vacio_editar !== 0 && 
        validar_clave_sat_vacia_editar !== 0 && 
        validar_cve_unidad_vacio_editar !== 0 && 
        validar_unidad_vacia_editar !== 0 && 
        validar_descripcion_corta_vacia_editar !== 0/* &&
        validar_id_proveedor1_vacio_editar !== 0 &&
        validar_autos_vacios !== 0*/){

        document.forms["formularioEditarProducto"].submit();

}

});












/*function validarFamiliaExistenteCrear() {


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
}*/








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
$(document).on("change", "#precio1", function(){

        var precio1 = $("#precio1").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad1 = ((precio1/(precioCompra * 1.16))).toFixed(4);

        $("#utilidad1").val(utilidad1);
}



});



//CAMBIO DE PRECIO 1
$(document).on("change", "#utilidad1", function(){

        var utilidad1 = $("#utilidad1").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);
            
            var precio1 =((precioCompra * 1.16)*(utilidad1)).toFixed(0);

        $("#precio1").val(precio1);
        }


        

});


//CAMBIO DE UTILIDAD 2
$(document).on("change", "#precio2", function(){

        var precio2 = $("#precio2").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad2 = ((precio2/(precioCompra * 1.16))).toFixed(4);

        $("#utilidad2").val(utilidad2);
}



});



//CAMBIO DE PRECIO 2
$(document).on("change", "#utilidad2", function(){

        var utilidad2 = $("#utilidad2").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(0);
            
            var precio2 =((precioCompra * 1.16)*(utilidad2)).toFixed(2);

        $("#precio2").val(precio2);
        }


        

});

//CAMBIO DE UTILIDAD 3
$(document).on("change", "#precio3", function(){

        var precio3 = $("#precio3").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad3 = ((precio3/(precioCompra * 1.16))).toFixed(4);

        $("#utilidad3").val(utilidad3);
}



});



//CAMBIO DE PRECIO 3
$(document).on("change", "#utilidad3", function(){

        var utilidad3 = $("#utilidad3").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(0

            var precio3 =((precioCompra * 1.16)*(utilidad3)).toFixed(2);

        $("#precio3").val(precio3);
        }


        

});




















$(document).on("keyup", "#precio1", function(){

        var precio1 = $("#precio1").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad1 = ((precio1/(precioCompra * 1.16))).toFixed(4);

        $("#utilidad1").val(utilidad1);
}



});



//CAMBIO DE PRECIO 1
$(document).on("keyup", "#utilidad1", function(){

        var utilidad1 = $("#utilidad1").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);
            
            var precio1 =((precioCompra * 1.16)*(utilidad1)).toFixed(0);

        $("#precio1").val(precio1);
        }


        

});


//CAMBIO DE UTILIDAD 2
$(document).on("keyup", "#precio2", function(){

        var precio2 = $("#precio2").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad2 = ((precio2/(precioCompra * 1.16))).toFixed(4);

        $("#utilidad2").val(utilidad2);
}



});



//CAMBIO DE PRECIO 2
$(document).on("keyup", "#utilidad2", function(){

        var utilidad2 = $("#utilidad2").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(0);
            
            var precio2 =((precioCompra * 1.16)*(utilidad2)).toFixed(2);

        $("#precio2").val(precio2);
        }


        

});

//CAMBIO DE UTILIDAD 3
$(document).on("keyup", "#precio3", function(){

        var precio3 = $("#precio3").val();

        var precioCompra = $("#precio_compra").val();
        
if(precioCompra != '' || precioCompra != 0){

var precioCompraIva = precioCompra * 1.16;

        //var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);

        var utilidad3 = ((precio3/(precioCompra * 1.16))).toFixed(4);

        $("#utilidad3").val(utilidad3);
}



});



//CAMBIO DE PRECIO 3
$(document).on("keyup", "#utilidad3", function(){

        var utilidad3 = $("#utilidad3").val();

        var precioCompra = $("#precio_compra").val();

        if(precioCompra != '' || precioCompra != 0){

            //var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(0

            var precio3 =((precioCompra * 1.16)*(utilidad3)).toFixed(2);

        $("#precio3").val(precio3);
        }


        

});



















/*
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

        var utilidad1 = (((precio1/(precioCompra*1.16))-1)*100).toFixed(2);

        $("#editarUtilidad1").val(utilidad1);
    }



})



//CAMBIO DE PRECIO 1
$("#editarUtilidad1").change(function(){

    var utilidad1 = $("#editarUtilidad1").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio1 =(precioCompra*(1+(utilidad1/100))*1.16).toFixed(0);

        $("#editarPrecio1").val(precio1);
    }




})


//CAMBIO DE UTILIDAD 2
$("#editarPrecio2").change(function(){

    var precio2 = $("#editarPrecio2").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad2 = (((precio2/(precioCompra*1.16))-1)*100).toFixed(2);

        $("#editarUtilidad2").val(utilidad2);
    }



})



//CAMBIO DE PRECIO 2
$("#editarUtilidad2").change(function(){

    var utilidad2 = $("#editarUtilidad2").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio2 =(precioCompra*(1+(utilidad2/100))*1.16).toFixed(0);

        $("#editarPrecio2").val(precio2);
    }




})

//CAMBIO DE UTILIDAD 3
$("#editarPrecio3").change(function(){

    var precio3 = $("#editarPrecio3").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){

        var precioCompraIva = precioCompra * 1.16;

        var utilidad3 = (((precio3/(precioCompra*1.16))-1)*100).toFixed(2);

        $("#editarUtilidad3").val(utilidad3);
    }



})



//CAMBIO DE PRECIO 3
$("#editarUtilidad3").change(function(){

    var utilidad3 = $("#editarUtilidad3").val();

    var precioCompra = $("#mostrarPrecioCompra").val();

    if(precioCompra != '' || precioCompra != 0){
        var precio3 =(precioCompra*(1+(utilidad3/100))*1.16).toFixed(0);

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

});*/










function activaTablaMulticlavesProducto() {

    $("#tablaMulticlavesProducto").DataTable({
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
  order: [[1, 'asc']],
});
}




function consultaMulticlavesProducto(id_producto) {

    document.getElementById("incrustarTablaMulticlavesProducto").innerHTML = "";

    var datos =  {"id_producto": id_producto};

    $.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaMulticlavesProducto.php',
        success: function(data) {

            document.getElementById("incrustarTablaMulticlavesProducto").innerHTML = data;
            activaTablaMulticlavesProducto();
        }
    });

}



$(document).on("click", "#btnVerClavesProducto", function(){

    $("#modalClavesProducto").modal("show");

    var id_producto = $("#id_producto").val();

    consultaMulticlavesProducto(id_producto);

    

});




$(document).on("click", "#btnAgregarMulticlave", function(){

    $("#modalCrearMulticlaveProducto").modal("show");

});



function validarMulticlaveProductoVacia() {
    if($("#nuevaMulticlaveProducto").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir la multiclave para el producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevaMulticlaveProducto").focus();
        
        return 0;
        
        
    }else{

        return 1;
        
    }
    
}



$(document).on("click", "#btnSubmitCrearMulticlaveProducto", function(){

    $(this).blur();
    
    validar_multiclave_producto_vacia = validarMulticlaveProductoVacia();
    //alert(validar_ubicacion_vacia_editar);

    if(validar_multiclave_producto_vacia !== 0){


    var id_producto = $("#id_producto").val();
    var multiclave = $("#nuevaMulticlaveProducto").val();

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

            consultaMulticlavesProducto(id_producto);
            $("#nuevaMulticlaveProducto").val("");
            $("#modalCrearMulticlaveProducto").modal("hide");

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

});












$(document).on("click", ".eliminarMulticlave", function(){

    var id_multiclave = $(this).attr("id_multiclave");

    Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres borrar esta multiclave?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
      }).then(function(result){

        if(result.value){

    var datos = new FormData();

    datos.append("eliminarMulticlaveProducto", id_multiclave);

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
            title: 'La multiclave se ha eliminado con éxito',
            showConfirmButton: true
        });

                var id_producto = $("#id_producto").val();

                consultaMulticlavesProducto(id_producto);

            }else if(respuesta == 0){
                Swal.fire({
            icon: 'warning',
            title: 'No se ha podido eliminar la multiclave',
            showConfirmButton: true
        });
            }
        }

    });

}

});

});












function activaTablaProveedoresProducto() {

    $("#tablaProveedoresProducto").DataTable({
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
  order: [[1, 'asc']],
});
}










function consultaProveedoresProducto(id_producto) {

    document.getElementById("incrustarTablaProveedoresProducto").innerHTML = "";

    var datos =  {"id_producto": id_producto};

    $.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaProveedoresProducto.php',
        success: function(data) {

            document.getElementById("incrustarTablaProveedoresProducto").innerHTML = data;
            activaTablaProveedoresProducto();
        }
    });

}



$(document).on("click", "#btnVerProveedoresProducto", function(){

    $("#modalProveedoresProducto").modal("show");

    var id_producto = $("#editarProducto").val();

    consultaProveedoresProducto(id_producto);

    

});










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
listarProductosCompuesto();


var contador = $("#listaProductosCompuesto").attr("numProductoCompuesto");
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

                //console.log(respuesta);


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

                //console.log(productosCompuestoArr);         
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

                var posicion = productosCompuestoArr.indexOf(id_producto);

                productosCompuestoArr.splice(posicion, 1);

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

                productosCompuestoArr = [];

                var descripcion = $(".nuevaDescripcionProducto");

                var cantidad = $(".nuevaCantidadProducto");

                for(var i = 0; i < descripcion.length; i++){

                        listaProductosCompuesto.push({ "id_producto" : $(descripcion[i]).attr("id_producto"),
                            "cantidad" : $(cantidad[i]).val()});

                        productosCompuestoArr.push($(descripcion[i]).attr("id_producto"));

                }
                //console.log("listaProductosCompuesto", listaProductosCompuesto);

                $("#listaProductosCompuesto").val(JSON.stringify(listaProductosCompuesto)); 

        }




















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










$(document).on("change", "#precio_compra", function(){

    var precio_compra = $(this).val();


    var id_producto = $("#editarProducto").val();

    var id_sucursal = $("#idSucursalEP").val();

    var respuesta = actualizarProductoES2("precio_compra", precio_compra, id_producto, id_sucursal);

    $("#utilidad1").trigger("change");
    $("#utilidad2").trigger("change");
    $("#utilidad3").trigger("change");

});




$(document).on("keyup", "#precio_compra", function(){

    var precio_compra = $(this).val();


    var id_producto = $("#editarProducto").val();

    var id_sucursal = $("#idSucursalEP").val();

    var respuesta = actualizarProductoES2("precio_compra", precio_compra, id_producto, id_sucursal);

    $("#utilidad1").trigger("change");
    $("#utilidad2").trigger("change");
    $("#utilidad3").trigger("change");

});
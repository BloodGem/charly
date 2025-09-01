
/*=============================================
BOTON EDITAR PRODUCTO
=============================================*/
$(document).on("click", ".btnEditarProducto", function(){

    var id_producto = $(this).attr("id_producto");

    window.location = "index.php?ruta=editar-producto&id_producto="+id_producto;


})

/*=============================================
BOTON DUPLICAR PRODUCTO
=============================================*/
$(document).on("click", ".btnDuplicarProducto", function(){

    var id_producto = $(this).attr("id_producto");

    window.location = "index.php?ruta=duplicar-producto&id_producto="+id_producto;


})





$('#nuevoIdProveedor1').one('select2:open', function(e) {
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
});

$('#nuevoIdMarca').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca la marca aquí...');
});


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
















        /*=============================================
        CONFIRMAR DEVOLUCIÓN
        =============================================*/
        /*$(document).on("click", ".btnConfirmarProducto", function(){

            $("#formularioNuevoProducto").preventDefault();
                        //var listaAutosProducto = $("#listaAutosProducto").val();
                        var indice = nombres_autos.indexOf(0);
                        console.log(indice);
                        /*if(listaAutosProducto == ""){
                                Swal.fire({
                icon: 'error',
                title: 'No se ha seleccionado ninguna venta para comenzar una devolución',
                showConfirmButton: false,
                timer: 2000
                });
                        }else if(indice >= 0){
                                Swal.fire({
                icon: 'error',
                title: 'Alguna partida de los autos tiene el nombre vacio',
                showConfirmButton: false,
                timer: 2000
                });
                        }else{
                           $("#formularioNuevoProducto").submit();   
                        }
                      

                    

                  
        })*/






/*ACTIVAR O DESACTIVAR PRODUCTO*/
$(document).on("click", ".btnEstatus", function(){

    var id_producto = $(this).attr("id_producto");
    var estatusProducto = $(this).attr("estatusProducto")

    var datos = new FormData();

    datos.append("estatusIdProducto", id_producto);
    datos.append("estatusProducto", estatusProducto);

    $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){



        }
    });

    if(estatusProducto == 0){

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('ACTIVADO');
        $(this).attr('estatusProducto',1);

    }else{

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('DESACTIVADO');
        $(this).attr('estatusProducto',0);

    }
});







        //BUSQUEDA DE PRODUCTOS POR DESCRIPCION
function buscarAhoraProductosD(buscarProductosD) {

    var busqueda_anterior = $("#buscarProductosD").attr("busqueda_anterior");

    //alert("busqueda anterior: "+busqueda_anterior);

    var no_letras = $("#buscarProductosD").val().length;

    //alert("no_letras: "+no_letras);

    //alert("busqueda: "+buscarProductosD);

    if(busqueda_anterior ==  buscarProductosD){

    }else{
        if(no_letras >= 3){
            var parametros = {"buscarProductosD":buscarProductosD};
            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/busquedas/buscadorProductos.php',
                success: function(data) {
                    document.getElementById("incrustarTablaListaProductos").innerHTML = data;
                    $("#buscarProductosD").attr("busqueda_anterior", buscarProductosD);
                }
            });
        }
    }


    
}










    $(document).keydown(function(event) {
    if (event.which === 27)
    {
        $("#buscarProductosD").val("");
            $("#buscarProductosD").focus();
            $("#buscarProductosD").attr("busqueda_anterior", "");
            document.getElementById("incrustarTablaListaProductos").innerHTML = "";
            //$(tecla_esc).trigger('click');
        
    }
});




$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 66)
    {

            $("#buscarProductosD").val("");
            $("#buscarProductosD").focus();
            $("#buscarProductosD").attr("busqueda_anterior", "");
            document.getElementById("incrustarTablaListaProductos").innerHTML = "";
            //$(tecla_esc).trigger('click');
        
    }
});




$(document).keydown(function(event) {
    if (event.which === 113)
    {
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];




            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);


            //alert("contador mas: "+contador_mas);
            

            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).children(".imagenes").children(".imagen1").trigger('click');

          

    }
});



$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 38)
    {
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("btnEditarProducto"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);


            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
        }else{

            setTimeout(function() { 

            //alert("si hay foco");


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            
            //alert("contador actual: "+contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);
            

            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".btnEditarProducto").addClass('foco').focus();

            //$(foco).focus();

            }, 100);
        }
        //alert('Ctrl + flecha abajo!');

    }
});


$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("btnEditarProducto"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);


            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
        }else{

            setTimeout(function() { 

            //alert("si hay foco");


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            
            //alert("contador actual: "+contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);
            

            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".btnEditarProducto").addClass('foco').focus();

            //$(foco).focus();

            }, 100);
        }
        //alert('Ctrl + flecha abajo!');

    }
});

$(document).on("focus", ".btnEditarProducto", function(){

    var contador_actual = $(this).attr("contador");

    var contador_menos = parseInt(contador_actual) - 1;

    var contador_mas = parseInt(contador_actual) + 1;

    $(this).addClass('foco');

    $(this).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");


    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".btnEditarProducto").removeClass('foco');

    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".btnEditarProducto").removeClass('foco');



});















/*=============================================
    VERIFICAR SI LA MARCA EXISTE
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










/*=============================================
    VERIFICAR SI LA MARCA EXISTE
    =============================================*/     

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



});











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



/*=============================================
VALIDACIONES
=============================================*/



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
LLENAR DESCRIPCION CORTA CON LA LARGA
=============================================*/

$(document).on("change", "#nuevaDescripcionLarga", function(){

    var descripcion_larga = $(this).val();

    var descripcion_corta = descripcion_larga.substring(0, 40);

    $("#nuevaDescripcionCorta").val(descripcion_corta);
    

});





$(document).on("change", "#editarDescripcionLarga", function(){

    var descripcion_larga = $(this).val();

    var descripcion_corta = descripcion_larga.substring(0, 40);

    $("#editarDescripcionCorta").val(descripcion_corta);
    

});

/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADA
=============================================*/

$(document).on("change", "#nuevaClaveProducto", function(){

    validar_clave_producto_existente_crear = validarClaveProductoExistenteCrear();
    

});



/*=============================================
VALIDACIONES PARA LA CREACION
=============================================*/

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





function validarIdClaveSatVacioCrear() {
    if($("#nuevoIdClaveSat").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una clave de SAT para el producto',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoIdClaveSat").focus();
        
        validar_id_clave_sat_vacio_crear = 0;
        
        return validar_id_clave_sat_vacio_crear;
        
        
    }else{

        validar_id_clave_sat_vacio_crear = 1;
        return validar_id_clave_sat_vacio_crear;
        
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





function validarDescripcionLargaVaciaCrear() {
    if($("#nuevaDescripcionLarga").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una descripción',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevaDescripcionLarga").focus();
        
        validar_descripcion_larga_vacia_crear = 0;
        
        return validar_descripcion_larga_vacia_crear;
        
        
    }else{

        validar_descripcion_larga_vacia_crear = 1;
        return validar_descripcion_larga_vacia_crear;
        
    }
    
}


















function validarIdProveedor1VacioCrear() {
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





function validarDescripcionLargaVaciaEditar() {
    if($("#editarDescripcionLarga").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir una descripción',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarDescripcionLarga").focus();
        
        validar_descripcion_larga_vacia_editar = 0;
        
        return validar_descripcion_larga_vacia_editar;
        
        
    }else{

        validar_descripcion_larga_vacia_editar = 1;
        return validar_descripcion_larga_vacia_editar;
        
    }
    
}











function validarIdProveedor1VacioEditar() {
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
    
}





$(document).on("click", "#btnCrearProducto", function(){

    $(this).blur();

    
    validar_id_proveedor1_vacio_crear = validarIdProveedor1VacioCrear();
    //alert("El proveedor 1 del producto esta vacio? "+validar_id_proveedor1_vacio_crear);
    
    validar_descripcion_larga_vacia_crear = validarDescripcionLargaVaciaCrear();
    //alert("La descripción corta del producto esta vacio? "+validar_descripcion_corta_vacia_crear);
    
    validar_unidad_vacia_crear = validarUnidadVaciaCrear();
    //alert("La unidad del producto esta vacia? "+validar_unidad_vacia_crear);
    
    validar_cve_unidad_vacio_crear = validarCveUnidadVaciaCrear();
    //alert("La clave de unidad del producto esta vacio? "+validar_cve_unidad_vacio_crear);
    
    validar_id_clave_sat_vacio_crear = validarIdClaveSatVacioCrear();
    //alert("La clave del sat esta vacia? "+validar_clave_sat_vacia_crear);
    
    validar_clave_producto_existente_crear = validarClaveProductoExistenteCrear();
    //alert("La clave del producto ya existe?"+validar_clave_producto_existente_crear);
    
    validar_clave_producto_vacio_crear = validarClaveProductoVacioCrear();
    //alert("La clave del producto esta vacio? "+validar_clave_producto_vacio_crear);
    

    if(validar_clave_producto_existente_crear !== 0 &&
        validar_clave_producto_vacio_crear !== 0 && 
        validar_id_clave_sat_vacio_crear !== 0 && 
        validar_cve_unidad_vacio_crear !== 0 && 
        validar_unidad_vacia_crear !== 0 && 
        validar_descripcion_larga_vacia_crear !== 0 &&
        validar_id_proveedor1_vacio_crear !== 0){

        Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres crear este producto?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
      }).then(function(result){

        if(result.value){

          document.forms["formularioNuevoProducto"].submit();

      }

  });



  }

});





/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarClaveProducto", function(){

    validar_clave_producto_existente_editar = validarClaveProductoExistenteEditar();

    
});



$(document).on("click", "#btnEditarProducto", function(){

    $(this).blur();
    
    
    validar_id_proveedor1_vacio_editar = validarIdProveedor1VacioEditar();
    //alert(validar_id_proveedor1_vacio_editar);
    
    validar_descripcion_larga_vacia_editar = validarDescripcionLargaVaciaEditar();
    //alert(validar_descripcion_larga_vacia_editar);
    
    validar_unidad_vacia_editar = validarUnidadVaciaEditar();
    //alert(validar_unidad_vacia_editar);

    validar_clave_producto_existente_editar = validarClaveProductoExistenteEditar();
    //alert(validar_clave_producto_existente_editar);
    
    validar_clave_producto_vacio_editar = validarClaveProductoVacioEditar();
    //alert(validar_clave_producto_vacio_editar);
    

    if(validar_clave_producto_existente_editar !== 0 &&
        validar_clave_producto_vacio_editar !== 0 &&
        validar_unidad_vacia_editar !== 0 && 
        validar_descripcion_larga_vacia_editar !== 0 &&
        validar_id_proveedor1_vacio_editar !== 0){

       Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres guardar las modificaciones de este producto?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
      }).then(function(result){

        if(result.value){

          document.forms["formularioEditarProducto"].submit();

      }

  });



  }

});









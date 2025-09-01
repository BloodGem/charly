$( document ).ready(function() {

    var busquedaAnterior = $("#busquedaAnterior").val();

    $("#buscarProductos").val(busquedaAnterior);

    $("#buscarProductos").trigger("change");

});








/*=============================================
BOTON EDITAR PRODUCTO
=============================================*/
$(document).on("click", ".btnEditarProducto", function(){

        var id_producto = $(this).attr("id_producto");

        var busquedaAnterior = $("#buscarProductos").val();

        window.location = "index.php?ruta=editar-producto&id_producto="+id_producto+"&busquedaAnterior="+busquedaAnterior;


});










/*=============================================
BOTON DUPLICAR PRODUCTO
=============================================*/
$(document).on("click", ".btnDuplicarProducto", function(){

        var id_producto = $(this).attr("id_producto");

        window.location = "index.php?ruta=duplicar-producto&id_producto="+id_producto;


});










/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$(document).on("click", ".btnEliminarProducto", function(){

   var id_producto = $(this).attr("id_producto");

   Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar este producto?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=lista-productos&id_producto="+id_producto;

    }

  });

});










/*=============================================
BUSCADOR DE PRODUCTOS
=============================================*/
function buscarAhoraProductos(buscarProductos) {
    if(buscarProductos == ""){
                    document.getElementById("incrustarTablaProductos").innerHTML = "";
                }else{
        var parametros = {"buscarProductos":buscarProductos};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorProductos.php',
        success: function(data) {
        document.getElementById("incrustarTablaProductos").innerHTML = data;
        }
        });
    }
        }


        $(document).on("change", "#buscarProductos", function(){

            var buscarProductos = $(this).val();

            $("#busquedaAnterior").val(buscarProductos);

            buscarAhoraProductos(buscarProductos);

        });







        //AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarProductos").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarProductos").val("");
            $("#buscarProductos").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarProductos").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarProductos").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevoProducto").trigger('click');
        //$(".close").hide();
        $("#buscarProductos").attr("teclaEsc", "no");

        

    }
});








//AL PRESIONAR F2 PARA EDITAR
$(document).keydown(function(event) {
    if(event.which === 113){

        event.preventDefault();

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

                var contador_actual = $(foco).attr("contador");

                $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarProducto").trigger("click"); 
        }
    }
});





//AL PRESIONAR F3 PARA ELIMINAR
$(document).keydown(function(event) {
    if (event.which === 114)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarProducto").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarProductos").attr("teclaEsc", "no");

    }

        

    }
});










//AL PRESIONAR F4 PARA DUPLICAR
$(document).keydown(function(event) {
    if(event.which === 115){

        event.preventDefault();

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

                var contador_actual = $(foco).attr("contador");

                $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnDuplicarProducto").trigger("click"); 
        }
    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarProductos").attr("teclaEsc");
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
        var buscador_esc = $("#buscarProductos").attr("teclaEsc");
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



$(document).on("click", ".btnVerMulticlavesProducto", function(){

    $("#modalMulticlavesProducto").modal("show");

    var id_producto = $(this).attr("id_producto");

    $("#idProductoMutlticlaves").val(id_producto);

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


    var id_producto = $("#idProductoMutlticlaves").val();
    var multiclave = $("#nuevaMulticlaveProducto").val();
    var multiplo_entrega = $("#nuevoMultiploEntregaclaveProducto").val();
    

    var datos = new FormData();

    datos.append("crearMulticlaveProducto", id_producto);
    datos.append("multiclave", multiclave);
    datos.append("multiplo_entrega", multiplo_entrega);

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

                var id_producto = $("#idProductoMutlticlaves").val();

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



















$(document).on("click", ".aEditarMultiploProducto", function(){
    event.preventDefault();
    var id_producto = $(this).attr("id_producto");
    var clave_producto = $(this).attr("clave_producto");
    $("#btnSubmitEMP").attr("clave_producto",clave_producto);
    var datos = new FormData();
    datos.append("id_producto", id_producto);
    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){

            console.log(respuesta);

            $("#modalEditarMultiploProducto").modal("show");

            $("#mostrarMultiploProductoActual").val(respuesta['multiplo']);
            $("#mostrarIdProductoEMP").val(id_producto);
            
        }
    });
});








$(document).on("click", "#btnSubmitEMP", function(){



                         Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres cambiar el multiplo?",
                  footer: "Si confirma ya no habrá vuelta atrás",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                        var id_producto = $("#mostrarIdProductoEMP").val();
                        var nuevo_multiplo = $("#nuevoMultiploProducto").val();

                        var actualizaProducto = new FormData();

                        actualizaProducto.append("actualizarProducto", id_producto);
                        actualizaProducto.append("valor", nuevo_multiplo);
                        actualizaProducto.append("columna", "multiplo");


                        $.ajax({
                            url:"ajax/productos.ajax.php",
                            method: "POST",
                            data: actualizaProducto,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(respuesta){
                                if(respuesta == 1){
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Se ha cambiado el múltiplo al producto correctamente',
                                    showConfirmButton: true
                                    }).then(function(result){

                                        var clave_producto = $("#btnSubmitEMP").attr("clave_producto");

                                        $("#buscarProductos").val(clave_producto);

                                        $(".close").trigger('click');

                                        var busquedaAnterior = $("#busquedaAnterior").val();

                                        $("#buscarProductos").val(busquedaAnterior);

                                        $("#buscarProductos").trigger("change");

                                        
                                    });
                                }else{
                                    Swal.fire({
                                    icon: 'warning',
                                    title: 'No se le ha podido cambiar el múltiplo al producto',
                                    showConfirmButton: true
                                    }).then(function(result){
                                        $(".close").trigger('click');
                                    });
                                }
                            }
                        });

                    }

                  });
        });











$(document).on("click", ".ActDesProducto", function(){

    var btnActDesProducto = $(this);
    var id_producto = $(this).attr("id_producto");
    var estadoProducto = $(this).attr("estadoProducto");

    var datos = new FormData();

    datos.append("actualizarProducto", id_producto);
    datos.append("columna", "descontinuado");
    datos.append("valor", estadoProducto);

    $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            if(estadoProducto == 0){

                btnActDesProducto.addClass('btn-success');
                btnActDesProducto.removeClass('btn-danger');
                btnActDesProducto.html('ACTIVADO');
                btnActDesProducto.attr('estadoProducto',1);

                
            }else{

                btnActDesProducto.removeClass('btn-success');
                btnActDesProducto.addClass('btn-danger');
                btnActDesProducto.html('DESACTIVADO');
                btnActDesProducto.attr('estadoProducto',0);

            } 

        }
    });

    
});
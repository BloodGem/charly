function activaTablaProductosVentasFiltros() {

    $("#tablaProductosVentasFiltros").DataTable({
      "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "",
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
  "columnDefs":[{
    targets: "_all",
    sortable: false
}],
  "lengthChange": false, 
  "autoWidth": false,
  "searching": false,
  "paging": false,
  order: [[2, 'asc']],
});
}


function divBusquedaActiva(){

    const verifica_div_busqueda = document.getElementsByClassName("divBusqueda");

    var div_busqueda = verifica_div_busqueda[0];

    $(div_busqueda).attr("style","background-color: blue;");

}


function divBusquedaDesactiva(){

    const verifica_div_busqueda = document.getElementsByClassName("divBusqueda");

    var div_busqueda = verifica_div_busqueda[0];

    $(div_busqueda).removeAttr("style");

}





function divVentaActiva(){

    const verifica_div_venta = document.getElementsByClassName("divVenta");

    var div_venta = verifica_div_venta[0];

    $(div_venta).attr("style","background-color: #E01200;");

}


function divVentaDesactiva(){

    const verifica_div_venta = document.getElementsByClassName("divVenta");

    var div_venta = verifica_div_venta[0];

    $(div_venta).removeAttr("style");;

}





$(document).on("click", "#aumentarEspacioDivVenta", function(){


    var aumdis_venta = $("#divVenta").attr("aumdis_venta");

    var aumdis_busqueda = $("#divBusqueda").attr("aumdis_busqueda");

    var nueva_aumdis_venta = Number(aumdis_venta) + 1;

    var nueva_aumdis_busqueda = Number(aumdis_busqueda) - 1;

    $("#divBusqueda").removeClass('col-md-'+aumdis_busqueda);
    $("#divBusqueda").addClass('col-md-'+nueva_aumdis_busqueda);

    $("#divVenta").removeClass('col-md-'+aumdis_venta);
    $("#divVenta").addClass('col-md-'+nueva_aumdis_venta);

    $("#divVenta").attr("aumdis_venta",nueva_aumdis_venta);
    $("#divBusqueda").attr("aumdis_busqueda",nueva_aumdis_busqueda);

});










$(document).on("click", "#disminuirEspacioDivVenta", function(){


    var aumdis_venta = $("#divVenta").attr("aumdis_venta");

    var aumdis_busqueda = $("#divBusqueda").attr("aumdis_busqueda");

    var nueva_aumdis_venta = Number(aumdis_venta) - 1;

    var nueva_aumdis_busqueda = Number(aumdis_busqueda) + 1;

    $("#divBusqueda").removeClass('col-md-'+aumdis_busqueda);
    $("#divBusqueda").addClass('col-md-'+nueva_aumdis_busqueda);

    $("#divVenta").removeClass('col-md-'+aumdis_venta);
    $("#divVenta").addClass('col-md-'+nueva_aumdis_venta);

    $("#divVenta").attr("aumdis_venta",nueva_aumdis_venta);
    $("#divBusqueda").attr("aumdis_busqueda",nueva_aumdis_busqueda);

});





        //BUSQUEDA DE PRODUCTOS POR DESCRIPCION
function buscarAhoraProductosD(buscarProductosD) {

    var busqueda_anterior = $("#buscarProductosD").attr("busqueda_anterior");

    var no_precio = $("#nuevoIdCliente").attr("no_precio");

    //alert("busqueda anterior: "+busqueda_anterior);

    var no_letras = $("#buscarProductosD").val().length;

    //alert("no_letras: "+no_letras);

    //alert("busqueda: "+buscarProductosD);

    if(busqueda_anterior ==  buscarProductosD){

    }else{
        if(no_letras >= 3){
            var parametros = {"buscarProductosD":buscarProductosD, "no_precio":no_precio};
            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadores/buscadorProductosVentasFiltros.php',
                success: function(data) {
                    document.getElementById("incrustarTablaProductos").innerHTML = data;
                    activaTablaProductosVentasFiltros();
                    $("#buscarProductosD").attr("busqueda_anterior", buscarProductosD);
                }
            });
        }
    }  
}







$(document).keydown(function(event) {
    if (event.which === 27)
    {
        divBusquedaActiva();
        divVentaDesactiva();
        var buscador_esc = $("#buscarProductosD").attr("teclaEsc");
        if(buscador_esc == "si"){
            $("#buscarProductosD").val("");
            $("#buscarProductosD").focus();
            $("#buscarProductosD").attr("busqueda_anterior", "");
            document.getElementById("incrustarTablaProductos").innerHTML = "";
            //$(tecla_esc).trigger('click');
        }else if(buscador_esc == "no"){
            $("#buscarProductosD").attr("teclaEsc","si");
            const verifica_foco = document.getElementsByClassName("foco");
            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);
            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).children().children().children(".agregarProducto").addClass('foco').focus();
        }
    }
});









$(document).keydown(function(event) {
    //CREAR VENTA F8
    if (event.which === 119)
    {
        event.preventDefault();
        $(".btnGenerarVenta").trigger('click');

    }
});




$(document).keydown(function(event) {
    //ABRIR IMAGENES F2
    if (event.which === 113)
    {

        $("#buscarProductosD").attr("teclaEsc","no");

        $(".close").trigger('click');
        const verifica_foco = document.getElementsByClassName("foco");
        setTimeout(function() { 
            var foco = verifica_foco[0];




            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);


            //alert("contador mas: "+contador_mas);
            
            
            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).children(".imagenes").children(".imagen1").trigger('click');
            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).attr("cont","1");
            $(".close").hide();
        }, 100);

    }
});









$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 37)
    {
        var buscador_esc = $("#buscarProductosD").attr("teclaEsc");
        if(buscador_esc == "no"){

           const verifica_foco = document.getElementsByClassName("foco");

           var foco = verifica_foco[0];
           setTimeout(function() { 


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            var img = $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).attr("cont");
            
            var cont_img = parseInt(img) - 1;

            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).attr("cont", cont_img);
            
            if(cont_img == 0){


                $(foco).removeClass("foco");

                $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

                $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("cont", "2");

                $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".agregarProducto").addClass('foco').focus();

            }
        }, 100); 
       }
   }

});










$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 39)
    {
     var buscador_esc = $("#buscarProductosD").attr("teclaEsc");
     if(buscador_esc == "no"){
       const verifica_foco = document.getElementsByClassName("foco");
       var foco = verifica_foco[0];
       setTimeout(function() { 


        var contador_actual = $(foco).attr("contador");

        contador_actual = parseInt(contador_actual);

        var contador_mas = contador_actual + 1;

        var contador_menos = contador_actual - 1;

        var img = $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).attr("cont");

        var cont_img = parseInt(img) + 1;

        $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).attr("cont", cont_img);

        if(cont_img == 3){


            $(foco).removeClass("foco");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("cont", "1");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".agregarProducto").addClass('foco').focus();

        }
    }, 100); 

   }
}

});





$(document).keydown(function(event) {
    //CAMBIAR A LA SIGUIENTES IMAGENES DE UN PRODUCTO
    if (event.ctrlKey && event.which === 38)
    {

        var contador_inicial = 1;

        var buscador_esc = $("#buscarProductosD").attr("teclaEsc");
        if(buscador_esc == "no"){




            const verifica_foco = document.getElementsByClassName("foco");
            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            $(".close").trigger('click');
            
            if(contador_actual <= contador_inicial){

                setTimeout(function() { 

                    $(".contador1").children().children().children(".agregarProducto").addClass('foco').focus();

                    $(".contador1").attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                    $("#buscarProductosD").attr("teclaEsc","si");

                }, 150);
                
            }else{



                setTimeout(function() { 






                    var contador_mas = contador_actual + 1;

                    var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);


                    $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("cont", "1");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".agregarProducto").addClass('foco').focus();

                    $("#buscarProductosD").attr("teclaEsc","no");
                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children(".imagenes").children(".imagen1").trigger('click');

                    $(".close").hide();



                }, 150);

            }
        }else{
            const verifica_foco = document.getElementsByClassName("foco");

            var foco = verifica_foco[0];



        //alert("foco "+foco);

            if(foco == null){
                const items = document.getElementsByClassName("agregarProducto"); 

                var contador_actual = $(items[0]).attr("contador");

                contador_actual = parseInt(contador_actual);


                $(items[0]).addClass("foco");
                $(items[0]).focus();
                $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                divBusquedaActiva();
                divVentaDesactiva();

            }else{

                divBusquedaActiva();
                divVentaDesactiva();

                setTimeout(function() { 

            //alert("si hay foco");


                    var contador_actual = $(foco).attr("contador");

                    contador_actual = parseInt(contador_actual);

                    if(contador_actual <= 1){
                        return;
                    }else{

            //alert("contador actual: "+contador_actual);

                        var contador_mas = contador_actual + 1;

                        var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);


                        $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".agregarProducto").addClass('foco').focus();

                    }
            //$(foco).focus();

                }, 100);
            }
        }
    }
});


$(document).keydown(function(event) {
    //CAMBIAR A LA SIGUIENTES IMAGENES DE UN PRODUCTO
    if (event.ctrlKey && event.which === 40)
    {

        var contador_final = $("#contadorFinal").val();

        var buscador_esc = $("#buscarProductosD").attr("teclaEsc");
        if(buscador_esc == "no"){




            const verifica_foco = document.getElementsByClassName("foco");
            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            $(".close").trigger('click');
            
            if(contador_actual >= contador_final){

                $(foco).addClass('foco').focus();

                $("#buscarProductosD").attr("teclaEsc","si");
                
            }else{



                setTimeout(function() { 






                    var contador_mas = contador_actual + 1;

                    var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);


                    $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("cont", "1");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".agregarProducto").addClass('foco').focus();

                    $("#buscarProductosD").attr("teclaEsc","no");
                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children(".imagenes").children(".imagen1").trigger('click');

                    $(".close").hide();



                }, 150);

            }
        }else{
            const verifica_foco = document.getElementsByClassName("foco");

            var foco = verifica_foco[0];

            var contador_final = $("#contadorFinal").val();
        //alert("foco "+foco);

            if(foco == null){
                const items = document.getElementsByClassName("agregarProducto"); 

                var contador_actual = $(items[0]).attr("contador");

                contador_actual = parseInt(contador_actual);


                $(items[0]).addClass("foco");
                $(items[0]).focus();
                $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                divBusquedaActiva();
                divVentaDesactiva();

            }else{

                divBusquedaActiva();
                divVentaDesactiva();

                setTimeout(function() { 

            //alert("si hay foco");


                    var contador_actual = $(foco).attr("contador");

                    contador_actual = parseInt(contador_actual);

                    if(contador_actual >= contador_final){
                        return;
                    }else{

            //alert("contador actual: "+contador_actual);

                        var contador_mas = contador_actual + 1;

                        var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);


                        $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".agregarProducto").addClass('foco').focus();

                    }
            //$(foco).focus();

                }, 100);
            }
        }
    }
});



/*$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 38)
    {
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        

        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("agregarProducto"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);


            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            divBusquedaActiva();
            divVentaDesactiva();
            
        }else{

            divBusquedaActiva();
            divVentaDesactiva();

            setTimeout(function() { 

            //alert("si hay foco");


                var contador_actual = $(foco).attr("contador");

                contador_actual = parseInt(contador_actual);

                if(contador_actual <= 1){
                    return;
                }else{

            //alert("contador actual: "+contador_actual);

                    var contador_mas = contador_actual + 1;

                    var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);


                    $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".agregarProducto").addClass('foco').focus();

                }
            //$(foco).focus();

            }, 100);
        }
        //alert('Ctrl + flecha abajo!');

    }
});*/


/*$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        var contador_final = $("#contadorFinal").val();
        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("agregarProducto"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);


            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
            divBusquedaActiva();
            divVentaDesactiva();

        }else{

            divBusquedaActiva();
            divVentaDesactiva();

            setTimeout(function() { 

            //alert("si hay foco");


                var contador_actual = $(foco).attr("contador");

                contador_actual = parseInt(contador_actual);

                if(contador_actual >= contador_final){
                    return;
                }else{

            //alert("contador actual: "+contador_actual);

                    var contador_mas = contador_actual + 1;

                    var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);


                    $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".agregarProducto").addClass('foco').focus();

                }
            //$(foco).focus();

            }, 100);
        }
        //alert('Ctrl + flecha abajo!');

    }
});*/

$(document).on("focus", ".agregarProducto", function(){

    var contador_actual = $(this).attr("contador");

    var contador_menos = parseInt(contador_actual) - 1;

    var contador_mas = parseInt(contador_actual) + 1;

    $(this).addClass('foco');

    $(this).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");


    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".agregarProducto").removeClass('foco');

    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".agregarProducto").removeClass('foco');



});









/*$(document).on("keyup", "#inputInserteCantidad", function(){   
        $("#inputInserteCantidad").select();
        event.preventDefault();
    });*/









id_cliente = $("#nuevoIdCliente").val();

$("#nuevoIdCliente").val(id_cliente);


var contador = 0;





                /*=============================================
        AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
        =============================================*/
var myArr = [];
$(document).on("click", ".agregarProducto", function(){

    var id_producto = $(this).attr("id_producto");

    
    if(myArr.includes(id_producto) == true){


        Swal.fire({
            icon: 'warning',
            title: 'Este producto ya fue agregado',
            showConfirmButton: true
        }).then(function(result){

            setTimeout(function() { 
                $("#rowProducto"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").focus();

            }, 400);
    

});

        
return;
    }else{

     

     





     var datos = new FormData();
     datos.append("id_producto", id_producto);


     $.ajax({

        url:"ajax/existencias-sucursales.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            var descripcion_corta = respuesta["descripcion_corta"];
            var stock = parseInt(respuesta["stock"]);


            var no_precio = $("#nuevoIdCliente").attr("no_precio");

            var clave_producto = respuesta["clave_producto"];

            var estatus_compra = parseInt(respuesta["estatus_compra"]);

            console.log(respuesta);


            if(estatus_compra == 0){

                Swal.fire({
                    icon: 'warning',
                    title: 'El producto se encuentra en cambio de precio',
                    text: 'No se agregará el producto',
                    showConfirmButton: false,
                    timer: 2000
                });

                return;
            }


            if(stock == 0){

                Swal.fire({
                    icon: 'warning',
                    title: 'No hay existencias',
                    text: 'No se agregará el producto',
                    showConfirmButton: false,
                    timer: 2000
                });

                return;
            }else if(stock !==0){

                Swal.fire({
                    title: 'Inserte cantidad',
                    input: 'number',
                    inputValue: 1,
                    inputAttributes: {
                        id: "inputInserteCantidad",
                        min: 1,
                        max: stock,
                        step: 1,
                        pattern: "[0-9]{10}"
                    },
                    inputValidator: (value) => {
                        if (value > stock) {
                            return 'La cantidad ingresada supera a la cantidad en inventario'
                        }
                        if (value < 0) {
                            return 'No puede ingresar cantidad negativa'
                        }
                        if (value == 0) {
                            return 'No ha especificado la catidad a vender'
                        }
                    },
                    showCancelButton: true,
                    confirmButtonText: 'confirmar',
                    showLoaderOnConfirm: true,
                    preConfirm: (cantidad) => {



                        if (cantidad > stock) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'No hay existencias suficientes',
                                text: 'No se agregará el producto',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            var posicion = myArr.indexOf(id_producto);

                            myArr.splice(posicion, 1);
                            $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

                            $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');

                            return;
                        }else{

                            myArr.push(id_producto);

                            $(this).removeClass("btn-primary agregarProducto");

                            $(this).addClass("btn-default");

                            if(no_precio == 1){

                                var precioOriginal = Number(respuesta["precio1"]);

                                var precio1 = Number(respuesta["precio1"]);

                                
                            }else if(no_precio == 2){
                                var precioOriginal = Number(respuesta["precio2"],2);

                                var precio1 = Number(respuesta["precio2"],2);

                            }else if(no_precio == 3){


                                var precioOriginal = Number(respuesta["precio3"],2);

                                var precio1 = Number(respuesta["precio3"],2);


                            }else{

                                var precioOriginal = Number(respuesta["precio1"]);

                                var precio1 = Number(respuesta["precio1"]);

                               
                            }

                            var total = cantidad * precio1;
                            total = Number(total, 2);

                            contador = contador + 1;



                            var no_forma_pago = $('input:radio[name=nuevoIdFormaPago]:checked').val();

                            



                        $(".nuevoProducto").append('<div class="row rowProducto" id="rowProducto'+id_producto+'" style="font-size: 13px;">'+
                            '<div class="col-1">'+
                            '<button type="button" class="btn btn-sm btn-danger quitarProducto" id_producto="'+id_producto+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                            '</div>'+
                            '<div class="col-2">'+
            //'<input type="text" class="form-control form-control-sm nuevaClaveProducto" placeholder="" name="claveProducto" value="'+clave_producto+'" tabindex="-1" readonly>'+
                            '<span class="nuevaClaveProducto" style="font-size: 15px; color: blue; ">'+clave_producto+'</span>'+
                            '</div>'+
                            '<div class="col-4">'+
            //'<input type="text" class="form-control form-control-sm nuevaDescripcionProducto" id_producto="'+id_producto+'" placeholder="" name="agregarProducto" value="'+descripcion_corta+'" tabindex="-1" readonly>'+
                            '<span class="nuevaDescripcionProducto" style="font-size: 15px; color: blue; " descripcion="'+descripcion_corta+'" id_producto="'+id_producto+'">'+descripcion_corta+'</span>'+
                            '</div>'+
                            '<div class="col-2 ingresoCantidad">'+
                            '<input type="number" class="form-control form-control-sm nuevaCantidadProducto" id="nuevaCantidadProducto'+contador+'" name="nuevaCantidadProducto'+contador+'" min="1" value="'+cantidad+'" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" onkeydown="numerosSinDecimales()" required>'+
                            '</div>'+
                            '<div class="col-3 ingresoPrecio">'+
                            '<div class="input-group input-group-sm mb-3">'+
                            '<input type="number" class="form-control form-control-sm nuevoPrecioProducto" precioReal="'+precio1+'" value="'+total+'" tabindex="-1" readonly>'+
                            '</div>'+
                            '</div>'+
                            '</div>');



                        $("#nuevaCantidadProducto"+contador).focus();

                                        // SUMAR TOTAL DE PRECIOS

                        sumarTotalPrecios();


                                        // AGRUPAR PRODUCTOS EN FORMATO JSON

                        listarProductos();



                                        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                        $(".nuevoPrecioProducto").number(true, 0);

                        document.getElementById("incrustarTablaProductos").innerHTML = "";

                        $("#buscarProductosD").val("");

                        divVentaActiva();

                        divBusquedaDesactiva();

                    }

                }
            });

}


}
                        });//AJAX

        //document.getElementById("buscar3").onkeyup();


}




});








$(document).on("change", "input[name=nuevoIdFormaPago]", function(){

    divBusquedaDesactiva();
    divVentaActiva();


});













function buscarAhoraCliente(buscarCliente) {

    var busqueda_anterior = $("#rfcCliente").attr("busqueda_anterior");



    if(busqueda_anterior ==  buscarCliente){

    }else{
        var datos = new FormData();
        datos.append("validarRfc", buscarCliente);
        $.ajax({
            url: "ajax/clientes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success: function(respuesta){



                if(respuesta == false){

                    $("#nuevoIdCliente").val(1);
                    $("#nombreCliente").val("VENTA PUBLICO EN GENERAL");
                    $("#nuevoIdCliente").attr("no_precio",1);
                    $("#nuevoIdCliente").attr("comision",0);
                    document.getElementById("textoPrecio").innerHTML = "Precio: Público";
                    $("#buscarProductosD").val("");
                    document.getElementById("incrustarTablaProductos").innerHTML = "";
                    $("#rfcCliente").attr("busqueda_anterior", "XAXX010101000");

                    myArr = [];
                    listaProductos = [];


                    $("#listaProductos").val("");


                    removeAllChilds('a');
                    $("#totalVenta").val("");
                    $("#nuevoTotalVenta").val("");
                    $("#nuevoTotalVenta").text(0);

                }else{

                    $("#nuevoIdCliente").val(respuesta["id_cliente"]);
                    $("#nombreCliente").val(respuesta["nombre"]);
                    $("#nuevoIdCliente").attr("no_precio",respuesta["no_precio"]);

                    if(respuesta["no_precio"] == 1){
                        var texto_precio = "Público";
                    }else if(respuesta["no_precio"] == 2){
                        var texto_precio = "Mayoreo";
                    }else if(respuesta["no_precio"] == 3){
                        var texto_precio = "Especial";
                    }else{
                        var texto_precio = "Público";
                    }
                    

                    document.getElementById("textoPrecio").innerHTML = "Precio: "+texto_precio;

                    $("#rfcCliente").attr("busqueda_anterior", buscarCliente);

                    $("#buscarProductosD").attr("busqueda_anterior", "");
                    document.getElementById("incrustarTablaProductos").innerHTML = "";



                    myArr = [];
                    listaProductos = [];


                    $("#listaProductos").val("");


                    removeAllChilds('a');

                    $("#buscarProductosD").val("");
                    $("#buscarProductosD").focus();
                    $("#buscarProductosD").attr("busqueda_anterior", "");
                    document.getElementById("incrustarTablaProductos").innerHTML = "";

                    $("#totalVenta").val("");
                    $("#nuevoTotalVenta").val("");
                    $("#nuevoTotalVenta").text(0);

                }

            }

        });
        
    }  
}












        /*$(document).on("change", "#rfcCliente", function(){

                var rfc = $(this).val();

  var datos = new FormData();
  datos.append("validarRfc", rfc);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){


        $("#nuevoIdCliente").val(respuesta["id_cliente"]);
        $("#nombreCliente").val(respuesta["nombre"]);
        
        myArr = [];
                listaProductos = [];


                $("#listaProductos").val("");


                removeAllChilds('a');

                $("#buscarProductosD").val("");
            $("#buscarProductosD").focus();
            $("#buscarProductosD").attr("busqueda_anterior", "");
            document.getElementById("incrustarTablaProductos").innerHTML = "";

                $("#totalVenta").val("");
                $("#nuevoTotalVenta").val("");

      }

  });

                



        });*/



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
        $("#nuevoTotalVenta").text(0);
        $("#nuevoTotalVenta").number(true, 0);
        $("#totalVenta").val(0);
        $("#nuevoTotalVenta").attr("total", 0);







    }else{
                    // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();


    }



});









function numerosSinDecimales()
{
    var tecla = event.key;
    if (['.','e'].includes(tecla))
     event.preventDefault()
}


        /*=============================================
        MODIFICAR LA CANTIDAD
        =============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

    cantidad = $(this).val();

    var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var precio = precio1.attr("precioReal");

    precioFinal = precio * cantidad;

    precioFinal = Number(precioFinal, 2);

    precio1.val(precioFinal);







    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if(Number($(this).val()) > Number($(this).attr("stock"))){



        $(this).val(1);

        $(this).attr("nuevoStock", $(this).attr("stock"));

        cantidad = $(this).val();

        precioFinal = precio * cantidad;

        precio1.val(precioFinal);

                // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();




        Swal.fire({
            icon: 'error',
            title: 'existencias insuficientes',
            showConfirmButton: false,
            timer: 2000
        });

        return;

    }else if(Number($(this).val()) <= 0){



        $(this).val(1);

        $(this).attr("nuevoStock", $(this).attr("stock"));

        cantidad = $(this).val();

        precioFinal = precio * cantidad;

        precio1.val(precioFinal);

                // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();




        Swal.fire({
            icon: 'error',
            title: 'No se puede ingresar 0 o números negativos',
            showConfirmButton: false,
            timer: 2000
        });

        return;

    }else{
            // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();
    }



});









$(document).on("keyup", ".nuevaCantidadProducto", function(){

    cantidad = $(this).val();

    var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    var precio = precio1.attr("precioReal");

    precioFinal = precio * cantidad;

    precioFinal = Number(precioFinal, 2);

    precio1.val(precioFinal);








    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if(Number($(this).val()) > Number($(this).attr("stock"))){



        $(this).val(1);

        $(this).attr("nuevoStock", $(this).attr("stock"));

        cantidad = $(this).val();

        precioFinal = precio * cantidad;

        precio1.val(precioFinal);

                // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();




        Swal.fire({
            icon: 'error',
            title: 'existencias insuficientes',
            showConfirmButton: false,
            timer: 2000
        });

        return;

    }else if(Number($(this).val()) <= 0){



        $(this).val(1);

        $(this).attr("nuevoStock", $(this).attr("stock"));

        cantidad = $(this).val();

        precioFinal = precio * cantidad;

        precio1.val(precioFinal);

                // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();




        Swal.fire({
            icon: 'error',
            title: 'No se puede ingresar 0 o números negativos',
            showConfirmButton: false,
            timer: 2000
        });

        return;

    }else{
            // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

                // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();
    }



});







$(document).on("click", ".nuevaCantidadProducto", function(){
    $(this).select();
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

$("#nuevoTotalVenta").text(sumaTotalPrecio);
$("#nuevoTotalVenta").number(true, 2);
$("#totalVenta").val(sumaTotalPrecio);
$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}








        /*=============================================
        LISTAR TODOS LOS PRODUCTOS
        =============================================*/

function listarProductos(){

    var listaProductos = [];

    var descripcion = $(".nuevaDescripcionProducto");

    var cantidad = $(".nuevaCantidadProducto");

    var precio = $(".nuevoPrecioProducto");

    for(var i = 0; i < descripcion.length; i++){

        var precioFormateado = Number($(precio[i]).val(), 2);

        listaProductos.push({ 
            "id" : $(descripcion[i]).attr("id_producto"), 
            "descripcion" : $(descripcion[i]).attr("descripcion"),
            "cantidad" : $(cantidad[i]).val(),
            "precio" : $(precio[i]).attr("precioReal"),
            "total" : precioFormateado
        })

    }
    console.log("listaProductos", listaProductos);

    $("#listaProductos").val(JSON.stringify(listaProductos)); 

}







        /*=============================================
        CUANDO CAMBIE SI VA A SER PAGO CON TARJETA
        =============================================*/

        /*$("#pago_tarjeta").on('change', function() {
  if ($(this).is(':checked')) {
    $(this).attr('value', 'true');

  } else {
    $(this).attr('value', 'false');
  }
  
});*/





        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
$(document).on("click", ".btnGenerarVenta", function(){



 Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres generar la venta?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

        var id_cliente = $("#nuevoIdCliente").val();


        if(id_cliente == 1){

            Swal.fire({
                    title: 'Inserta el nombre del cliente',
                    input: 'text',
                    inputAttributes: {
                        pattern: "[A-Za-z]"
                    },
                    inputValidator: (value) => {
                        //var contador = value.length ;
                        if (value == "") {
                            return 'No has escrito el  nombre del cliente'
                        }
                    },
                    showCancelButton: true,
                    confirmButtonText: 'confirmar',
                    showLoaderOnConfirm: true,
                    preConfirm: (nombre_cliente) => {
                        $("#nuevoNombreClienteTicket").val(nombre_cliente);
                        Swal.fire({
            title: 'Inserta tu código',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off',
                autocomplete: 'new-password'
            },
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            showLoaderOnConfirm: true,
            preConfirm: (codigo) => {

                var datoCodigo = new FormData();
                datoCodigo.append("mostrar_vendedor", codigo);
                datoCodigo.append("columna", "codigo");


                $.ajax({

                    url:"ajax/crear-venta.ajax.php",
                    method: "POST",
                    data: datoCodigo,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType:"json",
                    success:function(respuestaVendedor){

                        if(respuestaVendedor == false){
                            Swal.fire({
                                icon: 'error',
                                title: 'No existe el vendedor ingresado',
                                text: 'No se puede finalizar venta',
                                showConfirmButton: true
                            });
                        }else{
                            var estatus = parseInt(respuestaVendedor['estatus']);
                            if(estatus == 0){
                               Swal.fire({
                                icon: 'info',
                                title: 'El vendedor esta desactivado',
                                text: 'No se puede finalizar venta',
                                showConfirmButton: true
                            }); 
                           }else if(estatus == 1){
                            $("#nuevoIdVendedor").val(respuestaVendedor['id_vendedor']);
                            setTimeout(function() {
                                document.forms["formularioVenta"].submit();
                            }, 100);
                        }
                    }
                }
            });

            },
        });
                    },
                });

        }else{
            Swal.fire({
            title: 'Inserta tu código',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off',
                autocomplete: 'new-password'
            },
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            showLoaderOnConfirm: true,
            preConfirm: (codigo) => {

                var datoCodigo = new FormData();
                datoCodigo.append("mostrar_vendedor", codigo);
                datoCodigo.append("columna", "codigo");


                $.ajax({

                    url:"ajax/crear-venta.ajax.php",
                    method: "POST",
                    data: datoCodigo,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType:"json",
                    success:function(respuestaVendedor){

                        if(respuestaVendedor == false){
                            Swal.fire({
                                icon: 'error',
                                title: 'No existe el vendedor ingresado',
                                text: 'No se puede finalizar venta',
                                showConfirmButton: true
                            });
                        }else{
                            var estatus = parseInt(respuestaVendedor['estatus']);
                            if(estatus == 0){
                               Swal.fire({
                                icon: 'info',
                                title: 'El vendedor esta desactivado',
                                text: 'No se puede finalizar venta',
                                showConfirmButton: true
                            }); 
                           }else if(estatus == 1){
                            $("#nuevoIdVendedor").val(respuestaVendedor['id_vendedor']);
                            setTimeout(function() {
                                document.forms["formularioVenta"].submit();
                            }, 100);
                        }
                    }
                }
            });

            },
        });
        }

        


    }

});
});









        /*=============================================
        SOLICITAR LA MUESTRA DE UN PRODUCTO
        =============================================*/
$(document).on("click", ".btnSolicitarProducto", function(){

    var id_producto = $(this).attr("id_producto");

    var id_usuario = $("#nuevoIdVendedor").val();

    Swal.fire({
        title: 'Estas segur@?',
        text: "Quieres solicitar la muestra de un producto?",
        footer: "Recuerda que tu serás el responsable del producto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function(result){

        if(result.value){

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
                    if(respuesta["stock"] > 0){

                        descripcion_corta = respuesta["descripcion_corta"];
                        ubicacion = respuesta["ubicacion"];

                        var datos = new FormData();
                        datos.append("id_producto_muestra", id_producto);

                        $.ajax({
                            url: "ajax/ventas.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(respuestaSolicitud){

                                var no_muestra = respuestaSolicitud;



                                var datosTraerUsuario = new FormData();
                                datosTraerUsuario.append("id_usuario", id_usuario);


                                                                        //TREAEMOS AL VENDEDOR
                                $.ajax({
                                    url: "ajax/usuarios.ajax.php",
                                    method: "POST",
                                    data: datosTraerUsuario,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    dataType:"json",
                                    success: function(traerUsuario){

                                        var nombre_usuario = traerUsuario['nombre'];

                                        var impresora_almacen = traerUsuario['imp_almacen'];



                                        if(no_muestra != "error"){


                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Espera un momento...',
                                                text: 'El producto solicitado esta en camino',
                                                showConfirmButton: false,
                                                timer: 2500
                                            });



                                            const URLPlugin = 'http://localhost:8000'

                                            const init = async () => {

                                                imprimirHolaMundo(impresora_almacen);

                                            }


                                            const imprimirHolaMundo = async (nombreImpresora) => {
                                                const conector = new ConectorPluginV3(URLPlugin, licencia);
                                                conector.Iniciar();


                                                var fecha = new Date();
                                                var fecha_formateada = fecha.toLocaleString();


                                                conector.EstablecerAlineacion(0);
                                                conector.EstablecerTamañoFuente(1, 1);
                                                conector.EscribirTexto("MUESTRA DE MERCANCIA muestra de mercancia MUESTRA DE MERCANCIA muestra de mercancia MUESTRA DE MERCANCIA muestra de mercancia");
                                                conector.Feed(2);
                                                conector.EscribirTexto("Fecha y hora: ");
                                                conector.EscribirTexto(fecha_formateada);
                                                conector.Feed(2);
                                                conector.EscribirTexto("Atendido por: "+nombre_usuario);
                                                conector.Feed(1);
                                                conector.EscribirTexto("No. Muestra: "+no_muestra);
                                                conector.Feed(1);
                                                conector.EscribirTexto('===============================================');
                                                conector.Feed(1);
                                                conector.TextoSegunPaginaDeCodigos(2, 'cp850', 'Ubicación: '+ubicacion);
                                                conector.Feed(1);
                                                conector.TextoSegunPaginaDeCodigos(2, 'cp850', 'Descripción: '+descripcion_corta);
                                                conector.Feed(4);
                                                conector.EscribirTexto("______________________   _______________________");
                                                conector.Feed(1);
                                                conector.EscribirTexto("  Firma del Vendedor         Nombre Surtidor");
                                                conector.Feed(4);
                                                conector.EscribirTexto("______________________   _______________________");
                                                conector.Feed(1);
                                                conector.EscribirTexto("      Se acomodo                No. Venta");
                                                conector.Feed(1);
                                                conector.EscribirTexto("    (REGRESO PZA)             (VENDIO PZA)");
                                                conector.Feed(6);
                                                conector.CorteParcial();
                                                const respuesta = await conector
                                                .imprimirEn(nombreImpresora);
                                            }
                                            init();
                                        }else{

                                            Swal.fire({
                                                icon: 'error',
                                                title: 'No es posible adquirir el producto solicitado',
                                                showConfirmButton: false,
                                                timer: 2500
                                            });
                                        }
                                    }

                                });        
}

});

}else{

    Swal.fire({
        icon: 'error',
        title: 'El producto no tiene exitencias',
        text: 'No se puede traer la muestra',
        showConfirmButton: false,
        timer: 2000
    });

}
}
                                });//AJAX
}

});
});



        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
$(document).on("click", ".btnImprimirNota", function(){

    var id_venta = $(this).attr("id_venta");

    window.open("extensiones/tcpdf/examples/factura.php?id_venta="+id_venta, "_blank");

})


$("#buscarProductosD").focus(function(){

    divBusquedaActiva();
    divVentaDesactiva();


});



$(document).on("focus", ".nuevaCantidadProducto", function(){

    divVentaActiva();
    divBusquedaDesactiva();
    
});





$(document).on("focus", "#rfcCliente", function(){

    divVentaActiva();
    divBusquedaDesactiva();
    
});



document.querySelectorAll('input[type="search"]').forEach((input) => {
    input.addEventListener('focusin', (event) => {
      event.target.style.background = '#FFC107';
      event.target.style.color = '#000000';   
  });
});

document.querySelectorAll('input[type="search"]').forEach((input) => {
    input.addEventListener('focusout', (event) => {
      event.target.style.background = '';
      event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('input[type="text"]').forEach((input) => {
    input.addEventListener('focusin', (event) => {
      event.target.style.background = '#F2620F';
      event.target.style.color = '#000000';   
  });
});

document.querySelectorAll('input[type="text"]').forEach((input) => {
    input.addEventListener('focusout', (event) => {
      event.target.style.background = '';
      event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('input[type="number"]').forEach((input) => {
    input.addEventListener('focusin', (event) => {
      event.target.style.background = '#F2620F';
      event.target.style.color = '#000000';   
  });
});

document.querySelectorAll('input[type="number"]').forEach((input) => {
    input.addEventListener('focusout', (event) => {
      event.target.style.background = '';
      event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('input[type="password"]').forEach((input) => {
    input.addEventListener('focusin', (event) => {
      event.target.style.background = '#F2620F';
      event.target.style.color = '#000000';   
  });
});

document.querySelectorAll('input[type="password"]').forEach((input) => {
    input.addEventListener('focusout', (event) => {
      event.target.style.background = '';
      event.target.style.color = '#000000';     
  });
});

document.querySelectorAll('select').forEach((input) => {
    input.addEventListener('focusin', (event) => {
      event.target.style.background = '#F2620F';
      event.target.style.color = '#000000';    
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
      event.target.style.background = '#F2620F'; 
      event.target.style.color = '#000000';    
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
      event.target.style.background = '#F2620F'; 
      event.target.style.color = '#000000';    
  });
});

document.querySelectorAll('textarea').forEach((input) => {
    input.addEventListener('focusout', (event) => {
      event.target.style.background = '';
      event.target.style.color = '#000000';     
  });
});
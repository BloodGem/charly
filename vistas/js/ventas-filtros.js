$('#nuevoIdCliente').one('select2:open', function(e) {
    $('input.select2-search__field').attr("style", "font-weight: bold; color: red;");
    $('input.select2-search__field').prop('placeholder', 'Busque el cliente aquí...');
    
    document.querySelector('.select2-search__field').focus();

});





function soloMayusculas(objeto) {
    objeto.value = objeto.value.toUpperCase();
}

function activaTabla3Producto() {

    $("#tabla3Producto").DataTable({
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
  order: [[0, 'asc']],
});
}










function activaAutosProducto() {

    $("#tablaAutosProducto").DataTable({
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
  order: [[0, 'asc']],
});
}










function divClienteActiva(){

    const verifica_div_cliente = document.getElementsByClassName("divCliente");

    var div_cliente = verifica_div_cliente[0];

    $(div_cliente).attr("style","background-color: #8AA3EF;");

}


function divClienteDesactiva(){

    const verifica_div_cliente = document.getElementsByClassName("divCliente");

    var div_cliente = verifica_div_cliente[0];

    $(div_cliente).removeAttr("style");

}









function divBusquedaActiva(){

    const verifica_div_busqueda = document.getElementsByClassName("divBusqueda");

    var div_busqueda = verifica_div_busqueda[0];

    var comodin = $("#comodin").val();

        if(comodin == 0){
            $(div_busqueda).attr("style","background-color: #F2D5BB;");
        }else{
            $(div_busqueda).attr("style", "background-color: #BBBFF2;");
        }

    

}


function divBusquedaDesactiva(){

    const verifica_div_busqueda = document.getElementsByClassName("divBusqueda");

    var div_busqueda = verifica_div_busqueda[0];

    $(div_busqueda).removeAttr("style");

}





function divPartidasActiva(){

    const verifica_div_partidas = document.getElementsByClassName("divPartidas");

    var div_partidas = verifica_div_partidas[0];

    $(div_partidas).attr("style","background-color: #8AA3EF;");

}


function divPartidasDesactiva(){

    const verifica_div_partidas = document.getElementsByClassName("divPartidas");

    var div_partidas = verifica_div_partidas[0];

    $(div_partidas).removeAttr("style");

}









$(document).on("click", "#nuevoNoFormaPago", function(){

    divClienteDesactiva();
    divBusquedaDesactiva();
    divPartidasDesactiva();
    

});




















function buscar_ahora3(buscar3) {

    //var no_precio = $("#nuevoIdCliente2").attr("no_precio");

    var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

     var comodin = $("#comodin").val();

    if(buscar3 == ""){
        document.getElementById("incrustarTablaProductos").innerHTML = "";
    }else{

        var parametros = {"buscar3":buscar3, "no_precio":no_precio, "comodin":comodin};
        $.ajax({
            data:parametros,
            type: 'POST',
            url: 'vistas/modulos/buscadores/buscadorProductosVentasFiltros.php',
            success: function(data) {
                document.getElementById("incrustarTablaProductos").innerHTML = data;
            }
        });
    }
}











$(document).on("change", "#buscar3", function(){

    var buscar3 = $(this).val();

    buscar_ahora3(buscar3);

});




function numerosSinDecimales()
{
    var tecla = event.key;
    if (['.','e'].includes(tecla))
     event.preventDefault()
}






//AL PRESIONAR f4
$(document).keydown(function(event) {
    if (event.which === 114)
    {

        event.preventDefault();


        

        $("#nuevoIdCliente").val(1).change();
    }
});






//AL PRESIONAR SUPRIMIR
$(document).keydown(function(event) {
    if (event.which === 46)
    {
        event.preventDefault();

        const verifica_producto_foco = document.getElementsByClassName("producto_foco");

        var foco = verifica_producto_foco[0];

        $(foco).children('.tdBtnQuitarProducto').children('.quitarProducto').trigger('click');
    }
});




//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();

        divClienteDesactiva();
        divBusquedaActiva();
        divPartidasDesactiva();
        


        var buscador_esc = $("#buscar3").attr("teclaEsc");
        if(buscador_esc == "si"){
            $("#buscar3").val("").trigger("change");
            $("#buscar3").focus();
        }else{
            $(".close").trigger('click');

            $("#buscar3").attr("teclaEsc", "si");

            const verifica_foco = document.getElementsByClassName("foco");

            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            $(foco).focus();

        }

    }
});





$(document).keydown(function(event) {
    //ACTIVAR DESACTIVAR COMODIN
    if (event.which === 112)
    {
        event.preventDefault();

        var comodin = $("#comodin").val();

        if(comodin == 0){
            $("#comodin").val(1);
            $(".divBusqueda").attr("style", "background-color: #BBBFF2;");
            $(".pDivBusqueda").text("Solo clave");
            $("#incrustarTablaProductos").attr("style", "font-weight:bold;");
        }else{
            $("#comodin").val(0);
            $(".divBusqueda").attr("style", "background-color: #F2D5BB;");
            $(".pDivBusqueda").text("Dínamica");
            $("#incrustarTablaProductos").attr("style", "font-weight: normal;");
        }

        var buscar3 = $("#buscar3").val();

        buscar_ahora3(buscar3);

    }
});











//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscar3").attr("teclaEsc", "si");     

    }
});













$(document).keydown(function(event) {
    //CREAR VENTA F8
    if (event.which === 119)
    {
        event.preventDefault();

        $("#btnGenerarVenta").trigger('click');

    }
});






$(document).keydown(function(event) {
    if (event.which === 115)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

            var contador_actual = $(foco).attr("contador");

            $(foco).parent().children(".verDetallesProducto").trigger("click"); 

            //$(".close").hide();

            $("#buscar3").attr("teclaEsc", "no");

        }

        

    }
});





$(document).keydown(function(event) {
    if (event.which === 116)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

            var contador_actual = $(foco).attr("contador");

            $(foco).parent().children(".btnSolicitarProducto").trigger("click"); 

        //$(".close").hide();

        //$("#buscar3").attr("teclaEsc", "no");

        }

        

    }
});














$(document).keydown(function(event) {
    //ABRIR IMAGENES F2
    if (event.which === 113)
    {

        $("#buscar3").attr("teclaEsc","no");

        const verifica_foco = document.getElementsByClassName("foco");
        setTimeout(function() { 
            var foco = verifica_foco[0];




            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);


            //alert("contador mas: "+contador_mas);
            
            
            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).children(".imagenes").children(".imagen1").trigger('click');
            $(foco).attr("cont","1");
            $(".close").hide();
        }, 100);

    }
});








//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {

        var contador_final = $("#contadorFinal").val()
        var buscador_esc = $("#buscar3").attr("teclaEsc");
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
                $(items[0]).parent().parent().parent().attr("style","font-weight: bold; background-color: #012340; color: white;");

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

                    $(foco).parent().parent().parent().removeAttr("style");

                    $(foco_menos).parent().parent().parent().removeAttr("style");

                    $(foco_mas).parent().parent().parent().attr("style","font-weight: bold; background-color: #012340; color: white;");

                    $(foco_mas).addClass('foco');
                    $(foco_mas).focus();
            //$(foco).focus();

                }, 100);
            }

        //alert('Ctrl + flecha abajo!');
        }else{
            const verifica_foco = document.getElementsByClassName("foco");
            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            $(".close").trigger('click');
            
            if(contador_actual >= contador_final){

                $(foco).addClass('foco').focus();

                $("#buscar3").attr("teclaEsc","si");
                
            }else{



                setTimeout(function() { 


                    var contador_mas = contador_actual + 1;

                    var contador_menos = contador_actual - 1;

                    const verifica_foco_mas = document.getElementsByClassName("guardaFoco"+contador_mas);

                    var foco_mas = verifica_foco_mas[0];

                    const verifica_foco_menos = document.getElementsByClassName("guardaFoco"+contador_menos);

                    var foco_menos = verifica_foco_menos[0];

            //alert("contador mas: "+contador_mas);

                    $(foco).removeClass("foco");

                    $(foco).parent().parent().parent().removeAttr("style");

                    $(foco_menos).parent().parent().parent().removeAttr("style");

                    $(foco_mas).attr("cont", "1");

                    $(foco_mas).parent().parent().parent().attr("style","font-weight: bold; background-color: #012340; color: white;");

                    $(foco_mas).addClass('foco');
                    $(foco_mas).focus();

                    $("#buscar3").attr("teclaEsc","no");
                    $(foco_mas).parent().parent().parent().children(".imagenes").children(".imagen1").trigger('click');

                    $(".close").hide();



                }, 150);

            }
        }

    }
});









//AL PRESIONAR CTRL + FLECHA ARRIBA
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 38)
    {
        var buscador_esc = $("#buscar3").attr("teclaEsc");
        var contador_inicial = 1;
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
                $(items[0]).parent().parent().parent().attr("style","font-weight: bold; background-color: #012340; color: white;");

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

                    $(foco).parent().parent().parent().removeAttr("style");

                    $(foco_mas).parent().parent().parent().removeAttr("style");

                    $(foco_menos).parent().parent().parent().attr("style","font-weight: bold; background-color: #012340; color: white;");

                    $(foco_menos).addClass('foco');
                    $(foco_menos).focus();
            //$(foco).focus();

                }, 100);
            }

        //alert('Ctrl + flecha abajo!');
        }else{
            const verifica_foco = document.getElementsByClassName("foco");
            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            $(".close").trigger('click');
            

            if(contador_actual <= contador_inicial){

                $(foco).addClass('foco').focus();

                $("#buscar3").attr("teclaEsc","si");
                
            }else{



                setTimeout(function() { 


                    var contador_mas = contador_actual + 1;

                    var contador_menos = contador_actual - 1;

                    const verifica_foco_mas = document.getElementsByClassName("guardaFoco"+contador_mas);

                    var foco_mas = verifica_foco_mas[0];

                    const verifica_foco_menos = document.getElementsByClassName("guardaFoco"+contador_menos);

                    var foco_menos = verifica_foco_menos[0];

            //alert("contador mas: "+contador_mas);

                    $(foco).removeClass("foco");

                    $(foco).parent().parent().parent().removeAttr("style");

                    $(foco_mas).parent().parent().parent().removeAttr("style");

                    $(foco_menos).attr("cont", "1");

                    $(foco_menos).parent().parent().parent().attr("style","font-weight: bold; background-color: #012340; color: white;");

                    $(foco_menos).addClass('foco');
                    $(foco_menos).focus();

                    $("#buscar3").attr("teclaEsc","no");
                    $(foco_menos).parent().parent().parent().children(".imagenes").children(".imagen1").trigger('click');

                    $(".close").hide();



                }, 150);

            }
        }
    }
});










$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 37)
    {
       var buscador_esc = $("#buscar3").attr("teclaEsc");
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

            if(cont_img == 0){


                $(foco).removeClass("foco");

                $(foco).parent().parent().parent().removeAttr("style");

                $(foco_mas).parent().parent().parent().removeAttr("style");

                $(foco_menos).attr("cont", "1");

                $(foco_menos).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                $(foco_menos).addClass('foco');

                $(foco_menos).focus();

            }
        }, 100); 

     }
 }

});










$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 39)
    {
       var buscador_esc = $("#buscar3").attr("teclaEsc");
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

            if(cont_img == 4){


                $(foco).removeClass("foco");

                $(foco).parent().parent().parent().removeAttr("style");

                $(foco_menos).parent().parent().parent().removeAttr("style");

                $(foco_mas).attr("cont", "1");

                $(foco_mas).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                $(foco_mas).addClass('foco');

                $(foco_mas).focus();

            }
        }, 100); 

     }
 }

});










$(document).on("change", "#seleccionarTipoVenta", function(){

    var id_cliente = $("#nuevoIdCliente2").val();

    if(id_cliente == 1){
        $("#seleccionarTipoVenta option:eq(0)").removeAttr("selected");
        $("#seleccionarTipoVenta option:eq(0)").attr("selected","selected");
    }
});








var contador = 0;








        /*=============================================
        VER AUTOS
        =============================================*/
$(".listaProductosVentas tbody").on("click", "button.verDetallesProducto", function(){

    divClienteDesactiva();
    divBusquedaActiva();
    divPartidasDesactiva();
    

    //$(".close").hide();

    $("#buscar3").attr("teclaEsc", "no");

    document.getElementById("incrustarDetallesProducto").innerHTML = "";

    var id_producto =  {"id_producto": $(this).attr("id_producto")};

    $.ajax({
        data:id_producto,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaDetallesProducto.php',
        success: function(data) {
            $("#modalVerDetallesProducto").modal("show");
            document.getElementById("incrustarDetallesProducto").innerHTML = data;
            activaAutosProducto();
        }
    });

});




/*(document).on("click", "#inputInserteCantidad", function(){   
        $("#inputInserteCantidad").select();
        event.preventDefault();
    });*/



                /*=============================================
        AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
        =============================================*/
var myArr = [];
$(".listaProductosVentas tbody").on("click", "button.agregarProducto", function(){

    var btnAgregarProducto = $(this);
    $(this).blur();

    divClienteDesactiva();
    divBusquedaActiva();
    divPartidasDesactiva();
    

    var id_producto = $(this).attr("id_producto");


    if(myArr.includes(id_producto) == true){

        $(this).removeClass("btn-primary agregarProducto");

        $(this).addClass("btn-default");

        Swal.fire({
            icon: 'info',
            title: 'Este producto ya fue agregado',
            showConfirmButton: true
        }).then(function(result){

            //$("#nuevaCantidadProducto"+id_producto).focus();

            $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").focus();

        });


    }else{



     $(this).removeClass("btn-primary agregarProducto");

     $(this).addClass("btn-default");





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

            var es_compuesto = parseInt(respuesta["es_compuesto"]);

            if(es_compuesto == 0){

                var stock = parseInt(respuesta["stock"]);

                var multiplo = parseInt(respuesta["multiplo"]);


                if(stock > 0){

                    setTimeout(function() { 

                        $("#inputInserteCantidad").select();

                    }, 200); 

                    Swal.fire({
                        title: 'Inserte cantidad',
                        input: 'number',
                        inputValue: '1',
                        inputAttributes: {
                            id: "inputInserteCantidad",
                            min: 1,
                            max: stock,
                            step: 1,
                            pattern: "[0-9]{10}"
                        },
                        inputValidator: (value) => {





                            if (value > stock) {
                                return 'La cantidad ingresada '+value+' supera a la cantidad en inventario '+stock
                            }
                            if (value < 0) {
                                return 'No puede ingresar cantidad negativa'
                            }
                            if (value == 0) {
                                return 'No ha especificado la catidad a vender'
                            }

                            var operacion = value % multiplo;

                            if(operacion !== 0){
                              var faltante = multiplo - operacion;
                              var nueva_cantidad = parseInt(value) + parseInt(faltante);
                              $("#inputInserteCantidad").val(nueva_cantidad);

                              return '<br>Solo se puede vender por múltiplo de '+multiplo+' estas ingresando '+value+',  te hacen falta '+faltante+' para poder vender este producto';
                          }

                      },
                      showCancelButton: false,
                      allowOutsideClick: false,
                      confirmButtonText: 'confirmar',
                      showLoaderOnConfirm: true,
                      preConfirm: (cantidad) => {


                        myArr.push(id_producto);

                        var descripcion_corta = respuesta["descripcion_corta"];



                    //var no_precio = $("#nuevoIdCliente2").attr("no_precio");

                        var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                        var descuento = $("#nuevoDescuentoVenta").val();


                        var clave_producto = respuesta["clave_producto"];

                        if(no_precio == 1){

                            var precioOriginal = Number(respuesta["precio1"]);

                            var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio1"]) * Number(.03))+Number(respuesta["precio1"]);



                            var precio1Comision = Number(precioOriginalComision) - (Number(precioOriginalComision) * (Number(descuento) / Number(100)));


                            precio1Comision = precio1Comision.toFixed(2);


                        }else if(no_precio == 2){
                            var precioOriginal = Number(respuesta["precio2"]);

                            var precio1 = Number(respuesta["precio2"]) -(Number(respuesta["precio2"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio2"]) * Number(.03))+Number(respuesta["precio2"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }else if(no_precio == 3){

                            var precioOriginal = Number(respuesta["precio3"]);

                            var precio1 = Number(respuesta["precio3"]) -(Number(respuesta["precio3"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio3"]) * Number(.03))+Number(respuesta["precio3"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }else{

                            var precioOriginal = Number(respuesta["precio1"]);

                            var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio1"]) * Number(.03))+Number(respuesta["precio1"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }


                        var total = cantidad * precio1;
                        total = Number(total, 2);

                        contador = contador + 1;




                        $(".nuevoProducto").append('<tr id="tr'+id_producto+'">'+
                          '<td class="tdBtnQuitarProducto">'+
                          '<button type="button" class="btn btn-xs btn-danger quitarProducto" style="height:21px; width:21px;" id_producto="'+id_producto+'" tabindex="-1"><i class="fa fa-times"></i></button>'+
                          '</td>'+
                          '<td style="text-size: 5px;">'+clave_producto+'</td>'+
                          '<td style="text-size: 5px;">'+descripcion_corta+'</td>'+
                          '<td class="ingresoCantidad">'+
                          '<input type="number" style="height:21px; width:65px; font-size:18px;" class="form-control-sm nuevaCantidadProducto" id="nuevaCantidadProducto'+contador+'" name="nuevaCantidadProducto'+contador+'" id_producto="'+id_producto+'" multiplo="'+multiplo+'" onkeydown="numerosSinDecimales()" min="1" value="'+cantidad+'" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                          '</td>'+
                          '<td class="ingresoDescuento">'+
                          '<input type="number" class="form-control-sm nuevoDescuentoProducto" style="height:21px; width:65px; font-size:18px;" name="nuevoDescuentoProducto" value="'+descuento+'" descuento="'+descuento+'" min="0" max="100" tabindex="-1" readonly>'+
                          '</td>'+
                          '<td class="ingresoPrecioUnitario">'+
                          '$<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control-sm nuevoPrecioUnitario" value="'+precio1+'" tabindex="-1" readonly>'+
                          '</td>'+
                          '<td class="ingresoPrecio">'+
                          '$<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control-sm nuevoPrecioProducto" precioOriginal="'+precioOriginal+'" precioReal="'+precio1+'" value="'+total+'" tabindex="-1" readonly>'+
                          '</td>'+
                          '</tr>'+
                          '<hr>');



                    //$("#nuevaCantidadProducto"+contador).focus();
                        const verifica_producto_foco = document.getElementsByClassName("producto_foco");

                        var foco = verifica_producto_foco[0];

                        $(foco).removeClass("producto_foco");
                        $(foco).removeAttr("style");

                        $("#nuevaCantidadProducto"+contador).parent().parent().addClass('producto_foco');
                        $("#nuevaCantidadProducto"+contador).parent().parent().addClass('producto_foco').attr("style","font-weight: bold; background-color: #F2620F; color: #FFFFFF;");

                                                // SUMAR TOTAL DE PRECIOS

                        sumarTotalPrecios();


                                                // AGRUPAR PRODUCTOS EN FORMATO JSON

                        listarProductos();



                                                // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                        $(".nuevoPrecioProducto").number(true, 2);

                                                /*$("#buscar3").val("");

                                                $("#buscar3").onkeyup(buscar_ahora3($('#buscar3').val()));*/





                    }

                });

}else{
    Swal.fire({
        icon: 'error',
        title: 'El producto no tiene existencias por lo tanto no se agregará',
        showConfirmButton: false,
        timer: 2000
    });

                                                //$("#buscar3").val("");

                                                //$("#buscar3").onkeyup(buscar_ahora3($('#buscar3').val()));

    $("#buscar3").focus();
}

}//Si NO es compuesto
else{

 productoCompuesto(respuesta['productos_compuesto']); 

}//Si SI es compuesto

}
                        });//AJAX

        //document.getElementById("buscar3").onkeyup();


}




});





function productoCompuesto(productos_compuesto){

    var obj = jQuery.parseJSON(productos_compuesto);



    $.each(obj, function(key,value) {
        var id_producto = value.id_producto;
        var cantidad = value.cantidad;

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

                var stock = parseInt(respuesta["stock"]);

                var multiplo = parseInt(respuesta["multiplo"]);

                var descripcion_corta = respuesta["descripcion_corta"];

                var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                var descuento = $("#nuevoDescuentoVenta").val();

                var clave_producto = respuesta["clave_producto"];

                if(myArr.includes(id_producto) == true){

                    var cantidad_actual = $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").val();

                    var cantidad_total = parseInt(cantidad) + parseInt(cantidad_actual);

                    if(stock > 0 && stock >= cantidad_total){

                        $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").attr("stock", stock);
                        $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").val(cantidad_total);
                        $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").trigger("change");

                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: 'Clave: '+clave_producto,
                            body: 'El producto '+descripcion_corta+' <br> tenia una cantidad de: '+cantidad_actual+' <br> y se le agrego la cantidad de: '+cantidad+' <br> ahora el producto tíene la cantidad de: '+cantidad_total
                        });

                    }else{
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Clave: '+clave_producto,
                            body: 'Al producto '+descripcion_corta+' <br> no se le ha podido aumentar la cantidad de: '+cantidad+' <br> debido a que en stock solo hay la cantida de: '+stock+' <br> y acualmente el producto tiene la cantidad de: '+cantidad_actual
                        });
                        $("#buscar3").focus();
                    }


                }//Si el producto del paquete ya existe en la lista
                else{

                    if(stock > 0 && stock >= cantidad){

                        myArr.push(id_producto);

                        

                        if(no_precio == 1){

                            var precioOriginal = Number(respuesta["precio1"]);

                            var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio1"]) * Number(.03))+Number(respuesta["precio1"]);



                            var precio1Comision = Number(precioOriginalComision) - (Number(precioOriginalComision) * (Number(descuento) / Number(100)));


                            precio1Comision = precio1Comision.toFixed(2);


                        }else if(no_precio == 2){
                            var precioOriginal = Number(respuesta["precio2"]);

                            var precio1 = Number(respuesta["precio2"]) -(Number(respuesta["precio2"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio2"]) * Number(.03))+Number(respuesta["precio2"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }else if(no_precio == 3){

                            var precioOriginal = Number(respuesta["precio3"]);

                            var precio1 = Number(respuesta["precio3"]) -(Number(respuesta["precio3"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio3"]) * Number(.03))+Number(respuesta["precio3"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }else{

                            var precioOriginal = Number(respuesta["precio1"]);

                            var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio1"]) * Number(.03))+Number(respuesta["precio1"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }


                        var total = cantidad * precio1;
                        total = Number(total, 2);

                        contador = contador + 1;




                        $(".nuevoProducto").append('<tr id="tr'+id_producto+'">'+
                          '<td class="tdBtnQuitarProducto">'+
                          '<button type="button" class="btn btn-xs btn-danger quitarProducto" style="height:21px; width:21px;" id_producto="'+id_producto+'" tabindex="-1"><i class="fa fa-times"></i></button>'+
                          '</td>'+
                          '<td style="text-size: 5px;">'+clave_producto+'</td>'+
                          '<td style="text-size: 5px;">'+descripcion_corta+'</td>'+
                          '<td class="ingresoCantidad">'+
                          '<input type="number" style="height:21px; width:65px; font-size:18px;" class="form-control-sm nuevaCantidadProducto" id="nuevaCantidadProducto'+contador+'" name="nuevaCantidadProducto'+contador+'" id_producto="'+id_producto+'" multiplo="'+multiplo+'" onkeydown="numerosSinDecimales()" min="1" value="'+cantidad+'" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                          '</td>'+
                          '<td class="ingresoDescuento">'+
                          '<input type="number" class="form-control-sm nuevoDescuentoProducto" style="height:21px; width:65px; font-size:18px;" name="nuevoDescuentoProducto" value="'+descuento+'" descuento="'+descuento+'" min="0" max="100" tabindex="-1" readonly>'+
                          '</td>'+
                          '<td class="ingresoPrecioUnitario">'+
                          '$<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control-sm nuevoPrecioUnitario" value="'+precio1+'" tabindex="-1" readonly>'+
                          '</td>'+
                          '<td class="ingresoPrecio">'+
                          '$<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control-sm nuevoPrecioProducto" precioOriginal="'+precioOriginal+'" precioReal="'+precio1+'" value="'+total+'" tabindex="-1" readonly>'+
                          '</td>'+
                          '</tr>'+
                          '<hr>');



                    //$("#nuevaCantidadProducto"+contador).focus();
                        const verifica_producto_foco = document.getElementsByClassName("producto_foco");

                        var foco = verifica_producto_foco[0];

                        $(foco).removeClass("producto_foco");
                        $(foco).removeAttr("style");

                        $("#nuevaCantidadProducto"+contador).parent().parent().addClass('producto_foco');
                        $("#nuevaCantidadProducto"+contador).parent().parent().addClass('producto_foco').attr("style","font-weight: bold; background-color: #F2620F; color: #FFFFFF;");

                                                // SUMAR TOTAL DE PRECIOS

                        sumarTotalPrecios();


                                                // AGRUPAR PRODUCTOS EN FORMATO JSON

                        listarProductos();



                                                // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                        $(".nuevoPrecioProducto").number(true, 2);



                }//SI EL PRODUCTO TIENE EXISTENCIAS
                else{

                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'En stock: '+stock+', cantidad requerida por el paquete: '+cantidad,
                        body: 'El producto '+descripcion_corta+' con clave '+clave_producto+' No se ha podido agregar por existencias insuficientes'
                    });
                    /*Swal.fire({
                        icon: 'error',
                        title: 'El producto no tiene existencias por lo tanto no se agregará',
                        showConfirmButton: false,
                        timer: 2000
                    });*/

                                                //$("#buscar3").val("");

                                                //$("#buscar3").onkeyup(buscar_ahora3($('#buscar3').val()));

                    $("#buscar3").focus();
                }//Si el producto NO tiene existencias

            }//Si el producto no se encuentra en la lista exisente

        }//SUCCESS AJAX TRAER PRODUCTO

    });//AJAX TRAER PRODUCTO

});//FOR EACH DE LOS PRODUCTOS COMPUESTO


}


/*$("#nuevoIdCliente").on('change', function() {

    var descuento = $("#nuevoIdCliente>option:selected").attr("descuento");

    var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

    //alert(no_precio);

    $("#nuevoDescuentoVenta").val(descuento);

    var id_cliente = $("#nuevoIdCliente>option:selected").val();

    if(id_cliente == 1){
        $("#nuevoTipoVenta option:eq(0)").removeAttr("selected");
        $("#nuevoTipoVenta option:eq(0)").attr("selected","selected");
    }


    if(no_precio == 1){
                        var texto_precio = "Público";
                    }else if(no_precio == 2){
                        var texto_precio = "Mayoreo";
                    }else if(no_precio == 3){
                        var texto_precio = "Especial";
                    }else{
                        var texto_precio = "Público";
                    }

    $("#textoPrecio").val(texto_precio);

    $("#nuevoIdCliente2").val(id_cliente);

                //myArr = [];
                //listaProductos = [];


                //$("#listaProductos").val("");


                //removeAllChilds('a');



                //document.getElementById("buscar3").onkeyup();

                //$("#totalVenta").val("");
                //$("#nuevoTotalVenta").val("");



})*/










$(document).on("click", "#buscar3", function(){

    divClienteDesactiva();
    divBusquedaActiva();
    divPartidasDesactiva();
    

});






$("#nuevoIdCliente").on('change', function() {



    Swal.fire({
      title: 'Estas segur@?',
      text: "Quieres cambiar de cliente?",
      footer:"Si aceptas, las partidas desaparecerán",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si'
  }).then(function(result){

    if(result.value){

        //var descuento = $("#nuevoIdCliente>option:selected").attr("descuento");
        var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");
        $("#nuevoDescuentoVenta").val(0);

        var id_cliente = $("#nuevoIdCliente>option:selected").val();

        if(id_cliente == 1){
            $("#nuevoTipoVenta option:eq(0)").removeAttr("selected");
            $("#nuevoTipoVenta option:eq(0)").attr("selected","selected");
        }

        $("#nuevoIdCliente2").val(id_cliente);



        if(no_precio == 1){
            var texto_precio = "Público";
        }else if(no_precio == 2){
            var texto_precio = "Mayoreo";
        }else if(no_precio == 3){
            var texto_precio = "Especial";
        }else{
            var texto_precio = "Público";
        }


        $("#textoPrecio").val(texto_precio);

        myArr = [];
        listaProductos = [];


        $("#listaProductos").val("");


        removeAllChilds('a');



        $("#buscar3").val("").trigger("change");
        $("#buscar3").focus();

        $("#totalVenta").val("");
        $("#nuevoTotalVenta").val("");

        $("#textoTotal").text("0").number(true, 2);

    }

});





})


/*function buscarAhoraCliente(buscarCliente) {

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

                    $("#nuevoIdCliente2").val(1);
                    $("#nombreCliente").val("VENTA PUBLICO EN GENERAL");
                    $("#nuevoIdCliente2").attr("no_precio",1);
                    $("#nuevoIdCliente2").attr("descuento",0);
                    $("#textoPrecio").val("Público");
                    $("#rfcCliente").attr("busqueda_anterior", "XAXX010101000");

                }else{

                    $("#nuevoIdCliente2").val(respuesta["id_cliente"]);
                    $("#nombreCliente").val(respuesta["nombre"]);
                    $("#nuevoIdCliente2").attr("no_precio",respuesta["no_precio"]);
                    $("#nuevoIdCliente2").attr("descuento",respuesta["descuento"]);

                    if(respuesta["no_precio"] == 1){
                        var texto_precio = "Público";
                    }else if(respuesta["no_precio"] == 2){
                        var texto_precio = "Mayoreo";
                    }else if(respuesta["no_precio"] == 3){
                        var texto_precio = "Especial";
                    }else{
                        var texto_precio = "Público";
                    }

                    $("#textoPrecio").val(texto_precio);

                    $("#rfcCliente").attr("busqueda_anterior", buscarCliente);

                    divClienteDesactiva();
                    divBusquedaActiva();
                    divPartidasDesactiva();
                    

                    $("#buscar3").focus();


                }

            }

        });
        
    }  
}*/










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

    divClienteDesactiva();
    divBusquedaActiva();
    divPartidasDesactiva();
    

    var id_producto = $(this).attr("id_producto");

    var posicion = myArr.indexOf(id_producto);

    myArr.splice(posicion, 1);

    //console.log(myArr); 

    $(this).parent().parent().remove();




    $("button.recuperarBoton[id_producto='"+id_producto+"']").removeClass('btn-default');

    $("button.recuperarBoton[id_producto='"+id_producto+"']").addClass('btn-primary agregarProducto');


    if($(".nuevoProducto").children().length == 0){

        $("#listaProductos").val("");
        $("#nuevoTotalVenta").attr("total",0);
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoImpuestoVenta").val(0);



        $("#listaProductosComision").val("");
        $("#nuevoTotalVentaComision").attr("total",0);
        $("#nuevoTotalVentaComision").val(0);
        $("#totalVentaComision").val(0);
        $("#nuevoImpuestoVentaComision").val(0);

        $("#textoTotal").text("0").number(true, 2);




    }else{
                     // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();   


                        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();


    }



});









$(document).on("focus", ".nuevaCantidadProducto", function(){

    const verifica_producto_foco = document.getElementsByClassName("producto_foco");

    var foco = verifica_producto_foco[0];

    $(foco).removeClass("producto_foco");
    $(foco).removeAttr("style");

    $(this).parent().parent().addClass('producto_foco');
    $(this).parent().parent().addClass('producto_foco').attr("style","font-weight: bold; background-color: #F2620F; color: #FFFFFF;");

});

$(document).on("focus", ".nuevoDescuentoProducto", function(){

    const verifica_producto_foco = document.getElementsByClassName("producto_foco");

    var foco = verifica_producto_foco[0];

    $(foco).removeClass("producto_foco");
    $(foco).removeAttr("style");


    $(this).parent().parent().addClass('producto_foco');
    //AZUL QUE EL PIDIO ANTERIORMENTE
    $(this).parent().parent().addClass('producto_foco').attr("style","font-weight: bold; background-color: #F2620F; color: #FFFFFF;");

});


        /*=============================================
        MODIFICAR LA CANTIDAD
        =============================================*/

$(".formularioVenta").on("click", "input.nuevaCantidadProducto", function(){


    $(this).select();

    



    divClienteDesactiva();
    divBusquedaDesactiva();
    divPartidasActiva();
    
});

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

    divClienteDesactiva();
    divBusquedaDesactiva();
    divPartidasActiva();
    

    var precio1 = $(this).parent().parent().children(".ingresoPrecio").children(".nuevoPrecioProducto");

                /*var precioFinal = $(this).val() * precio1.val();

                        precio1.val(precioFinal);*/


    var descuento = $(this).parent().parent().children(".ingresoDescuento").children(".nuevoDescuentoProducto");

    descuento = descuento.val();

    var precioProductoDescuento = precio1.attr("precioOriginal") - (precio1.attr("precioOriginal") * (Number(descuento) / Number(100)));

    cantidad = $(this).val();

    if(cantidad <= 0){
        cantidad = 1;
        $(this).val(cantidad);
    }


    precioFinal = precioProductoDescuento * cantidad;

    precio1.val(precioFinal);

    precio1.attr("precioReal", precioProductoDescuento);





    /*var precio1Comision = $(this).parent().parent().children(".ingresoPrecioComision").children().children(".nuevoPrecioProductoComision");

    var precioProductoDescuentoComision = Number(precio1Comision.attr("precioOriginalComision")) - (Number(precio1Comision.attr("precioOriginalComision")) * (Number(descuento) / Number(100)));

    var precioFinalComision = precioProductoDescuentoComision * cantidad;

    precioFinalComision = precioFinalComision.toFixed(2);

    precio1Comision.val(precioFinalComision);

    precio1Comision.attr("precioRealComision", precioProductoDescuentoComision);*/




    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if(Number($(this).val()) > Number($(this).attr("stock"))){



        $(this).val(1);

        $(this).attr("nuevoStock", $(this).attr("stock"));

        var precioProductoDescuento = precio1.attr("precioOriginal") - (precio1.attr("precioOriginal") * (Number(descuento) / Number(100)));

        cantidad = $(this).val();

        precioFinal = precioProductoDescuento * cantidad;

        precioFinal = precioFinal.toFixed(2);

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

    }
        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                        // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();


});








        /*=============================================
        MODIFICAR EL DESCUENTO POR PRODUCTO
        =============================================*/

$(".formularioVenta").on("change", "input.nuevoDescuentoProducto", function(){

    divClienteDesactiva();
    divBusquedaDesactiva();
    divPartidasActiva();
    

    var precio1 = $(this).parent().parent().children(".ingresoPrecio").children(".nuevoPrecioProducto");
    var precio_unitario = $(this).parent().parent().children(".ingresoPrecioUnitario").children(".nuevoPrecioUnitario");
    var cantidad = $(this).parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    var descuento = $(this).val();
    var descuento_cliente = $(this).attr("descuento");

    if(descuento < 0){
        $(this).val(descuento_cliente);
        descuento = descuento_cliente
    }else if(descuento > 100){
        $(this).val(descuento_cliente);
        descuento = descuento_cliente
    }



    var precioProductoDescuento = precio1.attr("precioOriginal") -(precio1.attr("precioOriginal") * (Number(descuento) / Number(100)));

    precio_unitario.val(precioProductoDescuento);

    cantidad = cantidad.val();

    precioFinal = precioProductoDescuento * cantidad;

    precioFinal = precioFinal.toFixed(2);

    precio1.val(precioFinal);

    precio1.attr("precioReal", precioProductoDescuento);





    /*var precio1Comision = $(this).parent().parent().children(".ingresoPrecioComision").children().children(".nuevoPrecioProductoComision");

    var precioProductoDescuentoComision = precio1Comision.attr("precioOriginalComision") - (precio1Comision.attr("precioOriginalComision") * (Number(descuento) / Number(100)));

    var precioFinalComision = precioProductoDescuentoComision * cantidad;

    precioFinalComision = precioFinalComision.toFixed(2);

    precio1Comision.val(precioFinalComision);

    precio1Comision.attr("precioRealComision", precioProductoDescuentoComision);*/



        // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios();

                        // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();

});











$(document).on("click", ".nuevoDescuentoProducto", function(){

    divClienteDesactiva();
    divBusquedaDesactiva();
    divPartidasActiva();
    

    var input_descuento = $(this);
    if(input_descuento.attr("readonly") !== undefined){
        Swal.fire({
          title: "Desbloquear descuento",
          html: '<label>Código</label><input type="codigo" id="codigo" class="swal2-input" autocomplete="off">',
          focusConfirm: false,
          preConfirm: () => {
            var codigo = $("#codigo").val();

            var datos = new FormData();
            datos.append("darPermisoCodigo", codigo);
            datos.append("darPermisoPermiso", "Desbloquear descuento de partidas en crear cotizaciones");


            $.ajax({
                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){

                    //console.log(respuesta);
                    if(respuesta == 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Desbloqueo exitoso',
                            showConfirmButton: true
                        });

                        input_descuento.removeAttr("readonly");

                    }else if(respuesta == 2){
                        Swal.fire({
                            icon: 'info',
                            title: 'No tienes permiso',
                            showConfirmButton: true
                        });
                    }else if(respuesta == 3){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Este usuario esta desactivado',
                            showConfirmButton: true
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'No se encuentra usuario',
                            showConfirmButton: true
                        });
                    }
                }
            });

        }
    });
    }
});






        /*=============================================
        SUMAR TODOS LOS PRECIOS
        =============================================*/

function sumarTotalPrecios(){

    var id_cliente = $("#nuevoIdCliente2").val();

    var precioItem = $(".nuevoPrecioProducto");

    var arraySumaPrecio = [];  

    for(var i = 0; i < precioItem.length; i++){

       arraySumaPrecio.push(Number($(precioItem[i]).val()));


   }



   function sumaArrayPrecios(total, numero){

    return total + numero;

}

var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

        /*if(id_cliente == 1){
            sumaTotalPrecio = Math.round(sumaTotalPrecio);


            
        }else{*/
sumaTotalPrecio = sumaTotalPrecio.toFixed(2);
        //}




$("#nuevoTotalVenta").val(sumaTotalPrecio);
$("#totalVenta").val(sumaTotalPrecio);
$("#textoTotal").text(sumaTotalPrecio).number(true, 2);
$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}








        /*=============================================
        LISTAR TODOS LOS PRODUCTOS
        =============================================*/

function listarProductos(){

    var listaProductos = [];

    var cantidad = $(".nuevaCantidadProducto");

    var descuento = $(".nuevoDescuentoProducto");

    var precio = $(".nuevoPrecioProducto");

    for(var i = 0; i < cantidad.length; i++){

        listaProductos.push({ "id" : $(cantidad[i]).attr("id_producto"),
          "cantidad" : $(cantidad[i]).val(),
          "descuento" : $(descuento[i]).val(),
          "precio" : $(precio[i]).attr("precioReal"),
          "total" : $(precio[i]).val()})

    }
    //console.log("listaProductos", listaProductos);

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
$(document).on("click", "#btnGenerarVenta", function(){


    var productos = $("#listaProductos").val();

    var dataVEPV = new FormData();
    dataVEPV.append("verificarExistenciasPorductosVenta", productos);

    $.ajax({

        url:"ajax/existencias-sucursales.ajax.php",
        method: "POST",
        data: dataVEPV,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuestaVEPV){

            var json = JSON.parse(respuestaVEPV);

            var json_id_producto = json[0];
            var json_clave_producto = json[1];
            var json_cantidad = json[2];
            var json_stock = json[3];


            if(json_id_producto.length == 0){
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

                        var id_cliente = $("#nuevoIdCliente2").val();


                        if(id_cliente == 1){

                            Swal.fire({
                                title: 'Inserta el nombre del cliente',
                                input: 'text',
                                inputAttributes: {
                                    pattern: "[A-Z]",
                                    onkeyup: "soloMayusculas(this)"
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
                                        title: '<b>Forma de pago</b>',
                                        html: '<br>'+
                                        '<select class="form-control selectpicker show-tick" id="seleccionarFormaPago" data-style="btn-warning" data-live-search="true" >'+
                                        '<option value="1">Efectivo</option>'+
                                        '<option value="2">Tarjeta Débito</option>'+
                                        '<option value="3">Tarjeta Crédito</option>'+
                                        '<option value="4">Transferencia</option>'+
                                        '</select>'+
                                        '<br>',
                                        showCancelButton: true,
                                        focusConfirm: false,
                                        showCancelButton: true,
                                        confirmButtonColor: '#28a745',
                                        cancelButtonColor: '#d33',
                                        cancelButtonText: 'Cancelar',
                                        confirmButtonText: 'Guardar',
                                    }).then(function(respuestaFormaPago){

                                        if(respuestaFormaPago.value){

                                            var forma_pago = $("#seleccionarFormaPago").val();
                                            $("#nuevoNoFormaPago").val(forma_pago);



                                            Swal.fire({
                                              title: "¿Enviar ticket por Whatsapp?",
                                              showDenyButton: true,
                                              showCancelButton: false,
                                              confirmButtonText: "Si",
                                              denyButtonText: "No"
                                          }).then((result) => {
                                              if (result.isConfirmed) {

                                                Swal.fire({
                                                    title: 'Inserta el número celular',
                                                    input: 'number',
                                                    inputAttributes: {
                                                        pattern: "[0-9]{10}"
                                                    },
                                                    inputValidator: (value) => {
                                                        var contador = value.length ;


                                                        if (contador > 10) {
                                                            return 'Introduzca un numero de 10 digitos, este tiene más'
                                                        }
                                                        if (contador < 10) {
                                                            return 'Introduzca un numero de 10 digitos, este tiene menos'
                                                        }
                                                        if (contador == 0) {
                                                            return 'No ha especificado ningún número'
                                                        }
                                                    },
                                                    showCancelButton: true,
                                                    confirmButtonText: 'confirmar',
                                                    showLoaderOnConfirm: true,
                                                    preConfirm: (celular) => {
                                                        $("#enviaCelular").val(celular);
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
                                        }//Respuesta vendedor
                                    });//ajax treaer vendedor

                                },//codigo vendedor ingresado
                            });//swal codigo vendedor 
                                                    },//aqui se inserto el celular
                                                });//Swalfire de insertar el numero al que se va a enviar el ticket

                                  }//si se le dio que SI se mande por whatsapp
                                  else if (result.isDenied) {

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
                                        }//Respuesta vendedor
                                    });//ajax treaer vendedor

                                },//codigo vendedor ingresado
                            });//swal codigo vendedor 

                                  }//si se le dio que NO se mande por whatsapp
                                });//Swalfire pregunta enviar ticket por whatsaoo



                            }//forma de pago ingreado
                    });//swal forma de pago

                }//nombre cliente ingresado
            });//swal nombre cliente

}//si clientes es = 1
else{


    Swal.fire({
        title: '<b>Forma de pago</b>',
        html: '<br>'+
        '<select class="form-control selectpicker show-tick" id="seleccionarFormaPago" data-style="btn-warning" data-live-search="true" >'+
        '<option value="1">Efectivo</option>'+
        '<option value="2">Tarjeta Débito</option>'+
        '<option value="3">Tarjeta Crédito</option>'+
        '<option value="4">Transferencia</option>'+
        '</select>'+
        '<br>',
        showCancelButton: true,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Guardar',
    }).then(function(respuestaFormaPago){

        if(respuestaFormaPago.value){

            var forma_pago = $("#seleccionarFormaPago").val();
            $("#nuevoNoFormaPago").val(forma_pago);

            var celular = $("#nuevoIdCliente>option:selected").attr("celular");

            console.log(celular);

            if(celular == undefined || celular == ""){


                Swal.fire({
                    title: 'El cliente no cuenta con número celular\npor favor\nInserte el número celular',
                    input: 'number',
                    inputAttributes: {
                        pattern: "[0-9]{10}"
                    },
                    inputValidator: (value) => {
                        var contador = value.length ;


                        if (contador > 10) {
                            return 'Introduzca un numero de 10 digitos, este tiene más'
                        }
                        if (contador < 10) {
                            return 'Introduzca un numero de 10 digitos, este tiene menos'
                        }
                        if (contador == 0) {
                            return 'No ha especificado ningún número'
                        }
                    },
                    showCancelButton: true,
                    confirmButtonText: 'confirmar',
                    showLoaderOnConfirm: true,
                    preConfirm: (celular) => {
                        $("#enviaCelular").val(celular);
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
                                        }//Respuesta vendedor
                                    });//ajax treaer vendedor

                                },//codigo vendedor ingresado
                            });//swal codigo vendedor 
                                                    },//aqui se inserto el celular
                                                });//Swalfire de insertar el numero al que se va a enviar el ticket
        }//Si el cliente no tiene celular
        else{
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
                                        }//Respuesta vendedor
                                    });//ajax treaer vendedor

                                },//codigo vendedor ingresado
                            });//swal codigo vendedor  
      }//Si el cliente si tiene celular
                            }//forma de pago ingreado
                    });//swal forma de pago
}




}

});
}else{



    for(var i = 0; i < json_id_producto.length; i++){

        var id_producto = json_id_producto[i];
        var clave_producto = json_clave_producto[i];
        var cantidad = json_cantidad[i];
        var stock = json_stock[i];

        $(document).Toasts('create', {
            class: 'bg-warning',
            title: 'El producto con clave '+clave_producto+' ya no cuenta con la cantidad solicitada',
            body: 'Se solicitaron '+cantidad+ ' pero en stock ahora solo hay '+stock
        });
        


        $("#tr"+id_producto).attr("style", "background-color: red;"); 
        $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").attr("stock", stock); 

        

    }
}
}
});




});








        /*=============================================
        SOLICITAR LA MUESTRA DE UN PRODUCTO
        =============================================*/
$(document).on("click", ".btnSolicitarProducto", function(){

    divClienteDesactiva();
    divBusquedaActiva();
    divPartidasDesactiva();
    

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
                                if(respuestaSolicitud == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Producto solicitado',
                                        showConfirmButton: true
                                    });
                                }else{
                                 Swal.fire({
                                    icon: 'error',
                                    title: 'No se pudo solicitar tu producto',
                                    text: 'Si el error permanece, comunícate con sistemas para dar pronta solución',
                                    showConfirmButton: true
                                }); 
                             }
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
        /*$(document).on("click", ".btnImprimirNota", function(){

                var id_venta = $(this).attr("id_venta");

                window.open("extensiones/tcpdf/examples/factura.php?id_venta="+id_venta, "_blank");

        })*/










$(document).on("click", "#rfcCliente", function(){

    divClienteActiva();
    divBusquedaDesactiva();
    divPartidasDesactiva();
    

});












$(document).on("click", "#btnCrearNuevoCliente", function(){

    divClienteActiva();
    divBusquedaDesactiva();
    divPartidasDesactiva();
    

    setTimeout(function() {
        $("#nuevoNombre").focus();
    }, 150);

    //$(".close").hide();

    $("#buscar3").attr("teclaEsc", "no");

});

/*=============================================
VALIDACIONES PARA CREAR AL CLIENTE EN EL MODLO DE CREAR VENTA
=============================================*/



   /*=============================================
    VERIFICAR SI EL NOMBRE FISCAL EXISTE
    =============================================*/     

function validarNombreExistenteCrear() {

    var nombre = $("#nuevoNombre").val();

    var datos = new FormData();
    datos.append("validarNombre", nombre);

    $.ajax({
        async: false,
        url:"ajax/clientes.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){


            if(respuesta[0] === undefined){
                validar_nombre_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevoNombre").parent().after(Swal.fire({
                    icon: 'error',
                    title: 'Esta nombre físcal ya existe, introduce otro',
                    showConfirmButton: false,
                    timer: 2000
                }));
                
                $("#nuevoNombre").focus();
                
                validar_nombre_existente_crear = 0;

            }

        }

    })
    
    return validar_nombre_existente_crear;
}








    /*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoNombre", function(){

    validar_nombre_existente_crear = validarNombreExistenteCrear();
    

});









    /*=============================================
    VERIFICAR SI EL RFC YA EXISTE
    =============================================*/     

function validarRfcExistenteCrear() {

    var rfc = $("#nuevoRfc").val();

    var datos = new FormData();
    datos.append("validarRfc", rfc);

    $.ajax({
        async: false,
        url:"ajax/clientes.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){


            if(respuesta[0] === undefined){
                validar_rfc_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevoRfc").parent().after(Swal.fire({
                    icon: 'error',
                    title: 'Este RFC ya existe, introduce otro',
                    showConfirmButton: false,
                    timer: 2000
                }));
                
                $("#nuevoRfc").focus();
                
                validar_rfc_existente_crear = 0;

            }

        }

    })
    
    return validar_rfc_existente_crear;
}






    /*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoRfc", function(){

    validar_rfc_existente_crear = validarRfcExistenteCrear();
    

});





function validarNombreVacioCrear() {
    if($("#nuevoNombre").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el nombre físcal del cliente',
            showConfirmButton: false,
            timer: 2000
        })
        
        
        $("#nuevoNombre").focus();
        
        
        validar_nombre_vacio_crear = 0;
        
        return validar_nombre_vacio_crear;
        
        
    }else{

        validar_nombre_vacio_crear = 1;
        return validar_nombre_vacio_crear;
    }
    
    
    
}





function validarRfcVacioCrear() {
    if($("#nuevoRfc").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el RFC del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoRfc").focus();
        
        validar_rfc_vacio_crear = 0;
        
        return validar_rfc_vacio_crear;
        
        
    }else{

        validar_rfc_vacio_crear = 1;
        return validar_rfc_vacio_crear;
        
    }
    
}





function validarEmailVacioCrear() {
    if($("#nuevoEmail").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el correo electronico del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoEmail").focus();
        
        validar_email_vacio_crear = 0;
        
        return validar_email_vacio_crear;
        
        
    }else{

        validar_email_vacio_crear = 1;
        return validar_email_vacio_crear;
        
    }
    
}





function validarIdRegimenVacioCrear() {
    if($("#nuevoIdRegimen").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe seleccionar el regímen físcal del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoIdRegimen").focus();
        
        validar_id_regimen_vacio_crear = 0;
        
        return validar_id_regimen_vacio_crear;
        
        
    }else{

        validar_id_regimen_vacio_crear = 1;
        return validar_id_regimen_vacio_crear;
        
    }
    
}





function validarNombreComercialVacioCrear() {
    if($("#nuevoNombreComercial").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el nombre comercial del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoNombreComercial").focus();
        
        validar_nombre_comercial_vacio_crear = 0;
        
        return validar_nombre_comercial_vacio_crear;
        
        
    }else{

        validar_nombre_comercial_vacio_crear = 1;
        return validar_nombre_comercial_vacio_crear;
        
    }
    
}






function validarContactoVacioCrear() {
    if($("#nuevoContacto").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir un contacto del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoContacto").focus();
        
        validar_contacto_vacio_crear = 0;
        
        return validar_contacto_vacio_crear;
        
        
    }else{

        validar_contacto_vacio_crear = 1;
        return validar_contacto_vacio_crear;
        
    }
    
}





function validarTelefono1VacioCrear() {
    if($("#nuevoTelefono1").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir un número telefónico',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoTelefono1").focus();
        
        validar_telefono1_vacio_crear = 0;
        
        return validar_telefono1_vacio_crear;
        
        
    }else{

        validar_telefono1_vacio_crear = 1;
        return validar_telefono1_vacio_crear;
        
    }
    
}





function validarCodigoPostalVacioCrear() {
    if($("#nuevoCodigoPostal").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el código postal del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#nuevoCodigoPostal").focus();
        
        validar_codigo_postal_vacio_crear = 0;
        
        return validar_codigo_postal_vacio_crear;
        
        
    }else{

        validar_codigo_postal_vacio_crear = 1;
        return validar_codigo_postal_vacio_crear;
        
    }
    
}






$(document).on("click", "#btnCrearClienteModulo", function(){



    $(this).blur();

    //validar_codigo_postal_vacio_crear = validarCodigoPostalVacioCrear();
    //alert(validar_codigo_postal_vacio_crear);
    
    validar_telefono1_vacio_crear = validarTelefono1VacioCrear();
    //alert(validar_telefono1_vacio_crear);
    
    //validar_contacto_vacio_crear = validarContactoVacioCrear();
    //alert(validar_contacto_vacio_crear);
    
    //validar_nombre_comercial_vacio_crear = validarNombreComercialVacioCrear();
    //alert(validar_nombre_comercial_vacio_crear);
    
    //validar_id_regimen_vacio_crear = validarIdRegimenVacioCrear();
    //alert(validar_id_regimen_vacio_crear);
    
    //validar_email_vacio_crear = validarEmailVacioCrear();
    //alert(validar_email_vacio_crear);
    
    //validar_rfc_existente_crear = validarRfcExistenteCrear();
    //alert(validar_nombre_existente_crear);
    
    //validar_rfc_vacio_crear = validarRfcVacioCrear();
    //alert(validar_rfc_vacio_crear);
    
    validar_nombre_existente_crear = validarNombreExistenteCrear();
    //alert(validar_nombre_existente_crear);
    
    validar_nombre_vacio_crear = validarNombreVacioCrear();
    //alert(validar_nombre_vacio_crear);
    

    if(validar_nombre_existente_crear !== 0 &&
        validar_nombre_vacio_crear !== 0 &&
        validar_telefono1_vacio_crear !== 0){

        var nombre = $("#nuevoNombre").val();
    var rfc = $("#nuevoRfc").val();
    var email = $("#nuevoEmail").val();
    var telefono1 = $("#nuevoTelefono1").val();
    var codigo_postal = $("#nuevoCodigoPostal").val();
    var id_regimen = $("#nuevoIdRegimen").val();
    var no_precio = $("#nuevoNoPrecio").val();



        /*alert(nombre);
        alert(rfc);
        alert(email);
        alert(codigo_postal);
        alert(id_regimen);*/


    var datosCrearCliente = new FormData();
    datosCrearCliente.append("crearClienteModulo", nombre);
    datosCrearCliente.append("nombre", nombre);
    datosCrearCliente.append("rfc", rfc);
    datosCrearCliente.append("email", email);
    datosCrearCliente.append("telefono1", telefono1);
    datosCrearCliente.append("codigo_postal", codigo_postal);
    datosCrearCliente.append("id_regimen", id_regimen);
    datosCrearCliente.append("no_precio", no_precio);

    $.ajax({
        async: false,
        url:"ajax/clientes.ajax.php",
        method:"POST",
        data: datosCrearCliente,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            //console.log(respuesta);


            if(respuesta[0] === undefined){


               Swal.fire({icon: 'error',
                   title: 'Ha habido un error, intente de nuevo, si no, comuniquese con soporte',
                   showConfirmButton: true
               });


           }
           else if(respuesta[0] !== undefined){



            var newOption = new Option(respuesta[1]+" - "+respuesta[3], respuesta[0], false, false);
            $('#nuevoIdCliente').append(newOption).trigger('change');

            $("#nuevoIdCliente").val(respuesta[0]);

            $("#nuevoIdCliente2").val(respuesta[0]);

            $("#nuevoIdCliente>option:selected").attr("no_precio", respuesta[18]);

            $("#nuevoIdCliente>option:selected").attr("celular", respuesta[5]);


            /*$("#rfcCliente").val(respuesta[3]);

            $("#nombreCliente").val(respuesta[1]);

            $("#nuevoIdCliente").val(respuesta[0]);

            $("#nuevoIdCliente2").val(respuesta[0]);

            $("#nuevoIdCliente2").attr("no_precio", respuesta[18]);*/

            if( respuesta[18] == 1){
                $("#textoPrecio").val("1 --- Público");
            }else if( respuesta[18] == 2){
                $("#textoPrecio").val("2 --- Mayoreo");
            }else if( respuesta[18] == 3){
                $("#textoPrecio").val("3 --- Especial");
            }else{
                $("#textoPrecio").val("1 --- Público");
            }


            $("#nuevoNoPrecio").empty();
            $("#nuevoNoPrecio").attr("readonly", true);
            $("#nuevoNoPrecio").append("<option value='1'>1 --- Público</option>");

            Swal.fire({
                icon: 'success',
                title: 'El cliente '+respuesta[0]+' ha sido creado con éxito',
                text: 'El se agregará a la lista de clientes',
                showConfirmButton: true
            }).then(function(result){
             $('#modalCrearClienteModulo').modal('hide');

             setTimeout(function() { 

                divClienteDesactiva();
                divBusquedaActiva();
                divPartidasDesactiva();

                $("#buscar3").attr("teclaEsc","si");

                $("#buscar3").val("").trigger("change");

                $("#buscar3").focus();
            }, 400); 

         });

            /*var newOption = new Option(respuesta[1], respuesta[0], false, false);
            $('#nuevoIdCliente').append(newOption).trigger('change');*/

            

            





        }

    }

})
}



});




















$(document).on("click", "#btnEditarCliente", function(){

    divClienteActiva();
    divBusquedaDesactiva();
    divPartidasDesactiva();
    

    var id_cliente = $("#nuevoIdCliente2").val();

    if(id_cliente != 1){

    //$(".close").hide();

        $("#buscar3").attr("teclaEsc", "no");

        var datos = new FormData();
        datos.append("id_cliente", id_cliente);

        $.ajax({
            url: "ajax/clientes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success: function(respuesta){

                $("#modalEditarCliente").modal("show");

                $("#mostrarIdClienteECM").val(respuesta["id_cliente"]);
                $("#editarNombre").val(respuesta["nombre"]);
                $("#editarNombre").attr("nombreActual",respuesta["nombre"]);
                $("#editarRfc").val(respuesta["rfc"]);
                $("#editarRfc").attr("rfcActual",respuesta["rfc"]);
                $("#editarEmail").val(respuesta["email"]);
                $("#editarEmail").attr("emailActual",respuesta["email"]);
                $("#editarTelefono1").val(respuesta["telefono1"]);
                $("#editarTelefono1").attr("telefono1Actual",respuesta["telefono1"]);
                $("#editarCodigoPostal").val(respuesta["codigo_postal"]);
                $("#editarCodigoPostal").attr("codigoPostalActual",respuesta["codigo_postal"]);
                $("#editarIdRegimen").val(respuesta["id_regimen"]);
                $("#editarIdRegimen").attr("idRegimenActual",respuesta["id_regimen"]);

                


                if( respuesta['no_precio'] == 1){
                    var newOption = new Option("Público", 1, false, false);
                    $('#editarNoPrecio').append(newOption);
                }else if( respuesta['no_precio'] == 2){
                    var newOption = new Option("Mayoreo", 2, false, false);
                    $('#editarNoPrecio').append(newOption);
                }else if( respuesta['no_precio'] == 3){
                    var newOption = new Option("Especial", 3, false, false);
                    $('#editarNoPrecio').append(newOption);
                }else{
                    var newOption = new Option("Público", 1, false, false);
                    $('#editarNoPrecio').append(newOption);
                }


            }

        });

    }else{

        Swal.fire({
            icon: 'error',
            title: 'NO PUEDES CAMBIAR LOS DATOS DE ESTE CLIENTE',
            showConfirmButton: false,
            timer: 3000
        });

    }
});
































 /*=============================================
    VERIFICAR SI EL NOMBRE FISCAL EXISTE
    =============================================*/     

function validarNombreExistenteEditar() {
    var nombre = $("#editarNombre").val();
    var nombre_actual = $("#editarNombre").attr("nombreActual");


    if(nombre === nombre_actual){

        validar_nombre_existente_editar = 1;
        return validar_nombre_existente_editar;
        
    }
    else if(nombre !== nombre_actual){

        var datos = new FormData();
        datos.append("validarNombre", nombre);

        $.ajax({
            url:"ajax/clientes.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            async : false,
            dataType: "json",
            success:function(respuesta){

                if(respuesta[0] === undefined){



                    validar_nombre_existente_editar = 1;

                }

                else if(respuesta[0] !== undefined){

                    $("#editarNombre").parent().after(Swal.fire({
                        icon: 'error',
                        title: 'Esta nombre físcal ya existe, introduce otro',
                        showConfirmButton: false,
                        timer: 2000
                    }));

                    $("#editarNombre").focus();
                    validar_nombre_existente_editar = 0;
                    $("#editarNombre").attr("placeholder",nombre_actual);

                }

            }

        })

        return validar_nombre_existente_editar;

    }

}









/*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarNombre", function(){

    validar_nombre_existente_editar = validarNombreExistenteEditar();
    

});












     /*=============================================
    VERIFICAR SI LA FAMILIA EXISTE
    =============================================*/     

function validarRfcExistenteEditar() {
    var rfc = $("#editarRfc").val();
    var rfc_actual = $("#editarRfc").attr("rfcActual");


    if(rfc === rfc_actual){

        validar_rfc_existente_editar = 1;
        return validar_rfc_existente_editar;
        
    }
    else if(rfc !== rfc_actual){

        var datos = new FormData();
        datos.append("validarRfc", rfc);

        $.ajax({
            url:"ajax/clientes.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            async : false,
            dataType: "json",
            success:function(respuesta){

                if(respuesta[0] === undefined){



                    validar_rfc_existente_editar = 1;

                }

                else if(respuesta[0] !== undefined){

                    $("#editarRfc").parent().after(Swal.fire({
                        icon: 'error',
                        title: 'Este RFC ya existe, introduce otro',
                        showConfirmButton: false,
                        timer: 2000
                    }));

                    $("#editarRfc").focus();
                    validar_rfc_existente_editar = 0;
                    $("#editarRfc").attr("placeholder",rfc_actual);

                }

            }

        })

        return validar_rfc_existente_editar;

    }

}










/*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarRfc", function(){

    validar_rfc_existente_editar = validarRfcExistenteEditar();
    

});
















/*=============================================
VALIDACIONES PARA LA EDICION
=============================================*/


function validarNombreVacioEditar() {

    var nombre_actual = $("#editarNombre").attr("NombreActual");
    
    if($("#editarNombre").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el nombre físcal del cliente',
            showConfirmButton: false,
            timer: 2000
        })
        
        $("#editarNombre").val(nombre_actual);
        
        $("#editarNombre").focus();
        
        
        validar_nombre_vacio_editar = 0;
        
        return validar_nombre_vacio_editar;
        
        
    }else{

        validar_nombre_vacio_editar = 1;
        return validar_nombre_vacio_editar;
    }
    
    
    
}





function validarRfcVacioEditar() {

    var rfc_actual = $("#editarRfc").attr("rfcActual");
    
    if($("#editarRfc").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el RFC del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarRfc").val(rfc_actual);
        
        $("#editarRfc").focus();
        
        validar_rfc_vacio_editar = 0;
        
        return validar_rfc_vacio_editar;
        
        
    }else{

        validar_rfc_vacio_editar = 1;
        return validar_rfc_vacio_editar;
        
    }
    
}





function validarEmailVacioEditar() {

    var email_actual = $("#editarEmail").attr("emailActual");
    
    if($("#editarEmail").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el correo electronico del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarEmail").val(email_actual);
        
        $("#editarEmail").focus();
        
        validar_email_vacio_editar = 0;
        
        return validar_email_vacio_editar;
        
        
    }else{

        validar_email_vacio_editar = 1;
        return validar_email_vacio_editar;
        
    }
    
}












function validarTelefono1VacioEditar() {
    if($("#editarTelefono1").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir un número telefónico',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarTelefono1").focus();
        
        return 0;
        
        
    }else{

        return 1;
        
    }
    
}





function validarIdRegimenVacioEditar() {
    var id_regimen_actual = $("#editarIdRegimen").attr("idRegimenActual");
    if($("#editarIdRegimen").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe seleccionar el regimen físcal del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarIdRegimen").val(id_regimen_actual);
        
        $("#editarIdRegimen").focus();
        
        validar_id_regimen_vacio_editar = 0;
        
        return validar_id_regimen_vacio_editar;
        
        
    }else{

        validar_id_regimen_vacio_editar = 1;
        return validar_id_regimen_vacio_editar;
        
    }
    
}





function validarCodigoPostalVacioEditar() {
    var codigo_postal_actual = $("#editarCodigoPostal").attr("codigoPostalActual");
    if($("#editarCodigoPostal").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el código postal del cliente',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarCodigoPostal").val(codigo_postal_actual);
        
        $("#editarCodigoPostal").focus();
        
        validar_codigo_postal_vacio_editar = 0;
        
        return validar_codigo_postal_vacio_editar;
        
        
    }else{

        validar_codigo_postal_vacio_editar = 1;
        return validar_codigo_postal_vacio_editar;
        
    }
    
}










/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarNombre", function(){

    validar_nombre_existente_editar = validarNombreExistenteEditar();

    
});



$(document).on("click", "#btnGuardarDatosCliente", function(){

    $(this).blur();
    
    //validar_codigo_postal_vacio_editar = validarCodigoPostalVacioEditar();
    //alert(validar_codigo_postal_vacio_editar);
    
    validar_telefono1_vacio_editar = validarTelefono1VacioEditar();
    //alert(validar_telefono1_vacio_editar);
    
    //validar_contacto_vacio_editar = validarContactoVacioEditar();
    //alert(validar_contacto_vacio_editar);
    
    //validar_nombre_comercial_vacio_editar = validarNombreComercialVacioEditar();
    //alert(validar_nombre_comercial_vacio_editar);
    
    //validar_id_regimen_vacio_editar = validarIdRegimenVacioEditar();
    //alert(validar_id_regimen_vacio_editar);
    
    //validar_email_vacio_editar = validarEmailVacioEditar();
    //alert(validar_email_vacio_editar);
    
    //validar_rfc_existente_editar = validarRfcExistenteEditar();
    //alert(validar_rfc_existente_editar);
    
    //validar_rfc_vacio_editar = validarRfcVacioEditar();
    //alert(validar_rfc_vacio_editar);
    
    validar_nombre_existente_editar = validarNombreExistenteEditar();
    //alert(validar_nombre_existente_editar);
    
    validar_nombre_vacio_editar = validarNombreVacioEditar();
    //alert(validar_nombre_vacio_editar);
    

    if(validar_nombre_existente_editar !== 0 &&
        validar_nombre_vacio_editar !== 0 &&
        validar_telefono1_vacio_editar !== 0){

        /* !== 0 && 
        validar_rfc_existente_editar !== 0 &&
        validar_rfc_vacio_editar !== 0 && 
        validar_email_vacio_editar !== 0 && 
        validar_id_regimen_vacio_editar !== 0 &&
        validar_codigo_postal_vacio_editar !== 0*/

        Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres guardar los datos del cliente?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Guardar',
          cancelButtonText: 'No'
      }).then((result) => {


        if(result.isConfirmed) {

            var id_cliente = $("#mostrarIdClienteECM").val();
            var nombre = $("#editarNombre").val();
            var rfc = $("#editarRfc").val();
            var email = $("#editarEmail").val();
            var telefono1 = $("#editarTelefono1").val();
            var codigo_postal = $("#editarCodigoPostal").val();
            var id_regimen = $("#editarIdRegimen").val();
            var no_precio = $("#editarNoPrecio").val();



            var datosEditarCliente = new FormData();
            datosEditarCliente.append("editarDatosCortosCliente", id_cliente);
            datosEditarCliente.append("nombre", nombre);
            datosEditarCliente.append("rfc", rfc);
            datosEditarCliente.append("email", email);
            datosEditarCliente.append("telefono1", telefono1);
            datosEditarCliente.append("codigo_postal", codigo_postal);
            datosEditarCliente.append("id_regimen", id_regimen);
            datosEditarCliente.append("no_precio", no_precio);

            $.ajax({
                url: "ajax/clientes.ajax.php",
                method: "POST",
                data: datosEditarCliente,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){


                    if(respuesta == 1){
                        $("#buscar3").attr("teclaEsc", "si");
                        $("#modalEditarCliente").modal("hide");

                        $('#select2-nuevoIdCliente-container').text(nombre+" - "+rfc);

                        $("#nuevoIdCliente>option:selected").attr("no_precio", no_precio);

                        $("#nuevoIdCliente>option:selected").attr("no_precio", no_precio);

                        $("#nuevoIdCliente>option:selected").attr("celular", telefono1);
                        

                        if(no_precio == 1){
                            var texto_precio = "Público";
                        }else if(no_precio == 2){
                            var texto_precio = "Mayoreo";
                        }else if(no_precio == 3){
                            var texto_precio = "Especial";
                        }else{
                            var texto_precio = "Público";
                        }

                        $("#textoPrecio").val(texto_precio);


                        $("#editarNoPrecio").empty();
                        $("#editarNoPrecio").attr("readonly", true);


                        //$("#nuevoIdCliente>option:selected").text(" - ");
                        Swal.fire({
                            icon: 'success',
                            title: 'El cliente ha sido editado con éxito',
                            showConfirmButton: true
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'No se han podido guardar los datos del cliente',
                            showConfirmButton: true
                        });
                    }

                }
            });




        } else if (
    /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {

        }



    }); 

  }

});










$(document).on("click", "#nuevoNoPrecio", function(){



    var input_no_precio= $(this);
    if(input_no_precio.attr("readonly") !== undefined){
        Swal.fire({
          title: "Desbloquear lista de precios",
          html: '<label>Código</label><input type="codigo" id="codigo" class="swal2-input" autocomplete="off">',
          focusConfirm: false,
          preConfirm: () => {
            var codigo = $("#codigo").val();

            var datos = new FormData();
            datos.append("darPermisoCodigo", codigo);
            datos.append("darPermisoPermiso", "Desbloquear lista de precios en crear ventas");

            $.ajax({
                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){

                    //console.log(respuesta);
                    if(respuesta == 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Desbloqueo exitoso',
                            showConfirmButton: true
                        });

                        input_no_precio.removeAttr("readonly");
                        input_no_precio.append("<option value='2'>2 --- Mayoreo</option>");
                        input_no_precio.append("<option value='3'>3 --- Especial</option>");

                    }else if(respuesta == 2){
                        Swal.fire({
                            icon: 'info',
                            title: 'No tienes permiso',
                            showConfirmButton: true
                        });
                    }else if(respuesta == 3){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Este usuario esta desactivado',
                            showConfirmButton: true
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'No se encuentra usuario',
                            showConfirmButton: true
                        });
                    }
                }
            });

        }
    });
    }
});













$(document).on("click", "#editarNoPrecio", function(){



    var input_no_precio= $(this);
    if(input_no_precio.attr("readonly") !== undefined){
        Swal.fire({
          title: "Desbloquear lista de precios",
          html: '<label>Código</label><input type="codigo" id="codigo" class="swal2-input" autocomplete="off">',
          focusConfirm: false,
          preConfirm: () => {
            var codigo = $("#codigo").val();

            var datos = new FormData();
            datos.append("darPermisoCodigo", codigo);
            datos.append("darPermisoPermiso", "Desbloquear lista de precios en crear ventas");

            $.ajax({
                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){

                    //console.log(respuesta);
                    if(respuesta == 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Desbloqueo exitoso',
                            showConfirmButton: true
                        });

                        input_no_precio.removeAttr("readonly");
                        input_no_precio.append("<option value='1'>1 --- Público</option>");
                        input_no_precio.append("<option value='2'>2 --- Mayoreo</option>");
                        input_no_precio.append("<option value='3'>3 --- Especial</option>");

                    }else if(respuesta == 2){
                        Swal.fire({
                            icon: 'info',
                            title: 'No tienes permiso',
                            showConfirmButton: true
                        });
                    }else if(respuesta == 3){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Este usuario esta desactivado',
                            showConfirmButton: true
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'No se encuentra usuario',
                            showConfirmButton: true
                        });
                    }
                }
            });

        }
    });
    }
});










$(document).on("click", "#btnIncrustarCotizacion", function(){

    Swal.fire({
      title: "Ingrese número de cotización",
      html: '<label>Cotización</label><input type="id_cotizacion" id="id_cotizacion" class="swal2-input" autocomplete="off">',
      focusConfirm: false,
      preConfirm: () => {
        var id_cotizacion = $("#id_cotizacion").val();

        var datos = new FormData();
        datos.append("traerCotizacion", id_cotizacion);


        $.ajax({

            url:"ajax/cotizaciones.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){

                var productos = respuesta['productos'];

                json=JSON.parse(productos);

                console.log(json);

                json.forEach(function(item) {

                    var id_producto = item['id'];
                    var cantidad = item['cantidad'];

                    var descuento = item['descuento'];

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

                            var stock = parseInt(respuesta["stock"]);

                            var multiplo = parseInt(respuesta["multiplo"]);

                            var descripcion_corta = respuesta["descripcion_corta"];

                            var no_precio = $("#nuevoIdCliente>option:selected").attr("no_precio");

                            

                            var clave_producto = respuesta["clave_producto"];

                            if(myArr.includes(id_producto) == true){

                                var cantidad_actual = $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").val();

                                var cantidad_total = parseInt(cantidad) + parseInt(cantidad_actual);

                                if(stock > 0 && stock >= cantidad_total){

                                    $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").attr("stock", stock);
                                    $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").val(cantidad_total);
                                    $("#tr"+id_producto).children(".ingresoCantidad").children(".nuevaCantidadProducto").trigger("change");

                                    $(document).Toasts('create', {
                                        class: 'bg-success',
                                        title: 'Clave: '+clave_producto,
                                        body: 'El producto '+descripcion_corta+' <br> tenia una cantidad de: '+cantidad_actual+' <br> y se le agrego la cantidad de: '+cantidad+' <br> ahora el producto tíene la cantidad de: '+cantidad_total
                                    });

                                }else{
                                    $(document).Toasts('create', {
                                        class: 'bg-danger',
                                        title: 'Clave: '+clave_producto,
                                        body: 'Al producto '+descripcion_corta+' <br> no se le ha podido aumentar la cantidad de: '+cantidad+' <br> debido a que en stock solo hay la cantida de: '+stock+' <br> y acualmente el producto tiene la cantidad de: '+cantidad_actual
                                    });
                                    $("#buscar3").focus();
                                }


                }//Si el producto del paquete ya existe en la lista
                else{

                    if(stock > 0 && stock >= cantidad){

                        myArr.push(id_producto);

                        

                        if(no_precio == 1){

                            var precioOriginal = Number(respuesta["precio1"]);

                            var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio1"]) * Number(.03))+Number(respuesta["precio1"]);



                            var precio1Comision = Number(precioOriginalComision) - (Number(precioOriginalComision) * (Number(descuento) / Number(100)));


                            precio1Comision = precio1Comision.toFixed(2);


                        }else if(no_precio == 2){
                            var precioOriginal = Number(respuesta["precio2"]);

                            var precio1 = Number(respuesta["precio2"]) -(Number(respuesta["precio2"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio2"]) * Number(.03))+Number(respuesta["precio2"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }else if(no_precio == 3){

                            var precioOriginal = Number(respuesta["precio3"]);

                            var precio1 = Number(respuesta["precio3"]) -(Number(respuesta["precio3"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio3"]) * Number(.03))+Number(respuesta["precio3"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }else{

                            var precioOriginal = Number(respuesta["precio1"]);

                            var precio1 = Number(respuesta["precio1"]) -(Number(respuesta["precio1"]) * (Number(descuento) / Number(100)));
                                                                //precio1 = Number(precio1) -(Number(precio1) * (Number(descuentoFamilia) / Number(100)));
                            var precioOriginalComision = (Number(respuesta["precio1"]) * Number(.03))+Number(respuesta["precio1"]);



                            var precio1Comision = Number(precioOriginalComision) -(Number(precioOriginalComision) * (Number(descuento) / Number(100)));
                            var precio1Comision = precio1Comision.toFixed();
                        }


                        var total = cantidad * precio1;
                        total = Number(total, 2);

                        contador = contador + 1;




                        $(".nuevoProducto").append('<tr id="tr'+id_producto+'">'+
                          '<td class="tdBtnQuitarProducto">'+
                          '<button type="button" class="btn btn-xs btn-danger quitarProducto" style="height:21px; width:21px;" id_producto="'+id_producto+'" tabindex="-1"><i class="fa fa-times"></i></button>'+
                          '</td>'+
                          '<td style="text-size: 5px;">'+clave_producto+'</td>'+
                          '<td style="text-size: 5px;">'+descripcion_corta+'</td>'+
                          '<td class="ingresoCantidad">'+
                          '<input type="number" style="height:21px; width:65px; font-size:18px;" class="form-control-sm nuevaCantidadProducto" id="nuevaCantidadProducto'+contador+'" name="nuevaCantidadProducto'+contador+'" id_producto="'+id_producto+'" multiplo="'+multiplo+'" onkeydown="numerosSinDecimales()" min="1" value="'+cantidad+'" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                          '</td>'+
                          '<td class="ingresoDescuento">'+
                          '<input type="number" class="form-control-sm nuevoDescuentoProducto" style="height:21px; width:65px; font-size:18px;" name="nuevoDescuentoProducto" value="'+descuento+'" descuento="'+descuento+'" min="0" max="100" tabindex="-1" readonly>'+
                          '</td>'+
                          '<td class="ingresoPrecioUnitario">'+
                          '$<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control-sm nuevoPrecioUnitario" value="'+precio1+'" tabindex="-1" readonly>'+
                          '</td>'+
                          '<td class="ingresoPrecio">'+
                          '$<input type="text" style="height:21px; width:100px; text-align: right; font-size:18px;" class="form-control-sm nuevoPrecioProducto" precioOriginal="'+precioOriginal+'" precioReal="'+precio1+'" value="'+total+'" tabindex="-1" readonly>'+
                          '</td>'+
                          '</tr>'+
                          '<hr>');



                    //$("#nuevaCantidadProducto"+contador).focus();
                        const verifica_producto_foco = document.getElementsByClassName("producto_foco");

                        var foco = verifica_producto_foco[0];

                        $(foco).removeClass("producto_foco");
                        $(foco).removeAttr("style");

                        $("#nuevaCantidadProducto"+contador).parent().parent().addClass('producto_foco');
                        $("#nuevaCantidadProducto"+contador).parent().parent().addClass('producto_foco').attr("style","font-weight: bold; background-color: #F2620F; color: #FFFFFF;");

                                                // SUMAR TOTAL DE PRECIOS

                        sumarTotalPrecios();


                                                // AGRUPAR PRODUCTOS EN FORMATO JSON

                        listarProductos();



                                                // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                        $(".nuevoPrecioProducto").number(true, 2);



                }//SI EL PRODUCTO TIENE EXISTENCIAS
                else{

                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'En stock: '+stock+', cantidad requerida por la cotización: '+cantidad,
                        body: 'El producto '+descripcion_corta+' con clave '+clave_producto+' No se ha podido agregar por existencias insuficientes'
                    });
                    /*Swal.fire({
                        icon: 'error',
                        title: 'El producto no tiene existencias por lo tanto no se agregará',
                        showConfirmButton: false,
                        timer: 2000
                    });*/

                                                //$("#buscar3").val("");

                                                //$("#buscar3").onkeyup(buscar_ahora3($('#buscar3').val()));

                    $("#buscar3").focus();
                }//Si el producto NO tiene existencias

            }//Si el producto no se encuentra en la lista exisente

        }//SUCCESS AJAX TRAER PRODUCTO

    });//AJAX TRAER PRODUCTO

                });//FOREACH de los productos de la cotizacion

}

});

}
});

});
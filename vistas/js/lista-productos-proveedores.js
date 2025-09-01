$('#proveedorLPP').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');
});










function activaTablaProductosProveedor() {

    $("#tablaProductosProveedor").DataTable({
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
  order: [[0, 'desc']],
});
}




function incrsutarTablaProductosProveedor(parametros){

    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorProductosProveedor.php',
        success: function(data) {
            document.getElementById("incrustarTablaProductosProveedor").innerHTML = data;
            activaTablaProductosProveedor();

        }
    });

}





$(document).on("change", "#proveedorLPP", function(){ 

    document.getElementById("incrustarTablaProductosProveedor").innerHTML = "";

    var id_proveedor =  $("#proveedorLPP>option:selected").val();

    var parametros = {"id_proveedor":id_proveedor};
    
    incrsutarTablaProductosProveedor(parametros);
});





























$(document).keydown(function(event) {
    //ABRIR IMAGENES F2
    if (event.which === 113)
    {

        $("#proveedorLPP").attr("teclaEsc","no");

        $(".close").trigger('click');
        const verifica_foco = document.getElementsByClassName("foco");
        setTimeout(function() { 
            var foco = verifica_foco[0];




            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);


            //alert("contador mas: "+contador_mas);
            
            
            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).children(".imagenes").children(".imagen1").trigger('click');
            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).attr("cont","1");
            //$(".close").hide();
        }, 100);

    }
});









$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 37)
    {
        var buscador_esc = $("#proveedorLPP").attr("teclaEsc");
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

                $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".seleccionarProducto").addClass('foco').focus();

            }
        }, 100); 
     }
 }

});










$(document).keydown(function(event) {
    //HACER SALTO DE LINEA AL SIGIUENTE PRODUCTO CUANDO LAS IMAGENES DE UN PRODUCTO YA SE LE HAYAN ACABO
    if (event.which === 39)
    {
       var buscador_esc = $("#proveedorLPP").attr("teclaEsc");
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

                $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".seleccionarProducto").addClass('foco').focus();

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

        var buscador_esc = $("#proveedorLPP").attr("teclaEsc");
        if(buscador_esc == "no"){




            const verifica_foco = document.getElementsByClassName("foco");
            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            $(".close").trigger('click');
            
            if(contador_actual <= contador_inicial){

                setTimeout(function() { 

                    $(".contador1").children().children().children(".seleccionarProducto").addClass('foco').focus();

                    $(".contador1").attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                    $("#proveedorLPP").attr("teclaEsc","si");

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

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".seleccionarProducto").addClass('foco').focus();

                    $("#proveedorLPP").attr("teclaEsc","no");
                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children(".imagenes").children(".imagen1").trigger('click');

                    //$(".close").hide();



                }, 150);

            }
        }else{
            const verifica_foco = document.getElementsByClassName("foco");

            var foco = verifica_foco[0];



        //alert("foco "+foco);

            if(foco == null){
                const items = document.getElementsByClassName("seleccionarProducto"); 

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

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".seleccionarProducto").addClass('foco').focus();

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

        var buscador_esc = $("#proveedorLPP").attr("teclaEsc");
        if(buscador_esc == "no"){




            const verifica_foco = document.getElementsByClassName("foco");
            var foco = verifica_foco[0];

            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            $(".close").trigger('click');
            
            if(contador_actual >= contador_final){

                $(foco).addClass('foco').focus();

                $("#proveedorLPP").attr("teclaEsc","si");
                
            }else{



                setTimeout(function() { 






                    var contador_mas = contador_actual + 1;

                    var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);


                    $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("cont", "1");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".seleccionarProducto").addClass('foco').focus();

                    $("#proveedorLPP").attr("teclaEsc","no");
                    $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children(".imagenes").children(".imagen1").trigger('click');

                    //$(".close").hide();



                }, 150);

            }
        }else{
            const verifica_foco = document.getElementsByClassName("foco");

            var foco = verifica_foco[0];

            var contador_final = $("#contadorFinal").val();
        //alert("foco "+foco);

            if(foco == null){
                const items = document.getElementsByClassName("seleccionarProducto"); 

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

                        $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".seleccionarProducto").addClass('foco').focus();

                    }
            //$(foco).focus();

                }, 100);
            }
        }
    }
});


$(document).on("focus", ".seleccionarProducto", function(){

    var contador_actual = $(this).attr("contador");

    var contador_menos = parseInt(contador_actual) - 1;

    var contador_mas = parseInt(contador_actual) + 1;

    $(this).addClass('foco');

    $(this).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");


    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".seleccionarProducto").removeClass('foco');

    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".seleccionarProducto").removeClass('foco');



});






$(document).on("click", ".seleccionarProducto", function(){

    var id_producto = $(this).attr("id_producto");

    var id_proveedor = $("#proveedorLPP>option:selected").val();

    if(id_producto !== "" && id_proveedor !== ""){



        $("#btnEditarClaveProductoProveedor").attr("id_producto", id_producto);

        $("#btnEditarClaveProductoProveedor").attr("id_proveedor", id_proveedor);

        var datos = new FormData();
        datos.append("traerProductoProveedor", id_producto);
        datos.append("id_proveedor", id_proveedor);


        $.ajax({

            url:"ajax/productos-proveedores.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){

                $("#modalEditarClaveProductoProveedor").modal("show");
                $("#mostrarClaveProductoOriginal").val(respuesta['clave_producto']);
                $("#mostrarClaveProductoProveedor").val(respuesta['clave_prod_prov']);

            }

        });

    }

});










$(document).on("click", "#btnEditarClaveProductoProveedor", function(){


    Swal.fire({
      title: 'Estas segur@?',
      text: "Quieres cambiar esta clave?",
      footer: 'Si confirmas la compra ya no habrá vuelta atras',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Confirmo',
      cancelButtonText: 'No'
  }).then((result) => {


    if (result.isConfirmed) {

        var id_producto = $("#btnEditarClaveProductoProveedor").attr("id_producto");

        var id_proveedor = $("#btnEditarClaveProductoProveedor").attr("id_proveedor");

        var clave_prod_prov = $("#mostrarClaveProductoProveedor").val();

        var datos = new FormData();

        datos.append("actualizarProductoProveedor", id_producto);
        datos.append("id_proveedor", id_proveedor);
        datos.append("valor", clave_prod_prov);
        datos.append("columna", "clave_prod_prov");

        console.log(id_producto);
        console.log(id_proveedor);
        console.log(clave_prod_prov);


        $.ajax({

            url:"ajax/productos-proveedores.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                console.log(respuesta);

                if(respuesta == "ok"){
                    Swal.fire({
                  icon: 'success',
                  title: 'Se le ha cambiado la clave al producto exitosamente',
                  showConfirmButton: false,
                  timer: 2000
              }).then(function(result){

                var parametros = {"id_proveedor":id_proveedor};
                incrsutarTablaProductosProveedor(parametros);

            });
                }else{
                    Swal.fire({
                  icon: 'error',
                  title: 'No se le ha cambiado la clave al producto',
                  showConfirmButton: false,
                  timer: 2000
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

});
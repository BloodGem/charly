

var agentes = [];

console.log(agentes);




        



        function buscarAhoraComprasDevoluciones(buscarComprasDevoluciones) {

                var parametros = {"buscarComprasDevoluciones":buscarComprasDevoluciones};
                $.ajax({
                        data:parametros,
                        type: 'POST',
                        url: 'vistas/modulos/buscadores/buscadorComprasDevoluciones.php',
                        success: function(data) {
                                document.getElementById("incrustarTablaComprasDevoluciones").innerHTML = data;
                        }
                });
        }









        /*=============================================
SELEECIONA VENTA DEVOLUCION
=============================================*/
$(document).on("click", ".btnSeleccionaCompraDevolucion", function(){

        var foo = document.getElementById("a");
        var id_compra = $(this).attr("id_compra");

        $("#idCompraDevolucionSeleccionada").val(id_compra);

        if (foo.children.length > 0) {

                Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres seleccionar esta nueva compra?",
                  footer: 'Si la confirmas los datos de la compra actual desapareceran',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                      removeAllChilds('a');


        var parametros = {"id_compra":id_compra};
                $.ajax({
                        data:parametros,
                        type: 'POST',
                        url: 'vistas/modulos/consultas/compraDevolucionSeleccionada.php',
                        success: function(data) {
                                document.getElementById("a").innerHTML = data;
                        }
                });


                $("#buscarComprasDevoluciones").val("");

                $("#buscarComprasDevoluciones").onkeyup(buscarAhoraComprasDevoluciones($('#buscarComprasDevoluciones').val()));

                

                    }

                  });

                
        
            }else{



        var parametros = {"id_compra":id_compra};
                $.ajax({
                        data:parametros,
                        type: 'POST',
                        url: 'vistas/modulos/consultas/compraDevolucionSeleccionada.php',
                        success: function(data) {
                                document.getElementById("a").innerHTML = data;
                        }
                });


                $("#buscarComprasDevoluciones").val("");

                $("#buscarComprasDevoluciones").onkeyup(buscarAhoraComprasDevoluciones($('#buscarComprasDevoluciones').val()));

                
            }


});










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarComprasDevoluciones").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarComprasDevoluciones").val("");
            $("#buscarComprasDevoluciones").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarComprasDevoluciones").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarComprasDevoluciones").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();

        $("#btnConfirmarDevolucion").trigger('click');
    }
});

















//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarComprasDevoluciones").attr("teclaEsc");
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
            $(items[0]).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
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

            $(foco_mas).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

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
        var buscador_esc = $("#buscarComprasDevoluciones").attr("teclaEsc");
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
            $(items[0]).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
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

            $(foco_menos).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco_menos).addClass('foco');
            $(foco_menos).focus();
            //$(foco).focus();

            }, 100);
        }
        
        //alert('Ctrl + flecha abajo!');
    }
    }
});



        
        









        function removeAllChilds(a)
        {
               var a=document.getElementById(a);
               while(a.hasChildNodes())
                    a.removeChild(a.firstChild);    
        }















        /*=============================================
        MODIFICAR LA CANTIDAD
        =============================================*/

        $(".formularioDevolucion").on("change", "input.ingresoADevolver", function(){

                var a_devolver = $(this).val();

                //alert(a_devolver);

                var ingresoCantidadTotalDevuelta = $(this).parent().parent().children(".divCantidadTotalDevuelta").children(".ingresoCantidadTotalDevuelta");

                var cantidad_total_devuelta = ingresoCantidadTotalDevuelta.val();

                //alert(cantidad_total_devuelta);

                var ingresoCantidadComprada = $(this).parent().parent().children(".divCantidadComprada").children(".ingresoCantidadComprada");

                var cantidad_vendida = ingresoCantidadComprada.val();


                var ingresoPrecioNeto = $(this).parent().parent().children(".divPrecioNeto").children(".ingresoPrecioNeto");

                var precio_neto = ingresoPrecioNeto.val();


                var ingresoTotalADevolver = $(this).parent().parent().children(".divTotalADevolver").children(".ingresoTotalADevolver");

                var total_a_devolver = a_devolver * precio_neto;

                total_a_devolver = total_a_devolver.toFixed(2);

                ingresoTotalADevolver.val(total_a_devolver);

                //alert(cantidad_vendida);

                var cantidad_disponible = cantidad_vendida - cantidad_total_devuelta;

                //alert(cantidad_disponible);

                if(a_devolver > cantidad_disponible){

                $(this).val(0);
                ingresoTotalADevolver.val(0);

                        Swal.fire({
                icon: 'error',
                title: 'No puedes devolver la cantidad de: '+a_devolver+' porque la cantidad disponible a devolver ya se supero',
                text: 'La cantidad disponible para devolver es: '+cantidad_disponible,
                showConfirmButton: true
                });
                        

                        
                }

                listarProductosDevolucion();

                sumarTotalPrecios();
                
        });




        /*=============================================
        SUMAR TODOS LOS PRECIOS
        =============================================*/

        function sumarTotalPrecios(){

                var precioItem = $(".ingresoTotalADevolver");
                
                var arraySumaPrecio = [];  

                for(var i = 0; i < precioItem.length; i++){

                       arraySumaPrecio.push(Number($(precioItem[i]).val()));


               }



               function sumaArrayPrecios(total, numero){

                return total + numero;

        }

        var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

        //sumaTotalPrecio = Math.round(sumaTotalPrecio);


        $("#nuevoTotalDevolucion").val(sumaTotalPrecio);
        $("#totalDevolucion").val(sumaTotalPrecio);
        $("#textoTotal").text(sumaTotalPrecio);
        $("#nuevoTotalDevolucion").attr("total",sumaTotalPrecio);


        }


        /*=============================================
        LISTAR TODOS LOS PRODUCTOS
        =============================================*/

        function listarProductosDevolucion(){

                agentes = [];

                var listaProductos = [];

                var id_producto = $(".nuevaDescripcionProducto");

                var cantidad = $(".ingresoADevolver");

                var precio_unitario = $(".ingresoPrecioUnitario");

                var precio_neto = $(".ingresoPrecioNeto");

                var descuento = $(".ingresoDescuento");

                var total = $(".ingresoTotalADevolver");


                for(var i = 0; i < id_producto.length; i++){

                        listaProductos.push({ "id_producto" : $(id_producto[i]).attr("id_producto"),
                             "id_partcom" : $(id_producto[i]).attr("id_partcom"),
                              "cantidad" : $(cantidad[i]).val(),
                              "precio_unitario" : $(precio_unitario[i]).val(),
                              "precio_neto" : $(precio_neto[i]).val(),
                              "descuento" : $(descuento[i]).val(),
                              "total" : $(total[i]).val()})

                        agentes.push($(cantidad[i]).val());


                        console.log(agentes);



                }

                $("#listaProductosDevolucion").val(JSON.stringify(listaProductos)); 

        }






/*=============================================
REVISAR SI EL AÑO ESTA VACIO
=============================================*/
function validarIdMotivoDevolucionVacio() {
if($("#nuevoIdMotivoDevolucion").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe seleccionar el motivo de la devolución',
        showConfirmButton: false,
        timer: 2000
        }).then(function(result){
                $("#nuevoIdMotivoDevolucion").focus();
        });
        
        return 0;
        
        
    }else{
    
    return 1;
    }
    
    
    
}









        /*=============================================
        CONFIRMAR DEVOLUCIÓN
        =============================================*/
$(document).on("click", "#btnConfirmarDevolucion", function(){

$(this).blur();

       Swal.fire({
              title: 'Estas segur@?',
              text: "Quieres confirmar esta devolución?",
              footer: 'Si la confirmas no habrá vuelta atras',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si'
      }).then(function(result){

            if(result.value){

                var totalDevolucion = $("#totalDevolucion").val();

                if(totalDevolucion == 0){
                        Swal.fire({
                                icon: 'error',
                                title: 'No hay ninguna cantidad a devolver',
                                showConfirmButton: false,
                                timer: 2000
                        });
                }else{

                        validar_id_motivo_devolucion_vacio = validarIdMotivoDevolucionVacio();



                        if(validar_id_motivo_devolucion_vacio !== 0){
    
                                document.forms["formularioDevolucion"].submit();
                        }


             }


     }

})
})



$(document).on("click", "#btnBuscarVentaEntrega", function(){ 

    $("#modalResultadoBuscarVentaEntrega").modal("show");

    var id_venta = $('#buscarVentaEntrega').val();

    var parametros = {"id_venta":id_venta};
    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaPartidasVentaEntrega.php',
        success: function(data) {
            document.getElementById("incrustarPartidasVentaEntrega").innerHTML = data;
        }
    });

});









var myArr = [];


listarProductos();

var contador = 0;



/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/




function removeAllChilds(a)
{
    a=document.getElementById(a);
    while(a.hasChildNodes())
        a.removeChild(a.firstChild);    
}














/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(document).on("change", "#escaneador", function(){

    var codigo_barras = $(this).val();


    var datos = new FormData();
    datos.append("codigo_barras", codigo_barras);


    $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(traerProducto){


            var id_producto = traerProducto['id_producto'];

            var cantidad_entregada = $("#"+id_producto).val();

            var cantidad_entregar = $("#"+id_producto).attr("cantidad_entregar");

            var multiplo = traerProducto['multiplo_entrega'];
            

            console.log(traerProducto['multiplo_entrega']);

            if(cantidad_entregada == undefined){
                Swal.fire({
                  icon: 'error',
                  title: 'Este producto no esta en la lista de los productos de esta venta',
                  showConfirmButton: false,
                  timer: 1500
              }).then(function(result){
                $("#escaneador").val("").focus();
            });

          }else if(cantidad_entregada !== undefined){

            cantidad_entregada = parseInt(cantidad_entregada);

            cantidad_entregar = parseInt(cantidad_entregar);

            multiplo = parseInt(multiplo);

            verificar = cantidad_entregada + multiplo;

            if(verificar > cantidad_entregar){

                Swal.fire({
                  icon: 'warning',
                  title: 'La cantidad a entregar de este producto ya se supero',
                  showConfirmButton: false,
                  timer: 2000
              }).then(function(result){
                $("#escaneador").val("").focus();
            });


            }else if(verificar == cantidad_entregar){
                
                $("#"+id_producto).val(verificar);

                $("#escaneador").val("").focus();

                $("#"+id_producto).attr("readonly", true);
                $("#"+id_producto).attr("style","font-weight: bold; background-color: green; color: white;");

                }else if(verificar < cantidad_entregar){

                $("#"+id_producto).val(verificar);

                $("#escaneador").val("").focus();

            }

      }

      listarProductos();

  }
});




});







        /*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

    var listaEstatus = [];

    var cantidad = $(".nuevaCantidad");

    myArr = [];

    for(var i = 0; i < cantidad.length; i++){

        var cantidad_entregada = $(cantidad[i]).val();
        var cantidad_entregar = $(cantidad[i]).attr("cantidad_entregar");

        cantidad_entregada = parseInt(cantidad_entregada);
        cantidad_entregar = parseInt(cantidad_entregar);

        if(cantidad_entregada < cantidad_entregar){

            myArr.push(0);

            var estatus = 0; 

        }else if(cantidad_entregada = cantidad_entregar){

            myArr.push(1);

            var estatus = 1; 

        }

        listaEstatus.push({ "estatus" : estatus})

    }

    $("#listaEstatus").val(JSON.stringify(listaEstatus)); 

}




function verificarVenta(){

    console.log(myArr);

    var posicion = myArr.indexOf(0);

    

    return posicion;

    

        //
}









/*ACTIVAR O DESACTIVAR USUARIO*/
$(document).on("click", "#btnConfirmarEntregarVenta", function(){

    var verifica_venta = verificarVenta();


    if(verifica_venta == -1){
        Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres confirmar la entrega de la venta?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Confirma la entrega',
          cancelButtonText: 'No'
      }).then((result) => {


        if (result.isConfirmed) {

            document.forms["formularioEntregarVenta"].submit();


        }else if (result.dismiss === Swal.DismissReason.cancel) {


            $("#escaneador").val("").focus();

        }


    });
  }else{
    Swal.fire({
        icon: 'error',
        title: 'Al parecer aún no has entregado todos los productos de esta venta',
        showConfirmButton: false,
        timer: 2000
    }).then(function(result){
        $("#escaneador").val("").focus();
    });
}

});












$(document).on("click", ".btnDevolverProductoEntrega", function(){

    var id_partvta = $(this).attr("id_partvta");

    $("#btnDevolverProductoEntrega").attr("id_partvta",id_partvta);

    var id_venta = $("#id_venta").val();
    $("#mostrarIdVentaDevolucionProductoEntrega").val(id_venta);
    var datos = new FormData();
    datos.append("id_partvta", id_partvta);

    $.ajax({

        url:"ajax/partvta.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            var cantidad_disponible = respuesta['cantidad'] - respuesta['cant_dev'];


            $("#id_partvta_devolucion_entrega").val(respuesta['id_partvta']);
            $("#cantidad_devolver").attr("cantidad_devolver_disponible", cantidad_disponible);
            $("#cantidad_devolver").attr("precio_unitario", respuesta['precio_unitario']);
            $("#cantidad_devolver").attr("precio_neto", respuesta['precio_neto']);
            $("#cantidad_devolver").attr("descuento", respuesta['descuento']);
            $("#cantidad_devolver").attr("id_producto", respuesta['id_producto']);
            $("#texto_cantidad_disponible_devolver").text(cantidad_disponible);

            $("#modalDevolverProductoEntrega").modal("show");
        }
    });

});











$(document).on("keyup", "#cantidad_devolver", function(){

    var cantidad_devolver = parseInt($(this).val());

    var cantidad_disponible = parseInt($(this).attr("cantidad_devolver_disponible"));

    if(cantidad_devolver > cantidad_disponible){
        Swal.fire({
            icon: 'warning',
            title: 'La cantidad a devolver es mayor a la cantidad disponible',
            text: 'La cantidad disponible son: '+cantidad_disponible,
            showConfirmButton: false,
            timer: 2500
        }).then(function(result){
            $("#cantidad_devolver").val(cantidad_disponible).focus();

            listarProductoDevolucionEntrega();
        });
    }



    listarProductoDevolucionEntrega();


});



function listarProductoDevolucionEntrega(){

    var devolucionEntregaArray = [];


    var id_producto = $("#cantidad_devolver").attr("id_producto");

    var id_partvta = $("#id_partvta_devolucion_entrega").val();

    var cantidad_devolver = $("#cantidad_devolver").val();

    var precio_unitario = $("#cantidad_devolver").attr("precio_unitario");

    var precio_neto = $("#cantidad_devolver").attr("precio_neto");

    var descuento = $("#cantidad_devolver").attr("descuento");

    var cantidad_disponible = $("#cantidad_devolver").attr("cantidad_devolver_disponible");

    total = cantidad_devolver * precio_neto;


    devolucionEntregaArray.push({ "id_producto" : id_producto,
        "id_partvta" : id_partvta,
        "cantidad" : cantidad_devolver,
        "precio_unitario" : precio_unitario,
        "precio_neto" : precio_neto,
        "descuento" : descuento,
        "total" : total})



    $("#listaDevolucionProductoEntrega").val(JSON.stringify(devolucionEntregaArray)); 

}










/*=============================================
VALIDACIONES PARA LA DEVOLUCION DE UN PRODUCTO DENTRO DE LA ENTREGA DE LA VENTA
=============================================*/

//VALIDAR QUE HAYA UN ID DE VENTA
function validarIdVentaDevolucionProductoEntrega() {
    if($("#mostrarIdVentaDevolucionProductoEntrega").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'No hay ID de venta a registrar',
            showConfirmButton: false,
            timer: 2000
        });
        
        
        validar_id_venta_vacio = 0;
        
        return validar_id_venta_vacio;
        
        
    }else{

        validar_id_venta_vacio = 1;
        return validar_id_venta_vacio;
    }
    
    
    
}










function validarListaDevolucionProductoEntrega() {
    if($("#listaDevolucionProductoEntrega").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'No hay lista de devolución',
            showConfirmButton: false,
            timer: 2000
        });
        
        
        validar_lista_devolucion_vacia = 0;
        
        return validar_lista_devolucion_vacia;
        
        
    }else{

        validar_lista_devolucion_vacia = 1;
        return validar_lista_devolucion_vacia;
    }
    
    
    
}









function validarCantidadDevolver() {

    var cantidad_devolver = parseInt($("#cantidad_devolver").val());

    var cantidad_disponible = parseInt($("#cantidad_devolver").attr("cantidad_devolver_disponible"));

    if(cantidad_devolver === "" || cantidad_devolver == 0){

        Swal.fire({
            icon: 'error',
            title: 'No hay cantidad a devolver',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#cantidad_devolver").focus();
        
        validar_cantidad_devolver = 0;
        
        return validar_cantidad_devolver;
        
        
    }else if(cantidad_devolver < 0 ){

        Swal.fire({
            icon: 'error',
            title: 'No puedes devolver una cantidad negativa',
            showConfirmButton: false,
            timer: 2000
        });

        $("#cantidad_devolver").val(0).focus();
        
        
        validar_cantidad_devolver = 0;
        
        return validar_cantidad_devolver;
        
        
    }else if(cantidad_devolver > cantidad_disponible){

        Swal.fire({
            icon: 'error',
            title: 'La cantidad a devolver ya supero a la cantidad disponible',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#cantidad_devolver").focus();

        validar_cantidad_devolver = 0;
        
        return validar_cantidad_devolver;
        
        
    }else{

        validar_cantidad_devolver = 1;
        return validar_cantidad_devolver;
    }
    
    
    
}










function validarMotivoDevolucionProductoEntrega() {
    if($("#nuevoIdMotivoDevolucionProductoEntrega").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el motivo de la devolución',
            showConfirmButton: false,
            timer: 2000
        });


        $("#nuevoIdMotivoDevolucionProductoEntrega").focus();
        
        
        validar_motivo_devolucion_vacio = 0;
        
        return validar_motivo_devolucion_vacio;
        
        
    }else{

        validar_motivo_devolucion_vacio = 1;
        return validar_motivo_devolucion_vacio;
    }
    
    
    
}











$(document).on("click", "#btnDevolverProductoEntrega", function(){

    $(this).blur();

    var IdPartvta = $(this).attr("id_partvta"); 

    var cantidad_devolver = parseInt($("#cantidad_devolver").val());
    var cantidad_disponible = parseInt($("#cantidad_devolver").attr("cantidad_devolver_disponible"));

    var nueva_cantidad = cantidad_disponible - cantidad_devolver;

    var validar_motivo_devolucion_vacio = validarMotivoDevolucionProductoEntrega();

    var validar_id_venta_vacio = validarIdVentaDevolucionProductoEntrega();

    var validar_lista_devolucion_vacia = validarListaDevolucionProductoEntrega();

    var validar_cantidad_devolver = validarCantidadDevolver();


    //alert("La clave del sat esta vacia? "+validar_clave_sat_vacia_crear);
    
    //alert("La clave del producto ya existe?"+validar_clave_producto_existente_crear);
    
    //alert("La clave del producto esta vacio? "+validar_clave_producto_vacio_crear);
    

    if(validar_id_venta_vacio !== 0 &&
        validar_lista_devolucion_vacia !== 0 && 
        validar_cantidad_devolver !== 0 && 
        validar_motivo_devolucion_vacio !== 0){

        Swal.fire({
          title: 'Estas segur@?',
          text: "Quieres generar devolución?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si'
      }).then(function(result){

        if(result.value){

            var id_venta_devolucion_producto_entrega = $('#mostrarIdVentaDevolucionProductoEntrega').val();
            var lista_devolucion_producto_entrega = $('#listaDevolucionProductoEntrega').val();
            var id_motivo_devolucion_producto_entrega = $('#nuevoIdMotivoDevolucionProductoEntrega').val();

            var datos = new FormData();
            datos.append("id_venta_devolucion_producto_entrega", id_venta_devolucion_producto_entrega);
            datos.append("lista_devolucion_producto_entrega", lista_devolucion_producto_entrega);
            datos.append("id_motivo_devolucion_producto_entrega", id_motivo_devolucion_producto_entrega);
            $.ajax({
                url:"ajax/devoluciones.ajax.php",      
                method: "POST",     
                data: datos,      
                cache: false,      
                contentType: false,     
                processData: false,    
                success:function(data){

                    

                    if(data != 0){


                    $("#modalDevolverProductoEntrega").modal("hide");



                        var inputCantidad = $("#Partvta"+IdPartvta).children(".ingresoCantidadEntregar").children(".nuevaCantidad");
                        inputCantidad.attr("cantidad_entregar",nueva_cantidad);

                        var inputMostrarCantidad = $("#Partvta"+IdPartvta).children(".muestraCantidad").children().children(".textoCantidadDisponible");
                        inputMostrarCantidad.text(nueva_cantidad);


                        var cantidad_antes_entregada = inputCantidad.val();

                        if(cantidad_antes_entregada == nueva_cantidad){
                            inputCantidad.attr("readonly", true);
                            inputCantidad.attr("style","font-weight: bold; background-color: green; color: white;");
                        }

                        $("#cantidad_devolver").val("");
                        $("#nuevoIdMotivoDevolucionProductoEntrega").val("").trigger('change.select2');
                        $("#listaDevolucionProductoEntrega").val("");

                    var json = JSON.parse(data);

                    var traerVenta = json[0];
                    var traerDevolucion = json[1];
                    var traerSucursal = json[2];
                    var traerProducto = json[3];


                    if(traerVenta['tipo_venta'] == "FC"){

                        window.open("index.php?ruta=timbrar-devolucion-modulo&id_devolucion="+traerDevolucion['id_devolucion'], "_blank");




                    }else{

                    Swal.fire({
                        icon: 'success',
                        title: 'La devolución se ha creado con éxito',
                    });





                        





                        var imp_devoluciones = $("#imp_devoluciones").val();


                        productos = traerDevolucion['productos'];

                        const json = JSON.parse(productos);



                        const URLPlugin = 'http://localhost:8000'

                        const init = async () => {



                            imprimirHolaMundo(imp_devoluciones);

                        }


                        const imprimirHolaMundo = async (nombreImpresora) => {
                            const conector = new ConectorPluginV3(URLPlugin, licencia);
                            conector.Iniciar();
                            conector.EstablecerAlineacion(1);
                            conector.CargarImagenLocalEImprimir('C:/xampp/htdocs/guerrero/vistas/img/perfil_empresa/logo.jpg', ConectorPluginV3.TAMAÑO_IMAGEN_NORMAL, 400);
                            conector.Feed(1);
                            conector.EscribirTexto(traerSucursal['nombre']);
                            conector.Feed(1);
                            conector.TextoSegunPaginaDeCodigos(2, 'cp850', traerSucursal['direccion']+' Mz'+traerSucursal['no_interior']+' Lt'+traerSucursal['no_exterior']);
                            conector.Feed(1);
                            conector.TextoSegunPaginaDeCodigos(2, 'cp850', traerSucursal['colonia']);
                            conector.Feed(1);
                            conector.TextoSegunPaginaDeCodigos(2, 'cp850', traerSucursal['codigo_postal']+', '+traerSucursal['ciudad']+', '+traerSucursal['id_estado']);
                            conector.Feed(1);
                            conector.EscribirTexto(traerSucursal['rfc']);
                            conector.Feed(1);
                            conector.EscribirTexto('D E V O L U C I O N');
                            conector.Feed(1);
                            conector.EstablecerAlineacion(0);
                            conector.TextoSegunPaginaDeCodigos(2, 'cp850', 'Devolucion: '+traerDevolucion['id_devolucion']);
                            conector.Feed(1);
                            conector.EscribirTexto('=============================================');
                            conector.Feed(1);
                            json.forEach(function(value) {
                                total_producto = value['cantidad'] * value['precio_neto'];

                                producto = traerProducto['descripcion_corta'];

                                conector.EstablecerAlineacion(0);
                                conector.TextoSegunPaginaDeCodigos(2, 'cp850', value['cantidad']+'  '+producto);
                                conector.Feed(1);
                                conector.EstablecerAlineacion(0);
                                conector.EscribirTexto(traerProducto['ubicacion']+'  '+traerProducto['clave_producto']+'    ');
                                conector.EscribirTexto('$'+value['precio_neto']+'   $'+total_producto); 
                                conector.Feed(2);
                            });
                            conector.Feed(2);
                            conector.EstablecerAlineacion(1);
                            conector.EscribirTexto('Total: $'+traerDevolucion["total"]);
                            conector.Feed(1);
                            conector.EstablecerAlineacion(0);
                            conector.EscribirTexto('=============================================');
                            conector.Feed(5);
                            conector.CorteParcial();
                            const respuesta = await conector
                            .imprimirEn(nombreImpresora);
                        }//imprimir hola mundo

                        init();






}

}else{
    Swal.fire({
        icon: 'error',
        title: 'No se ha podido crear la devolución',
        text: 'Comuníque esto a sistemas',
    });
}//respuesta data
}//data
});//ajax data

}//confirmcion

});//swal pregunta



}



});
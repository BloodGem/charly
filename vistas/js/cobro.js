$( document ).ready(function() {
    var fecha_actual = $("#fecha_actual").val();
    var fecha_corte_caja = $("#fecha_corte_caja").val();

    if(fecha_corte_caja == ""){
        Swal.fire({
            icon: 'error',
            title: 'Aún no has abierto tu corte de caja',
            showConfirmButton: false,
            timer: 2000
        });
        $("#buscarVentaCobro").attr("disabled", true);
        $("#buscarDevolucion").attr("disabled", true);
        $("#buscarGarantia").attr("disabled", true);
    }else if(fecha_actual != fecha_corte_caja){
        Swal.fire({
            icon: 'error',
            title: 'Tu corte es de un dia diferente, cierralo y abre uno nuevo para que sea con fecha actual',
            showConfirmButton: false,
            timer: 3000
        });
        $("#buscarVentaCobro").attr("disabled", true);
        $("#buscarDevolucion").attr("disabled", true);
        $("#buscarGarantia").attr("disabled", true);
    }
});


$(document).on("change", "#buscarVentaCobro", function(){ 

    var folio = $('#buscarVentaCobro').val();

    var datos = new FormData();
    
    datos.append("folio", folio);

    $.ajax({

        url:"ajax/cobro.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            // crea un nuevo objeto `Date`
            var today = new Date();

            // obtener la fecha de hoy en formato `MM/DD/YYYY`
            var now = today.toLocaleDateString('en-US');

            $('#nuevaFechaActual').val(now);


            if(respuesta["pagada"] == 0){

                $('#modalResultadoBuscarVentaCobro').modal('show');
                $("#mostrarNombreCliente").val(respuesta["nombre"]);
                $("#envia_celular").attr("id_cliente",respuesta["id_cliente"]);
                $("#envia_celular").val(respuesta["telefono1"]);
                $("#mostrarIdVenta").val(respuesta["id"]);
                $("#mostrarTotalVenta").val(respuesta["total"]);

                $("#nuevoImporteEfectivo").val(0);
                $("#nuevoImporteTarjetaDebito").val(0);
                $("#nuevoImporteTarjetaCredito").val(0);
                $("#nuevoImporteTransferencia").val(0);

                if(respuesta["no_forma_pago"] == 1){

                    $("#nuevoImporteEfectivo").val(respuesta["total"]);

                    setTimeout(function() { 
                        $("#nuevoImporteEfectivo").select();
                    }, 200);
                    

                }else if(respuesta["no_forma_pago"] == 2){

                    $("#nuevoImporteTarjetaDebito").val(respuesta["total"]);
                    $("#nuevaTerminalBancaria").attr("disabled", false);
                    $("#nuevoImporteTarjetaCredito").attr("readonly", true);
                    $("#nuevoImporteTransferencia").attr("readonly", true);

                }else if(respuesta["no_forma_pago"] == 3){

                    $("#nuevoImporteTarjetaCredito").val(respuesta["total"]);
                    $("#nuevaTerminalBancaria").attr("disabled", false);
                    $("#nuevoImporteTarjetaDebito").attr("readonly", true);
                    $("#nuevoImporteTransferencia").attr("readonly", true);

                }else if(respuesta["no_forma_pago"] == 4){

                    $("#nuevoImporteTransferencia").val(respuesta["total"]);
                    $("#nuevaTerminalBancaria").attr("disabled", false);
                    $("#nuevoImporteTarjetaCredito").attr("readonly", true);
                    $("#nuevoImporteTarjetaDebito").attr("readonly", true);

                }
                
                $("#nuevoImporteTotal").val(respuesta["total"]);
                $("#nuevoCambioCobro").val(0); 

                if(respuesta["tipo_venta"] == "FC"){

                    document.getElementById("formaPago").innerHTML =
                    '<label>Forma de pago<big><code>*</code></big>:</label>'+
                    '<select class="form-control" name="nuevoIdFormaPagoCobro" id="nuevoIdFormaPagoCobro">'+
                    '<option value="PUE">PAGO EN UNA SOLA EXHIBICIÓN</option>'+
                    '<option value="PPD">PAGO EN PARCIALIDADES O DIFERIDO</option>'+
                    '</select>';

                    document.getElementById("cfdi").innerHTML =
                    '<label>CFDI<big><code>*</code></big>:</label>'+
                    '<select class="form-control" name="nuevoIdCfdiCobro" id="nuevoIdCfdiCobro">'+
                    '<option value="G03">GASTOS EN GENERAL.</option>'+
                    '<option value="G01">ADQUISICIÓN DE MERCANCÍAS.</option>'+
                    '</select>';

                    document.getElementById("metodoPago").innerHTML =
                            '<label>Método de pago<big><code>*</code></big>:</label>'+
                            '<select class="form-control" name="nuevoIdMetodoPagoCobro" id="nuevoIdMetodoPagoCobro">'+                
                            '<option value="01">EFECTIVO</option>'+             
                            '<option value="02">CHEQUE NOMINATIVO</option>'+                
                            '<option value="03">TRANSFERENCIA ELECTRONICA DE FONDOS</option>'+              
                            '<option value="04">TARJETA DE CREDITO</option>'+               
                            '<option value="05">MONEDERO ELECTRONICO</option>'+             
                            '<option value="06">DINERO ELECTRONICO</option>'+               
                            '<option value="08">VALES DE DESPENSA</option>'+                
                            '<option value="28">TARJETA DE DEBITO</option>'+                
                            '<option value="29">TARJETA DE SERVICIO</option>'+           
                            '</select>';

                    
                }
                else{
                    document.getElementById("esFactura").innerHTML = '<input type="hidden" id="nuevaFormaPagoCobro" name="nuevoIdFormaPagoCobro" value="NA">'+
                    '<input type="hidden" id="nuevoUsoCfdiCobro" name="nuevoIdCfdiCobro" value="NA">'+
                    '<input type="hidden" id="nuevoMetodoPagoCobro" name="nuevoIdMetodoPagoCobro" value="NA">';
                }
            }
            else{

                $('.btnBuscarVentaCobro').blur();
                
                Swal.fire({
                    icon: 'error',
                    title: 'Esta venta ya ha sido pagada o no existe o no pertenece a tu sucursal',
                    showConfirmButton: false,
                    timer: 2500
                }).then(function(result){


                    $('#buscarVentaCobro').val("");
                    $('#buscarVentaCobro').focus();


                });
                
                
            }  
        }
    });

});








$(document).on("change", "#nuevoIdFormaPagoCobro", function(){ 

                        if($("#nuevoIdFormaPagoCobro").val() == "PUE"){

                            document.getElementById("metodoPago").innerHTML =
                            '<label>Método de pago<big><code>*</code></big>:</label>'+
                            '<select class="form-control" name="nuevoIdMetodoPagoCobro" id="nuevoIdMetodoPagoCobro">'+                
                            '<option value="01">EFECTIVO</option>'+             
                            '<option value="02">CHEQUE NOMINATIVO</option>'+                
                            '<option value="03">TRANSFERENCIA ELECTRONICA DE FONDOS</option>'+              
                            '<option value="04">TARJETA DE CREDITO</option>'+               
                            '<option value="05">MONEDERO ELECTRONICO</option>'+             
                            '<option value="06">DINERO ELECTRONICO</option>'+               
                            '<option value="08">VALES DE DESPENSA</option>'+                
                            '<option value="28">TARJETA DE DEBITO</option>'+                
                            '<option value="29">TARJETA DE SERVICIO</option>'+           
                            '</select>';
                        }
                        else if($("#nuevoIdFormaPagoCobro").val() == "PPD"){
                            document.getElementById("metodoPago").innerHTML =
                            '<label>Método de pago<big><code>*</code></big>:</label>'+
                            '<select class="form-control" name="nuevoIdMetodoPagoCobro" id="nuevoIdMetodoPagoCobro">'+             
                            '<option value="99">POR DEFINIR</option>'+              
                            '</select>';
                        }else{
                            document.getElementById("metodoPago").innerHTML =
                            '<label>Método de pago<big><code>*</code></big>:</label>'+
                            '<h5 style="color: red;">Introduce un método de pago</h5>';
                        }
                    });



















//$("#nuevoImporteEfectivo").onkeyup(function(){
$(document).on("keyup", "#nuevoImporteEfectivo", function(){ 

    var total_venta = Number($("#mostrarTotalVenta").val());

    var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var importe_transferencia = Number($("#nuevoImporteTransferencia").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;

    $("#nuevoImporteTotal").val(total_pago);

    var nuevo_cambio_cobro = total_pago - total_venta;


    $("#nuevoCambioCobro").val(nuevo_cambio_cobro);

    if(importe_tarjeta_debito > 0 || importe_tarjeta_credito > 0 || importe_transferencia > 0 ){
        $("#nuevaTerminalBancaria").attr("disabled", false);
    }else{
        $("#nuevaTerminalBancaria").val("");
        $("#nuevaTerminalBancaria").attr("disabled", true);
    }

});

//$("#nuevoImporteTarjetaDebito").onkeyup(function(){
$(document).on("keyup", "#nuevoImporteTarjetaDebito", function(){ 

    var total_venta = Number($("#mostrarTotalVenta").val());

    var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var importe_transferencia = Number($("#nuevoImporteTransferencia").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;

    $("#nuevoImporteTotal").val(total_pago);
    var nuevo_cambio_cobro = total_pago - total_venta;

    $("#nuevoCambioCobro").val(nuevo_cambio_cobro);

    if(importe_tarjeta_debito > 0 || importe_tarjeta_credito > 0 || importe_transferencia > 0 ){
        $("#nuevaTerminalBancaria").attr("disabled", false);
    }else{
        $("#nuevaTerminalBancaria").val("");
        $("#nuevaTerminalBancaria").attr("disabled", true);
    }

    if($(this).val() >= 1){

    $("#nuevoImporteTarjetaCredito").attr("readonly", true);
    $("#nuevoImporteTransferencia").attr("readonly", true);

    }else{

        $("#nuevoImporteTarjetaCredito").attr("readonly", false);
    $("#nuevoImporteTransferencia").attr("readonly", false);

}


});

//$("#nuevoImporteTarjetaCredito").onkeyup(function(){
$(document).on("keyup", "#nuevoImporteTarjetaCredito", function(){ 
    var total_venta = Number($("#mostrarTotalVenta").val());

    var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var importe_transferencia = Number($("#nuevoImporteTransferencia").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;

    $("#nuevoImporteTotal").val(total_pago);

    var nuevo_cambio_cobro = total_pago - total_venta;


    $("#nuevoCambioCobro").val(nuevo_cambio_cobro);


    if(importe_tarjeta_debito > 0 || importe_tarjeta_credito > 0 || importe_transferencia > 0 ){
        $("#nuevaTerminalBancaria").attr("disabled", false);
    }else{
        $("#nuevaTerminalBancaria").val("");
        $("#nuevaTerminalBancaria").attr("disabled", true);
    }

    if($(this).val() >= 1){

    $("#nuevoImporteTarjetaDebito").attr("readonly", true);
    $("#nuevoImporteTransferencia").attr("readonly", true);

    }else{

        $("#nuevoImporteTarjetaDebito").attr("readonly", false);
    $("#nuevoImporteTransferencia").attr("readonly", false);
}

});



//$("#nuevoImporteTransferencia").onkeyup(function(){
$(document).on("keyup", "#nuevoImporteTransferencia", function(){ 

    var total_venta = Number($("#mostrarTotalVenta").val());

    var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var importe_transferencia = Number($("#nuevoImporteTransferencia").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;

    $("#nuevoImporteTotal").val(total_pago);
    var nuevo_cambio_cobro = total_pago - total_venta;


    $("#nuevoCambioCobro").val(nuevo_cambio_cobro);


    if(importe_tarjeta_debito > 0 || importe_tarjeta_credito > 0 || importe_transferencia > 0 ){
        $("#nuevaTerminalBancaria").attr("disabled", false);
    }else{
        $("#nuevaTerminalBancaria").val("");
        $("#nuevaTerminalBancaria").attr("disabled", true);
    }

    if($(this).val() >= 1){
        $("#nuevoImporteTarjetaCredito").attr("readonly", true);
        $("#nuevoImporteTarjetaDebito").attr("readonly", true); 
    }else{
        $("#nuevoImporteTarjetaCredito").attr("readonly", false);
        $("#nuevoImporteTarjetaDebito").attr("readonly", false); 
    }
    


})




function verificarImporteTotalPago(){

    var total_venta = Number($("#mostrarTotalVenta").val());

    var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var importe_transferencia = Number($("#nuevoImporteTransferencia").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;



    if(total_pago < total_venta){

        Swal.fire({
            icon: 'error',
            title: 'El importe no puede ser menor al total de venta',
            showConfirmButton: true
        });


        return;

    }


    if(importe_tarjeta_debito !== 0 || importe_tarjeta_credito !== 0 || importe_transferencia !== 0){

        suma_tarjetas = importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;

        if (suma_tarjetas > total_venta) {

            Swal.fire({
                icon: 'error',
                title: 'La suma del importe de las tarjetas y el importe de la tranferencia no puede ser mayor al total de la venta',
                showConfirmButton: true
            });

            return;

        }


        if($("#nuevaTerminalBancaria").val() == ""){
            Swal.fire({
                icon: 'error',
                title: 'Debe escoger una terminal bancaria',
                showConfirmButton: true,
            }).then(function(result){
                $("#nuevaTerminalBancaria").css("background-color", "red");
                $("#nuevaTerminalBancaria").css("color", "white");
            });

            return;    
        }


    }




            
               document.forms["formularioCobro"].submit(); 




}






















$(document).on("change", "#buscarDevolucion", function(){ 

    var id_devolucion = $('#buscarDevolucion').val();


    var datos = new FormData();
    
    datos.append("id_devolucion", id_devolucion);

    $.ajax({

        url:"ajax/devoluciones.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            if(respuesta["id_corte_caja"] == 0){

                if(respuesta["tipo_devolucion"] == 1){

                $('#modalRegistrarDevolucion').modal('show');
                $("#mostrarIdDevolucionRDCC").val(respuesta["id_devolucion"]);
                $("#mostrarTotalDevolucion").val(respuesta["total"]);
                $("#nuevoImporteDevolucion").val(respuesta["total"]);
                $("#nuevoCambioDevolucion").val(0); 
                var id_cliente = respuesta["id_cliente"];

            //TRAEMOS EL CLIENTE
                var datos2 = new FormData();
                datos2.append("id_cliente", id_cliente);

                $.ajax({

                    url:"ajax/clientes.ajax.php",
                    method: "POST",
                    data: datos2,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(traerCliente){

                        $("#mostrarNombreClienteDevolucion").val(traerCliente["nombre"]);

                    }
                });


                }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Esta devolución fue con cambio físico',
                    showConfirmButton: true
                }).then(function(result){
                     window.location.reload();
                });

               
            }

            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Esta devolución ya ha tenido movimiento',
                    showConfirmButton: true
                }).then(function(result){
                     window.location.reload();
                });
            }
        }
    });

});










function validarImporte(){

    var total_devolucion = $("#mostrarTotalDevolucion").val();

    if($("#nuevoImporteDevolucion").val() === "" || $("#nuevoImporteDevolucion").val() < total_devolucion){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir la cantidad exacta a devolver o mayor cantidad para cambio',
            showConfirmButton: false,
            timer: 2000
        });
        
        return 0;
        
        
    }else{

        return 1;
    }

}










$(document).on("click", "#btnRegistrarDevolucion", function(){ 
    validar_importe = validarImporte();

    if(validar_importe !== 0){

        document.forms["formularioRDCC"].submit();
    }
});





















$(document).on("change", "#buscarGarantia", function(){ 

    var id_garantia = $('#buscarGarantia').val();


    var datos = new FormData();
    
    datos.append("id_garantia", id_garantia);

    $.ajax({

        url:"ajax/garantias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            if(respuesta["id_corte_caja"] == 0){

                if(respuesta["tipo_cambio"] == 2){

                $('#modalRegistrarGarantia').modal('show');
                $("#mostrarIdGarantiaRGCC").val(respuesta["id_garantia"]);
                $("#mostrarTotalGarantia").val(respuesta["total"]);
                $("#mostrarNombreClienteGarantia").val(respuesta["nombre_cliente"]);

                
                setTimeout(function () {
 $('#btnRegistrarGarantia').focus();
}, 200);

            }else if(respuesta["tipo_cambio"] == 1){
                Swal.fire({
                    icon: 'warning',
                    title: 'Esta garantia fue con cambio físico',
                    showConfirmButton: false,
                    timer: 2000
                });

                return;
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Esta garantia ya ha tenido movimiento o no existe',
                    showConfirmButton: false,
                    timer: 2000
                });

                return;
            }


                

            }
        }
    });

});










$(document).on("click", "#btnRegistrarGarantia", function(){ 

    Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres asignar esta garantia a tu corte de caja?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){
        
      document.forms["formularioRGCC"].submit();

    }

  });

    
    
});










$(document).on("click", ".btnCerrarVentana", function(){ 

    window.location.reload();

});









$(document).on("focus", "#nuevoImporteEfectivo", function(){ 
    $("#nuevoImporteEfectivo").select();
});


$(document).on("focus", "#nuevoImporteTarjetaDebito", function(){ 
    $("#nuevoImporteTarjetaDebito").select();
});


$(document).on("focus", "#nuevoImporteTarjetaCredito", function(){ 
    $("#nuevoImporteTarjetaCredito").select();
});


$(document).on("focus", "#nuevoImporteTransferencia", function(){ 
    $("#nuevoImporteTransferencia").select();
});
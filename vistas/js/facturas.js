


function buscarAhoraFacturas(buscarFacturas) {
        var parametros = {"buscarFacturas":buscarFacturas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorFacturas.php',
        success: function(data) {
        document.getElementById("listaFacturas").innerHTML = data;
        }
        });
        }



$(document).on("click", ".btnFacturar", function(){ 

    var id_venta = $(this).attr("id_venta");

    var datos = new FormData();
    datos.append("id_venta",id_venta); 
    $.ajax({

        url:"ajax/facturas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){


                $('#modalResultadoBuscarVentaFactura').modal('show');
                $("#mostrarNombreCliente").val(respuesta["nombre"]);
                $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                $("#mostrarIdVenta").val(respuesta["id"]);
                $("#mostrarTotalVenta").val(respuesta["total"]);
                $("#nuevoImporteEfectivo").val(respuesta["total"]);
                $("#nuevoImporteTotal").val(respuesta["total"]);
                $("#nuevoCambioCobro").val(0); 
                    
                    document.getElementById("formaPago").innerHTML =
                    '<label>Forma de pago<big><code>*</code></big>:</label>'+
                    '<select class="form-control" name="nuevoIdFormaPagoCobro" id="nuevoIdFormaPagoCobro">'+
                    '<option value="">--Selecciona--</option>'+
                    '<option value="PUE">PAGO EN UNA SOLA EXHIBICIÓN</option>'+
                    '<option value="PPD">PAGO EN PARCIALIDADES O DIFERIDO</option>'+
                    '</select>';

                    document.getElementById("cfdi").innerHTML =
                    '<label>CFDI<big><code>*</code></big>:</label>'+
                    '<select class="form-control" name="nuevoIdCfdiCobro" id="nuevoIdCfdiCobro">'+
                    '<option value="CN01">NÓMINA</option>'+
                    '<option value="CP01">PAGOS</option>'+
                    '<option value="D01">HONORARIOS MÉDICOS, DENTALES Y GASTOS HOSPITALARIOS</option>'+
                    '<option value="D02">GASTOS MÉDICOS POR INCAPACIDAD O DISCAPACIDAD</option>'+
                    '<option value="D03">GASTOS FUNERALES.</option>'+
                    '<option value="D04">DONATIVOS.</option>'+
                    '<option value="D05">INTERESES REALES EFECTIVAMENTE PAGADOS POR CRÉDITOS HIPOTECARIOS (CASA HABITACIÓN).</option>'+
                    '<option value="D06">APORTACIONES VOLUNTARIAS AL SAR.</option>'+
                    '<option value="D07">PRIMAS POR SEGUROS DE GASTOS MÉDICOS.</option>'+
                    '<option value="D08">GASTOS DE TRANSPORTACIÓN ESCOLAR OBLIGATORIA.</option>'+
                    '<option value="D09">DEPÓSITOS EN CUENTAS PARA EL AHORRO, PRIMAS QUE TENGAN COMO BASE PLANES DE PENSIONES.</option>'+
                    '<option value="D10">PAGOS POR SERVICIOS EDUCATIVOS (COLEGIATURAS).</option>'+
                    '<option value="G01">ADQUISICIÓN DE MERCANCÍAS.</option>'+
                    '<option value="G02">DEVOLUCIONES, DESCUENTOS O BONIFICACIONES.</option>'+
                    '<option value="G03">GASTOS EN GENERAL.</option>'+
                    '<option value="I01">CONSTRUCCIONES.</option>'+
                    '<option value="I02">MOBILIARIO Y EQUIPO DE OFICINA POR INVERSIONES.</option>'+
                    '<option value="I03">EQUIPO DE TRANSPORTE.</option>'+
                    '<option value="I04">EQUIPO DE COMPUTO Y ACCESORIOS.</option>'+
                    '<option value="I05">DADOS, TROQUELES, MOLDES, MATRICES Y HERRAMENTAL.</option>'+
                    '<option value="I06">COMUNICACIONES TELEFÓNICAS.</option>'+
                    '<option value="I07">COMUNICACIONES SATELITALES.</option>'+
                    '<option value="I08">OTRA MAQUINARIA Y EQUIPO.</option>'+
                    '<option value="S01">SIN EFECTOS FISCALES. </option>'+
                    '</select>';

                    document.getElementById("metodoPago").innerHTML = '<h5 style="color: red;">Introduce un método de pago</h5>';

                    $("#nuevoIdFormaPagoCobro").on('change', function() {

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
                
        }
    });

});






$("#nuevoImporteEfectivo").change(function(){

    var total_venta = Number($("#mostrarTotalVenta").val());

 var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito;

    $("#nuevoImporteTotal").val(total_pago);

    var nuevo_cambio_cobro = total_pago - total_venta;


    $("#nuevoCambioCobro").val(nuevo_cambio_cobro);

})

$("#nuevoImporteTarjetaDebito").change(function(){

    var total_venta = Number($("#mostrarTotalVenta").val());

 var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito;

    $("#nuevoImporteTotal").val(total_pago);
    var nuevo_cambio_cobro = total_pago - total_venta;


    $("#nuevoCambioCobro").val(nuevo_cambio_cobro);

})

$("#nuevoImporteTarjetaCredito").change(function(){
    var total_venta = Number($("#mostrarTotalVenta").val());

 var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito;

    $("#nuevoImporteTotal").val(total_pago);

var nuevo_cambio_cobro = total_pago - total_venta;


    $("#nuevoCambioCobro").val(nuevo_cambio_cobro);
})




function verificarImporteTotalPago(){

    var total_venta = Number($("#mostrarTotalVenta").val());

    var importe_efectivo = Number($("#nuevoImporteEfectivo").val());

    var importe_tarjeta_debito = Number($("#nuevoImporteTarjetaDebito").val());

    var importe_tarjeta_credito = Number($("#nuevoImporteTarjetaCredito").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito;

    var nuevoIdFormaPagoCobro = $("#nuevoIdFormaPagoCobro").val();



    if(total_pago < total_venta){

        Swal.fire({
          icon: 'error',
          title: 'El importe no puede ser menor al total de venta',
          showConfirmButton: false,
          timer: 2500
      })

    }else{
        if(nuevoIdFormaPagoCobro == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Debes de poner una forma de pago',
                    showConfirmButton: false,
                    timer: 2000
                })
            }else{
                document.forms["formularioFacturar"].submit();
            }

        
    }




    if(importe_efectivo == 0 && importe_tarjeta_debito !== 0 && importe_tarjeta_debito !== 0){

        suma_tarjetas = importe_tarjeta_debito + importe_tarjeta_credito;

        if (suma_tarjetas !==  total_venta) {

            Swal.fire({
              icon: 'error',
              title: 'El importe con tarjetas debe ser exacto',
              showConfirmButton: false,
              timer: 2500
          })

        }else{
            
            if(nuevoIdFormaPagoCobro == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Debes de poner una forma de pago',
                    showConfirmButton: false,
                    timer: 2000
                })
            }else{
                document.forms["formularioFacturar"].submit();
            }

            

        }


    }


    



    

    

}

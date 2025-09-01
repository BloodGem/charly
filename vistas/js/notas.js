

function buscarAhoraNotas(buscarNotas) {
        var parametros = {"buscarNotas":buscarNotas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorNotas.php',
        success: function(data) {
        document.getElementById("listaNotas").innerHTML = data;
        }
        });
        }



$(document).on("click", ".btnConvertirNotaFactura", function(){

        var id_venta_nota = $(this).attr("id_venta_nota"); 

        var datos = new FormData();
        datos.append("id_venta_nota",id_venta_nota);

        $.ajax({

                url:"ajax/notas.ajax.php",
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



                        $('#modalResultadoBuscarVentaCobro').modal('show');
                $("#mostrarNombreCliente").val(respuesta["nombre"]);
                $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                $("#mostrarIdVenta").val(respuesta["id"]);
                $("#mostrarTotalVenta").val(respuesta["total"]);
                $("#mostrarImporteEfectivo").val(respuesta["efectivo"]);
                $("#mostrarImporteTarjetaDebito").val(respuesta["tarjeta_debito"]);
                $("#mostrarImporteTarjetaCredito").val(respuesta["tarjeta_credito"]);
                $("#mostrarImporteTransferencia").val(respuesta["transferencia"]);


                document.getElementById("esFactura").innerHTML =
                    '<div class="col-sm-4">'+
                    '<select class="form-control" name="nuevoIdFormaPagoCobro" id="nuevoIdFormaPagoCobro">'+
                    '<option value="PUE">PAGO EN UNA SOLA EXHIBICIÓN</option>'+
                    '<option value="PPD">PAGO EN PARCIALIDADES O DIFERIDO</option>'+
                    '</select>'+
                    '</div>'+

                    '<div class="col-sm-4">'+
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
                    '</select>'+
                    '</div>'+

                    '<div class="col-sm-4">'+
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
                    '<option value="99">POR DEFINIR</option>'+              
                    '</select>'+
                    '</div>';

                }
        });


})






/*ACTIVAR O DESACTIVAR USUARIO*/
$(document).on("click", ".btnConfirmarConvertirNotaFactura", function(){


Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres confirmar la conversión?",
  footer: 'Si confirmas la conversión ya no habrá vuelta atras',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Confirma la conversión',
  cancelButtonText: 'No'
}).then((result) => {


if (result.isConfirmed) {
        document.forms["formularioConvertirNotaFactura"].submit();
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {

  }

})    

})
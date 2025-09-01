$('#editarIdClienteCDPV').one('select2:open', function(e) {
    $('input.select2-search__field').attr("style", "font-weight: bold; color: red;");
    $('input.select2-search__field').prop('placeholder', 'Busque el cliente aquí...');
    
    document.querySelector('.select2-search__field').focus();
});










function activaTablaVentas() {

                $("#tablaVentas").DataTable({
      "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "No se encontraron resultados",
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
      "responsive": false, 
      "lengthChange": false, 
      "autoWidth": true,
      "scrollX": true,
        order: [[1, 'desc']],
    });
  }




function activaTablaPartidasVenta() {

    $("#tablaPartidasVenta").DataTable({
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
  order: [[2, 'asc']],
});
}

$(document).on("click", ".btnVerPartidasVenta", function(){

    

    $("#buscarVentas").attr("teclaEsc", "no");

    var id_venta = $(this).attr("id_venta");

    var datos =  {"id_venta": id_venta};


    $.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerPartidasVenta.php',
        success: function(data) {

            $("#modalVerPartidasVenta").modal("show");

            document.getElementById("incrustarTablaPartidasVenta").innerHTML = data;
            activaTablaPartidasVenta();
        }
    });

});










function buscarAhoraVentas(buscarVentas) {

    document.getElementById("incrustarTablaVentas").innerHTML = "";

    var parametros = {"buscarVentas":buscarVentas};
    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorVentas.php',
        success: function(data) {
            document.getElementById("incrustarTablaVentas").innerHTML = data;

            activaTablaVentas();

            setInterval(parpadeo, 2000);
        }
    });
}









        //AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarVentas").attr("teclaEsc");
        if(buscador_esc == "si"){
            $("#buscarVentas").val("");
            $("#buscarVentas").focus();
        }else{
            $(".cerrarModal").trigger('click');

            $("#buscarVentas").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".cerrarModal").trigger('click');
        
        $("#buscarVentas").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".cerrarModal").trigger('click');
        $("#btnCrearNuevaVenta").trigger('click');
        
        $("#buscarVentas").attr("teclaEsc", "no");

        

    }
});








//AL PRESIONAR F2 PARA EDITAR
$(document).keydown(function(event) {
    if (event.which === 115)
    {
        event.preventDefault();
        $(".cerrarModal").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

            var contador_actual = $(foco).attr("contador");

            $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerPartidasVenta").trigger("click"); 

            

            $("#buscarVentas").attr("teclaEsc", "no");

        }

        

    }
});










//AL PRESIONAR F6 PARA REIMPRIMIR UNA VENTA
$(document).keydown(function(event) {
    if (event.which === 117)
    {
        event.preventDefault();
        $(".cerrarModal").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

            var contador_actual = $(foco).attr("contador");

            $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnReimprimirTicket").trigger("click"); 

            

            $("#buscarVentas").attr("teclaEsc", "no");

        }

        

    }
});










//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarVentas").attr("teclaEsc");
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
        var buscador_esc = $("#buscarVentas").attr("teclaEsc");
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











$(document).on("click", ".btnReimprimirTicket", function(){ 

    var id_venta = $(this).attr("id_venta");

    $("#reimprimir_ticket_venta").val(id_venta);


    $("#modalReimprimirTicketVenta").modal("show");

    setTimeout(function() { 
        $("#btnNoReimprimirTicket").focus();
    }, 150);


});










$(document).on("click", ".btnReimprimirTicketVentaMostrador", function(){ 

    var id_venta = $(this).attr("id_venta");

    $("#reimprimir_ticket_venta_mostrador").val(id_venta);


    $("#modalReimprimirTicketVentaMostrador").modal("show");

    setTimeout(function() { 
        $("#btnNoReimprimirTicketVentaMostrador").focus();
    }, 150);


});










$(document).on("click", ".btnReimprimirTicketVentaCaja", function(){ 

    var id_venta = $(this).attr("id_venta");

    $("#reimprimir_ticket_venta_caja").val(id_venta);


    $("#modalReimprimirTicketVentaCaja").modal("show");

    setTimeout(function() { 
        $("#btnNoReimprimirTicketVentaCaja").focus();
    }, 150);


});










$(document).on("click", ".btnReenviarFacturaVenta", function(){ 

    var id_venta = $(this).attr("id_venta");

    $("#reenviar_factura_venta").val(id_venta);


    $("#modalReenviarFacturaVenta").modal("show");

    setTimeout(function() { 
        $("#btnNoReenviarFacturaVenta").focus();
    }, 150);


});









$(document).on("click", ".btnTimbrarVenta", function(){ 

    var id_venta = $(this).attr("id_venta");

    $("#timbrarVenta").val(id_venta);


    $("#modalTimbrarVenta").modal("show");

    setTimeout(function() { 
        $("#btnNoTimbrarVenta").focus();
    }, 150);


});











$(document).on("change", "#nuevoIdMetodoPago", function(){ 

                        if($("#nuevoIdMetodoPago").val() == "PUE"){

                            document.getElementById("formaPago").innerHTML =
                            '<label>FormaMétodo de pago<big><code>*</code></big>:</label>'+
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
                        else if($("#nuevoIdMetodoPago").val() == "PPD"){
                            document.getElementById("formaPago").innerHTML =
                            '<label>Forma de pago<big><code>*</code></big>:</label>'+
                            '<select class="form-control" name="nuevoIdMetodoPagoCobro" id="nuevoIdMetodoPagoCobro">'+             
                            '<option value="99">POR DEFINIR</option>'+              
                            '</select>';
                        }
                    });










$(document).on("click", ".btnCambiarDatosPagoVenta", function(){ 

    var id_venta = $(this).attr("id_venta");

    var datos = new FormData();
    
    datos.append("id_venta2", id_venta);

    $.ajax({

        url:"ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){



            $("#cambiarDatosPagoVenta").val(id_venta);

            $("#modalCambiarDatosPagoVenta").modal("show");

            // crea un nuevo objeto `Date`
            /*var today = new Date();

            // obtener la fecha de hoy en formato `MM/DD/YYYY`
            var now = today.toLocaleDateString('en-US');

            $('#nuevaFechaActual').val(now);*/


            //$("#mostrarNombreClienteCDPV").val(respuesta["nombre"]);
            $("#editarIdClienteCDPV").val(respuesta["id_cliente"]).trigger('change');
            $("#mostrarTotalVentaCDPV").val(respuesta["total"]);
            $("#editarImporteEfectivoCDPV").val(respuesta["dinero"]);
            $("#editarImporteTarjetaDebitoCDPV").val(respuesta["tarjeta_debito"]);
            $("#editarImporteTarjetaCreditoCDPV").val(respuesta["tarjeta_credito"]);
            $("#editarImporteTransferenciaCDPV").val(respuesta["transferencia"]);
            
            calcularImportaTotalCDPV();

            

        }
    });

});










function calcularImportaTotalCDPV() {
    var total_venta = Number($("#mostrarTotalVentaCDPV").val());

    var importe_efectivo = Number($("#editarImporteEfectivoCDPV").val());

    var importe_tarjeta_debito = Number($("#editarImporteTarjetaDebitoCDPV").val());

    var importe_tarjeta_credito = Number($("#editarImporteTarjetaCreditoCDPV").val());

    var importe_transferencia = Number($("#editarImporteTransferenciaCDPV").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;

    $("#editarImporteTotalCDPV").val(total_pago);
    
    var nuevo_cambio_cobro = total_pago - total_venta;

    $("#editarCambioCobroCDPV").val(nuevo_cambio_cobro);


}









$("#editarImporteEfectivoCDPV").change(function(){

    calcularImportaTotalCDPV();

})

$("#editarImporteTarjetaDebitoCDPV").change(function(){

    calcularImportaTotalCDPV();

})

$("#editarImporteTarjetaCreditoCDPV").change(function(){
    
    calcularImportaTotalCDPV();
})



$("#editarImporteTransferenciaCDPV").change(function(){

    calcularImportaTotalCDPV();

})




function verificarImporteTotalPagoCDPV(){

    var total_venta = Number($("#mostrarTotalVentaCDPV").val());

    var importe_efectivo = Number($("#editarImporteEfectivoCDPV").val());

    var importe_tarjeta_debito = Number($("#editarImporteTarjetaDebitoCDPV").val());

    var importe_tarjeta_credito = Number($("#editarImporteTarjetaCreditoCDPV").val());

    var importe_transferencia = Number($("#editarImporteTransferenciaCDPV").val());

    var total_pago = importe_efectivo + importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;



    if(total_pago < total_venta){

        Swal.fire({
            icon: 'error',
            title: 'El importe no puede ser menor al total de venta',
            showConfirmButton: true
        });


        return 0;

    }else if(importe_tarjeta_debito !== 0 || importe_tarjeta_credito !== 0 || importe_transferencia !== 0){

        suma_tarjetas = importe_tarjeta_debito + importe_tarjeta_credito + importe_transferencia;

        if (suma_tarjetas > total_venta) {

            Swal.fire({
                icon: 'error',
                title: 'La suma del importe de las tarjetas y el importe de la tranferencia no puede ser mayor al total de la venta',
                showConfirmButton: true
            });

            return 0;

        }


    }else{
        return 1;
    }

                

}









$(document).on("click", "#btnSubmitCDPV", function(){

    $(this).blur();
    
    validacion = verificarImporteTotalPagoCDPV();
    

if(validacion !== 0){
    
    document.forms["formularioCDPV"].submit();
}

   

});













$(document).on("click", ".btnReenviarTicketWhatsapp", function(){ 

    var id_venta = $(this).attr("id_venta");

    var datos = new FormData();
    
    datos.append("folio", id_venta);

    $.ajax({

        url:"ajax/cobro.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

                $('#modalReenviarTicketWhatsapp').modal('show');

                $("#envia_celular").attr("id_cliente",respuesta["id_cliente"]);

                if(respuesta["id_cliente"] == 1){
                    $("#envia_celular").val(respuesta["celular"]);  
                }else{
                    $("#envia_celular").val(respuesta["telefono1"]); 
                }
                
                
                $("#reenviar_ticket_whatsapp").val(respuesta["id"]);

                setTimeout(function () {
                 $('#btnSiReenviarTicketWhatsapp').focus();
                }, 200);
            
        }
    });

});









$(document).on("click", "#btnSiReenviarTicketWhatsapp", function(){ 
    var id_cliente = $("#envia_celular").attr("id_cliente");

            var celular = $("#envia_celular").val();
            //document.forms["formularioCobro"].submit();

                //alert(id_cliente);

            if(id_cliente == 1){

                if(celular != ""){
               document.forms["formularioReenviarTicketWhatsapp"].submit(); 
            }else{

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
                    preConfirm: (codigo) => {
                        $("#envia_celular").val(codigo);
                        document.forms["formularioReenviarTicketWhatsapp"].submit();
                    },
                });

                }

                //document.forms["formularioCobro"].submit();

          }else{

            if(celular != ""){
               document.forms["formularioReenviarTicketWhatsapp"].submit(); 
            }else{
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
                    preConfirm: (codigo) => {
                        $("#envia_celular").val(codigo);
                        document.forms["formularioReenviarTicketWhatsapp"].submit();
                    },
                });
            }
            
        }
});
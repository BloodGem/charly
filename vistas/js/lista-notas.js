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


function buscarAhoraNotas(buscarNotas) {
        var parametros = {"buscarNotas":buscarNotas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorNotas.php',
        success: function(data) {
        document.getElementById("incrustarTablaNotas").innerHTML = data;
        }
        });
        }









$(document).on("click", ".btnVerPartidasVenta", function(){

        //$(".close").hide();

        $("#buscarNotas").attr("teclaEsc", "no");

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










$(document).on("click", ".btnConvertirNotaFactura", function(){

    //$(".close").hide();

        $("#buscarNotas").attr("teclaEsc", "no");

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
                $("#mostrarTotalVenta").val(respuesta["total"]).number(true, 2);
                $("#mostrarImporteEfectivo").val(respuesta["efectivo"]).number(true, 2);
                $("#mostrarImporteTarjetaDebito").val(respuesta["tarjeta_debito"]).number(true, 2);
                $("#mostrarImporteTarjetaCredito").val(respuesta["tarjeta_credito"]).number(true, 2);
                $("#mostrarImporteTransferencia").val(respuesta["transferencia"]).number(true, 2);

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
                    '<option value="G03">GASTOS EN GENERAL.</option>'+
                    '<option value="G01">ADQUISICIÓN DE MERCANCÍAS.</option>'+
                    '</select>';

                    document.getElementById("metodoPago").innerHTML = '<h5 style="color: red;">Introduce un método de pago</h5>';

                    

                

                }
        });


})


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



/*ACTIVAR O DESACTIVAR USUARIO*/
$(document).on("click", ".btnConfirmarConvertirNotaFactura", function(){

var nuevoIdFormaPagoCobro = $("#nuevoIdFormaPagoCobro").val();

if(nuevoIdFormaPagoCobro == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Debes de poner una forma de pago',
                    showConfirmButton: false,
                    timer: 2000
                })
            }else{
                
            
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

} 

});










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarNotas").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarNotas").val("");
            $("#buscarNotas").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarNotas").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarNotas").attr("teclaEsc", "si");     

    }
});









//AL PRESIONAR F4 PARA CONVERTIR NOTA A FACTURA
$(document).keydown(function(event) {
    if (event.which === 115)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerPartidasVenta").trigger("click"); 

        //$(".close").hide();

        $("#buscarNotas").attr("teclaEsc", "no");

    }

        

    }
});










//AL PRESIONAR F5 PARA VER PARTIDAS DE LA VENTA
$(document).keydown(function(event) {
    if (event.which === 116)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnConvertirNotaFactura").trigger("click"); 

        //$(".close").hide();

        $("#buscarNotas").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarNotas").attr("teclaEsc");
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
        var buscador_esc = $("#buscarNotas").attr("teclaEsc");
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
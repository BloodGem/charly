function activaTablaFacturasGlobales() {

                $("#tablaFacturasGlobales").DataTable({
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










function activaTablaVentasFacturaGlobal() {

    $("#tablaVentasFacturaGlobal").DataTable({
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
  order: [[1, 'asc']],
});
}

function buscarAhoraFacturasGlobales(buscarFacturasGlobales) {

    document.getElementById("incrustarTablaFacturasGlobales").innerHTML = "";

    var parametros = {"buscarFacturasGlobales":buscarFacturasGlobales};

    $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorFacturasGlobales.php',
        success: function(data) {
            document.getElementById("incrustarTablaFacturasGlobales").innerHTML = data;

            activaTablaFacturasGlobales();
        }
    });
}





         //AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarFacturasGlobales").attr("teclaEsc");
        if(buscador_esc == "si"){
            $("#buscarFacturasGlobales").val("");
            $("#buscarFacturasGlobales").focus();
        }else{
            $(".close").trigger('click');

            $("#buscarFacturasGlobales").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarFacturasGlobales").attr("teclaEsc", "si");     

    }
});








//AL PRESIONAR F1 PARA VER VENTAS DE UNA FACTUA GLOBAL
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

            var contador_actual = $(foco).attr("contador");

            $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerVentasFacturaGlobal").trigger("click"); 

            $(".close").hide();

            $("#buscarFacturasGlobales").attr("teclaEsc", "no");

        }

        

    }
});










//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarFacturasGlobales").attr("teclaEsc");
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
        var buscador_esc = $("#buscarFacturasGlobales").attr("teclaEsc");
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





/*$("#nuevoIdFormaPagoFacturaGlobal").on('change', function() {

                        if($("#nuevoIdFormaPagoFacturaGlobal").val() == "PUE"){

                            document.getElementById("metodoPago").innerHTML =
                            '<label>Método de pago<big><code>*</code></big>:</label>'+
                            '<select class="form-control" name="nuevoIdMetodoPagoFacturaGlobal" id="nuevoIdMetodoPagoFacturaGlobal">'+                
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
                        else if($("#nuevoIdFormaPagoFacturaGlobal").val() == "PPD"){
                            document.getElementById("metodoPago").innerHTML =
                            '<label>Método de pago<big><code>*</code></big>:</label>'+
                                '<select class="form-control" name="nuevoIdMetodoPagoFacturaGlobal" id="nuevoIdMetodoPagoFacturaGlobal">'+             
                            '<option value="99">POR DEFINIR</option>'+              
                            '</select>';
                        }else{
                            document.getElementById("metodoPago").innerHTML =
                            '<label>Método de pago<big><code>*</code></big>:</label>'+
                            '<h5 style="color: red;">Introduce un método de pago</h5>';
                        }
                    });*/










function validarTotalVacio() {

    var total = $("#nuevoTotalFactuaGlobal").val();

    if(total == ""){
        Swal.fire({
            icon: 'error',
            title: 'FALTA TOTAL',
            text: 'Debes elegir un rango de fecha inicial y final y consultar el total a facturar',
            showConfirmButton: true
        }).then(function(result){
            //setTimeout(function() { 
                $("#nuevoTotalFactuaGlobal").focus();
            //}, 1000);
        });

        

        

        return 0;
    }else{
        return 1;
    }

}










function validarFechasVacias() {

    var fecha_inicial = $("#nuevaFechaInicial").val();

    var fecha_final = $("#nuevaFechaFinal").val();

    if(fecha_inicial == ""){

        Swal.fire({
            icon: 'error',
            title: 'Debes elegir un rango de fecha inicial y final',
            showConfirmButton: true
        }).then(function(result){
            //setTimeout(function() { 
                $("#nuevaFechaInicial").focus();
            //}, 1000);
        });

        return 0;

    }else if(fecha_final == ""){

        Swal.fire({
            icon: 'error',
            title: 'Debes elegir un rango de fecha inicial y final',
            showConfirmButton: true
        }).then(function(result){
            //setTimeout(function() { 
                $("#nuevaFechaFinal").focus();
            //}, 1000);
        });

        return 0;

    }else{

        return 1;

    }

}











function validarFechaFinalContraInicial() {

    var fecha_inicial = $("#nuevaFechaInicial").val();

    var fecha_final = $("#nuevaFechaFinal").val();

    if(fecha_final < fecha_inicial){
        Swal.fire({
            icon: 'error',
            title: 'La fecha final no puede ser menor a la fecha inicial',
            showConfirmButton: true
        }).then(function(result){
            //setTimeout(function() { 
                $("#nuevaFechaFinal").focus();
            //}, 1000);
        });

        return 0;
    }else{
        return 1;
    }

}










function validarPeriodoVacio() {

    var periodo = $("#nuevoIdPeriodo>option:selected").val();

    if(periodo == ""){
        Swal.fire({
            icon: 'error',
            title: 'Debe elegir un periodo',
            showConfirmButton: true
        }).then(function(result){
            //setTimeout(function() { 
                $("#nuevoIdPeriodo").focus();
            //}, 1000);
        });

        return 0;
    }else{
        return 1;
    }

}










function validarRangoMesesVacio() {

    var rango_meses = $("#nuevoIdRangoMes>option:selected").val();

    if(rango_meses == ""){
        Swal.fire({
            icon: 'error',
            title: 'Debe elegir un rango de mes',
            showConfirmButton: true
        }).then(function(result){
            //setTimeout(function() { 
                $("#nuevoIdRangoMes").focus();
            //}, 1000);
        });

        return 0;
    }else{
        return 1;
    }

}









function validarYearVacio() {

    var year = $("#nuevoYear").val();

    if(year == ""){
        Swal.fire({
            icon: 'error',
            title: 'Introduzca el año',
            showConfirmButton: true
        }).then(function(result){
            //setTimeout(function() { 
                $("#nuevoYear").focus();
            //}, 1000);
        });

        

        

        return 0;
    }else{
        return 1;
    }

}










/*=============================================
        CONFIRMAR CREAR FACTURA GLOBAL
        =============================================*/
$(document).on("click", "#btnCrearFacturaGlobal", function(){

    $(this).blur();

    validar_year_vacio = validarYearVacio();

    validar_rango_meses_vacio = validarRangoMesesVacio();

    validar_periodo_vacio = validarPeriodoVacio();

    validar_total_vacio = validarTotalVacio();

    validar_fechas_vacias = validarFechasVacias();

    validar_fecha_final_contra_inicial = validarFechaFinalContraInicial();

    if(validar_fechas_vacias !== 0 &&
        validar_fecha_final_contra_inicial !== 0 &&
        validar_total_vacio !== 0 &&
        validar_periodo_vacio !== 0 &&
         validar_rango_meses_vacio !== 0 &&
         validar_year_vacio !== 0){

        Swal.fire({
            title: 'Estas segur@?',
            text: "Quieres crear esta factura?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then(function(result){

            if(result.value){

               document.forms["formularioCrearFacturaGlobal"].submit();

           }

       });

    }

});










        /*=============================================
        VER LAS VENTAS DE UNA FACTURA GLOBAL
        =============================================*/
$(document).on("click", ".btnVerVentasFacturaGlobal", function(){


    $(".close").hide();

    $("#buscarFacturasGlobales").attr("teclaEsc", "no");

    var id_factura_global = $(this).attr("id_factura_global");

    var datos =  {"id_factura_global": id_factura_global};


    $.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerVentasFacturaGlobal.php',
        success: function(data) {

            $("#modalVerVentasFacturaGlobal").modal("show");

            document.getElementById("incrustarTablaVentasFacturaGlobal").innerHTML = data;
            activaTablaVentasFacturaGlobal();
        }
    });

});








$(document).on("click", "#btnTraerTotalVentasRangoFecha", function(){

    var fecha_inicial = $("#nuevaFechaInicial").val();

    var fecha_final = $("#nuevaFechaFinal").val();

    validar_fechas_vacias = validarFechasVacias();

    validar_fecha_final_contra_inicial = validarFechaFinalContraInicial();

    if(validar_fechas_vacias !== 0 &&
        validar_fecha_final_contra_inicial !== 0){

        var datos = new FormData();
        datos.append("mostrarSumaVentasRangoFechasFacturaGlobal",fecha_inicial);
        datos.append("fecha2",fecha_final);

        $.ajax({
            url:"ajax/ventas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                console.log(respuesta);

                var json = JSON.parse(respuesta);

                var respuestaOpcion = json[0];


                if(respuestaOpcion == 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'En el rango escogido ya hay ventas con factura global asignada',
                        text: 'Revisa tu seguimiento',
                        showConfirmButton: true
                    });

                    $("#nuevoTotalFactuaGlobal").val("");
                }else if(respuestaOpcion == 1){

                    var total_ventas = json[1];

                    $("#nuevoTotalFactuaGlobal").val(total_ventas);
                    $("#mostrarTotalFactuaGlobal").val(total_ventas).number(true, 2);
                }

                

            }

        });

    }
    



});










$(document).on("click", ".btnDescargarPDFVentasFacturaGlobal", function(){

    var id_factura_global = $(this).attr("id_factura_global");

    window.open("extensiones/tcpdf/examples/pdf-ventas-factura-global.php?id_factura_global="+id_factura_global, "_blank");

});










$(document).on("click", ".btnDescargarPDFFacturaGlobal", function(){

    var id_factura_global = $(this).attr("id_factura_global");

    window.open("extensiones/tcpdf/examples/factura-global.php?id_factura_global="+id_factura_global, "_blank");

});










$(document).on("click", ".btnDescargarXMLFacturaGlobal", function(){

    var id_factura_global = $(this).attr("id_factura_global");

   window.open("vistas/modulos/descargarArchivo.php?no_archivo=1&id_factura_global="+id_factura_global, "_blank");

});










$(document).on("click", ".btnComprimirVentasFacturaGlobal", function(){
    var id_factura_global = $(this).attr("id_factura_global");
    $("#modalComprimirNotasFacturaGlobal").modal("show");
    $("#smallIdFacturaGlobal").text(id_factura_global);
    $("#comprimirNotasFacturaGlobal").val(id_factura_global);
});










$(document).on("click", ".btnTimbrarFacturaGlobal", function(){
    var id_factura_global = $(this).attr("id_factura_global");
    $("#modalFacturarFacturaGlobal").modal("show");
    $("#small2IdFacturaGlobal").text(id_factura_global);
    $("#timbrarFacturaGlobal").val(id_factura_global);
});
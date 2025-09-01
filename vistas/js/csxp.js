/*window.onload = function(){
    fecha = new Date();
    texto = document.getElementById("nuevaFechaActual");
    texto.value = fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear();
}*/


function activaTablaPartidasCompra() {

                $("#tablaPartidasCompra").DataTable({
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









  function activaTablaProveedoresDeuda() {

                $("#tablaProveedoresDeuda").DataTable({
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
      searching: false,
        order: [[1, 'asc']],
    });
  }










  function activaTablaCsxpProveedor() {

                $("#tablaCsxpProveedor").DataTable({
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
        order: [[1, 'desc']],
    });
  }











function activaTablaPagosCompra() {

                $("#tablaPagosCompra").DataTable({
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










$(document).on("click", ".btnVerPartidasCompra", function(){



        var id_compra = $(this).attr("id_compra");

var datos =  {"id_compra": id_compra};


$.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerPartidasCompra.php',
        success: function(data) {

        $("#modalVerPartidasCompra").modal("show");

        document.getElementById("incrustarTablaPartidasCompra").innerHTML = data;
        activaTablaPartidasCompra();
        }
        });

})

var agentes = [];

console.log(agentes);

function buscarAhoraCsxp(buscarCsxp) {
        var parametros = {"buscarCsxp":buscarCsxp};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorCsxp.php',
        success: function(data) {
        document.getElementById("incrustarTablaCsxp").innerHTML = data;

        activaTablaProveedoresDeuda();
        }
        });
        }












$(document).on("click", ".btnVerCsxpProveedor", function(){


        var id_proveedor = $(this).attr("id_proveedor");
        var nombre = $(this).attr("nombre");
        var adeudo_total = $(this).attr("adeudo_total");

        //adeudo_total = adeudo_total.toFixed(2);

        $("#mostrarIdProveedorC").val(id_proveedor);
        $("#mostrarNombreProveedorC").val(nombre);
        $("#mostrarAdeudoTotalC").val(adeudo_total);

        $("#mostrarAdeudoTotalC").number(true, 2);


var id_proveedor =  {"id_proveedor": id_proveedor};

$.ajax({
        data:id_proveedor,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaCsxpProveedor.php',
        success: function(data) {
        document.getElementById("incrustarTablaComprasCsxp").innerHTML = data;

        activaTablaCsxpProveedor()
        }
        });

})










$(document).on("click", ".btnVerSeguimientoCompra", function(){

        var id_compra = $(this).attr("id_compra"); 

        var datos = new FormData();
        datos.append("id_compra",id_compra);

        $.ajax({

            url:"ajax/csxp.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                
                $("#mostrarIdCompra").val(respuesta["id"]);
                $("#mostrarSaldoInicial").val(respuesta["total"]);
                $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                var total_abonos = respuesta["total"] - respuesta["saldo_actual"];

                $("#mostrarTotalAbonos").val(total_abonos);

                $("#mostrarSaldoInicial").number(true, 2);
                $("#mostrarSaldoActual").number(true, 2);
                $("#mostrarTotalAbonos").number(true, 2);

                $(".btnCrearAbono").attr("id_compra",respuesta["id"]);



                var id_proveedor = respuesta["id_proveedor"]; 

                var datosProveedor = new FormData();
                datosProveedor.append("id_proveedor",id_proveedor);
                $.ajax({

                    url:"ajax/proveedores.ajax.php",
                    method: "POST",
                    data: datosProveedor,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(traerProveedor){

                        $("#mostrarNombreProveedor").val(traerProveedor["nombre"]);
                        $("#mostrarIdProveedor").val(traerProveedor["id_proveedor"]);
                    }
                });




                //TRAEMOS LAS PARTIDAS DE CXP DE LA COMPRA
                var datosTraerCompra =  {"id_compra": id_compra};

                $.ajax({
                    data:datosTraerCompra,
                    type: 'POST',
                    url: 'vistas/modulos/consultas/consultaSeguimientoCxpCompra.php',
                        success: function(traerPartidasCxpCompra) {

                        document.getElementById("incrustarTablaPagosCompra").innerHTML = traerPartidasCxpCompra;

                        activaTablaPagosCompra();
                    }
                });


            }
        });








})




/*$("#nuevoImporte").change(function(){

saldo_actual = Number($("#saldoActual").val());
importe = Number($("#nuevoImporte").val());

if (importe > saldo_actual){
Swal.fire({
  icon: 'error',
  title: 'El importe es mayor al saldo actual, debe introducir un valor menor o igual al saldo actual',
  showConfirmButton: false,
  timer: 2500
})

$("#nuevoImporte").val("");

}

else if(importe <= 0){
    Swal.fire({
  icon: 'error',
  title: 'El importe es igual a cero, debe introducir un valor mayor, si el saldo actual es igual a 0 ya no puede realizar esta operaci贸n',
  showConfirmButton: false,
  timer: 4500
})
    $("#nuevoImporte").val("");
}

    });*/




/*=============================================
ELIMINAR FAMILIA
=============================================*/
/*function verificarImporte(){


importe = Number($("#nuevoImporte").val());

saldo_actual = Number($("#saldoActual").val());

metodo = $("#nuevoIdMetodo").val();


if (metodo == 0){
Swal.fire({
  icon: 'error',
  title: 'Debes elegir un metodo de pago',
  showConfirmButton: false,
  timer: 1500
})

}else if (importe > saldo_actual){
Swal.fire({
  icon: 'error',
  title: 'El importe es mayor al saldo actual, debe introducir un valor menor o igual al saldo actual',
  showConfirmButton: false,
  timer: 3000
})

$("#nuevoImporte").val("");

}

else if(importe <= 0){
    Swal.fire({
  icon: 'error',
  title: 'El importe esta vacio, debe introducir un valor mayor a 0, si el saldo actual es igual a 0 ya no puede realizar esta operaci贸n',
  showConfirmButton: false,
  timer: 3500
})
    $("#nuevoImporte").val("");

}else{

Swal.fire({
    title: "Verifica el importe",
    input: 'number',
    showCancelButton: true        
}).then((result) => {
    if(result.value == '' || result.value == 0 ){
        Swal.fire({
  icon: 'error',
  title: 'No has introducido ningun valor o tu verificacion de importe es igual a 0, no puedes hacer eso',
  showConfirmButton: false,
  timer: 3000
});
    }
    else if (importe == result.value) {
        document.forms["myForm"].submit();
    }else if(importe !== result.value){
      Swal.fire({
  icon: 'error',
  title: 'Los importes no coinciden, verifica tu importe',
  showConfirmButton: false,
  timer: 1500
});
    }
});

}

}*/


var contador = 0;
        /*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
var myArr = [];
    $(document).on("click", ".agregarCompra", function(){


        var id_compra = $(this).attr("id_compra");


        

if(myArr.includes(id_compra) == true){

    //$('#modalCrearAbono').modal('show');

                $(this).removeClass("btn-primary agregarCompra");

                $(this).addClass("btn-default");

        }else{

            //$('#modalCrearAbono').modal('show');

         

         $(this).removeClass("btn-primary agregarCompra");

         $(this).addClass("btn-default");

            var datos = new FormData();
            datos.append("id_compra", id_compra);

            $.ajax({

                url:"ajax/csxp.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){

                    myArr.push(id_compra);

                    contador = contador + 1;

                    var id_compra = respuesta["id"];
                    var saldo_actual = respuesta["saldo_actual"];

                    $(".nuevaCompra").append('<div class="row">'+
                              '<div class="col-1">'+
                              '<button type="button" class="btn btn-danger quitarCompraCxp" id_compra="'+id_compra+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                              '</div>'+
                              '<div class="col-3">'+
                              '<input type="text" class="form-control idCompraCxp" id_compra="'+id_compra+'" value="'+id_compra+'" disabled>'+
                              '</div>'+
                              '<div class="col-4 ingresoImporteCxp">'+
                              '<div class="input-group">'+
                              '<div class="input-group-prepend">'+
                                '<span class="input-group-text">'+
                                  '<i class="fas fa-dollar-sign"></i>'+
                                '</span>'+
                              '</div>'+
                              '<input type="text" class="form-control nuevoImporteCxp" id="nuevoImporteCxp'+contador+'" name="nuevoImporteCxp"'+contador+'" saldo_actual="'+saldo_actual+'" value="" required>'+
                              '</div>'+
                              '</div>'+


                              '<div class="col-4 ingresoAdeudoCxp">'+
                              '<div class="input-group">'+
                              '<div class="input-group-prepend">'+
                                '<span class="input-group-text">'+
                                  '<i class="fas fa-dollar-sign"></i>'+
                                '</span>'+
                              '</div>'+
                              '<input type="text" class="form-control nuevoAdeudoCxp" name="nuevoAdeudoCxp" value="'+saldo_actual+'" readonly tabindex="-1">'+
                              '</div>'+
                              '</div>'+
                              '</div>');


                    $("#nuevoImporteCxp"+contador).focus();

                    // AGRUPAR PRODUCTOS EN FORMATO JSON
                    // 
                     $(".nuevoAdeudoCxp").number(true, 2);
                     $(".nuevoImporteCxp").number(true, 2);

                        listarCsxp();

                        sumarTotalImportes();




                }
});//AJAX


}



});//inicio del evento












/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioCsxp").on("change", "input.nuevoImporteCxp", function(){

    var importe = $(this).val();

    var saldo_actual = $(this).attr("saldo_actual");

    if(Number(importe) > Number(saldo_actual)){

        /*=============================================
        SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
        =============================================*/

        $(this).val(0);

        Swal.fire({
                                    icon: 'error',
                                    title: 'El importe no puede ser mayor al adeudo actual de esta cuenta por cobrar',
                                    showConfirmButton: false,
                                    timer: 3500
                                    })

        // AGRUPAR PRODUCTOS EN FORMATO JSON

                        
listarCsxp();

sumarTotalImportes();

    }else{
       // AGRUPAR PRODUCTOS EN FORMATO JSON

                        
listarCsxp(); 

sumarTotalImportes();
    }

    
})














/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

$(".formularioCsxp").on("click", "button.quitarCompraCxp", function(){

        var id_compra = $(this).attr("id_compra");

        var posicion = myArr.indexOf(id_compra);

        myArr.splice(posicion, 1); 

        $(this).parent().parent().remove();

        


        $("button.recuperarBoton[id_compra='"+id_compra+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_compra='"+id_compra+"']").addClass('btn-primary agregarCompra');



if($(".nuevaCompra").children().length == 0){

                $("#listaCsxpCC").val("");
                $("#nuevoTotalAdeudoC").val(0);

                
                

        }else{
             // AGRUPAR PRODUCTOS EN FORMATO JSON

                listarCsxp();
        

        sumarTotalImportes();
        }

                



});








/*=============================================
SUMAR TODOS LOS IMPORTES
=============================================*/

function sumarTotalImportes(){

    var precioItem = $(".nuevoImporteCxp");
    
    var arraySumaImporte = [];  

    for(var i = 0; i < precioItem.length; i++){

         arraySumaImporte.push(Number($(precioItem[i]).val()));
        
         
    }

    function sumaArrayImportes(total, numero){

        return total + numero;

    }

    var sumaTotalImporte = arraySumaImporte.reduce(sumaArrayImportes);

    

    sumaTotalImporte = sumaTotalImporte.toFixed(2);
    
    $("#nuevoTotalImporteC").val(sumaTotalImporte);

    $("#textoTotal").text(sumaTotalImporte);

    $("#textoTotal").number(true, 2);


}






function removeAllChilds(a)
{
       var a=document.getElementById(a);
       while(a.hasChildNodes())
            a.removeChild(a.firstChild);    
}








        /*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarCsxp(){

        agentes = [];

        var listaCsxp = [];

        var id_compra = $(".idCompraCxp");

        var importe = $(".nuevoImporteCxp");

        var adeudo = $(".nuevoAdeudoCxp");

        for(var i = 0; i < id_compra.length; i++){

                listaCsxp.push({ "id_compra" : $(id_compra[i]).val(), 
                      "importe" : $(importe[i]).val(),
                      "adeudo" : $(adeudo[i]).val()})

                agentes.push($(importe[i]).val());


                        console.log(agentes);

        }

        $("#listaCsxpCC").val(JSON.stringify(listaCsxp)); 

}










    /*=============================================
    IMPRIMIR NOTA
    =============================================*/
    $(document).on("click", ".btnGenerarCxp", function(){

        var lista_csxp = $("#listaCsxpCC").val();

        if(lista_csxp == "" || lista_csxp == "[]"){

            Swal.fire({
            icon: 'error',
            title: 'No hay ninguna cuenta seleccionada',
            showConfirmButton: false,
            timer: 2000
            });

        }else{

            var indice = agentes.indexOf('0');

            console.log(indice);
            if(indice >= 0){
                Swal.fire({
                icon: 'error',
                title: 'Alguna de las partida no tiene importe o tiene un importe de 0, esto no puede ser',
                showConfirmButton: false,
                timer: 2000
                });
            }else{
                                
                Swal.fire({
                title: 'Estas segur@?',
                text: "Quiere seguir con el procedimiento?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){
                        Swal.fire({
                            title: 'Inserte la cantidad total para verificar y confirmar que el importe a abonar es el correcto',
                            input: 'number',
                            inputAttributes: {
                            autocapitalize: 'off',
                            step: 'any'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'confirmar',
                            showLoaderOnConfirm: true,
                            preConfirm: (login) => {


                                var total_importe = $("#nuevoTotalImporteC").val();

                                var importe = login;
        
                                if(importe == total_importe){
                                    $("#formularioCsxp").submit();
                                }else{
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'La suma de los importes no es igual a la cantidad dada',
                                    showConfirmButton: false,
                                    timer: 2000
                                    });
                                }
                            },
                        });
                    }

                })
            }
        }
    });
















/*var_dump($respuestaSucursal['ccer']);
        var_dump("<br><br><br>");
        var_dump($respuestaSucursal['ckey']);
        var_dump("<br><br><br>");
        var_dump($respuestaSucursal['clave']);
        var_dump("<br><br><br>");
        var_dump($traerProveedor['rfc']);
        var_dump("<br><br><br>");
        var_dump($traerProveedor['nombre']);
        var_dump("<br><br><br>");
        var_dump($traerProveedor['codigo_postal']);
        var_dump("<br><br><br>");
        var_dump($traerProveedor['id_regimen']);
        var_dump("<br><br><br>");
        var_dump($total_importe);
        var_dump("<br><br><br> saldo insoluto");
        var_dump($saldo_insoluto);
        var_dump("<br><br><br> uuid");
        var_dump($traerCompra['uuid']);
        var_dump("<br><br><br>");
        var_dump($adeudo);

        return;*/
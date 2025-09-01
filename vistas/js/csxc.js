/*window.onload = function(){
    fecha = new Date();
    texto = document.getElementById("nuevaFechaActual");
    texto.value = fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear();
}*/


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









  function activaTablaClientesDeuda() {

                $("#tablaClientesDeuda").DataTable({
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










  function activaTablaCsxcCliente() {

                $("#tablaCsxcCliente").DataTable({
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











function activaTablaPagosVenta() {

                $("#tablaPagosVenta").DataTable({
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










$(document).on("click", ".btnVerPartidasVenta", function(){



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

})

var agentes = [];

console.log(agentes);

function buscarAhoraCsxc(buscarCsxc) {
        var parametros = {"buscarCsxc":buscarCsxc};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorCsxc.php',
        success: function(data) {
        document.getElementById("listaCsxc").innerHTML = data;

        activaTablaClientesDeuda();
        }
        });
        }


$(document).on("click", ".btnVerCsxcCliente", function(){


        var id_cliente = $(this).attr("id_cliente");
        var nombre = $(this).attr("nombre");
        var adeudo_total = $(this).attr("adeudo_total");

        //adeudo_total = adeudo_total.toFixed(2);
    
    


        $("#mostrarIdClienteC").val(id_cliente);
        $("#mostrarNombreClienteC").val(nombre);
        $("#mostrarAdeudoTotalC").val(adeudo_total);

        $("#mostrarAdeudoTotalC").number(true, 2);


var id_cliente =  {"id_cliente": id_cliente};

$.ajax({
        data:id_cliente,
        type: 'POST',
        url: 'vistas/modulos/consultaCsxcCliente.php',
        success: function(data) {
        document.getElementById("listaFacturasCliente").innerHTML = data;

        activaTablaCsxcCliente()
        }
        });

})





$(document).on("click", ".btnVerSeguimientoVenta", function(){

        var id_venta = $(this).attr("id_venta"); 

        var datos = new FormData();
        datos.append("id_venta",id_venta);

        $.ajax({

                url:"ajax/ventas.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){



                        $("#mostrarNombreCliente").val(respuesta["nombre"]);
                        $("#mostrarIdCliente").val(respuesta["id_cliente"]);
                        $("#mostrarIdVenta").val(respuesta["id"]);
                        $("#mostrarSaldoInicial").val(respuesta["total"]);
                        $("#mostrarSaldoActual").val(respuesta["saldo_actual"]);

                        $("#mostrarSaldoInicial").number(true, 2);
                        $("#mostrarSaldoActual").number(true, 2);

                        $(".btnCrearAbono").attr("id_venta",respuesta["id"]);

                }
        });


var id_venta3 =  {"id_venta3": $(this).attr("id_venta")};

$.ajax({
        data:id_venta3,
        type: 'POST',
        url: 'vistas/modulos/consultaSeguimiento.php',
        success: function(data) {
        document.getElementById("listaSeguimiento").innerHTML = data;

        activaTablaPagosVenta()
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
    $(".listaCsxcCliente tbody").on("click", "button.agregarVenta", function(){

        var id_venta = $(this).attr("id_venta");

if(myArr.includes(id_venta) == true){

    $('#modalCrearAbono').modal('show');

                $(this).removeClass("btn-primary agregarProducto");

                $(this).addClass("btn-default");

        }else{

            $('#modalCrearAbono').modal('show');

         myArr.push(id_venta);

         $(this).removeClass("btn-primary agregarProducto");

         $(this).addClass("btn-default");

            var datos = new FormData();
            datos.append("id_venta", id_venta);

            $.ajax({

                url:"ajax/csxc.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){

                    contador = contador + 1;

                    var id_venta = respuesta["id"];
                    var saldo_actual = respuesta["saldo_actual"];

                    $(".nuevaVenta").append('<div class="row">'+
                              '<div class="col-1">'+
                              '<button type="button" class="btn btn-danger quitarVentaCxc" id_venta="'+id_venta+'" accesskey="q"><i class="fa fa-times"></i></button>'+
                              '</div>'+
                              '<div class="col-3">'+
                              '<input type="text" class="form-control idVentaCxc" id_venta="'+id_venta+'" value="'+id_venta+'" disabled>'+
                              '</div>'+
                              '<div class="col-4 ingresoImporteCxc">'+
                              '<div class="input-group">'+
                              '<div class="input-group-prepend">'+
                                '<span class="input-group-text">'+
                                  '<i class="fas fa-dollar-sign"></i>'+
                                '</span>'+
                              '</div>'+
                              '<input type="text" class="form-control nuevoImporteCxc" id="nuevoImporteCxc'+contador+'" name="nuevoImporteCxc"'+contador+'" saldo_actual="'+saldo_actual+'" value="" required>'+
                              '</div>'+
                              '</div>'+


                              '<div class="col-4 ingresoAdeudoCxc">'+
                              '<div class="input-group">'+
                              '<div class="input-group-prepend">'+
                                '<span class="input-group-text">'+
                                  '<i class="fas fa-dollar-sign"></i>'+
                                '</span>'+
                              '</div>'+
                              '<input type="text" class="form-control nuevoAdeudoCxc" name="nuevoAdeudoCxc" value="'+saldo_actual+'" readonly tabindex="-1">'+
                              '</div>'+
                              '</div>'+
                              '</div>');


                    $("#nuevoImporteCxc"+contador).focus();

                    // AGRUPAR PRODUCTOS EN FORMATO JSON
                    // 
                     $(".nuevoAdeudoCxc").number(true, 2);
                     $(".nuevoImporteCxc").number(true, 2);

                        listarCsxc();

                        sumarTotalImportes();




                }
});//AJAX


}



});//inicio del evento












/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioCsxc").on("change", "input.nuevoImporteCxc", function(){

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

                        
listarCsxc();

sumarTotalImportes();

    }else{
       // AGRUPAR PRODUCTOS EN FORMATO JSON

                        
listarCsxc(); 

sumarTotalImportes();
    }

    
})














/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

$(".formularioCsxc").on("click", "button.quitarVentaCxc", function(){

        var id_venta = $(this).attr("id_venta");

        var posicion = myArr.indexOf(id_venta);

        myArr.splice(posicion, 1); 

        $(this).parent().parent().remove();

        


        $("button.recuperarBoton[id_venta='"+id_venta+"']").removeClass('btn-default');

        $("button.recuperarBoton[id_venta='"+id_venta+"']").addClass('btn-primary agregarVenta');



if($(".nuevaVenta").children().length == 0){

                $("#listaCsxcCC").val("");
                $("#nuevoTotalAdeudoC").val(0);

                
                

        }else{
             // AGRUPAR PRODUCTOS EN FORMATO JSON

                listarCsxc();
        

        sumarTotalImportes();
        }

                



});








/*=============================================
SUMAR TODOS LOS IMPORTES
=============================================*/

function sumarTotalImportes(){

    var precioItem = $(".nuevoImporteCxc");
    
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

function listarCsxc(){

        agentes = [];

        var listaCsxc = [];

        var id_venta = $(".idVentaCxc");

        var importe = $(".nuevoImporteCxc");

        var adeudo = $(".nuevoAdeudoCxc");

        for(var i = 0; i < id_venta.length; i++){

                listaCsxc.push({ "id_venta" : $(id_venta[i]).val(), 
                      "importe" : $(importe[i]).val(),
                      "adeudo" : $(adeudo[i]).val()})

                agentes.push($(importe[i]).val());


                        console.log(agentes);

        }

        $("#listaCsxcCC").val(JSON.stringify(listaCsxc)); 

}










    /*=============================================
    IMPRIMIR NOTA
    =============================================*/
    $(document).on("click", ".btnGenerarCxc", function(){

        var lista_csxc = $("#listaCsxcCC").val();

        if(lista_csxc == "" || lista_csxc == "[]"){

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
                                    $("#formularioCsxc").submit();
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
        var_dump($traerCliente['rfc']);
        var_dump("<br><br><br>");
        var_dump($traerCliente['nombre']);
        var_dump("<br><br><br>");
        var_dump($traerCliente['codigo_postal']);
        var_dump("<br><br><br>");
        var_dump($traerCliente['id_regimen']);
        var_dump("<br><br><br>");
        var_dump($total_importe);
        var_dump("<br><br><br> saldo insoluto");
        var_dump($saldo_insoluto);
        var_dump("<br><br><br> uuid");
        var_dump($traerVenta['uuid']);
        var_dump("<br><br><br>");
        var_dump($adeudo);

        return;*/
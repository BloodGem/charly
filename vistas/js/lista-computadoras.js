function activaTablaComputadoras() {

                $("#tablaComputadoras").DataTable({
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










$( document ).ready(function() {
    activaTablaComputadoras();
});



/*Editar computadora*/
$(document).on("click", ".btnEditarComputadora", function(){

	var id_computadora = $(this).attr("id_computadora");

	var datos = new FormData();
	datos.append("traerComputadora",id_computadora);

	$.ajax({

		url:"ajax/computadoras.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(traerComputadora){

            $("#modalEditarComputadora").modal("show");

            $("#idComputadora").val(traerComputadora["id_computadora"]);
            $("#editarCodigo").val(traerComputadora["codigo"]);
            $("#editarCodigo").attr("codigoActual",traerComputadora["codigo"]);
            $("#editarComputadora").val(traerComputadora["computadora"]);
            $("#editarComputadora").attr("computadoraActual",traerComputadora["computadora"]);
            $("#mostrarImpresoraVentas").val(traerComputadora["imp_ventas"]);
            $("#mostrarImpresoraCaja").val(traerComputadora["imp_caja"]);
            $("#mostrarImpresoraAlmacen").val(traerComputadora["imp_almacen"]);
            $("#mostrarImpresoraDevoluciones").val(traerComputadora["imp_devoluciones"]);
            $("#mostrarImpresoraCompras").val(traerComputadora["imp_compras"]);
            $("#mostrarImpresoraCotizaciones").val(traerComputadora["imp_cotizaciones"]);
            $("#mostrarImpresoraGarantias").val(traerComputadora["imp_garantias"]);

            setTimeout(function() {
                $("#editarImpresoraVentas").val(traerComputadora["imp_ventas"]);
                $("#editarImpresoraCaja").val(traerComputadora["imp_caja"]);
                $("#editarImpresoraAlmacen").val(traerComputadora["imp_almacen"]);
                $("#editarImpresoraDevoluciones").val(traerComputadora["imp_devoluciones"]);
                $("#editarImpresoraCompras").val(traerComputadora["imp_compras"]);
                $("#editarImpresoraCotizaciones").val(traerComputadora["imp_cotizaciones"]);
                $("#editarImpresoraGarantias").val(traerComputadora["imp_garantias"]);
                console.log("listo");
            }, 2500);




        }
    });


})










     /*=============================================
LISTAR LISTA DE IMPRESORAS EN CADA SELECCIONADOR
=============================================*/
$(document).on("click", "#btnCrearNuevaComputadora", function(){

   const obtenerListaDeImpresoras = async () => {
    return await ConectorPluginV3.obtenerImpresoras();
}
const URLPlugin = "http://localhost:8000"
const $nuevaImpresoraVentas = document.querySelector("#nuevaImpresoraVentas");
const $nuevaImpresoraCaja = document.querySelector("#nuevaImpresoraCaja");
const $nuevaImpresoraAlmacen = document.querySelector("#nuevaImpresoraAlmacen");
const $nuevaImpresoraDevoluciones = document.querySelector("#nuevaImpresoraDevoluciones");
const $nuevaImpresoraCompras = document.querySelector("#nuevaImpresoraCompras");
const $nuevaImpresoraCotizaciones = document.querySelector("#nuevaImpresoraCotizaciones");
const $nuevaImpresoraGarantias = document.querySelector("#nuevaImpresoraGarantias");

const init = async () => {
    const impresoras = await ConectorPluginV3.obtenerImpresoras(URLPlugin);
    for (const impresora of impresoras) {
        $nuevaImpresoraVentas.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $nuevaImpresoraCaja.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $nuevaImpresoraAlmacen.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $nuevaImpresoraDevoluciones.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $nuevaImpresoraCompras.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $nuevaImpresoraCotizaciones.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $nuevaImpresoraGarantias.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));



    }

}


init();

});










/*=============================================
LISTAR LISTA DE IMPRESORAS EN CADA SELECCIONADOR
=============================================*/
$(document).on("click", ".btnEditarComputadora", function(){

   const obtenerListaDeImpresoras = async () => {
    return await ConectorPluginV3.obtenerImpresoras();
}
const URLPlugin = "http://localhost:8000"
const $editarImpresoraVentas = document.querySelector("#editarImpresoraVentas");
const $editarImpresoraCaja = document.querySelector("#editarImpresoraCaja");
const $editarImpresoraAlmacen = document.querySelector("#editarImpresoraAlmacen");
const $editarImpresoraDevoluciones = document.querySelector("#editarImpresoraDevoluciones");
const $editarImpresoraCompras = document.querySelector("#editarImpresoraCompras");
const $editarImpresoraCotizaciones = document.querySelector("#editarImpresoraCotizaciones");
const $editarImpresoraGarantias = document.querySelector("#editarImpresoraGarantias");

const init = async () => {
    const impresoras = await ConectorPluginV3.obtenerImpresoras(URLPlugin);
    for (const impresora of impresoras) {
        $editarImpresoraVentas.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $editarImpresoraCaja.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $editarImpresoraAlmacen.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $editarImpresoraDevoluciones.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $editarImpresoraCompras.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $editarImpresoraCotizaciones.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));

        $editarImpresoraGarantias.appendChild(Object.assign(document.createElement("option"), {
            value: impresora,
            text: impresora,
        }));



    }

}


init();

});




	 /*=============================================
ELIMINAR USUARIO
=============================================*/
$(document).on("click", ".btnEliminarComputadora", function(){

  var id_computadora = $(this).attr("id_computadora");

  Swal.fire({
      title: 'Estas seguro?',
      text: "Quieres eliminar esta compuradora?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=lista-computadoras&id_computadora="+id_computadora;

  }

})

})










function validarCodigoExistenteCrear() {


    var codigo = $("#nuevoCodigo").val();


    var datos = new FormData();
    datos.append("validarCodigo", codigo);

    $.ajax({
        async: false,
        url:"ajax/computadoras.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            console.log(respuesta);


            if(respuesta[0] === undefined){

                validar_codigo_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){


                $("#nuevoCodigo").parent().after(Swal.fire({
                    icon: 'error',
                    title: 'Este código ya existe',
                    showConfirmButton: false,
                    timer: 2000
                }));

                //$("#nuevaComputadora").val("");
                
                validar_codigo_existente_crear = 0;

            }

        }

    });

    return validar_codigo_existente_crear;

}





/*=============================================
VALIDACIONES PARA LA CREACION
=============================================*/
function validarCodigoVacioCrear() {

    var codigo = $("#nuevoCodigo").val();

    if(codigo === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el código de la computadora',
            showConfirmButton: false,
            timer: 2000
        });

        $("#nuevoCodigo").focus();
        
        
        return 0;
        
        
    }else{

        return 1;
    }
    
    
    
}













function validarComputadoraExistenteCrear() {


    var computadora = $("#nuevaComputadora").val();


    var datos = new FormData();
    datos.append("validarComputadora", computadora);

    $.ajax({
        async: false,
        url:"ajax/computadoras.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            console.log(respuesta);


            if(respuesta[0] === undefined){

                validar_computadora_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){


                $("#nuevaComputadora").parent().after(Swal.fire({
                    icon: 'error',
                    title: 'Esta computadora ya existe',
                    showConfirmButton: false,
                    timer: 2000
                }));

                //$("#nuevaComputadora").val("");
                
                validar_computadora_existente_crear = 0;

            }

        }

    });

    return validar_computadora_existente_crear;

}





/*=============================================
VALIDACIONES PARA LA CREACION
=============================================*/
function validarComputadoraVaciaCrear() {

    var computadora = $("#nuevaComputadora").val();

    if(computadora === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir un nombre para la computadora',
            showConfirmButton: false,
            timer: 2000
        });

        $("#nuevaComputadora").focus();
        
        
        return 0;
        
        
    }else{

        return 1;
    }
    
    
    
}













/*=============================================
VALIDACIONES PARA LA EDICION
=============================================*/

function validarCodigoVacioEditar() {

    var codigo_actual = $("#editarCodigo").attr("codigoActual");
    
    if($("#editarCodigo").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir el código de la computadora',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarCodigo").val(codigo_actual);
        
        return 0;
        
    }else{

        return 1;
        
    }
    
    
    
}










function validarCodigoExistenteEditar() {
    var codigo = $("#editarCodigo").val();
    var codigo_actual = $("#editarCodigo").attr("codigoActual");

    if(codigo == codigo_actual){
        return 1;
    }
    else if(codigo !== codigo_actual){
        var datos = new FormData();
        datos.append("validarCodigo", codigo);

        $.ajax({
            url:"ajax/computadoras.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            async : false,
            dataType: "json",
            success:function(respuesta){

                if(respuesta[0] === undefined){

                    validar_codigo_existente_editar = 1;

                }

                else if(respuesta[0] !== undefined){



                    $("#editarCodigo").parent().after(Swal.fire({
                        icon: 'error',
                        title: 'Ese código ya existe',
                        showConfirmButton: false,
                        timer: 2000
                    }));

                    $("#editarCodigo").val(codigo_actual);

                    validar_codigo_existente_editar = 0;

                }

            }

        });

        return validar_codigo_existente_editar;
    }

}










function validarComputadoraVaciaEditar() {

    var computadora_actual = $("#editarComputadora").attr("computadoraActual");
    
    if($("#editarComputadora").val() === ""){

        Swal.fire({
            icon: 'error',
            title: 'Debe introducir un nombre para la computadora',
            showConfirmButton: false,
            timer: 2000
        });
        
        $("#editarComputadora").val(computadora_actual);
        
        return 0;
        
    }else{

        return 1;
        
    }
    
    
    
}










function validarComputadoraExistenteEditar() {
    var computadora = $("#editarComputadora").val();
    var computadora_actual = $("#editarComputadora").attr("computadoraActual");

    if(computadora == computadora_actual){
        return 1;
    }
    else if(computadora !== computadora_actual){
        var datos = new FormData();
        datos.append("validarComputadora", computadora);

        $.ajax({
            url:"ajax/computadoras.ajax.php",
            method:"POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            async : false,
            dataType: "json",
            success:function(respuesta){

                if(respuesta[0] === undefined){

                    validar_computadora_existente_editar = 1;

                }

                else if(respuesta[0] !== undefined){



                    $("#editarComputadora").parent().after(Swal.fire({
                        icon: 'error',
                        title: 'Esta computadora ya existe',
                        showConfirmButton: false,
                        timer: 2000
                    }));

                    $("#editarComputadora").val(computadora_actual);

                    validar_computadora_existente_editar = 0;

                }

            }

        });

        return validar_computadora_existente_editar;
    }

}









$(document).on("click", "#btnCrearComputadora", function(){

    $(this).blur();

    validar_computadora_existente_crear = validarComputadoraExistenteCrear();
    //alert("existente: "+validar_computadora_existente_crear);

    validar_computadora_vacia_crear = validarComputadoraVaciaCrear();
    //alert("vacio: "+validar_computadora_vacia_crear);

    validar_codigo_existente_crear = validarCodigoExistenteCrear();
    //alert("existente: "+validar_codigo_existente_crear);

    validar_codigo_vacia_crear = validarCodigoVacioCrear();
    //alert("vacio: "+validar_codigo_vacia_crear);

    if(validar_computadora_existente_crear !== 0 &&
        validar_computadora_vacia_crear !== 0 &&
        validar_codigo_existente_crear !== 0 &&
        validar_codigo_vacia_crear !== 0){

        document.forms["formularioCrearComputadora"].submit();
}

});







$(document).on("click", "#btnEditarComputadora", function(){

     $(this).blur();

    validar_computadora_existente_editar = validarComputadoraExistenteEditar();
    validar_computadora_vacia_editar = validarComputadoraVaciaEditar();
    validar_codigo_existente_editar = validarCodigoExistenteEditar();
    validar_codigo_vacio_editar = validarCodigoVacioEditar();
    

    if(validar_computadora_existente_editar !== 0 &&
        validar_computadora_vacia_editar  !== 0 &&
        validar_codigo_existente_editar !== 0 &&
        validar_codigo_vacio_editar  !== 0){



        document.forms["formularioEditarComputadora"].submit();
}

});



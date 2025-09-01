function activaTablaInventarios() {

  $("#tablaInventarios").DataTable({
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










function activaTablaAnaquelesInventario() {

  $("#tablaAnaquelesInventario").DataTable({
    stateSave: true,
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



$(document).ready(function () {
  activaTablaInventarios();
});








//stateSave: true,     se pone entre el DataTable({ y el "language"

function activaTablaProductosAnaquel() {

  $("#tablaProductosAnaquel").DataTable({
    stateSave: true,
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
    "searching": false,
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false,
    order: [[1, 'asc']],
  });
}










function activaTablaParticipantesInventario() {

  $("#tablaParticipantesInventario").DataTable({
    "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "",
      "sInfoEmpty":      "",
      "sInfoFiltered":   "",
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
    "searching": false,
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false,
    order: [[0, 'asc']],
  });
}










function activaTablaResponsablesInventario() {

  $("#tablaResponsablesInventario").DataTable({
    "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "",
      "sInfoEmpty":      "",
      "sInfoFiltered":   "",
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
    "searching": false,
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false,
    order: [[0, 'asc']],
  });
}






function activaTablaMovimientosInventario() {

  $("#tablaMovimientosInventario").DataTable({
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
    order: [[0, 'asc']],
  });
}






function activaSelectResponsablesInventario() {
  $('.duallistboxResponsablesInventario').bootstrapDualListbox({
    selectorMinimalHeight: '200',
    infoText:'Tiene {0} Responsables',
    infoTextEmpty : 'No hay Responsables',
    infoTextFiltered : '<span class="label label-warning">Buscar Responsable</span> {0} from {1}',
  });
}






$(document).on("change", "#id_sucursal", function(){

  document.getElementById("incrustarSelectResponsablesInventarios").innerHTML = "";

  var id_sucursal = $(this).val();

  var datos =  {"id_sucursal": id_sucursal};


  $.ajax({
    data:datos,
    type: 'POST',
    url: 'vistas/modulos/selects/selectResponsablesInventarios.php',
    success: function(data) {


      document.getElementById("incrustarSelectResponsablesInventarios").innerHTML = data;

      activaSelectResponsablesInventario();
    }
  });

  /*$.ajax({
        url: 'vistas/modulos/selects/selectParticipantesInventarios.php',
        success: function(data) {

        document.getElementById("incrustarSelectParticipantesInventarios").innerHTML = data;
        }
        });*/
});







$(document).on("click", "#btnAgregarNuevoInventario", function(){

  $("#modalCrearInventario").modal('show');

  $("#id_sucursal").change();

  /*$.ajax({
        url: 'vistas/modulos/selects/selectParticipantesInventarios.php',
        success: function(data) {

        document.getElementById("incrustarSelectParticipantesInventarios").innerHTML = data;
        }
        });*/
});




function validarSucursalVacia() {
  if($("#id_sucursal").val() === ""){

    Swal.fire({
      icon: 'error',
      title: 'Debe seleccionar una sucursal',
      showConfirmButton: false,
      timer: 2000
    });

    validar_sucursal_vacia = 0;

    return validar_sucursal_vacia;


  }else{

    validar_sucursal_vacia = 1;
    return validar_sucursal_vacia;

  }

}










function validarParticipantesVacios() {

  var count2 = $("#nuevosParticipantes :selected").length;


  if(count2 == 0){

    Swal.fire({
      icon: 'error',
      title: 'Debe seleccionar almenos un participante',
      showConfirmButton: false,
      timer: 2000
    });

    validar_participantes_vacios = 0;

    return validar_participantes_vacios;


  }else{

    validar_participantes_vacios = 1;
    return validar_participantes_vacios;

  }

}




function validarResponsablesInventario() {

  var count = $("#nuevosResponsablesInventario :selected").length;


  if(count == 0){

    Swal.fire({
      icon: 'error',
      title: 'Debe seleccionar almenos un Responsable',
      showConfirmButton: false,
      timer: 2000
    });

    validar_responsables_inventario = 0;

    return validar_responsables_inventario;

  }else{
    if(count >= 4){
      Swal.fire({
        icon: 'error',
        title: 'Solo puede seleccionar hasta 3 responsables',
        showConfirmButton: false,
        timer: 2000
      });

      validar_responsables_inventario = 0;

      return validar_responsables_inventario;
    }else{
      validar_responsables_inventario = 1;

      return validar_responsables_inventario;
    }
  }



}





$(document).on("click", "#btnCrearInventario", function(){

  validar_participantes_vacios = validarParticipantesVacios();
  validar_responsables_inventario = validarResponsablesInventario();
  validar_sucursal_vacia = validarSucursalVacia();


  if(validar_sucursal_vacia !== 0 &&
    validar_responsables_inventario  !== 0 && 
    validar_participantes_vacios  !== 0){


    var nombre_sucursal = $("#id_sucursal>option:selected").text();

  Swal.fire({
    title: 'Estas segur@?',
    text: "Quieres crear un nuevo inventario?",
    footer: "Recuerda que serás responsable de este movimiento",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then(function(result){

    if(result.value){

      document.forms["formularioCrearInventario"].submit();

    }
    
  });
}

});









function refrescarTablaAnaquelesInventario(id_inventario) {

  document.getElementById("incrustarTablaAnaquelesInventario").innerHTML = "";

  var datos =  {"id_inventario": id_inventario};


  $.ajax({
    data:datos,
    type: 'POST',
    url: 'vistas/modulos/consultas/consultaAnaquelesInventario.php',
    success: function(data) {

      document.getElementById("incrustarTablaAnaquelesInventario").innerHTML = data;
      activaTablaAnaquelesInventario();
    }
  });

}









$(document).on("click", ".btnVerAnaquelesInventario", function(){

 var id_inventario = $(this).attr("id_inventario");

 $("#modalVerAnaquelesInventario").modal("show");

 refrescarTablaAnaquelesInventario(id_inventario);

});









$(document).on("click", ".btnVerProductosAnaquel", function(){

  $("#modalVerProductosAnaquel").modal("show");

  document.getElementById("incrustarTablaProductosAnaquel").innerHTML = "";
  var id_anaquel_inventario = $(this).attr("id_anaquel_inventario");
        /*var id_inventario = $(this).attr("id_inventario");
        var anaquel = $(this).attr("anaquel");*/

  $("#id_anaquel_inventario").val(id_anaquel_inventario);
        /*$("#id_inventario").val(id_inventario);
        $("#anaquel").val(anaquel);


        $("#textoAnaquel").text(anaquel);*/


  var datos =  {"id_anaquel_inventario": id_anaquel_inventario};


  $.ajax({
    data:datos,
    type: 'POST',
    url: 'vistas/modulos/consultas/consultaProductosAnaquel.php',
    success: function(data) {

      document.getElementById("incrustarTablaProductosAnaquel").innerHTML = data;
      activaTablaProductosAnaquel();
    }
  });

});









$(document).on("click", ".btnAsignarAnaquelInventario", function(){

  var id_anaquel_inventario = $(this).attr("id_anaquel_inventario");

  var id_inventario = $(this).attr("id_inventario");


  Swal.fire({
    title: 'Estas segur@?',
    text: "Quieres tomar este anaquel?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then(function(result){

    if(result.value){





     var datos2 = new FormData();
     datos2.append("asignarAnaquelInventario", id_anaquel_inventario);


     $.ajax({
      url: "ajax/anaqueles-inventarios.ajax.php",
      method: "POST",
      data: datos2,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuestaAsignarAnaquel){


        respuestaAsignarAnaquel = Number(respuestaAsignarAnaquel);


        if(respuestaAsignarAnaquel == 1){


          Swal.fire({
            icon: 'success',
            title: 'Se le ha asignado con éxito el anaquel',
            showConfirmButton: false,
            timer: 2500
          }).then(function(result){

            refrescarTablaAnaquelesInventario(id_inventario);

          });

          
        }else if(respuestaAsignarAnaquel == 0){

         Swal.fire({
          icon: 'error',
          title: 'Error: Este anaquel ya fue asignado',
          showConfirmButton: true
        }).then(function(result){

          refrescarTablaAnaquelesInventario(id_inventario);

        });

      }else if(respuestaAsignarAnaquel == 2){

       Swal.fire({
        icon: 'error',
        title: 'No se ha podido asignar el anaquel',
        showConfirmButton: true
      }).then(function(result){

        refrescarTablaAnaquelesInventario(id_inventario);

      });
    }else{
      Swal.fire({
        icon: 'warning',
        title: 'No puedes asignarte otro anaquel',
        text: 'Primero termina el que tienes abierto y cierralo',
        showConfirmButton: true
      }).then(function(result){

        refrescarTablaAnaquelesInventario(id_inventario);

      });
    }
    }//RESPUESTA DEL AJAX DE LA RESPUESTA DE ASIGNACION

  });//AJAX QUE TRAE LA RESPUESTA DE LA ASIGNACION




      }//EN CASO DE QUE EL USUARIO HAYA SELECCIONADO QUE SI QUIERE ASIGNARSE EL ANAQUEL

    });//ALERT QUE VERIFICA SI SE QUIERE ASIGNAR ANAQUEL



});










$(document).on("click", ".btnCerrarAnaquel", function(){

  var id_inventario = $(this).attr("id_inventario");
  var id_anaquel_inventario = $(this).attr("id_anaquel_inventario");

  Swal.fire({
    title: 'Estas segur@?',
    text: "Quieres cerrar este anaquel?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then(function(result){

    if(result.value){





     var datos3 = new FormData();
     datos3.append("cerrarAnaquelInventario", id_anaquel_inventario);


     $.ajax({
      url: "ajax/anaqueles-inventarios.ajax.php",
      method: "POST",
      data: datos3,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuestaCerrarAnaquelInventario){

        console.log(respuestaCerrarAnaquelInventario);

        respuestaCerrarAnaquelInventario = Number(respuestaCerrarAnaquelInventario);

        if(respuestaCerrarAnaquelInventario == 0){


          Swal.fire({
            icon: 'success',
            title: 'El anaquel se ha cerrado con éxito',
            showConfirmButton: false,
            timer: 2500
          }).then(function(result){

            refrescarTablaAnaquelesInventario(id_inventario);
          });

          
        }else if(respuestaCerrarAnaquelInventario == 3){

         Swal.fire({
          icon: 'warning',
          title: 'Aun te hace falta agregar cantidades a los productos de este anaquel',
          showConfirmButton: true
        }).then(function(result){

          refrescarTablaAnaquelesInventario(id_inventario);
        });
      }//TERMINA EL IF 3
      else if(respuestaCerrarAnaquelInventario == 2){

       Swal.fire({
        icon: 'error',
        title: 'Este anaquel ya fue cerrado',
        showConfirmButton: true
      }).then(function(result){

        refrescarTablaAnaquelesInventario(id_inventario);
      });
      }//TERMINA EL ELSE IF 2
      else if(respuestaCerrarAnaquelInventario == 1){

       Swal.fire({
        icon: 'success',
        title: 'El anaquel fue cerrado con éxito',
        showConfirmButton: true
      }).then(function(result){

        refrescarTablaAnaquelesInventario(id_inventario);
      });
      }//TERMINA EL ELSE IF 1
      else{

       Swal.fire({
        icon: 'error',
        title: 'Error: '+respuestaCerrarAnaquelInventario,
        showConfirmButton: true
      }).then(function(result){

        refrescarTablaAnaquelesInventario(id_inventario);
      });
      }//TERMINA EL ELSE
    }

  });




      }//se confirma el cerrado

    });



});










$(document).on("click", ".btnIngresarCantidad", function(){

  var id_anaquel_inventario = $(this).attr("id_anaquel_inventario");

  $("#btnSubirCantidades").attr("id_anaquel_inventario", id_anaquel_inventario);

  var id_partida_inventario = $(this).attr("id_partida_inventario");

  $("#btnSubirCantidades").attr("id_partida_inventario", id_partida_inventario);

  var datos = new FormData();
  datos.append("traerPartidaInventario", id_partida_inventario); /*Aquí le decimos segun yo que busque los datos por
                      el atributo pos id_usuario el cual su valor será
                      id_usuario el cual le pasamos el id del usuario*/

  $.ajax({

    url:"ajax/partidas-inventarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(traerPartidaInventario){

      $("#modalCantidadesProducto").modal("show");

      //console.log(traerPartidaInventario);

      $("#cantidad1").val(traerPartidaInventario["cantidad1"]);
      $("#cantidad2").val(traerPartidaInventario["cantidad2"]);
      $("#cantidad3").val(traerPartidaInventario["cantidad3"]);
      $("#cantidad4").val(traerPartidaInventario["cantidad4"]);
      $("#cantidad5").val(traerPartidaInventario["cantidad5"]);

      var cantidad1 = traerPartidaInventario["cantidad1"];
      var cantidad2 = traerPartidaInventario["cantidad2"];
      var cantidad3 = traerPartidaInventario["cantidad3"];
      var cantidad4 = traerPartidaInventario["cantidad4"];
      var cantidad5 = traerPartidaInventario["cantidad5"];

      var existencias_encontradas = Number(cantidad1) + Number(cantidad2) + Number(cantidad3) + Number(cantidad4) + Number(cantidad5);

      $("#existenciasEncontradas").val(existencias_encontradas);

    }
  });





});










$(document).on("click", "#btnSubirCantidades", function(){


  var cantidad1 = $("#cantidad1").val();
  var cantidad2 = $("#cantidad2").val();
  var cantidad3 = $("#cantidad3").val();
  var cantidad4 = $("#cantidad4").val();
  var cantidad5 = $("#cantidad5").val();

  var id_partida_inventario = $("#btnSubirCantidades").attr("id_partida_inventario");


  var datos = new FormData();
  datos.append("ingresarCantidadEncontrada", id_partida_inventario);
  datos.append("cantidad1", cantidad1);
  datos.append("cantidad2", cantidad2);
  datos.append("cantidad3", cantidad3);
  datos.append("cantidad4", cantidad4);
  datos.append("cantidad5", cantidad5);


  $.ajax({
    url: "ajax/partidas-inventarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuestaAgregarCantidad){

      respuestaAgregarCantidad = Number(respuestaAgregarCantidad);

      if(respuestaAgregarCantidad == 1){


        Swal.fire({
          icon: 'success',
          title: 'La cantidad se ha agregado con éxito',
          showConfirmButton: false,
          timer: 2000
        }).then(function(result){
          $("#btnCerrarModalCantidadesProducto").trigger("click");
          document.getElementById("incrustarTablaProductosAnaquel").innerHTML = "";

          var id_anaquel_inventario = $("#btnSubirCantidades").attr("id_anaquel_inventario");


          var datos =  {"id_anaquel_inventario": id_anaquel_inventario};


          $.ajax({
            data:datos,
            type: 'POST',
            url: 'vistas/modulos/consultas/consultaProductosAnaquel.php',
            success: function(data) {

              document.getElementById("incrustarTablaProductosAnaquel").innerHTML = data;
              activaTablaProductosAnaquel();
            }
          });
        });


      }else{

        console.log(respuestaAgregarCantidad);

        $("#btnCerrarModalCantidadesProducto").trigger("click");

        Swal.fire({
          icon: 'error',
          title: 'Error',
          showConfirmButton: true
        });
      }
    }

  });
});













function sumarCantidadesEncontradas(){
  var cantidad1 = $("#cantidad1").val();
  var cantidad2 = $("#cantidad2").val();
  var cantidad3 = $("#cantidad3").val();
  var cantidad4 = $("#cantidad4").val();
  var cantidad5 = $("#cantidad5").val();

  var total_encontrado = Number(cantidad1) + Number(cantidad2) + Number(cantidad3) + Number(cantidad4) + Number(cantidad5);

  $("#existenciasEncontradas").val(total_encontrado);
}


$(document).on("keyup", "#cantidad1", function(){
  sumarCantidadesEncontradas();
});

$(document).on("keyup", "#cantidad2", function(){
  sumarCantidadesEncontradas();
});

$(document).on("keyup", "#cantidad3", function(){
  sumarCantidadesEncontradas();
});

$(document).on("keyup", "#cantidad4", function(){
  sumarCantidadesEncontradas();
});

$(document).on("keyup", "#cantidad5", function(){
  sumarCantidadesEncontradas();
});






/*$(document).on("click", ".btnIngresarCantidad", function(){

var id_partida_inventario = $(this).attr("id_partida_inventario");

                        Swal.fire({
  title: 'Inserte la nueva cantidad',
  input: 'number',
  inputAttributes: {
    pattern: "[0-9]{10}"
  },
  inputValidator: (value) => {
        if (value == "" || value == null) {
            return 'No ha especificado la catidad encontrada'
        }
    },
  showCancelButton: true,
  confirmButtonText: 'confirmar',
  showLoaderOnConfirm: true,
  preConfirm: (cantidad) => {
//alert(cantidad);

         var datos = new FormData();
         datos.append("id_partida_inventario", id_partida_inventario);
        datos.append("cantidad_encontrada", cantidad);


  $.ajax({
    url: "ajax/partidas-inventarios.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      success: function(respuestaAgregarCantidad){

        console.log(respuestaAgregarCantidad);

        respuestaAgregarCantidad = Number(respuestaAgregarCantidad);

        if(respuestaAgregarCantidad == 1){
          

          Swal.fire({
              icon: 'success',
              title: 'La cantidad se ha agregado con éxito',
              showConfirmButton: false,
              timer: 2000
            }).then(function(result){
            document.getElementById("incrustarTablaProductosAnaquel").innerHTML = "";

        var id_inventario = $("#id_inventario").val();
        var anaquel = $("#anaquel").val();


var datos =  {"id_inventario": id_inventario, "anaquel": anaquel};


$.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaProductosAnaquel.php',
        success: function(data) {

        document.getElementById("incrustarTablaProductosAnaquel").innerHTML = data;
        activaTablaProductosAnaquel();
        }
        });
            });

          
        }else{
          
        Swal.fire({
              icon: 'error',
              title: 'Error',
              showConfirmButton: true
            });
      }
    }

  });
    
  },
  allowOutsideClick: () => !Swal.isLoading()
});
                

      
        


});



*/






$(document).on("click", ".btnVerParticipantesInventario", function(){

  $("#modalVerParticipantesInventario").modal("show");

  document.getElementById("incrustarTablaParticipantesInventario").innerHTML = "";

  var id_inventario = $(this).attr("id_inventario");

  var datos =  {"id_inventario": id_inventario};


  $.ajax({
    data:datos,
    type: 'POST',
    url: 'vistas/modulos/consultas/consultaParticipantesInventario.php',
    success: function(data) {

      document.getElementById("incrustarTablaParticipantesInventario").innerHTML = data;
      activaTablaParticipantesInventario();
      activaTablaResponsablesInventario();
    }
  });

});










$(document).on("click", ".btnConfirmarInventario", function(){

 var id_inventario = $(this).attr("id_inventario");

 var datos = new FormData();
 datos.append("verificar_inventario", id_inventario);

 $.ajax({
  url: "ajax/inventarios.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  success: function(respuestaVerificarInventario){

    respuestaVerificarInventario = parseInt(respuestaVerificarInventario);

    if(respuestaVerificarInventario == 0){


      $("#modalConfirmarInventario").modal("show");

      $("#confirmarInventario").val(id_inventario);

      setTimeout(function() { 
        $("#btnNoConfirmarInventario").focus();
      }, 150);

    }else{
      Swal.fire({
        icon: 'error',
        title: 'Aun hay productos sin llenar',
        showConfirmButton: false,
        timer: 2500
      });
        }//VERIFICAR QUE TODOS LOS ANAQUELES HAYAN SIDO LLENADOS
      }//RESPUESTA DEL AJAX QUE REVISA EL INVENTARIO

    });//AJAX QUE REVISA EL INVENTARIO

});










$(document).on("click", ".btnDescargarPDFPreviaInventario", function(){

 var id_inventario = $(this).attr("id_inventario");

 window.open("extensiones/tcpdf/examples/pdf-previa-hoja-inventario.php?id_inventario="+id_inventario, "_blank");


/*var datos = new FormData();
         datos.append("verificar_inventario", id_inventario);

  $.ajax({
    url: "ajax/inventarios.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      success: function(respuestaVerificarInventario){

        respuestaVerificarInventario = parseInt(respuestaVerificarInventario);

        if(respuestaVerificarInventario == 0){

          window.open("extensiones/tcpdf/examples/pdf-previa-hoja-inventario.php?id_inventario="+id_inventario, "_blank");

        }else{
          Swal.fire({
              icon: 'error',
              title: 'Aun hay productos sin llenar',
              showConfirmButton: false,
              timer: 2500
            });
        }
      }

    });*/

});










//SUBIR ARCHIVO AL INVENTARIO
$(document).on("click", ".btnSubirArchivoInventario", function(){


  var id_inventario = $(this).attr("id_inventario");

  $('#modalSubirArchivoInventario').modal('show');

  $("#mostrarIdInventario").val(id_inventario);

  $("#btnSubirArchivoInventario").attr("id_inventario",id_inventario);



});










$(document).on("click", "#btnSubirArchivoInventario", function(){

  var id_inventario = $(this).attr("id_inventario");

  Swal.fire({
    title: 'Estas segur@?',
    text: "Quieres subir este archivo al inventario no."+id_inventario+"?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si'
  }).then(function(result){

    if(result.value){

      document.forms["formularioSubirArchivoInventario"].submit();

    }

                  });//SWAL.FIRE DE CONFIRMACION


});










/*$(document).on("click", ".btnVerMovimientosInventario", function(){

  $("#modalVerMovimientosInventario").modal("show");

        document.getElementById("incrustarTablaMovimientosInventario").innerHTML = "";

        var id_inventario = $(this).attr("id_inventario");

var datos =  {"id_inventario": id_inventario};


$.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaMovimientosInventario.php',
        success: function(data) {

        document.getElementById("incrustarTablaMovimientosInventario").innerHTML = data;
        activaTablaMovimientosInventario();
        }
        });

});*/













$(document).on("click", ".btnVerMovimientosInventario", function(){
  $("#modalVerMovimientosInventario").modal("show");

  document.getElementById("incrustarTablaMovimientosInventario").innerHTML = "";

  var id_inventario = $(this).attr("id_inventario");

  var datos =  {"id_inventario": id_inventario};


  $.ajax({
    data:datos,
    type: 'POST',
    url: 'vistas/modulos/consultas/consultaMovimientosInventario.php',
    success: function(data) {

      document.getElementById("incrustarTablaMovimientosInventario").innerHTML = data;

      $("#tablaMovimientosInventario").DataTable({
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
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "sAjaxSource": "ServerSide/serversideMovimientosInventario.php",
        lengthMenu: [
          [ 10, 25, 50, 100, 500, 1000, -1 ],
          [ '10', '25', '50', '100', '500', '1000', 'Mostrar todos los' ]
        ],
        order: [[3, 'asc'],[ 1, 'asc' ]],
        "dom": 'Blfrtip',
        "buttons": ['excel', 'pdf'],
      }); 


    }
  });




});
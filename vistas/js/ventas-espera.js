

$("#tablaVentasEspera").DataTable({
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
        order: [[0, 'desc']],
    });
  


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


/*=============================================
CANCELAR UNA VENTA
=============================================*/
$(document).on("click", ".btnCancelarVenta", function(){

    var id_venta = $(this).attr("id_venta");
    Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres cancelar la venta no."+id_venta+" ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){
        
      var datos = new FormData();
	datos.append("id_venta_cancelacion", id_venta);
	
	$.ajax({
		url: "ajax/ventas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	success: function(respuesta){
     	    
     	if(respuesta == "ok"){
     	    Swal.fire({
					icon: 'success',
					title: 'La venta ha sido cancelada con exito',
					showConfirmButton: false,
					timer: 2000
					}).then(function(result){
						
						location.reload();

					});
					
     	}else{
     	    Swal.fire({
					icon: 'error',
					title: 'No se ha podido cancelar la venta',
					showConfirmButton: false,
					timer: 2000
					});
     	}
     	
     
     	}

	});

    }

  })

})










/*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnCancelarVenta2", function(){
            
            var id_venta = $(this).attr("id_venta");

            var nombre_formulario = "formularioCancelarVenta"+id_venta;

                         Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres cancelar la venta no."+id_venta,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                      document.forms[nombre_formulario].submit();

                    }

                  })
        })










/*=============================================
CANCELAR UNA VENTA
=============================================*/
$(document).on("click", "#btnCancelarVentas", function(){

    Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres cancelar todas las ventas ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){
        
      document.forms["formularioCancelarVentas"].submit();

    }

  });

});



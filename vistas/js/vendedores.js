function activaTablaVendedores() {

                $("#tablaVendedores").DataTable({
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
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
        order: [[0, 'asc']],
    });
  }



function buscarAhoraVendedores(buscarVendedores) {
    var busqueda_anterior = $("#buscarVendedores").attr("busqueda_anterior");

    document.getElementById("incrustarTablaVendedores").innerHTML = "";

        var parametros = {"buscarVendedores":buscarVendedores};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorVendedores.php',
        success: function(data) {
        document.getElementById("incrustarTablaVendedores").innerHTML = data;

        activaTablaVendedores();
        }
        });
    
        }






$(document).on("click", "#mostrarCodigo", function(){

           var cambio = document.getElementById("nuevoCodigo");
           if (cambio.type == "password") {
               cambio.type = "text";
               $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
           } else {
               cambio.type = "password";
               $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
           }
       });


/*ACTIVAR O DESACTIVAR USUARIO*/
$(document).on("click", ".btnActivarVendedor", function(){

	var id_vendedor = $(this).attr("id_vendedor");
	var estadoVendedor = $(this).attr("estadoVendedor")

	var datos = new FormData();

	datos.append("valor2", id_vendedor);
	datos.append("cambiar_estatus", estadoVendedor);
    datos.append("columna1", "estatus");
    datos.append("columna2", "id_vendedor");

	$.ajax({

		url:"ajax/vendedores.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

			console.log(respuesta);

		}
	});

	if(estadoVendedor == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('DESACTIVADO');
  		$(this).attr('estadoVendedor',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('ACTIVADO');
  		$(this).attr('estadoVendedor',0);

  	}
});





function generadorCodigoVendedor(plength){
  var chars = "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  var codigo = '';    
    for(i=0; i<plength; i++){
      codigo+=chars.charAt(Math.floor(Math.random()*chars.length));
    }
  
  return codigo;
}




function generaCodigo() {

    /*var nombres = $("#nuevosNombres").val();
    var apellido_p = $("#nuevoApellidoP").val();
    var apellido_m = $("#nuevoApellidoM").val();

    ex_nombres = nombres.substring(0,2);
    ex_apellido_p = apellido_p.substring(0,2);
    ex_apellido_m = apellido_m.substring(0,2);*/

    

    codigo = generadorCodigoVendedor(40);

    $("#nuevoCodigo").val(codigo);
    
    validar_codigo_existente_crear = validarCodigoExistenteCrear();
    

}



   /*=============================================
    VERIFICAR SI EL CODIGO YA EXISTE
    =============================================*/     
        
    function validarCodigoExistenteCrear() {
        
        
        var codigo = $("#nuevoCodigo").val();

        var datos = new FormData();
        datos.append("mostrar_vendedor", codigo);
        datos.append("columna", "codigo");

     $.ajax({
        async: false,
        url:"ajax/vendedores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_codigo_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevoCodigo").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'El código generado ya existe',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                //$("#nuevoCodigo").val("");
                
                validar_codigo_existente_crear = 0;

            }

        }

    })
    
    return validar_codigo_existente_crear;
    }
    
    
    
    

/*=============================================
CUANDO EL CODIGO CAMBIE VERIFICAR SI YA EXISTE
=============================================*/

$(document).on("change", "#nuevosNombres", function(){
    
    generaCodigo();
    

});

$(document).on("change", "#nuevoApellidoP", function(){
    
    generaCodigo();
    

});

$(document).on("change", "#nuevoApellidoM", function(){
    
    generaCodigo();
    

});



/*=============================================
VALIDACIONES PARA LA CREACION
=============================================*/
function validarCodigoVacioCrear() {
if($("#nuevoCodigo").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Código vacio',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_codigo_vacio_crear = 0;
        
        return validar_codigo_vacio_crear;
        
        
    }else{
    
    validar_codigo_vacio_crear = 1;
    return validar_codigo_vacio_crear;
    }
    
    
    
}





function validarNombresVaciosCrear() {
    if($("#nuevosNombres").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el o los nombres del vendedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_nombres_vacios_crear = 0;
        
        return validar_nombres_vacios_crear;
        
        
    }else{
        
        validar_nombres_vacios_crear = 1;
        return validar_nombres_vacios_crear;
        
    }
    
}





function validarApellidoPVacioCrear() {
    if($("#nuevoApellidoP").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el apellido paterno del vendedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_apellido_p_vacio_crear = 0;
        
        return validar_apellido_p_vacio_crear;
        
        
    }else{
        
        validar_apellido_p_vacio_crear = 1;
        return validar_apellido_p_vacio_crear;
        
    }
    
}





function validarApellidoMVacioCrear() {
    if($("#nuevoApellidoM").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el apellido materno del vendedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_apellido_m_vacio_crear = 0;
        
        return validar_apellido_m_vacio_crear;
        
        
    }else{
        
        validar_apellido_m_vacio_crear = 1;
        return validar_apellido_m_vacio_crear;
        
    }
    
}






$(document).on("click", "#btnCrearVendedor", function(){

    validar_codigo_existente_crear = validarCodigoExistenteCrear();
    validar_codigo_vacio_crear = validarCodigoVacioCrear();
    validar_apellido_m_vacio_crear = validarApellidoMVacioCrear();
    validar_apellido_p_vacio_crear = validarApellidoPVacioCrear();
    validar_nombres_vacios_crear = validarNombresVaciosCrear();
    
    

    if(validar_codigo_existente_crear !== 0 &&
    validar_codigo_vacio_crear  !== 0 && 
    validar_nombres_vacios_crear  !== 0 && 
    validar_apellido_p_vacio_crear  !== 0 && 
    validar_apellido_m_vacio_crear  !== 0){

        
    
        document.forms["formularioCrearVendedor"].submit();
    }

});


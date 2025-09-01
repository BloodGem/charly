function activaTablaUsuarios() {

                $("#tablaUsuarios").DataTable({
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




/*Editar usuario*/
$(document).on("click", ".btnEditarUsuario", function(){ /*Aqui le decimos que cuando se haga clic a boton que 
										tiene la clase brnEditarUsuario se ejecute el script*/

	var id_usuario = $(this).attr("id_usuario"); /*Aqui le decimos que la variable id_suario va a ser
													igual al atributo id_usuario el cual le asignamos
													el id del usuario*/

	var datos = new FormData();
	datos.append("id_usuario",id_usuario); /*Aquí le decimos segun yo que busque los datos por
											el atributo pos id_usuario el cual su valor será
											id_usuario el cual le pasamos el id del usuario*/

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
		    
		    $("#idUsuario").val(respuesta["id"]);

			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarNombre").attr("nombreActual",respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarUsuario").attr("usuarioActual",respuesta["usuario"]);
            $("#editarCodigo").val(respuesta["codigo"]);
			$("#editarIdGrupo").val(respuesta["id_grupo"]);
			
			$("#passwordActual").val(respuesta["password"]);


		}
	});


})





/*ACTIVAR O DESACTIVAR USUARIO*/
$(document).on("click", ".btnActivar", function(){

	var id_usuario = $(this).attr("id_usuario");
	var estadoUsuario = $(this).attr("estadoUsuario")

	var datos = new FormData();

	datos.append("activarId", id_usuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){

			

		}
	});

	if(estadoUsuario == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('DESACTIVADO');
  		$(this).attr('estadoUsuario',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('ACTIVADO');
  		$(this).attr('estadoUsuario',0);

  	}
});














function generadorCodigoUsuario(plength){
  var chars = "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  var codigo = '';    
    for(i=0; i<plength; i++){
      codigo+=chars.charAt(Math.floor(Math.random()*chars.length));
    }
  
  return codigo;
}






function generaCodigo() {

    codigo = generadorCodigoUsuario(40);

    $("#nuevoCodigo").val(codigo);
    
    validar_codigo_existente_crear = validarCodigoExistenteCrear();
    

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





function generaCodigo2() {
    
    codigo = generadorCodigoUsuario(40);

    $("#editarCodigo").val(codigo);
    
    validar_codigo_existente_crear = validarCodigoExistenteCrear();
    

}






$(document).on("click", "#mostrarCodigo2", function(){

           var cambio = document.getElementById("editarCodigo");
           if (cambio.type == "password") {
               cambio.type = "text";
               $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
           } else {
               cambio.type = "password";
               $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
           }
       });





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





















	 /*=============================================
ELIMINAR USUARIO
=============================================*/
$(document).on("click", ".btnEliminarUsuario", function(){

  var id_usuario = $(this).attr("id_usuario");
  //var usuario = $(this).attr("usuario");

  Swal.fire({
  title: 'Estas seguro?',
  text: "Quieres eliminar este usuario?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=usuarios&id_usuario="+id_usuario;

    }

  })

})





function buscar_ahora(buscar) {

	var id_sucursal = $("#buscar").attr("id_sucursal");

    document.getElementById("incrustarTablaUsuarios").innerHTML = "";

        var parametros = {"buscar":buscar, "id_sucursal":id_sucursal};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscador.php',
        success: function(data) {
        document.getElementById("incrustarTablaUsuarios").innerHTML = data;

        activaTablaUsuarios();
        }
        });
        }
        
        
        
        
        






























   /*=============================================
    VERIFICAR SI LA FAMILIA EXISTE
    =============================================*/     
        
    function validarUsuarioExistenteCrear() {
        
        
        var usuario = $("#nuevoUsuario").val();

        var datos = new FormData();
        datos.append("validarUsuario", usuario);

     $.ajax({
        async: false,
        url:"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_usuario_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevoUsuario").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Este usuario ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#nuevoUsuario").val("");
                
                validar_usuario_existente_crear = 0;

            }

        }

    })
    
    return validar_usuario_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA FAMILIA EXISTE
    =============================================*/     
        
    function validarUsuarioExistenteEditar() {
        var usuario = $("#editarUsuario").val();
        var usuario_actual = $("#editarUsuario").attr("usuarioActual");

    if(usuario == usuario_actual){
        validar_usuario_existente_editar = 1;
        return validar_usuario_existente_editar;
    }
    else if(usuario !== usuario_actual){
        var datos = new FormData();
    datos.append("validarUsuario", usuario);

     $.ajax({
        url:"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_usuario_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                $("#editarUsuario").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Este usuario ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarUsuario").val(usuario_actual);
                
                validar_usuario_existente_editar = 0;

            }

        }

    })
    
    return validar_usuario_existente_editar;
    
    }
                
    }




        /*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADA
=============================================*/

/*$(document).on("change", "#nuevoUsuario", function(){
    
    validar_usuario_existente_crear = validarUsuarioExistenteCrear();
    

});*/



/*=============================================
VALIDACIONES PARA LA CREACION
=============================================*/
function validarUsuarioVacioCrear() {
if($("#nuevoUsuario").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre de usuario',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_usuario_vacio_crear = 0;
        
        return validar_usuario_vacio_crear;
        
        
    }else{
    
    validar_usuario_vacio_crear = 1;
    return validar_usuario_vacio_crear;
    }
    
    
    
}





function validarNombreVacioCrear() {
    if($("#nuevoNombre").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_nombre_vacio_crear = 0;
        
        return validar_nombre_vacio_crear;
        
        
    }else{
        
        validar_nombre_vacio_crear = 1;
        return validar_nombre_vacio_crear;
        
    }
    
}





function validarPasswordVacioCrear() {
    if($("#nuevoPassword").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una contraseña',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_password_vacio_crear = 0;
        
        return validar_password_vacio_crear;
        
        
    }else{
        
        validar_password_vacio_crear = 1;
        return validar_password_vacio_crear;
        
    }
    
}





function validarIdGrupoVacioCrear() {
    if($("#nuevoIdGrupo").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe seleccionar un grupo',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_id_grupo_vacio_crear = 0;
        
        return validar_id_grupo_vacio_crear;
        
        
    }else{
        
        validar_id_grupo_vacio_crear = 1;
        return validar_id_grupo_vacio_crear;
        
    }
    
}








/*=============================================
VALIDACIONES PARA LA EDICION
=============================================*/


function validarUsuarioVacioEditar() {
    
    var usuario_actual = $("#editarUsuario").attr("usuarioActual");
    
if($("#editarUsuario").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre de usuario',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarUsuario").val(usuario_actual);
        
        validar_usuario_vacio_editar = 0;
        
        return validar_usuario_vacio_editar;
        
    }else{
        validar_usuario_vacio_editar = 1;
        
        return validar_usuario_vacio_editar;
        
    }
    
    
    
}





function validarNombreVacioEditar() {
    
    var nombre_actual = $("#editarNombre").attr("nombreActual");
    
    if($("#editarNombre").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarNombre").val(nombre_actual);
        
        validar_nombre_vacio_editar = 0;
        
        return validar_nombre_vacio_editar;
        
        
    }else{
        
        validar_nombre_vacio_editar = 1;
        return validar_nombre_vacio_editar;
        
    }
    
}





function validarIdGrupoVacioEditar() {
    if($("#editarIdGrupo").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe seleccionar un grupo',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_id_grupo_vacio_editar = 0;
        
        return validar_id_grupo_vacio_editar;
        
        
    }else{
        
        validar_id_grupo_vacio_editar = 1;
        return validar_id_grupo_vacio_editar;
        
    }
    
}



$(document).on("click", "#btnCrearUsuario", function(){
    
    validar_id_grupo_vacio_crear = validarIdGrupoVacioCrear();
    validar_password_vacio_crear = validarPasswordVacioCrear();
    validar_nombre_vacio_crear = validarNombreVacioCrear();
    validar_usuario_existente_crear = validarUsuarioExistenteCrear();
    validar_usuario_vacio_crear = validarUsuarioVacioCrear();
    

    if(validar_usuario_existente_crear !== 0 &&
    validar_usuario_vacio_crear  !== 0 && 
    validar_nombre_vacio_crear  !== 0 && 
    validar_password_vacio_crear  !== 0 && 
    validar_id_grupo_vacio_crear  !== 0){
    
        document.forms["formularioCrearUsuario"].submit();
    }

});





/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADO
=============================================*/

/*$(document).on("change", "#editarUsuario", function(){
    
    validar_usuario_existente_editar = validarUsuarioExistenteEditar();

    
});*/


$(document).on("click", "#btnEditarUsuario", function(){
    
    validar_id_grupo_vacio_editar = validarIdGrupoVacioEditar();
    validar_nombre_vacio_editar = validarNombreVacioEditar();
    validar_usuario_existente_editar = validarUsuarioExistenteEditar();
    validar_usuario_vacio_editar = validarUsuarioVacioEditar();
    

    if(validar_usuario_existente_editar !== 0 &&
    validar_usuario_vacio_editar  !== 0 && 
    validar_nombre_vacio_editar  !== 0 &&
    validar_id_grupo_vacio_editar  !== 0){
    
    
    
    document.forms["formularioEditarUsuario"].submit();
}

});



/*=============================================
CARGAR LA TABLA DINÁMICA DE PROVEEDORES
=============================================*/

/*$.ajax({

  url: "ajax/datatable.proveedores.ajax.php",
  success:function(respuesta){
    
    console.log("respuesta", respuesta);

  }

})*/




/*=============================================
EDITAR PROVEEDOR
=============================================*/
$(document).on("click", ".btnEditarProveedor", function(){

  var id_proveedor = $(this).attr("id_proveedor");

  var datos = new FormData();
  datos.append("id_proveedor", id_proveedor);

  $.ajax({
    url: "ajax/proveedores.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){


        $("#id_proveedor").val(respuesta["id_proveedor"]);
        $("#editarNombre").val(respuesta["nombre"]);
        $("#editarNombre").attr("nombreActual",respuesta["nombre"]);
        $("#editarNombreComercial").val(respuesta["nombre_comercial"]);
        $("#editarNombreComercial").attr("nombreComercialActual",respuesta["nombre_comercial"]);
        $("#editarRfc").val(respuesta["rfc"]);
        $("#editarRfc").attr("rfcActual",respuesta["rfc"]);
        $("#editarContacto").val(respuesta["contacto"]);
        $("#editarContacto").attr("contactoActual",respuesta["contacto"]);
        $("#editarEmail").val(respuesta["email"]);
        $("#editarEmail").attr("emailActual",respuesta["email"]);
        $("#editarTelefono1").val(respuesta["telefono1"]);
        $("#editarTelefono1").attr("telefono1Actual",respuesta["telefono1"]);
        $("#editarTelefono2").val(respuesta["telefono2"]);
        $("#editarDireccion").val(respuesta["direccion"]);
        $("#editarNoInterior").val(respuesta["no_interior"]);
        $("#editarNoExterior").val(respuesta["no_exterior"]);
        $("#editarColonia").val(respuesta["colonia"]);
        $("#editarCodigoPostal").val(respuesta["codigo_postal"]);
        $("#editarCodigoPostal").attr("codigoPostalActual",respuesta["codigo_postal"]);
        $("#editarCiudad").val(respuesta["ciudad"]);
        $("#editarIdEstado").val(respuesta["id_estado"]);
        $("#editarDiaRevpag").val(respuesta["dia_revpag"]);
        $("#editarDiasCredito").val(respuesta["dias_credito"]);
        $("#editarLimiteCredito").val(respuesta["limite_credito"]);
        $("#editarDescuento").val(respuesta["descuento"]);
        $("#editarNoPrecio").val(respuesta["no_precio"]);
        
        


      }

  })


})

/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(document).on("click", ".btnEliminarProveedor", function(){

   var id_proveedor = $(this).attr("id_proveedor");

   Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar este proveedor?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=lista-proveedores&id_proveedor="+id_proveedor;

    }

  })

})





function buscarAhoraProveedores(buscarProveedores) {
    var busqueda_anterior = $("#buscarProveedores").attr("busqueda_anterior");

    if(busqueda_anterior ==  buscarProveedores){
    }else{
        var parametros = {"buscarProveedores":buscarProveedores};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorProveedores.php',
        success: function(data) {
        document.getElementById("incrustarTablaProveedores").innerHTML = data;
        $("#buscarProveedores").attr("busqueda_anterior", buscarProveedores);
        }
        });
    }
        }









        //CONTROLADOR FOCO

        $(document).keydown(function(event) {
    if (event.which === 27)
    {
        $("#buscarProveedores").val("");
        $("#buscarProveedores").focus();
        $("#buscarProveedores").attr("busqueda_anterior", "");
        document.getElementById("incrustarTablaProveedores").innerHTML = "";
    }
});

        $(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 66)
    {
        $("#buscarProveedores").val("");
        $("#buscarProveedores").focus();
        $("#buscarProveedores").attr("busqueda_anterior", "");
        document.getElementById("incrustarTablaProveedores").innerHTML = "";
    }
});




$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 38)
    {
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("btnEditarProveedor"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);


            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
        }else{

            setTimeout(function() { 

            //alert("si hay foco");


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            
            //alert("contador actual: "+contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);
            $(foco).removeClass('foco');

            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".btnEditarProveedor").addClass('foco').focus();

            //$(foco).focus();

            }, 100);
        }
        //alert('Ctrl + flecha abajo!');

    }
});


$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        //alert("foco "+foco);

        if(foco == null){
            const items = document.getElementsByClassName("btnEditarProveedor"); 

            var contador_actual = $(items[0]).attr("contador");

            contador_actual = parseInt(contador_actual);


            $(items[0]).addClass("foco");
            $(items[0]).focus();
            $(items[0]).parent().parent().parent().parent().children(".contador"+contador_actual).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");
            
        }else{

            setTimeout(function() { 

            //alert("si hay foco");


            var contador_actual = $(foco).attr("contador");

            contador_actual = parseInt(contador_actual);

            
            //alert("contador actual: "+contador_actual);

            var contador_mas = contador_actual + 1;

            var contador_menos = contador_actual - 1;

            //alert("contador mas: "+contador_mas);
            $(foco).removeClass('foco');

            $(foco).parent().parent().parent().parent().children(".contador"+contador_actual).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");

            $(foco).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".btnEditarProveedor").addClass('foco').focus();

            //$(foco).focus();

            }, 100);
        }
        //alert('Ctrl + flecha abajo!');

    }
});

$(document).on("focus", ".btnEditarProveedor", function(){

    var contador_actual = $(this).attr("contador");

    var contador_menos = parseInt(contador_actual) - 1;

    var contador_mas = parseInt(contador_actual) + 1;

    $(this).addClass('foco');

    $(this).parent().parent().parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");


    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).removeAttr("style");

    $(this).parent().parent().parent().parent().children(".contador"+contador_mas).children().children().children(".btnEditarProveedor").removeClass('foco');

    $(this).parent().parent().parent().parent().children(".contador"+contador_menos).children().children().children(".btnEditarProveedor").removeClass('foco');



});






/*=============================================
VALIDACIONES
=============================================*/



   /*=============================================
    VERIFICAR SI EL NOMBRE FISCAL EXISTE
    =============================================*/     
        
    function validarNombreExistenteCrear() {
        
        var nombre = $("#nuevoNombre").val();

        var datos = new FormData();
        datos.append("validarNombre", nombre);

     $.ajax({
        async: false,
        url:"ajax/proveedores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_nombre_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevoNombre").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta nombre físcal ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));
                
                $("#nuevoNombre").focus();
                
                validar_nombre_existente_crear = 0;

            }

        }

    })
    
    return validar_nombre_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI EL NOMBRE FISCAL EXISTE
    =============================================*/     
        
    function validarNombreExistenteEditar() {
        var nombre = $("#editarNombre").val();
        var nombre_actual = $("#editarNombre").attr("nombreActual");
        

    if(nombre === nombre_actual){
        
        validar_nombre_existente_editar = 1;
        return validar_nombre_existente_editar;
        
    }
    else if(nombre !== nombre_actual){
        
        var datos = new FormData();
        datos.append("validarNombre", nombre);

        $.ajax({
        url:"ajax/proveedores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                
                
                validar_nombre_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                $("#editarNombre").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta nombre físcal ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarNombre").focus();
                validar_nombre_existente_editar = 0;
                $("#editarNombre").attr("placeholder",nombre_actual);

            }

        }

    })
    
    return validar_nombre_existente_editar;
    
    }
                
    }
    
    
    
    
/*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoNombre", function(){
    
    validar_nombre_existente_crear = validarNombreExistenteCrear();
    

});




/*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarNombre", function(){
    
    validar_nombre_existente_editar = validarNombreExistenteEditar();
    

});
    
    
    
    
    
    
    
    /*=============================================
    VERIFICAR SI EL RFC YA EXISTE
    =============================================*/     
        
    function validarRfcExistenteCrear() {
        
        var rfc = $("#nuevoRfc").val();

        var datos = new FormData();
        datos.append("validarRfc", rfc);

     $.ajax({
        async: false,
        url:"ajax/proveedores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_rfc_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevoRfc").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Este RFC ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));
                
                $("#nuevoRfc").focus();
                
                validar_rfc_existente_crear = 0;

            }

        }

    })
    
    return validar_rfc_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA FAMILIA EXISTE
    =============================================*/     
        
    function validarRfcExistenteEditar() {
        var rfc = $("#editarRfc").val();
        var rfc_actual = $("#editarRfc").attr("rfcActual");
        

    if(rfc === rfc_actual){
        
        validar_rfc_existente_editar = 1;
        return validar_rfc_existente_editar;
        
    }
    else if(rfc !== rfc_actual){
        
        var datos = new FormData();
        datos.append("validarRfc", rfc);

        $.ajax({
        url:"ajax/proveedores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                
                
                validar_rfc_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                $("#editarRfc").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Este RFC ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarRfc").focus();
                validar_rfc_existente_editar = 0;
                $("#editarRfc").attr("placeholder",rfc_actual);

            }

        }

    })
    
    return validar_rfc_existente_editar;
    
    }
                
    }





/*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoRfc", function(){
    
    validar_rfc_existente_crear = validarRfcExistenteCrear();
    

});




/*=============================================
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarRfc", function(){
    
    validar_rfc_existente_editar = validarRfcExistenteEditar();
    

});






/*=============================================
VALIDACIONES PARA LA CREACION
=============================================*/

//VALIDAR QUE EL NOMBRE DEL CLIENTE NO ESTE VACIO
function validarNombreVacioCrear() {
if($("#nuevoNombre").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el nombre físcal del proveedor',
        showConfirmButton: false,
        timer: 2000
        })
        
        
        $("#nuevoNombre").focus();
        
        
        validar_nombre_vacio_crear = 0;
        
        return validar_nombre_vacio_crear;
        
        
    }else{
    
    validar_nombre_vacio_crear = 1;
    return validar_nombre_vacio_crear;
    }
    
    
    
}





function validarRfcVacioCrear() {
    if($("#nuevoRfc").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el RFC del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevoRfc").focus();
        
        validar_rfc_vacio_crear = 0;
        
        return validar_rfc_vacio_crear;
        
        
    }else{
        
        validar_rfc_vacio_crear = 1;
        return validar_rfc_vacio_crear;
        
    }
    
}





function validarEmailVacioCrear() {
    if($("#nuevoEmail").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el correo electronico del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevoEmail").focus();
        
        validar_email_vacio_crear = 0;
        
        return validar_email_vacio_crear;
        
        
    }else{
        
        validar_email_vacio_crear = 1;
        return validar_email_vacio_crear;
        
    }
    
}








function validarNombreComercialVacioCrear() {
    if($("#nuevoNombreComercial").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el nombre comercial del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevoNombreComercial").focus();
        
        validar_nombre_comercial_vacio_crear = 0;
        
        return validar_nombre_comercial_vacio_crear;
        
        
    }else{
        
        validar_nombre_comercial_vacio_crear = 1;
        return validar_nombre_comercial_vacio_crear;
        
    }
    
}






function validarContactoVacioCrear() {
    if($("#nuevoContacto").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un contacto del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevoContacto").focus();
        
        validar_contacto_vacio_crear = 0;
        
        return validar_contacto_vacio_crear;
        
        
    }else{
        
        validar_contacto_vacio_crear = 1;
        return validar_contacto_vacio_crear;
        
    }
    
}





function validarTelefono1VacioCrear() {
    if($("#nuevoTelefono1").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un número telefónico',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevoTelefono1").focus();
        
        validar_telefono1_vacio_crear = 0;
        
        return validar_telefono1_vacio_crear;
        
        
    }else{
        
        validar_telefono1_vacio_crear = 1;
        return validar_telefono1_vacio_crear;
        
    }
    
}





function validarCodigoPostalVacioCrear() {
    if($("#nuevoCodigoPostal").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el código postal del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#nuevoCodigoPostal").focus();
        
        validar_codigo_postal_vacio_crear = 0;
        
        return validar_codigo_postal_vacio_crear;
        
        
    }else{
        
        validar_codigo_postal_vacio_crear = 1;
        return validar_codigo_postal_vacio_crear;
        
    }
    
}









/*=============================================
VALIDACIONES PARA LA EDICION
=============================================*/


function validarNombreVacioEditar() {
    
    var nombre_actual = $("#editarNombre").attr("NombreActual");
    
    if($("#editarNombre").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el nombre físcal del proveedor',
        showConfirmButton: false,
        timer: 2000
        })
        
        $("#editarNombre").val(nombre_actual);
        
        $("#editarNombre").focus();
        
        
        validar_nombre_vacio_editar = 0;
        
        return validar_nombre_vacio_editar;
        
        
    }else{
    
    validar_nombre_vacio_editar = 1;
    return validar_nombre_vacio_editar;
    }
    
    
    
}





function validarRfcVacioEditar() {
    
    var rfc_actual = $("#editarRfc").attr("rfcActual");
    
    if($("#editarRfc").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el RFC del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarRfc").val(rfc_actual);
        
        $("#editarRfc").focus();
        
        validar_rfc_vacio_editar = 0;
        
        return validar_rfc_vacio_editar;
        
        
    }else{
        
        validar_rfc_vacio_editar = 1;
        return validar_rfc_vacio_editar;
        
    }
    
}





function validarEmailVacioEditar() {
    
    var email_actual = $("#editarEmail").attr("emailActual");
    
    if($("#editarEmail").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el correo electronico del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarEmail").val(email_actual);
        
        $("#editarEmail").focus();
        
        validar_email_vacio_editar = 0;
        
        return validar_email_vacio_editar;
        
        
    }else{
        
        validar_email_vacio_editar = 1;
        return validar_email_vacio_editar;
        
    }
    
}









function validarNombreComercialVacioEditar() {
    
    var nombre_comercial_actual = $("#editarNombreComercial").attr("nombreComercialActual");
    
    if($("#editarNombreComercial").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el nombre comercial del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarNombreComercial").val(nombre_comercial_actual);
        
        $("#editarNombreComercial").focus();
        
        validar_nombre_comercial_vacio_editar = 0;
        
        return validar_nombre_comercial_vacio_editar;
        
        
    }else{
        
        validar_nombre_comercial_vacio_editar = 1;
        return validar_nombre_comercial_vacio_editar;
        
    }
    
}






function validarContactoVacioEditar() {
    
    var contacto_actual = $("#editarContacto").attr("contactoActual");
    
    if($("#editarContacto").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el contacto del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarContacto").val(contacto_actual);
        
        $("#editarContacto").focus();
        
        validar_contacto_vacio_editar = 0;
        
        return validar_contacto_vacio_editar;
        
        
    }else{
        
        validar_contacto_vacio_editar = 1;
        return validar_contacto_vacio_editar;
        
    }
    
}





function validarTelefono1VacioEditar() {
    
    var telefono1_actual = $("#editarTelefono1").attr("telefono1Actual");
    
    if($("#editarTelefono1").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un número telefónico del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarTelefono1").val(telefono1_actual);
        
        $("#editarTelefono1").focus();
        
        validar_telefono1_vacio_editar = 0;
        
        return validar_telefono1_vacio_editar;
        
        
    }else{
        
        validar_telefono1_vacio_editar = 1;
        return validar_telefono1_vacio_editar;
        
    }
    
}





function validarCodigoPostalVacioEditar() {
    var codigo_postal_actual = $("#editarCodigoPostal").attr("codigoPostalActual");
    if($("#editarCodigoPostal").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir el código postal del proveedor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarCodigoPostal").val(codigo_postal_actual);
        
        $("#editarCodigoPostal").focus();
        
        validar_codigo_postal_vacio_editar = 0;
        
        return validar_codigo_postal_vacio_editar;
        
        
    }else{
        
        validar_codigo_postal_vacio_editar = 1;
        return validar_codigo_postal_vacio_editar;
        
    }
    
}




$(document).on("click", "#btnCrearProveedor", function(){
    
    $(this).blur();
    
    validar_codigo_postal_vacio_crear = validarCodigoPostalVacioCrear();
    //alert(validar_codigo_postal_vacio_crear);
    
    validar_telefono1_vacio_crear = validarTelefono1VacioCrear();
    //alert(validar_telefono1_vacio_crear);
    
    validar_contacto_vacio_crear = validarContactoVacioCrear();
    //alert(validar_contacto_vacio_crear);
    
    validar_nombre_comercial_vacio_crear = validarNombreComercialVacioCrear();
    //alert(validar_nombre_comercial_vacio_crear);
    
    validar_email_vacio_crear = validarEmailVacioCrear();
    //alert(validar_email_vacio_crear);
    
    validar_rfc_existente_crear = validarRfcExistenteCrear();
    //alert(validar_nombre_existente_crear);
    
    validar_rfc_vacio_crear = validarRfcVacioCrear();
    //alert(validar_rfc_vacio_crear);
    
    validar_nombre_existente_crear = validarNombreExistenteCrear();
    //alert(validar_nombre_existente_crear);
    
    validar_nombre_vacio_crear = validarNombreVacioCrear();
    //alert(validar_nombre_vacio_crear);
    

    if(validar_nombre_existente_crear !== 0 &&
    validar_nombre_vacio_crear !== 0 && 
    validar_rfc_existente_crear !== 0 &&
    validar_rfc_vacio_crear !== 0 && 
    validar_email_vacio_crear !== 0 && 
    validar_nombre_comercial_vacio_crear !== 0 && 
    validar_contacto_vacio_crear !== 0 && 
    validar_codigo_postal_vacio_crear !== 0 && 
    validar_telefono1_vacio_crear !== 0){
        
    document.forms["formularioCrearProveedor"].submit();
        
    }
    
});





/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarNombre", function(){
    
    validar_nombre_existente_editar = validarNombreExistenteEditar();

    
});



$(document).on("click", "#btnEditarProveedor", function(){
    
    $(this).blur();
    
    validar_codigo_postal_vacio_editar = validarCodigoPostalVacioEditar();
    //alert(validar_codigo_postal_vacio_editar);
    
    validar_telefono1_vacio_editar = validarTelefono1VacioEditar();
    //alert(validar_telefono1_vacio_editar);
    
    validar_contacto_vacio_editar = validarContactoVacioEditar();
    //alert(validar_contacto_vacio_editar);
    
    validar_nombre_comercial_vacio_editar = validarNombreComercialVacioEditar();
    //alert(validar_nombre_comercial_vacio_editar);
    
    validar_email_vacio_editar = validarEmailVacioEditar();
    //alert(validar_email_vacio_editar);
    
    validar_rfc_existente_editar = validarRfcExistenteEditar();
    //alert(validar_rfc_existente_editar);
    
    validar_rfc_vacio_editar = validarRfcVacioEditar();
    //alert(validar_rfc_vacio_editar);
    
    validar_nombre_existente_editar = validarNombreExistenteEditar();
    //alert(validar_nombre_existente_editar);
    
    validar_nombre_vacio_editar = validarNombreVacioEditar();
    //alert(validar_nombre_vacio_editar);
    

    if(validar_nombre_existente_editar !== 0 &&
    validar_nombre_vacio_editar !== 0 && 
    validar_rfc_existente_editar !== 0 &&
    validar_rfc_vacio_editar !== 0 && 
    validar_email_vacio_editar !== 0 && 
    validar_nombre_comercial_vacio_editar !== 0 && 
    validar_contacto_vacio_editar !== 0 && 
    validar_codigo_postal_vacio_editar !== 0 && 
    validar_telefono1_vacio_editar !== 0){
        
    document.forms["formularioEditarProveedor"].submit();
        
    }
    
});
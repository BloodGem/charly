//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $("#btnCrearProveedor").trigger('click');
        

    }
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
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoNombre", function(){
    
    validar_nombre_existente_crear = validarNombreExistenteCrear();
    

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
REVISAR SI EL NOMBRE FISCAL YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoRfc", function(){
    
    validar_rfc_existente_crear = validarRfcExistenteCrear();
    

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
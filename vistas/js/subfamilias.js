
/*=============================================
CRESR AUTO
=============================================*/
$(document).on("click", "#btnCrearNuevaSubfamilia", function(){

    setTimeout(function() {
    $("#nuevaSubfamiliaCS").focus();
}, 150);

    //$(".close").hide();

    $("#buscarSubfamilias").attr("teclaEsc", "no");

});






/*=============================================
EDITAR AUTO
=============================================*/
$(document).on("click", ".btnEditarSubfamilia", function(){

    //$(".close").hide();

        $("#buscarSubfamilias").attr("teclaEsc", "no");

    var id_subfamilia = $(this).attr("id_subfamilia");

    var datos = new FormData();
    datos.append("id_subfamilia", id_subfamilia);

    $.ajax({
        url: "ajax/subfamilias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){

            $("#modalEditarSubfamilia").modal('show');

            $("#editarSubfamiliaES").val(respuesta["subfamilia"]);
            $("#editarSubfamiliaES").attr("subfamilia_actual",respuesta["subfamilia"]);
            $("#editarIdFamiliaES").val(respuesta["id_familia"]).trigger('change.select2');
            $("#editarIdFamiliaES").attr("id_familia_actual",respuesta["id_familia"]);
            $("#subfamiliaActualES").val(respuesta["subfamilia_completa"]);
            $("#idSubfamiliaES").val(respuesta["id_subfamilia"]);

        }

    })


})

/*=============================================
ELIMINAR AUTO
=============================================*/
$(document).on("click", ".btnEliminarSubfamilia", function(){

     var id_subfamilia = $(this).attr("id_subfamilia");

     Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar este subfamilia?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=subfamilias&id_subfamilia="+id_subfamilia;

    }

  })

})




function buscarAhoraSubfamilias(buscarSubfamilias) {
        var parametros = {"buscarSubfamilias":buscarSubfamilias};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorSubfamilias.php',
        success: function(data) {
        document.getElementById("incrustarTablaSubfamilias").innerHTML = data;
        
        
        }
        });
        }










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarSubfamilias").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarSubfamilias").val("");
            $("#buscarSubfamilias").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarSubfamilias").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarSubfamilias").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CRESR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevoSubfamilia").trigger('click');
        //$(".close").hide();
        $("#buscarSubfamilias").attr("teclaEsc", "no");

        

    }
});








//AL PRESIONAR F2 PARA EDITAR
$(document).keydown(function(event) {
    if (event.which === 113)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarSubfamilia").trigger("click"); 

        //$(".close").hide();

        $("#buscarSubfamilias").attr("teclaEsc", "no");

    }

        

    }
});





//AL PRESIONAR F3 PARA ELIMINAR
$(document).keydown(function(event) {
    if (event.which === 114)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarSubfamilia").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarSubfamilias").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarSubfamilias").attr("teclaEsc");
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
        var buscador_esc = $("#buscarSubfamilias").attr("teclaEsc");
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









/*FOCO*/
/*$(document).on("focus", ".guardaFoco", function(){

    var contador_actual = $(this).attr("contador");

    var contador_menos = parseInt(contador_actual) - 1;

    var contador_mas = parseInt(contador_actual) + 1;

    $(this).addClass('foco');

    $(this).parent().attr("style","font-weight: bold; background-color: #F2620F; color: #0208C9;");


    $(this).parent().parent().children(".contador"+contador_menos).removeAttr("style");

    $(this).parent().parent().children(".contador"+contador_mas).removeAttr("style");

    $(this).parent().parent().children(".contador"+contador_mas).children(".guardaFoco").removeClass('foco');

    $(this).parent().parent().children(".contador"+contador_menos).children(".guardaFoco").removeClass('foco');



});*/




   /*=============================================
    VERIFICSR SI LA AUTO EXISTE
    =============================================*/     
        
    function validarSubfamiliaCompletaExistenteCrear() {
        
    var subfamilia = $("#nuevaSubfamiliaCS").val();
    var id_familia = $("#nuevoIdFamiliaCS").val();
    
    var subfamilia_completa = subfamilia+" "+id_familia;


    var datos = new FormData();
    datos.append("validarSubfamiliaCompleta", subfamilia_completa);

     $.ajax({
        async: false,
        url:"ajax/subfamilias.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_subfamilia_completa_existente_crear = 1;
                
            }
            else if(respuesta[0] !== undefined){

                Swal.fire({
                                    icon: 'error',
                                    title: 'Este subfamilia ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    });

                $("#nuevoIdFamiliaCS").val("").trigger('change.select2');
                $("#nuevoIdFamiliaCS").focus();
                validar_subfamilia_completa_existente_crear = 0;

            }

        }

    })
    
    return validar_subfamilia_completa_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICSR SI LA AUTO EXISTE
    =============================================*/     
        
    function validarSubfamiliaCompletaExistenteEditar() {
    var subfamilia = $("#editarSubfamiliaES").val();
    var id_familia = $("#editarIdFamiliaES").val();
    
    var subfamilia_completa = subfamilia+" "+id_familia;
    var subfamilia_actual = $("#subfamiliaActualES").val();
    
    var id_familia_actual = $("#editarIdFamiliaES").attr("id_familia_actual");

    if(subfamilia_completa == subfamilia_actual){
        validar_subfamilia_completa_existente_editar = 1;
        return validar_subfamilia_completa_existente_editar;
    }
    else if(subfamilia !== subfamilia_actual){
        var datos = new FormData();
    datos.append("validarSubfamiliaCompleta", subfamilia_completa);

     $.ajax({
        url:"ajax/subfamilias.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_subfamilia_completa_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                Swal.fire({
                    icon: 'error',
                    title: 'Esta subfamilia ya existe, introduce otro',
                    showConfirmButton: false,
                    timer: 2000
                });
                
                $("#editarIdFamiliaES").val(id_familia_actual).trigger('change.select2');
                $("#editarIdFamiliaES").focus();
                
                validar_subfamilia_completa_existente_editar = 0;

            }

        }

    })
    
    return validar_subfamilia_completa_existente_editar;
    
    }
                
    }




/*=============================================
REVISAR SI EL AUTO YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevaSubfamiliaCS", function(){
    
    validar_subfamilia_completa_existente_crear = validarSubfamiliaCompletaExistenteCrear();
    

});



$(document).on("change", "#nuevoIdFamiliaCS", function(){
    
    validar_subfamilia_completa_existente_crear = validarSubfamiliaCompletaExistenteCrear();
    

});




/*=============================================
REVISAR SI LA AUTO NO ESTA VACIA
=============================================*/
function validarSubfamiliaVacioCrear() {
if($("#nuevaSubfamiliaCS").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la subfamilia',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_subfamilia_vacio_crear = 0;
        
        return validar_subfamilia_vacio_crear;
        
        
    }else{
    
    validar_subfamilia_vacio_crear = 1;
    return validar_subfamilia_vacio_crear;
    }
    
    
    
}







/*=============================================
REVISAR SI EL ID MOTOR ESTA VACIO
=============================================*/
function validarIdFamiliaVacioCrear() {
if($("#nuevoIdFamiliaCS").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un familia para el subfamilia',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_id_familia_vacio_crear = 0;
        
        return validar_id_familia_vacio_crear;
        
        
    }else{
    
    validar_id_familia_vacio_crear = 1;
    return validar_id_familia_vacio_crear;
    }
    
    
    
}





/*=============================================
REVISAR SI LA AMRADORA ESTA VACIA
=============================================*/



function validarSubfamiliaVacioEditar() {
    
    var subfamilia_actual = $("#editarSubfamiliaES").attr("subfamilia_actual");
    
if($("#editarSubfamiliaES").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para el subfamilia',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarSubfamiliaES").val(subfamilia_actual);
        
        validar_subfamilia_vacio_editar = 0;
        
        return validar_subfamilia_vacio_editar;
        
    }else{
        validar_subfamilia_vacio_editar = 1;
        
        return validar_subfamilia_vacio_editar;
        
    }
    
    
    
}









function validarIdFamiliaVacioEditar() {
    
    var id_familia_actual = $("#editarIdFamiliaES").attr("id_familia_actual");
    
if($("#editarIdFamiliaES").val() == ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una familia para el subfamilia',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarIdFamiliaES").val(id_familia_actual);
        
        validar_id_familia_vacio_editar = 0;
        
        return validar_id_familia_vacio_editar;
        
    }else{
        validar_id_familia_vacio_editar = 1;
        
        return validar_id_familia_vacio_editar;
        
    }
    
    
    
}








$(document).on("click", "#btnCrearSubfamilia", function(){
    
    $(this).blur();
    
    validar_subfamilia_vacio_crear = validarSubfamiliaVacioCrear();
    
    validar_id_familia_vacio_crear = validarIdFamiliaVacioCrear();
    
    validar_subfamilia_completa_existente_crear = validarSubfamiliaCompletaExistenteCrear();
    

if(validar_subfamilia_completa_existente_crear !== 0 && validar_subfamilia_vacio_crear  !== 0 && validar_id_familia_vacio_crear  !== 0){
    
    document.forms["formularioCrearSubfamilia"].submit();
}

   

});





/*=============================================
REVISAR SI LA AUTO YA ESTÁ REGISTRADO
=============================================*/


$(document).on("change", "#editarSubfamiliaES", function(){
    
validar_subfamilia_completa_existente_editar = validarSubfamiliaCompletaExistenteEditar();

    
});



$(document).on("change", "#editarIdFamiliaES", function(){
    
validar_subfamilia_completa_existente_editar = validarSubfamiliaCompletaExistenteEditar();

    
});





$(document).on("click", "#btnEditarSubfamilia", function(){

    $(this).blur();
    
    validar_subfamilia_vacio_editar = validarSubfamiliaVacioEditar();
    
    validar_id_familia_vacio_editar = validarIdFamiliaVacioEditar();
    
validar_subfamilia_completa_existente_editar = validarSubfamiliaCompletaExistenteEditar();



if(validar_subfamilia_completa_existente_editar !== 0 && validar_subfamilia_vacio_editar !== 0 && validar_id_familia_vacio_editar !== 0){
    
    
    
    document.forms["formularioEditarSubfamilia"].submit();
}

});

        

/*=============================================
CREAR AUTO
=============================================*/
$(document).on("click", "#btnCrearNuevoAuto", function(){

    //document.all.sound.src = "http://recursostic.educacion.es/bancoimagenes/contenidos/sonidos01/CD23/wav/eip02186.wav";
    $("#click_audio")[0].play();
    setTimeout(function() {
    $("#nuevoAutoCA").focus();
}, 150);

    //$(".close").hide();

    $("#buscarAutos").attr("teclaEsc", "no");

});






/*=============================================
EDITAR AUTO
=============================================*/
$(document).on("click", ".btnEditarAuto", function(){

    //$(".close").hide();

        $("#buscarAutos").attr("teclaEsc", "no");

	var id_auto = $(this).attr("id_auto");

	var datos = new FormData();
	datos.append("id_auto", id_auto);

	$.ajax({
		url: "ajax/autos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $("#modalEditarAuto").modal('show');

     		$("#editarAutoEA").val(respuesta["auto"]);
     		$("#editarAutoEA").attr("auto_actual",respuesta["auto"]);
            $("#editarVersionEA").val(respuesta["version"]);
            $("#editarVersionEA").attr("version_actual",respuesta["version"]);
            $("#editarIdMotorEA").val(respuesta["id_motor"]);
            $("#editarIdMotorEA").attr("id_motor_actual",respuesta["id_motor"]);
            $("#autoActualEA").val(respuesta["auto_completo"]);
     		$("#idAutoEA").val(respuesta["id_auto"]);

     	}

	})


})

/*=============================================
ELIMINAR AUTO
=============================================*/
$(document).on("click", ".btnEliminarAuto", function(){

	 var id_auto = $(this).attr("id_auto");

	 Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar este auto?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=autos&id_auto="+id_auto;

    }

  })

})




function buscarAhoraAutos(buscarAutos) {
        var parametros = {"buscarAutos":buscarAutos};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorAutos.php',
        success: function(data) {
        document.getElementById("incrustarTablaAutos").innerHTML = data;
        
        
        }
        });
        }










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarAutos").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarAutos").val("");
            $("#buscarAutos").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarAutos").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarAutos").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevoAuto").trigger('click');
        //$(".close").hide();
        $("#buscarAutos").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarAuto").trigger("click"); 

        //$(".close").hide();

        $("#buscarAutos").attr("teclaEsc", "no");

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarAuto").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarAutos").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarAutos").attr("teclaEsc");
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
        var buscador_esc = $("#buscarAutos").attr("teclaEsc");
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
    VERIFICAR SI LA AUTO EXISTE
    =============================================*/     
        
    function validarAutoCompletoExistenteCrear() {
        
    var auto = $("#nuevoAutoCA").val();
    var version = $("#nuevaVersionCA").val();
    var id_motor = $("#nuevoIdMotorCA").val();
    
    var auto_completo = auto+" "+version+" "+id_motor;



    var datos = new FormData();
    datos.append("validarAutoCompleto", auto_completo);

     $.ajax({
        async: false,
        url:"ajax/autos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_auto_completo_existente_crear = 1;
                
            }
            else if(respuesta[0] !== undefined){

                Swal.fire({
                                    icon: 'error',
                                    title: 'Este auto ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    });

                $("#nuevoIdMotorCA").val("").trigger('change.select2');
                $("#nuevoIdMotorCA").focus();
                validar_auto_completo_existente_crear = 0;

            }

        }

    })
    
    return validar_auto_completo_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA AUTO EXISTE
    =============================================*/     
        
    function validarAutoCompletoExistenteEditar() {
    var auto = $("#editarAutoEA").val();
    var version = $("#editarVersionEA").val();
    var id_motor = $("#editarIdMotorEA").val();
    
    var auto_completo = auto+" "+version+" "+id_motor;
    var auto_actual = $("#autoActualEA").val();
    
    var id_motor_actual = $("#editarIdMotorEA").attr("id_motor_actual");

    if(auto_completo == auto_actual){
        validar_auto_completo_existente_editar = 1;
        return validar_auto_completo_existente_editar;
    }
    else if(auto !== auto_actual){
        var datos = new FormData();
    datos.append("validarAutoCompleto", auto_completo);

     $.ajax({
        url:"ajax/autos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_auto_completo_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                Swal.fire({
                    icon: 'error',
                    title: 'Esta auto ya existe, introduce otro',
                    showConfirmButton: false,
                    timer: 2000
                });
                
                $("#editarIdMotorEA").val(id_motor_actual).trigger('change.select2');
                $("#editarIdMotorEA").focus();
                
                validar_auto_completo_existente_editar = 0;

            }

        }

    })
    
    return validar_auto_completo_existente_editar;
    
    }
                
    }




/*=============================================
REVISAR SI EL AUTO YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoAutoCA", function(){
    
    validar_auto_completo_existente_crear = validarAutoCompletoExistenteCrear();
    

});

$(document).on("change", "#nuevaVersionCA", function(){
    
    validar_auto_completo_existente_crear = validarAutoCompletoExistenteCrear();
    

});

$(document).on("change", "#nuevoIdMotorCA", function(){
    
    validar_auto_completo_existente_crear = validarAutoCompletoExistenteCrear();
    

});

$(document).on("change", "#nuevoIdArmadoraCA", function(){
    
    validar_auto_completo_existente_crear = validarAutoCompletoExistenteCrear();
    

});



/*=============================================
REVISAR SI LA AUTO NO ESTA VACIA
=============================================*/
function validarAutoVacioCrear() {
if($("#nuevoAutoCA").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la auto',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_auto_vacio_crear = 0;
        
        return validar_auto_vacio_crear;
        
        
    }else{
    
    validar_auto_vacio_crear = 1;
    return validar_auto_vacio_crear;
    }
    
    
    
}





/*=============================================
REVISAR SI LA VERSION NO ESTA VACIA
=============================================*/
function validarVersionVaciaCrear() {
if($("#nuevaVersionCA").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una versión para la auto',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_version_vacia_crear = 0;
        
        return validar_version_vacia_crear;
        
        
    }else{
    
    validar_version_vacia_crear = 1;
    return validar_version_vacia_crear;
    }
    
    
    
}

/*=============================================
REVISAR SI EL ID MOTOR ESTA VACIO
=============================================*/
function validarIdMotorVacioCrear() {
if($("#nuevoIdMotorCA").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un motor para el auto',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_id_motor_vacio_crear = 0;
        
        return validar_id_motor_vacio_crear;
        
        
    }else{
    
    validar_id_motor_vacio_crear = 1;
    return validar_id_motor_vacio_crear;
    }
    
    
    
}





/*=============================================
REVISAR SI LA AMRADORA ESTA VACIA
=============================================*/



function validarAutoVacioEditar() {
    
    var auto_actual = $("#editarAutoEA").attr("auto_actual");
    
if($("#editarAutoEA").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para el auto',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarAutoEA").val(auto_actual);
        
        validar_auto_vacio_editar = 0;
        
        return validar_auto_vacio_editar;
        
    }else{
        validar_auto_vacio_editar = 1;
        
        return validar_auto_vacio_editar;
        
    }
    
    
    
}





/*=============================================
REVISAR SI LA VERSION NO ESTA VACIA
=============================================*/
function validarVersionVaciaEditar() {

    var version_actual = $("#editarVersionEA").attr("version_actual");

if($("#editarVersionEA").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una versión para la auto',
        showConfirmButton: false,
        timer: 2000
        });

        $("#editarVersionEA").val(version_actual);
        
        validar_version_vacia_editar = 0;
        
        return validar_version_vacia_editar;
        
        
    }else{
    
    validar_version_vacia_editar = 1;
    return validar_version_vacia_editar;
    }
    
    
    
}



function validarIdMotorVacioEditar() {
    
    var id_motor_actual = $("#editarIdMotorEA").attr("id_motor_actual");
    
if($("#editarIdMotorEA").val() == ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir una motor para el auto',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarIdMotorEA").val(id_motor_actual);
        
        validar_id_motor_vacio_editar = 0;
        
        return validar_id_motor_vacio_editar;
        
    }else{
        validar_id_motor_vacio_editar = 1;
        
        return validar_id_motor_vacio_editar;
        
    }
    
    
    
}








$(document).on("click", "#btnCrearAuto", function(){
    
    $(this).blur();
    
    validar_auto_vacio_crear = validarAutoVacioCrear();

    validar_version_vacia_crear = validarVersionVaciaCrear();
    
    validar_id_motor_vacio_crear = validarIdMotorVacioCrear();
    
    validar_auto_completo_existente_crear = validarAutoCompletoExistenteCrear();
    

if(validar_auto_completo_existente_crear !== 0 && validar_auto_vacio_crear  !== 0 && validar_version_vacia_crear  !== 0 && validar_id_motor_vacio_crear  !== 0){
    
    document.forms["formularioCrearAuto"].submit();
}

   

});





/*=============================================
REVISAR SI LA AUTO YA ESTÁ REGISTRADO
=============================================*/


$(document).on("change", "#editarAutoEA", function(){
    
validar_auto_completo_existente_editar = validarAutoCompletoExistenteEditar();

    
});

$(document).on("change", "#editarVersionEA", function(){
    
validar_auto_completo_existente_editar = validarAutoCompletoExistenteEditar();

    
});

$(document).on("change", "#editarIdMotorEA", function(){
    
validar_auto_completo_existente_editar = validarAutoCompletoExistenteEditar();

    
});





$(document).on("change", "#editarIdArmadoraEA", function(){
    
validar_auto_completo_existente_editar = validarAutoCompletoExistenteEditar();

    
});


$(document).on("click", "#btnEditarAuto", function(){

    $(this).blur();
    
    validar_auto_vacio_editar = validarAutoVacioEditar();

    validar_version_vacia_editar = validarVersionVaciaEditar();
    
    validar_id_motor_vacio_editar = validarIdMotorVacioEditar();
    
validar_auto_completo_existente_editar = validarAutoCompletoExistenteEditar();



if(validar_auto_completo_existente_editar !== 0 && validar_auto_vacio_editar !== 0 && validar_version_vacia_editar !== 0 && validar_id_motor_vacio_editar !== 0){
    
    
    
    document.forms["formularioEditarAuto"].submit();
}

});

        
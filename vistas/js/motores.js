/*=============================================
CREAR MARCA
=============================================*/
$(document).on("click", "#btnCrearNuevaMotor", function(){

    setTimeout(function() {
    $("#nuevaMotor").focus();
}, 150);

    //$(".close").hide();

        $("#buscarMotores").attr("teclaEsc", "no");

});

/*=============================================
EDITAR MARCA
=============================================*/
$(document).on("click", ".btnEditarMotor", function(){

    //$(".close").hide();

    $("#buscarFamilias").attr("teclaEsc", "no");

	var id_motor = $(this).attr("id_motor");

	var datos = new FormData();
	datos.append("id_motor", id_motor);


	$.ajax({
		url: "ajax/motores.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $("#modalEditarMotor").modal('show');

     		$("#editarMotor").val(respuesta["motor"]);
            $("#motorActual").val(respuesta["motor"]);
     		$("#idMotorEM").val(respuesta["id_motor"]);

     	}

	})


})

/*=============================================
ELIMINAR MARCA
=============================================*/
$(document).on("click", ".btnEliminarMotor", function(){

	 var id_motor = $(this).attr("id_motor");

	 Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar esta motor?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=motores&id_motor="+id_motor;

    }

  })

})






function buscarAhoraMotores(buscarMotores) {
        var parametros = {"buscarMotores":buscarMotores};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorMotores.php',
        success: function(data) {
        document.getElementById("incrustarTablaMotores").innerHTML = data;
        }
        });
        }










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarMotores").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarMotores").val("");
            $("#buscarMotores").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarMotores").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarMotores").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaMotor").trigger('click');
        //$(".close").hide();
        $("#buscarMotores").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarMotor").trigger("click"); 

        //$(".close").hide();

        $("#buscarMotores").attr("teclaEsc", "no");

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarMotor").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarMotores").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarMotores").attr("teclaEsc");
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
        var buscador_esc = $("#buscarMotores").attr("teclaEsc");
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
        
        


   /*=============================================
    VERIFICAR SI LA MARCA EXISTE
    =============================================*/     
        
    function validarMotorExistenteCrear() {
        
        
        var motor = $("#nuevaMotor").val();

        var datos = new FormData();
        datos.append("validarMotor", motor);

     $.ajax({
        async: false,
        url:"ajax/motores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_motor_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevaMotor").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Este motor ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#nuevaMotor").val("");
                
                validar_motor_existente_crear = 0;

            }

        }

    })
    
    return validar_motor_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA MARCA EXISTE
    =============================================*/     
        
    function validarMotorExistenteEditar() {
        var motor = $("#editarMotor").val();
        var motor_actual = $("#motorActual").val();

    if(motor == motor_actual){
        validar_motor_existente_editar = 1;
        return validar_motor_existente_editar;
    }
    else if(motor !== motor_actual){
        var datos = new FormData();
    datos.append("validarMotor", motor);

     $.ajax({
        url:"ajax/motores.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_motor_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                $("#editarMotor").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Este motor ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarMotor").val(motor_actual);
                
                validar_motor_existente_editar = 0;

            }

        }

    })
    
    return validar_motor_existente_editar;
    
    }
                
    }




        /*=============================================
REVISAR SI LA MARCA YA ESTÁ REGISTRADA
=============================================*/

$(document).on("change", "#nuevaMotor", function(){
    
    validar_motor_existente_crear = validarMotorExistenteCrear();
    

});



/*=============================================
REVISAR SI LA MARCA NO ESTA VACIA
=============================================*/
function validarMotorVaciaCrear() {
if($("#nuevaMotor").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para el motor',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_motor_vacia_crear = 0;
        
        return validar_motor_vacia_crear;
        
        
    }else{
    
    validar_motor_vacia_crear = 1;
    return validar_motor_vacia_crear;
    }
    
    
    
}



function validarMotorVaciaEditar() {
    
    var motor_actual = $("#motorActual").val();
    
if($("#editarMotor").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para el motor',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarMotor").val(motor_actual);
        
        validar_motor_vacia_editar = 0;
        
        return validar_motor_vacia_editar;
        
    }else{
        validar_motor_vacia_editar = 1;
        
        return validar_motor_vacia_editar;
        
    }
    
    
    
}



$(document).on("click", "#btnCrearMotor", function(){
    
    validar_motor_existente_crear = validarMotorExistenteCrear();
    validar_motor_vacia_crear = validarMotorVaciaCrear();
    

if(validar_motor_existente_crear !== 0 && validar_motor_vacia_crear  !== 0){
    
    document.forms["formularioCrearMotor"].submit();
}

   

});





/*=============================================
REVISAR SI LA MARCA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarMotor", function(){
    
    validar_motor_existente_editar = validarMotorExistenteEditar();

    
});


$(document).on("click", "#btnEditarMotor", function(){
    
validar_motor_existente_editar = validarMotorExistenteEditar();

validar_motor_vacia_editar = validarMotorVaciaEditar();

if(validar_motor_existente_editar !== 0 && validar_motor_vacia_editar  !== 0){
    
    
    
    document.forms["formularioEditarMotor"].submit();
}

});
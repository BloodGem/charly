/*=============================================
CREAR MARCA
=============================================*/
$(document).on("click", "#btnCrearNuevaTerminalBancaria", function(){

    setTimeout(function() {
    $("#nuevaTerminalBancaria").focus();
}, 150);

    //$(".close").hide();

        $("#buscarTerminalesBancarias").attr("teclaEsc", "no");

});

/*=============================================
EDITAR MARCA
=============================================*/
$(document).on("click", ".btnEditarTerminalBancaria", function(){

    //$(".close").hide();

    $("#buscarFamilias").attr("teclaEsc", "no");

	var id_terminal_bancaria = $(this).attr("id_terminal_bancaria");

	var datos = new FormData();
	datos.append("id_terminal_bancaria", id_terminal_bancaria);


	$.ajax({
		url: "ajax/terminales-bancarias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

            $("#modalEditarTerminalBancaria").modal('show');

     		$("#editarTerminalBancaria").val(respuesta["terminal_bancaria"]);
            $("#editarTerminalBancaria").attr("terminalBancariaActual", respuesta["terminal_bancaria"]);
     		$("#idTerminalBancaria").val(respuesta["id_terminal_bancaria"]);

     	}

	})


})





function buscarAhoraTerminalesBancarias(buscarTerminalesBancarias) {
        var parametros = {"buscarTerminalesBancarias":buscarTerminalesBancarias};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorTerminalesBancarias.php',
        success: function(data) {
        document.getElementById("incrustarTablaTerminalesBancarias").innerHTML = data;
        }
        });
        }










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarTerminalesBancarias").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarTerminalesBancarias").val("");
            $("#buscarTerminalesBancarias").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarTerminalesBancarias").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarTerminalesBancarias").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaTerminalBancaria").trigger('click');
        //$(".close").hide();
        $("#buscarTerminalesBancarias").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarTerminalBancaria").trigger("click"); 

        //$(".close").hide();

        $("#buscarTerminalesBancarias").attr("teclaEsc", "no");

    }

        

    }
});





//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarTerminalesBancarias").attr("teclaEsc");
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
        var buscador_esc = $("#buscarTerminalesBancarias").attr("teclaEsc");
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
        
    function validarTerminalBancariaExistenteCrear() {
        
        
        var terminal_bancaria = $("#nuevaTerminalBancaria").val();

        var datos = new FormData();
        datos.append("validarTerminalBancaria", terminal_bancaria);

     $.ajax({
        async: false,
        url:"ajax/terminales-bancarias.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_terminal_bancaria_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevaTerminalBancaria").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta terminal bancaria ya existe, introduce otra',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#nuevaTerminalBancaria").val("");
                
                validar_terminal_bancaria_existente_crear = 0;

            }

        }

    })
    
    return validar_terminal_bancaria_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA MARCA EXISTE
    =============================================*/     
        
    function validarTerminalBancariaExistenteEditar() {
        var terminal_bancaria = $("#editarTerminalBancaria").val();
        var terminal_bancaria_actual = $("#editarTerminalBancaria").attr("terminalBancariaActual");

    if(terminal_bancaria == terminal_bancaria_actual){
        validar_terminal_bancaria_existente_editar = 1;
        return validar_terminal_bancaria_existente_editar;
    }
    else if(terminal_bancaria !== terminal_bancaria_actual){
        var datos = new FormData();
    datos.append("validarTerminalBancaria", terminal_bancaria);

     $.ajax({
        url:"ajax/terminales-bancarias.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_terminal_bancaria_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                $("#editarTerminalBancaria").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta terminal bancaria ya existe, introduce otra',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarTerminalBancaria").val(terminal_bancaria_actual);
                
                validar_terminal_bancaria_existente_editar = 0;

            }

        }

    })
    
    return validar_terminal_bancaria_existente_editar;
    
    }
                
    }




        /*=============================================
REVISAR SI LA MARCA YA ESTÁ REGISTRADA
=============================================*/

$(document).on("change", "#nuevaTerminalBancaria", function(){
    
    validar_terminal_bancaria_existente_crear = validarTerminalBancariaExistenteCrear();
    

});



/*=============================================
REVISAR SI LA MARCA NO ESTA VACIA
=============================================*/
function validarTerminalBancariaVaciaCrear() {
if($("#nuevaTerminalBancaria").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la terminal bancaria',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_terminal_bancaria_vacia_crear = 0;
        
        return validar_terminal_bancaria_vacia_crear;
        
        
    }else{
    
    validar_terminal_bancaria_vacia_crear = 1;
    return validar_terminal_bancaria_vacia_crear;
    }
    
    
    
}



function validarTerminalBancariaVaciaEditar() {
    
    var terminal_bancaria_actual = $("#terminal_bancariaActual").val();
    
if($("#editarTerminalBancaria").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la terminal bancaria',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarTerminalBancaria").val(terminal_bancaria_actual);
        
        validar_terminal_bancaria_vacia_editar = 0;
        
        return validar_terminal_bancaria_vacia_editar;
        
    }else{
        validar_terminal_bancaria_vacia_editar = 1;
        
        return validar_terminal_bancaria_vacia_editar;
        
    }
    
    
    
}



$(document).on("click", "#btnCrearTerminalBancaria", function(){
    
    validar_terminal_bancaria_existente_crear = validarTerminalBancariaExistenteCrear();
    validar_terminal_bancaria_vacia_crear = validarTerminalBancariaVaciaCrear();
    

if(validar_terminal_bancaria_existente_crear !== 0 && 
    validar_terminal_bancaria_vacia_crear  !== 0){
    
    document.forms["formularioCrearTerminalBancaria"].submit();
}

   

});





/*=============================================
REVISAR SI LA MARCA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarTerminalBancaria", function(){
    
    validar_terminal_bancaria_existente_editar = validarTerminalBancariaExistenteEditar();

    
});


$(document).on("click", "#btnEditarTerminalBancaria", function(){
    
validar_terminal_bancaria_existente_editar = validarTerminalBancariaExistenteEditar();

validar_terminal_bancaria_vacia_editar = validarTerminalBancariaVaciaEditar();

if(validar_terminal_bancaria_existente_editar !== 0 && 
    validar_terminal_bancaria_vacia_editar  !== 0){
    
    
    
    document.forms["formularioEditarTerminalBancaria"].submit();
}

});
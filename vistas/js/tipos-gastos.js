/*=============================================
CREAR TIPO DE GASTO
=============================================*/
$(document).on("click", "#btnCrearNuevoTipoGasto", function(){

    setTimeout(function() {
    $("#nuevoTipoGasto").focus();
}, 150);

    //$(".close").hide();

    $("#buscarTiposGastos").attr("teclaEsc", "no");

});










/*=============================================
EDITAR TIPO DE GASTO
=============================================*/
$(document).on("click", ".btnEditarTipoGasto", function(){

    //$(".close").hide();

    $("#buscarTiposGastos").attr("teclaEsc", "no");

	var id_tipo_gasto = $(this).attr("id_tipo_gasto");

	var datos = new FormData();
	datos.append("id_tipo_gasto", id_tipo_gasto);

	$.ajax({
		url: "ajax/tipos_gastos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarTipoGasto").val(respuesta["tipo_gasto"]);
            $("#editarTipoGasto").attr("tipoGastoActual", respuesta["tipo_gasto"]);
     		$("#id_tipo_gasto").val(respuesta["id_tipo_gasto"]);

     	}

	})


})

/*=============================================
ELIMINAR TIPO DE GASTO
=============================================*/
$(document).on("click", ".btnEliminarTipoGasto", function(){

	 var id_tipo_gasto = $(this).attr("id_tipo_gasto");

	 Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar este tipo de gasto?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=tipos-gastos&id_tipo_gasto="+id_tipo_gasto;

    }

  })

})




function buscarAhoraTiposGastos(buscarTiposGastos) {
        var parametros = {"buscarTiposGastos":buscarTiposGastos};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorTiposGastos.php',
        success: function(data) {
        document.getElementById("incrustarTablaTiposGastos").innerHTML = data;
        }
        });
        }










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarTiposGastos").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarTiposGastos").val("");
            $("#buscarTiposGastos").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarTiposGastos").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarTiposGastos").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevoTipoGasto").trigger('click');
        //$(".close").hide();
        $("#buscarTiposGastos").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarTipoGasto").trigger("click"); 

        //$(".close").hide();

        $("#buscarTiposGastos").attr("teclaEsc", "no");

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarTipoGasto").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarTiposGastos").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarTiposGastos").attr("teclaEsc");
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
        var buscador_esc = $("#buscarTiposGastos").attr("teclaEsc");
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
    VERIFICAR SI LA tipo_gasto EXISTE
    =============================================*/     
        
    function validarTipoGastoExistenteCrear() {
        
    var tipo_gasto = $("#nuevoTipoGasto").val();
    

    var datos = new FormData();
    datos.append("validarTipoGasto", tipo_gasto);

     $.ajax({
        async: false,
        url:"ajax/tipos_gastos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_tipo_gasto_existente_crear = 1;
                
            }
            else if(respuesta[0] !== undefined){

                Swal.fire({
                                    icon: 'error',
                                    title: 'Este tipo de gasto ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    });

                $("#enuevoTipoGasto").focus();
                
                validar_tipo_gasto_existente_crear = 0;

            }

        }

    })
    
    return validar_tipo_gasto_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA tipo_gasto EXISTE
    =============================================*/     
        
    function validarTipoGastoExistenteEditar() {
        
        var tipo_gasto = $("#editarTipoGasto").val();
        
    var tipo_gasto_actual = $("#editarTipoGasto").attr("tipoGastoActual");

    if(tipo_gasto === tipo_gasto_actual){
        validar_tipo_gasto_existente_editar = 1;
        return validar_tipo_gasto_existente_editar;
    }
    else if(tipo_gasto !== tipo_gasto_actual){
        var datos = new FormData();
    datos.append("validarTipoGasto", tipo_gasto);

     $.ajax({
        url:"ajax/tipos_gastos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_tipo_gasto_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                Swal.fire({
                    icon: 'error',
                    title: 'Esta tipo de gasto ya existe, introduce otro',
                    showConfirmButton: false,
                    timer: 2000
                });
                
                $("#editarTipoGasto").focus();
                
                validar_tipo_gasto_existente_editar = 0;

            }

        }

    })
    
    return validar_tipo_gasto_existente_editar;
    
    }
                
    }




/*=============================================
REVISAR SI EL tipo_gasto YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#nuevoTipoGasto", function(){
    
    validar_tipo_gasto_existente_crear = validarTipoGastoExistenteCrear();
    

});


/*=============================================
REVISAR SI LA tipo_gasto YA ESTÁ REGISTRADO
=============================================*/


$(document).on("change", "#editarTipoGasto", function(){
    
validar_tipo_gasto_existente_editar = validarTipoGastoExistenteEditar();

    
});





/*=============================================
REVISAR SI LA tipo_gasto NO ESTA VACIA
=============================================*/
function validarTipoGastoVacioCrear() {
if($("#nuevoTipoGasto").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para el tipo de gasto',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_tipo_gasto_vacio_crear = 0;
        
        return validar_tipo_gasto_vacio_crear;
        
        
    }else{
    
    validar_tipo_gasto_vacio_crear = 1;
    return validar_tipo_gasto_vacio_crear;
    }
    
    
    
}



function validarTipoGastoVacioEditar() {
    
    var tipo_gasto_actual = $("#editarTipoGasto").attr("tipoGastoActual");
    
if($("#editarTipoGasto").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para el tipo de gasto',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarTipoGasto").val(tipo_gasto_actual);
        
        validar_tipo_gasto_vacio_editar = 0;
        
        return validar_tipo_gasto_vacio_editar;
        
    }else{
        validar_tipo_gasto_vacio_editar = 1;
        
        return validar_tipo_gasto_vacio_editar;
        
    }
    
    
    
}




$(document).on("click", "#btnCrearTipoGasto", function(){
    
    validar_tipo_gasto_vacio_crear = validarTipoGastoVacioCrear();
    
    validar_tipo_gasto_existente_crear = validarTipoGastoExistenteCrear();
    
    
    

if(validar_tipo_gasto_existente_crear !== 0 && validar_tipo_gasto_vacio_crear  !== 0){
    
    document.forms["formularioCrearTipoGasto"].submit();
}

   

});








$(document).on("click", "#btnEditarTipoGasto", function(){
    
    validar_tipo_gasto_vacio_editar = validarTipoGastoVacioEditar();
    
validar_tipo_gasto_existente_editar = validarTipoGastoExistenteEditar();





if(validar_tipo_gasto_existente_editar !== 0 && validar_tipo_gasto_vacio_editar  !== 0){
    
    
    
    document.forms["formularioEditarTipoGasto"].submit();
}

});

/*=============================================
CREAR AUTO
=============================================*/
$(document).on("click", "#btnCrearNuevaFamilia", function(){

    setTimeout(function() {
    $("#nuevaFamilia").focus();
}, 150);

    //$(".close").hide();

        $("#buscarFamilias").attr("teclaEsc", "no");

});

/*=============================================
EDITAR FAMILIA
=============================================*/
$(document).on("click", ".btnEditarFamilia", function(){

    //$(".close").hide();

        $("#buscarFamilias").attr("teclaEsc", "no");

	var id_familia = $(this).attr("id_familia");

	var datos = new FormData();
	datos.append("id_familia", id_familia);

	$.ajax({
		url: "ajax/familias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarFamilia").val(respuesta["familia"]);
            $("#familiaActual").val(respuesta["familia"]);
     		$("#id_familia").val(respuesta["id_familia"]);

     	}

	})


})

/*=============================================
ELIMINAR FAMILIA
=============================================*/
$(document).on("click", ".btnEliminarFamilia", function(){

	 var id_familia = $(this).attr("id_familia");

	 Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar esta familia?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=familias&id_familia="+id_familia;

    }

  })

})






function buscarAhoraFamilias(buscarFamilias) {
        var parametros = {"buscarFamilias":buscarFamilias};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorFamilias.php',
        success: function(data) {
        document.getElementById("incrustarTablaFamilias").innerHTML = data;
        }
        });
        }










        //AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarFamilias").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarFamilias").val("");
            $("#buscarFamilias").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarFamilias").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarFamilias").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaFamilia").trigger('click');
        //$(".close").hide();
        $("#buscarFamilias").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarFamilia").trigger("click"); 

        //$(".close").hide();

        $("#buscarFamilias").attr("teclaEsc", "no");

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarFamilia").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarFamilias").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarFamilias").attr("teclaEsc");
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
        var buscador_esc = $("#buscarFamilias").attr("teclaEsc");
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
    VERIFICAR SI LA FAMILIA EXISTE
    =============================================*/     
        
    function validarFamiliaExistenteCrear() {
        
        
        var familia = $("#nuevaFamilia").val();

        var datos = new FormData();
        datos.append("validarFamilia", familia);

     $.ajax({
        async: false,
        url:"ajax/familias.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_familia_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevaFamilia").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta familia ya existe, introduce otra',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#nuevaFamilia").val("");
                
                validar_familia_existente_crear = 0;

            }

        }

    })
    
    return validar_familia_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA FAMILIA EXISTE
    =============================================*/     
        
    function validarFamiliaExistenteEditar() {
        var familia = $("#editarFamilia").val();
        var familia_actual = $("#familiaActual").val();

    if(familia == familia_actual){
        validar_familia_existente_editar = 1;
        return validar_familia_existente_editar;
    }
    else if(familia !== familia_actual){
        var datos = new FormData();
    datos.append("validarFamilia", familia);

     $.ajax({
        url:"ajax/familias.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_familia_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                $("#editarFamilia").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta familia ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarFamilia").val(familia_actual);
                
                validar_familia_existente_editar = 0;

            }

        }

    })
    
    return validar_familia_existente_editar;
    
    }
                
    }




        /*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADA
=============================================*/

$(document).on("change", "#nuevaFamilia", function(){
    
    validar_familia_existente_crear = validarFamiliaExistenteCrear();
    

});



/*=============================================
REVISAR SI LA FAMILIA NO ESTA VACIA
=============================================*/
function validarFamiliaVaciaCrear() {
if($("#nuevaFamilia").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la familia',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_familia_vacia_crear = 0;
        
        return validar_familia_vacia_crear;
        
        
    }else{
    
    validar_familia_vacia_crear = 1;
    return validar_familia_vacia_crear;
    }
    
    
    
}



function validarFamiliaVaciaEditar() {
    
    var familia_actual = $("#familiaActual").val();
    
if($("#editarFamilia").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la familia',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarFamilia").val(familia_actual);
        
        validar_familia_vacia_editar = 0;
        
        return validar_familia_vacia_editar;
        
    }else{
        validar_familia_vacia_editar = 1;
        
        return validar_familia_vacia_editar;
        
    }
    
    
    
}



$(document).on("click", "#btnCrearFamilia", function(){
    
    validar_familia_existente_crear = validarFamiliaExistenteCrear();
    validar_familia_vacia_crear = validarFamiliaVaciaCrear();
    

if(validar_familia_existente_crear !== 0 && validar_familia_vacia_crear  !== 0){
    
    document.forms["formularioCrearFamilia"].submit();
}

   

});





/*=============================================
REVISAR SI LA FAMILIA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarFamilia", function(){
    
    validar_familia_existente_editar = validarFamiliaExistenteEditar();

    
});


$(document).on("click", "#btnEditarFamilia", function(){
    
validar_familia_existente_editar = validarFamiliaExistenteEditar();

validar_familia_vacia_editar = validarFamiliaVaciaEditar();

if(validar_familia_existente_editar !== 0 && validar_familia_vacia_editar  !== 0){
    
    
    
    document.forms["formularioEditarFamilia"].submit();
}

});
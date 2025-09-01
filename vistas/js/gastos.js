/*=============================================
CREAR AUTO
=============================================*/
$(document).on("click", "#btnCrearNuevoGasto", function(){

    setTimeout(function() {
    $("#nuevoIdTipoGasto").focus();
}, 150);

    //$(".close").hide();

    $("#buscarGastos").attr("teclaEsc", "no");

});










/*=============================================
EDITAR TIPO DE GASTO
=============================================*/
$(document).on("click", ".btnEditarGasto", function(){

    //$(".close").hide();

    $("#buscarGastos").attr("teclaEsc", "no");

	var id_gasto = $(this).attr("id_gasto");

	var datos = new FormData();
	datos.append("id_gasto", id_gasto);

	$.ajax({
		url: "ajax/gastos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarIdTipoGasto").val(respuesta["id_tipo_gasto"]);
            $("#editarTotal").val(respuesta["total"]).number(true, 2);
             $("#editarComentario").val(respuesta["comentario"]);
            $("#id_gasto").val(respuesta["id_gasto"]);
            $("#editarArchivo").val(respuesta["archivo"]);
           



     	}

	})


})

/*=============================================
ELIMINAR TIPO DE GASTO
=============================================*/
$(document).on("click", ".btnEliminarGasto", function(){

	 var id_gasto = $(this).attr("id_gasto");

	 Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar este gasto?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=gastos&id_gasto="+id_gasto;

    }

  })

})




function buscarAhoraGastos(buscarGastos) {
        var parametros = {"buscarGastos":buscarGastos};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorGastos.php',
        success: function(data) {
        document.getElementById("incrustarTablaGastos").innerHTML = data;
        }
        });
        }










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarGastos").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarGastos").val("");
            $("#buscarGastos").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarGastos").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarGastos").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevoGasto").trigger('click');
        //$(".close").hide();
        $("#buscarGastos").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarGasto").trigger("click"); 

        //$(".close").hide();

        $("#buscarGastos").attr("teclaEsc", "no");

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarGasto").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarGastos").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarGastos").attr("teclaEsc");
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
        var buscador_esc = $("#buscarGastos").attr("teclaEsc");
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
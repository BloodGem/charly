function activaTablaMarcas() {

                $("#tablaMarcas").DataTable({
      "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
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



/*=============================================
CREAR MARCA
=============================================*/
$(document).on("click", "#btnCrearNuevaMarca", function(){

    setTimeout(function() {
    $("#nuevaMarca").focus();
}, 150);

    //$(".close").hide();

        $("#buscarMarcas").attr("teclaEsc", "no");

});

/*=============================================
EDITAR MARCA
=============================================*/
$(document).on("click", ".btnEditarMarca", function(){

    //$(".close").hide();

    $("#buscarFamilias").attr("teclaEsc", "no");

	var id_marca = $(this).attr("id_marca");

	var datos = new FormData();
	datos.append("id_marca", id_marca);

	$.ajax({
		url: "ajax/marcas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarMarca").val(respuesta["marca"]);
            $("#marcaActual").val(respuesta["marca"]);
     		$("#id_marca").val(respuesta["id_marca"]);

     	}

	})


})

/*=============================================
ELIMINAR MARCA
=============================================*/
$(document).on("click", ".btnEliminarMarca", function(){

	 var id_marca = $(this).attr("id_marca");

	 Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar esta marca?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=marcas&id_marca="+id_marca;

    }

  })

})






function buscarAhoraMarcas(buscarMarcas) {
        var parametros = {"buscarMarcas":buscarMarcas};
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadores/buscadorMarcas.php',
        success: function(data) {
        document.getElementById("incrustarTablaMarcas").innerHTML = data;

        activaTablaMarcas();
        }
        });
        }










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarMarcas").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarMarcas").val("");
            $("#buscarMarcas").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarMarcas").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarMarcas").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaMarca").trigger('click');
        //$(".close").hide();
        $("#buscarMarcas").attr("teclaEsc", "no");

        

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarMarca").trigger("click"); 

        //$(".close").hide();

        $("#buscarMarcas").attr("teclaEsc", "no");

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

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEliminarMarca").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarMarcas").attr("teclaEsc", "no");

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarMarcas").attr("teclaEsc");
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
        var buscador_esc = $("#buscarMarcas").attr("teclaEsc");
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
        
    function validarMarcaExistenteCrear() {
        
        
        var marca = $("#nuevaMarca").val();

        var datos = new FormData();
        datos.append("validarMarca", marca);

     $.ajax({
        async: false,
        url:"ajax/marcas.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_marca_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevaMarca").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta marca ya existe, introduce otra',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#nuevaMarca").val("");
                
                validar_marca_existente_crear = 0;

            }

        }

    })
    
    return validar_marca_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI LA MARCA EXISTE
    =============================================*/     
        
    function validarMarcaExistenteEditar() {
        var marca = $("#editarMarca").val();
        var marca_actual = $("#marcaActual").val();

    if(marca == marca_actual){
        validar_marca_existente_editar = 1;
        return validar_marca_existente_editar;
    }
    else if(marca !== marca_actual){
        var datos = new FormData();
    datos.append("validarMarca", marca);

     $.ajax({
        url:"ajax/marcas.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_marca_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                $("#editarMarca").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta marca ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarMarca").val(marca_actual);
                
                validar_marca_existente_editar = 0;

            }

        }

    })
    
    return validar_marca_existente_editar;
    
    }
                
    }




        /*=============================================
REVISAR SI LA MARCA YA ESTÁ REGISTRADA
=============================================*/

$(document).on("change", "#nuevaMarca", function(){
    
    validar_marca_existente_crear = validarMarcaExistenteCrear();
    

});



/*=============================================
REVISAR SI LA MARCA NO ESTA VACIA
=============================================*/
function validarMarcaVaciaCrear() {
if($("#nuevaMarca").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la marca',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_marca_vacia_crear = 0;
        
        return validar_marca_vacia_crear;
        
        
    }else{
    
    validar_marca_vacia_crear = 1;
    return validar_marca_vacia_crear;
    }
    
    
    
}



function validarMarcaVaciaEditar() {
    
    var marca_actual = $("#marcaActual").val();
    
if($("#editarMarca").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la marca',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarMarca").val(marca_actual);
        
        validar_marca_vacia_editar = 0;
        
        return validar_marca_vacia_editar;
        
    }else{
        validar_marca_vacia_editar = 1;
        
        return validar_marca_vacia_editar;
        
    }
    
    
    
}



$(document).on("click", "#btnCrearMarca", function(){
    
    validar_marca_existente_crear = validarMarcaExistenteCrear();
    validar_marca_vacia_crear = validarMarcaVaciaCrear();
    

if(validar_marca_existente_crear !== 0 && validar_marca_vacia_crear  !== 0){
    
    document.forms["formularioCrearMarca"].submit();
}

   

});





/*=============================================
REVISAR SI LA MARCA YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarMarca", function(){
    
    validar_marca_existente_editar = validarMarcaExistenteEditar();

    
});


$(document).on("click", "#btnEditarMarca", function(){
    
validar_marca_existente_editar = validarMarcaExistenteEditar();

validar_marca_vacia_editar = validarMarcaVaciaEditar();

if(validar_marca_existente_editar !== 0 && validar_marca_vacia_editar  !== 0){
    
    
    
    document.forms["formularioEditarMarca"].submit();
}

});
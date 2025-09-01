//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarResurtidos").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarResurtidos").val("");
            $("#buscarResurtidos").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarResurtidos").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarResurtidos").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevoResurtido").trigger('click');
        //$(".close").hide();
        $("#buscarResurtidos").attr("teclaEsc", "no");
    }
});










//AL PRESIONAR F4 PARA CONVERTIR RESURTIDO A COMPRA
$(document).keydown(function(event) {
    if (event.which === 115)
    {
        event.preventDefault();

        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnConvertirResurtidoACompra").trigger("click"); 

        ////$(".close").hide();

        //$("#buscarResurtidos").attr("teclaEsc", "no");

    }

        

    }
});










//AL PRESIONAR F5 PARA EDITAR
$(document).keydown(function(event) {
    if (event.which === 116)
    {
        event.preventDefault();

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerPartidasResurtido").trigger("click"); 


    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarResurtidos").attr("teclaEsc");
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
        var buscador_esc = $("#buscarResurtidos").attr("teclaEsc");
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









$(document).on("click", ".btnVerPartidasResurtido", function(){

        //$(".close").hide();

        $("#buscarResurtidos").attr("teclaEsc", "no");

        var id_resurtido = $(this).attr("id_resurtido");


var datos =  {"id_resurtido": id_resurtido};


$.ajax({
        data:datos,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerPartidasResurtido.php',
        success: function(data) {

        $("#modalVerPartidasResurtido").modal("show");

        document.getElementById("incrustarTablaPartidasResurtido").innerHTML = data;
        activaTablaPartidasResurtido();
        }
        });

});










function buscarAhoraResurtidos(buscarResurtidos) {
        var parametros = {"buscarResurtidos":buscarResurtidos};
        $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadores/buscadorResurtidos.php',
                success: function(data) {
                        document.getElementById("incrustarTablaResurtidos").innerHTML = data;
                }
        });
}









    /*=============================================
    CONVERTIR RESURTIDO A COMPRA
    =============================================*/
    $(document).on("click", ".btnConvertirResurtidoACompra", function(){

    var id_resurtido = $(this).attr("id_resurtido");

    $("#convertirResurtidoACompra").val(id_resurtido);

    $("#textoIdResurtido").text(id_resurtido);

    $("#modalConvertirResurtidoACompra").modal("show");


    });









    $(document).on("click", "#btnSubmitConfirmarConversion", function(){

    document.forms["formularioConfirmarConversion"].submit();


    });










/*=============================================
        GENERAR EXCEL DEL RESUTRIDO
        =============================================*/
        $(document).on("click", ".btnExportarEXCELResurtido", function(){

                var id_resurtido = $(this).attr("id_resurtido");


                if(id_resurtido == ""){
                  return;
                }else{
                  
                  window.open("vistas/modulos/exportesExcel/excel-resurtido.php?id_resurtido="+id_resurtido, "_blank");

              }


                


                
        });
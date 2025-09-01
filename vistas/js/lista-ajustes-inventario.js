function activaTablaAjustesInventario() {

                $("#tablaAjustesInventario").DataTable({
      "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "No se encontraron resultados",
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
      "responsive": false, 
      "lengthChange": false, 
      "autoWidth": true,
      "scrollX": true,
        order: [[1, 'desc']],
    });
  }










function activaTablaPartidasAjusteInventario() {

                $("#tablaPartidasAjusteInventario").DataTable({
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
        order: [[2, 'asc']],
    });
  }





/*=============================================
BOTON EDITAR COMPRA
=============================================*/
$(document).on("click", ".btnEditarAjusteInventario", function(){

        var id_ajuste_inventario = $(this).attr("id_ajuste_inventario");

        window.location = "index.php?ruta=editar-ajuste-inventario&id_ajuste_inventario="+id_ajuste_inventario;


})








  function buscarAhoraAjustesInventario(buscarAjustesInventario) {

    document.getElementById("incrustarTablaAjustesInventario").innerHTML = "";

        var parametros = {"buscarAjustesInventario":buscarAjustesInventario};

        $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadores/buscadorAjustesInventario.php',
                success: function(data) {
                        document.getElementById("incrustarTablaAjustesInventario").innerHTML = data;

                        activaTablaAjustesInventario();
                }
        });
}










//AL PRESIONAR ESC
$(document).keydown(function(event) {
    if (event.which === 27)
    {
        event.preventDefault();
        var buscador_esc = $("#buscarAjustesInventario").attr("teclaEsc");
        if(buscador_esc == "si"){
        $("#buscarAjustesInventario").val("");
            $("#buscarAjustesInventario").focus();
        }else{
        $(".close").trigger('click');
        
        $("#buscarAjustesInventario").attr("teclaEsc", "si");

        }

    }
});










//AL PRESIONAR CTRL + |
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 220)
    {

        event.preventDefault();
        
        $(".close").trigger('click');
        
        $("#buscarAjustesInventario").attr("teclaEsc", "si");     

    }
});










//AL PRESIONAR F1 PARA CREAR
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $(".close").trigger('click');
        $("#btnCrearNuevaAjusteInventario").trigger('click');
        //$(".close").hide();
        $("#buscarAjustesInventario").attr("teclaEsc", "no");

        

    }
});








//AL PRESIONAR F2 PARA EDITAR
$(document).keydown(function(event) {
    if (event.which === 113)
    {

        event.preventDefault();

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];

        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnEditarAjusteInventario").trigger("click"); 

  

    }

        

    }
});





//AL PRESIONAR F4 VER PARTIDAS DE COMPRA
$(document).keydown(function(event) {
    if (event.which === 115)
    {
        event.preventDefault();
        $(".close").trigger('click');

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnVerPartidasAjusteInventario").trigger("click"); 

        //$(".close").hide();

        $("#buscarAjustesInventario").attr("teclaEsc", "no");

    }

        

    }
});










//AL PRESIONAR F5 PARA CONFIRMAR COMPRA
$(document).keydown(function(event) {
    if (event.which === 116)
    {
        event.preventDefault();

        const verifica_foco = document.getElementsByClassName("foco");

        var foco = verifica_foco[0];


        if(foco !== undefined && foco !== null){

        var contador_actual = $(foco).attr("contador");

        $(foco).parent().parent().children(".botones").children(".btn-group").children(".btnConfirmarAjusteInventario").trigger("click"); 

   

    }

        

    }
});









//AL PRESIONAR CTRL + FLECHA ABAJO
$(document).keydown(function(event) {
    if (event.ctrlKey && event.which === 40)
    {
        var buscador_esc = $("#buscarAjustesInventario").attr("teclaEsc");
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
        var buscador_esc = $("#buscarAjustesInventario").attr("teclaEsc");
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










$(document).on("click", ".btnVerPartidasAjusteInventario", function(){



        var id_ajuste_inventario = $(this).attr("id_ajuste_inventario");

var datosAjusteInventario =  {"id_ajuste_inventario": id_ajuste_inventario};


$.ajax({
        data:datosAjusteInventario,
        type: 'POST',
        url: 'vistas/modulos/consultas/consultaVerPartidasAjusteInventario.php',
        success: function(traerPartidasAjusteInventario) {

        $("#modalVerPartidasAjusteInventario").modal("show");

        document.getElementById("incrustarTablaPartidasAjusteInventario").innerHTML = traerPartidasAjusteInventario;
        activaTablaPartidasAjusteInventario();
        }
        });

});


















/*CONFIRMAMOS UNA COMPRA*/
$(document).on("click", ".btnConfirmarAjusteInventario", function(){

    var tipo_ajuste = $(this).attr("tipo_ajuste");

    if(tipo_ajuste == 0){

//CUANDO EL AJUSTE ES DE TIPO SALIDA
Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres confirmar este ajuste inventario? es de tipo SALIDA",
  footer: 'Si confirmas ya no habrá vuelta atras',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si',
  cancelButtonText: 'No',
}).then((result) => {


    if(result.isConfirmed) {


        var id_ajuste_inventario = $(this).attr("id_ajuste_inventario");

        var id_ajuste_inventario2 = new FormData();

        id_ajuste_inventario2.append("id_ajuste_inventario2", id_ajuste_inventario);


        $.ajax({

            url:"ajax/ajustes-inventario.ajax.php",
            method: "POST",
            data: id_ajuste_inventario2,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(traerAjusteInventario){

                console.log(traerAjusteInventario);

                var estatus_compra = parseInt(traerAjusteInventario['estatus']);


                if (estatus_compra !== 0) {

                    Swal.fire({
                    icon: 'error',
                    title: 'Este ajuste ya ha tenido movimiento',
                    showConfirmButton: false,
                    timer: 2000
                    }).then(function(result){
                        return;
                    });
                }else{

                    var confirmaAjusteInventarioDatos = new FormData();

    confirmaAjusteInventarioDatos.append("confirmarAjusteInventario", id_ajuste_inventario);

    $.ajax({
        url:"ajax/ajustes-inventario.ajax.php",
        method: "POST",
        data: confirmaAjusteInventarioDatos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            
                Swal.fire({
                  icon: 'success',
                  title: 'El ajuste ha sido confirmado',
                  showConfirmButton: true
                });
            

            $("#buscarAjustesInventario").val(id_ajuste_inventario);

            document.getElementById("buscarAjustesInventario").onkeyup();

            
        }
    });

                }//ESTE ES EL ELSE DE SI LA COMPRA AUN NO HA SIDO CONFIRMADA
            }
        });//TERMINA EL PROCESO DE VERIFICAR SI EL PROVEEDOR TIENE DIAS DE CREDITO, ESTE ES EL SEGUNDO PASO


  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {

  }


  
}); 

}//CUANDO EL AJUSTE ES DE TIPO SALIDA










//CUANDO EL AJUSTE ES DE TIPO ENTRADA
else{

Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres confirmar este ajuste inventario? es de tipo ENTRADA",
  footer: 'Si confirmas ya no habrá vuelta atras',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si',
  cancelButtonText: 'No',
}).then((result) => {


    if(result.isConfirmed) {


        var id_ajuste_inventario = $(this).attr("id_ajuste_inventario");

        var id_ajuste_inventario2 = new FormData();

        id_ajuste_inventario2.append("id_ajuste_inventario2", id_ajuste_inventario);


        $.ajax({

            url:"ajax/ajustes-inventario.ajax.php",
            method: "POST",
            data: id_ajuste_inventario2,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(traerAjusteInventario){

                console.log(traerAjusteInventario);

                var estatus_compra = parseInt(traerAjusteInventario['estatus']);


                if (estatus_compra !== 0) {

                    Swal.fire({
                    icon: 'error',
                    title: 'Este ajuste ya ha tenido movimiento',
                    showConfirmButton: false,
                    timer: 2000
                    }).then(function(result){
                        return;
                    });
                }else{

                    var confirmaAjusteInventarioDatos = new FormData();

    confirmaAjusteInventarioDatos.append("confirmarAjusteInventario", id_ajuste_inventario);

    $.ajax({
        url:"ajax/ajustes-inventario.ajax.php",
        method: "POST",
        data: confirmaAjusteInventarioDatos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            
                Swal.fire({
                  icon: 'success',
                  title: 'El ajuste ha sido confirmado',
                  showConfirmButton: true
                });
            

            $("#buscarAjustesInventario").val(id_ajuste_inventario);

            document.getElementById("buscarAjustesInventario").onkeyup();

            
        }
    });

                }//ESTE ES EL ELSE DE SI LA COMPRA AUN NO HA SIDO CONFIRMADA
            }
        });//TERMINA EL PROCESO DE VERIFICAR SI EL PROVEEDOR TIENE DIAS DE CREDITO, ESTE ES EL SEGUNDO PASO


  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {

  }


  
}); 

}//CUANDO EL AJUSTE ES DE TIPO ENTRADA

});
function activaTablaGrupos() {

                $("#tablaGrupos").DataTable({
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
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
        order: [[0, 'asc']],
    });
  }




$('#modalEditarGrupo').on('hidden.bs.modal', function() {
    $("#editarPermisos").val('').trigger('change');
})


$(document).ready(function() {
    $('#editarPermisos').select2({
        dropdownParent: $('#modalEditarGrupo')
    });
});






        /*=============================================
EDITAR GRUPO
=============================================*/
$(document).on("click", ".btnEditarGrupo", function(){

    var id_grupo = $(this).attr("id_grupo");

    var datos = new FormData();
    datos.append("id_grupo", id_grupo);

    $.ajax({
        url: "ajax/grupos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){

            $("#editarNombreGrupo").val(respuesta["nombre_grupo"]);
            $("#actualNombreGrupo").val(respuesta["nombre_grupo"]);
            $("#id_grupo").val(respuesta["id_grupo"]);

            var permisos = JSON.parse(respuesta["permisos"]);
            var x;

      for (x of permisos) {
        $("#editarPermisos option[value='"+x+"']").prop("selected", true);
      }


        $("#editarPermisos").bootstrapDualListbox('refresh');

            /*
            
            este es con select2
            
             permisos = JSON.parse(respuesta["permisos"]);

            $("#editarPermisos").val(permisos).trigger('change');*/


        }

    })


})




/*=============================================
ELIMINAR GRUPO
=============================================*/
$(document).on("click", ".btnEliminarGrupo", function(){

     var id_grupo = $(this).attr("id_grupo");

     Swal.fire({
  title: 'Estas segur@?',
  text: "Quieres eliminar este grupo?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si'
}).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=grupos&id_grupo="+id_grupo;

    }

  })

})



    

function buscarAhoraGrupos(buscarGrupos) {
        var parametros = {"buscarGrupos":buscarGrupos};
        document.getElementById("incrustarTablaGrupos").innerHTML = "";
        $.ajax({
        data:parametros,
        type: 'POST',
        url: 'vistas/modulos/buscadorGrupos.php',
        success: function(data) {
        document.getElementById("incrustarTablaGrupos").innerHTML = data;

        activaTablaGrupos();
        }
        });
        }






   /*=============================================
    VERIFICAR SI EL GRUPO EXISTE
    =============================================*/     
        
    function validarGrupoExistenteCrear() {
        
        
        var grupo = $("#nuevoNombreGrupo").val();

        var datos = new FormData();
        datos.append("validarGrupo", grupo);

     $.ajax({
        async: false,
        url:"ajax/grupos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            
            if(respuesta[0] === undefined){
                validar_grupo_existente_crear = 1;
                
                
            }
            else if(respuesta[0] !== undefined){

                $("#nuevoNombreGrupo").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Este grupo ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#nuevoNombreGrupo").val("");
                
                validar_grupo_existente_crear = 0;

            }

        }

    })
    
    return validar_grupo_existente_crear;
    }
    
    
    
    
     /*=============================================
    VERIFICAR SI EL GRUPO EXISTE
    =============================================*/     
        
    function validarGrupoExistenteEditar() {
        var grupo = $("#editarNombreGrupo").val();
        var grupo_actual = $("#actualNombreGrupo").val();

    if(grupo == grupo_actual){
        validar_grupo_existente_editar = 1;
        return validar_grupo_existente_editar;
    }
    else if(grupo !== grupo_actual){
        var datos = new FormData();
    datos.append("validarGrupo", grupo);

     $.ajax({
        url:"ajax/grupos.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        async : false,
        dataType: "json",
        success:function(respuesta){
            
            if(respuesta[0] === undefined){
                
                validar_grupo_existente_editar = 1;
                
            }
            
            else if(respuesta[0] !== undefined){
                
                

                $("#editarNombreGrupo").parent().after(Swal.fire({
                                    icon: 'error',
                                    title: 'Esta grupo ya existe, introduce otro',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }));

                $("#editarNombreGrupo").val(grupo_actual);
                
                validar_grupo_existente_editar = 0;

            }

        }

    })
    
    return validar_grupo_existente_editar;
    
    }
                
    }




        /*=============================================
REVISAR SI EL GRUPO YA ESTÁ REGISTRADA
=============================================*/

$(document).on("change", "#nuevoNombreGrupo", function(){
    
    validar_grupo_existente_crear = validarGrupoExistenteCrear();
    

});



/*=============================================
REVISAR SI EL GRUPO NO ESTA VACIA
=============================================*/
function validarGrupoVacioCrear() {
if($("#nuevoNombreGrupo").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para el grupo',
        showConfirmButton: false,
        timer: 2000
        });
        
        validar_grupo_vacio_crear = 0;
        
        return validar_grupo_vacio_crear;
        
        
    }else{
    
    validar_grupo_vacio_crear = 1;
    return validar_grupo_vacio_crear;
    }
    
    
    
}



function validarGrupoVacioEditar() {
    
    var grupo_actual = $("#actualNombreGrupo").val();
    
if($("#editarNombreGrupo").val() === ""){
        
        Swal.fire({
        icon: 'error',
        title: 'Debe introducir un nombre para la grupo',
        showConfirmButton: false,
        timer: 2000
        });
        
        $("#editarNombreGrupo").val(grupo_actual);
        
        validar_grupo_vacio_editar = 0;
        
        return validar_grupo_vacio_editar;
        
    }else{
        validar_grupo_vacio_editar = 1;
        
        return validar_grupo_vacio_editar;
        
    }
    
    
    
}



$(document).on("click", "#btnCrearGrupo", function(){
    
    
    validar_grupo_existente_crear = validarGrupoExistenteCrear();
    validar_grupo_vacio_crear = validarGrupoVacioCrear();
    

if(validar_grupo_existente_crear !== 0 && validar_grupo_vacio_crear  !== 0){
    
    document.forms["formularioCrearGrupo"].submit();
}

   

});





/*=============================================
REVISAR SI EL GRUPO YA ESTÁ REGISTRADO
=============================================*/

$(document).on("change", "#editarNombreGrupo", function(){
    
    validar_grupo_existente_editar = validarGrupoExistenteEditar();

    
});


$(document).on("click", "#btnEditarGrupo", function(){
    
validar_grupo_existente_editar = validarGrupoExistenteEditar();

validar_grupo_vacio_editar = validarGrupoVacioEditar();

if(validar_grupo_existente_editar !== 0 && validar_grupo_vacio_editar  !== 0){
    
    
    
    document.forms["formularioEditarGrupo"].submit();
}

});

$(document).on("click", "button.quitarProducto", function(){

    var partida = $(this).parent().parent();

    var id_producto = $(this).attr("id_producto");

    var id_partres = $(this).attr("id_partres");



    Swal.fire({
        icon: "warning",
        title: "¿Estas segur@?",
        text: "¿quieres eliminar esta partida?",
        footer: "Si presionas SI ya no habrá vuelta atrás",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Si",
        denyButtonText: `No`
    }).then((result) => {
        if (result.isConfirmed) {





            var datos = new FormData();
    datos.append("eliminarPartidaResurtido", id_partres);

    $.ajax({
        url:"ajax/resurtidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

            console.log(respuesta);

            if(respuesta == 1){

                /*var posicion = myArr.indexOf(id_producto);

                myArr.splice(posicion, 1);*/


                partida.remove();




                }

           

        }
    });//ajax eliminacion




        
        }// si se confirma la eliminacion
    });//swal de confirmacion

    





});



















$(document).on("keyup", ".nuevoAPedir", function(){

    var partres = $(this).parent().parent().children(".partres").children(".quitarProducto");

    var id_partres = partres.attr("id_partres");

    var a_pedir = $(this).val();


    actualizar_partida_resurtido(id_partres, a_pedir);


});





$(document).on("click", ".nuevoAPedir", function(){

    var partres = $(this).parent().parent().children(".partres").children(".quitarProducto");

    var id_partres = partres.attr("id_partres");

    var a_pedir = $(this).val();

    actualizar_partida_resurtido(id_partres, a_pedir);


});











function actualizar_partida_resurtido(id_partres, a_pedir) {

    var datos = new FormData();
    datos.append("guardaDatosPartidaResurtido", id_partres);
    datos.append("a_pedir", a_pedir);

    $.ajax({
        url:"ajax/resurtidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

            console.log(respuesta);

        }
    });
}
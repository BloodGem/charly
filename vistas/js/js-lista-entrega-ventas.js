

/*=============================================
BOTON EDITAR COMPRA
=============================================*/
$(document).on("click", ".btnSeleccionaEntregaVenta", function(){

        var id_venta = $(this).attr("id_venta");

        window.location = "index.php?ruta=entrega-venta&id_venta="+id_venta;


})








function buscarAhoraEntregaVentas(buscarEntregaVentas) {
        var parametros = {"buscarEntregaVentas":buscarEntregaVentas};
        $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/buscadores/buscadorEntregaVentas.php',
                success: function(data) {
                        document.getElementById("incrustarTablaEntregaVentas").innerHTML = data;
                }
        });
}
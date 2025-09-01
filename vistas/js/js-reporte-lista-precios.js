$(document).on("click", "#btnVerProductos1", function(){

            var id_marca = $("#id_marca>option:selected").val();
            
            var parametros = {"id_marca":id_marca};
                        

            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/consultas/serversideProductos1.php',
                success: function(data) {

                    document.getElementById("incrustarProductos1").innerHTML = data;

                    var serverside = $("#serversideProductos1").val();


                    $("#modalProductos1").modal("show");
                    $("#tablaProductos1").DataTable({
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "sAjaxSource": "ServerSide/serversideProductosParaSelect.php?serverside="+serverside,
                        "columnDefs":[{
                        "targets": -1,
                        "defaultContent": "<div class='btn-group'><button class='btn btn-primary btn-sm btnSeleccionarProductoInicial'>Seleccionar</button></div>"
                      }],
                        lengthMenu: [
                            [ 10, 25, 50, 100, 500, 1000, -1 ],
                            [ '10 registros', '25 registros', '50 registros', '100 registros', '500 registros', '1000 registros', 'Mostrar todos' ]
                        ],
                        order: [1, 'asc'],
                    });




                    /*listarProductos();
                    listarProductos2();*/
                }
            });   

        });









        $(document).on("click", ".btnSeleccionarProductoInicial", function(){
            fila = $(this);

            producto = fila.closest('tr').find('td:eq(1)').text();

            $("#productoIncial").val(producto);

            $("#cerrarModalProductos1").trigger("click");
        });










        $(document).on("click", "#btnVerProductos2", function(){

            var id_marca = $("#id_marca>option:selected").val();
            
            var parametros = {"id_marca":id_marca};
                        

            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/consultas/serversideProductos2.php',
                success: function(data) {

                    document.getElementById("incrustarProductos2").innerHTML = data;

                    var serverside = $("#serversideProductos2").val();


                    $("#modalProductos2").modal("show");
                    $("#tablaProductos2").DataTable({
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "sAjaxSource": "ServerSide/serversideProductosParaSelect.php?serverside="+serverside,
                        "columnDefs":[{
                        "targets": -1,
                        "defaultContent": "<div class='btn-group'><button class='btn btn-primary btn-sm btnSeleccionarProductoFinal'>Seleccionar</button></div>"
                      }],
                        lengthMenu: [
                            [ 10, 25, 50, 100, 500, 1000, -1 ],
                            [ '10 registros', '25 registros', '50 registros', '100 registros', '500 registros', '1000 registros', 'Mostrar todos' ]
                        ],
                        order: [1, 'asc'],
                    });




                    /*listarProductos();
                    listarProductos2();*/
                }
            });   

        });








        $(document).on("click", ".btnSeleccionarProductoFinal", function(){
            fila = $(this);

            producto = fila.closest('tr').find('td:eq(1)').text();

            $("#productoFinal").val(producto);

            $("#cerrarModalProductos2").trigger("click");
        });










$(document).on("click", "#btnConsultarListaPrecios", function(){

    document.getElementById("incrustarTablaReporteListaPrecios").innerHTML = "";

            var producto_inicial = $("#productoIncial").val();

            var producto_final = $("#productoFinal").val();

            var id_marca = $("#id_marca>option:selected").val();

            var parametros = {"producto_inicial":producto_inicial, "producto_final":producto_final, "id_marca":id_marca};
                        

            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/consultasReportes/consultaReporteListaPrecios.php',
                success: function(data) {
                    document.getElementById("incrustarTablaReporteListaPrecios").innerHTML = data;

                    var viewServersideReporteListaPrecios = $("#viewServersideReporteListaPrecios").val();

                    $("#tablaReporteListaPrecios").DataTable({
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "sAjaxSource": "ServerSide/serversideReporteListaPrecios.php?viewServersideReporteListaPrecios="+viewServersideReporteListaPrecios,
                        lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 registros', '25 registros', '50 registros', 'Mostrar todos' ]
                        ],
                        "dom": 'Blfrtip',
                        "buttons": [
                        'excel', 'pdf'
                        ],
                    }); 


                }
            });  
        
});
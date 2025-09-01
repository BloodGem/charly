$('#seleccionaProveedorResurtido').one('select2:open', function(e) {
    $('input.select2-search__field').prop('placeholder', 'Busca al proveedor aquí...');

});

function activaTablaPartidasResurtido() {

                $("#tablaPartidasResurtido").DataTable({
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





       var id_proveedor = $("#seleccionaProveedorResurtido>option:selected").val();

                $("#seleccionaProveedorResurtido2").val(id_proveedor);


                

 
        /*=============================================
        IMPRIMIR NOTA
        =============================================*/
        $(document).on("click", ".btnListarResurtido", function(){


                Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres consultar el surtido de este proveedor?",
                  footer: "Si aceptas... las partidas y todos los cambios que hayas hecho del proveedor actual se borrarán y no habrá vuelta atras, estas segur@?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                      var id_proveedor = $("#seleccionaProveedorResurtido>option:selected").val();

                      var en_ceros = $("#verEnCeros").is(":checked");

                        if (!en_ceros) {
                            var parametros = {"id_proveedor":id_proveedor, "en_ceros":0};
                        }else{
                            var parametros = {"id_proveedor":id_proveedor, "en_ceros":1};
                        }

                $.ajax({
                        data:parametros,
                        type: 'POST',
                        url: 'vistas/modulos/consultaMinimos.php',
                        success: function(data) {
                                document.getElementById("a").innerHTML = data;

                                // AGRUPAR PRODUCTOS EN FORMATO JSON

                listarProductos();
                listarProductos2();
                        }
                });  

                    }

                  })



                
        });










        











        $("#seleccionaProveedorResurtido").on('change', function() {


                id_proveedor = $(this).val();

                $("#seleccionaProveedorResurtido2").val(id_proveedor);


        });










        /*=============================================
        MODIFICAR LA CANTIDAD
        =============================================*/

        $(".formularioResurtido").on("change", "input.nuevoAPedir", function(){

                var cantidad = $(this).val();

                //alert("La cantidad a comprar de este producto es:  "+cantidad);

                var parametrosResurtidoCompra = $(this).parent().parent().children(".ingresoTotal").children(".parametrosResurtidoCompra");

                var precioCompra = parametrosResurtidoCompra.attr("precioCompra");
                
                //alert("El precio de este producto es:  "+precioCompra);

                var total = precioCompra * cantidad;

                //alert("Tu precio final de este producto es:  "+total);

                parametrosResurtidoCompra.attr("total", total);

                parametrosResurtidoCompra.attr("value", total);


                
                        // AGRUPAR PRODUCTOS EN FORMATO JSON

                listarProductos();

                listarProductos2();

        });










        /*=============================================
        QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
        =============================================*/


        $(".formularioResurtido").on("click", "button.quitarProducto", function(){

 
                $(this).parent().parent().remove();


                if($(".nuevoProducto").children().length == 0){

                        $("#listaProductos").val("");
                        $("#listaProductos2").val("");

                        
                        

                }else{
                        listarProductos();

                        listarProductos2();
                }



        });





        //AL PRESIONAR F1 PARA CREAR RESURTIDO
$(document).keydown(function(event) {
    if (event.which === 112)
    {
        event.preventDefault();
        $("#btnGenerarResurtido").trigger('click');
    }
});












        $(document).on("click", "#btnResurtidoAlfabetico", function(){
            $("#modalResurtidoAlfabetico").modal("show");
        });










        $(document).on("click", "#btnVerProductosRA1", function(){
            $("#modalProductosRA1").modal("show");
            $("#tablaProductosRA1").DataTable({
                "destroy": true,
              "processing": true,
              "serverSide": true,
              "sAjaxSource": "ServerSide/serversideProductosParaSelect.php",
              "columnDefs":[{
                "targets": -1,
                "defaultContent": "<div class='btn-group'><button class='btn btn-primary btn-sm btnSeleccionarProductoInicial'>Seleccionar</button></div>"
              }],
              lengthMenu: [
                [ 10, 25, 50, 100, 500, 1000, -1 ],
                [ '10 registros', '25 registros', '50 registros', '100 registros', '500 registros', '1000 registros', 'Mostrar todos' ]
                ],  
           }); 

        });



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










$(document).on("click", "#btnGenerarRA", function(){

    Swal.fire({
        title: 'Estas segur@?',
        text: "Quieres consultar estos datos?",
        footer: "Si aceptas... las partidas y todos los cambios que hayas hecho se borrarán y no habrá vuelta atras, estas segur@?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function(result){

        if(result.value){

            $("#cerrarModalResurtidoAlfabetico").trigger("click");

            var producto_inicial = $("#productoIncial").val();

            var producto_final = $("#productoFinal").val();

            var id_marca = $("#id_marca>option:selected").val();

            //alert(producto_inicial);

            //alert(producto_final);

            var parametros = {"producto_inicial":producto_inicial, "producto_final":producto_final, "id_marca":id_marca};
                        

            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/consultas/consultaProductosRA.php',
                success: function(data) {
                    document.getElementById("a").innerHTML = data;

                    var viewServersideRA = $("#viewServersideRA").val();

                    $("#tablaProductosResurtido").DataTable({
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "sAjaxSource": "ServerSide/serversideProductosRA.php?viewServersideRA="+viewServersideRA,
                        lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 registros', '25 registros', '50 registros', 'Mostrar todos' ]
                        ],
                        "dom": 'Blfrtip',
                        "buttons": [
                        'excel', 'pdf'
                        ],
                    }); 


                    listarProductos();
                    listarProductos2();
                }
            });  
        }
    });  
});





























$(document).on("click", "#btnResurtidoAlfabeticoProveedor", function(){
            $("#modalResurtidoAlfabeticoProveedor").modal("show");
        });










        $(document).on("click", "#btnVerProductosProveedor1", function(){

            var id_proveedor = $("#seleccionaProveedorResurtido>option:selected").val();
            
            var parametros = {"id_proveedor":id_proveedor};
                        

            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/consultas/serversideProductosProveedor1.php',
                success: function(data) {

                    document.getElementById("incrustarProductosProveedor1").innerHTML = data;

                    $("#modalProductosProveedor1").modal("show");

                    var serverside = $("#serversideProductosProveedor1").val();


                    $("#tablaProductosProveedor1").DataTable({
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "sAjaxSource": "ServerSide/serversideProductosProveedorParaSelect.php?serverside="+serverside,
                        "columnDefs":[{
                        "targets": -1,
                        "defaultContent": "<div class='btn-group'><button class='btn btn-primary btn-sm btnSeleccionarProductoInicialProveedor'>Seleccionar</button></div>"
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









        $(document).on("click", ".btnSeleccionarProductoInicialProveedor", function(){
            fila = $(this);

            producto = fila.closest('tr').find('td:eq(1)').text();

            $("#productoInicialProveedor").val(producto);

            $("#cerrarModalProductosProveedor1").trigger("click");
        });










        $(document).on("click", "#btnVerProductosProveedor2", function(){

            var id_proveedor = $("#seleccionaProveedorResurtido>option:selected").val();
            
            var parametros = {"id_proveedor":id_proveedor};
                        

            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/consultas/serversideProductosProveedor2.php',
                success: function(data) {

                    document.getElementById("incrustarProductosProveedor2").innerHTML = data;

                    $("#modalProductosProveedor2").modal("show");

                    var serverside = $("#serversideProductosProveedor2").val();


                    $("#tablaProductosProveedor2").DataTable({
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "sAjaxSource": "ServerSide/serversideProductosProveedorParaSelect.php?serverside="+serverside,
                        "columnDefs":[{
                        "targets": -1,
                        "defaultContent": "<div class='btn-group'><button class='btn btn-primary btn-sm btnSeleccionarProductoFinalProveedor'>Seleccionar</button></div>"
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









        $(document).on("click", ".btnSeleccionarProductoFinalProveedor", function(){
            fila = $(this);

            producto = fila.closest('tr').find('td:eq(1)').text();

            $("#productoFinalProveedor").val(producto);

            $("#cerrarModalProductosProveedor2").trigger("click");
        });










$(document).on("click", "#btnGenerarRAP", function(){

    Swal.fire({
        title: 'Estas segur@?',
        text: "Quieres consultar estos datos?",
        footer: "Si aceptas... las partidas y todos los cambios que hayas hecho se borrarán y no habrá vuelta atras, estas segur@?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(function(result){

        if(result.value){

            $("#cerrarModalResurtidoAlfabeticoProveedor").trigger("click");

            var producto_inicial = $("#productoInicialProveedor").val();

            var producto_final = $("#productoFinalProveedor").val();

            var id_proveedor = $("#seleccionaProveedorResurtido>option:selected").val();


            //alert(producto_inicial);

            //alert(producto_final);

            var parametros = {"producto_inicial":producto_inicial, "producto_final":producto_final, "id_proveedor":id_proveedor};
                        

            $.ajax({
                data:parametros,
                type: 'POST',
                url: 'vistas/modulos/consultas/consultaProductosRAP.php',
                success: function(data) {
                    document.getElementById("a").innerHTML = data;

                    var viewServersideRAP = $("#viewServersideRAP").val();

                    $("#tabla2").DataTable({
                        "destroy": true,
                        "processing": true,
                        "serverSide": true,
                        "sAjaxSource": "ServerSide/serversideProductosRAP.php?viewServersideRAP="+viewServersideRAP,
                        lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 registros', '25 registros', '50 registros', 'Mostrar todos' ]
                        ],
                        "dom": 'Blfrtip',
                        "buttons": [
                        'excel', 'pdf'
                        ],
                    }); 


                    listarProductos();
                    listarProductos2();
                }
            });  
        }
    });  
});
















































        /*=============================================
        CONFIRMAR RESURTIDO
        =============================================*/
        $(document).on("click", "#btnGenerarResurtido", function(){



                         Swal.fire({
                  title: 'Estas segur@?',
                  text: "Quieres generar el resurtido?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si'
                }).then(function(result){

                    if(result.value){

                        var lista = $("#listaProductos").val();

                        if(lista !== ""){
                                document.forms["formularioResurtido"].submit();
                        }else{
                                Swal.fire({
                                icon: 'error',
                                title: 'No se han detectado productos en el resurtido',
                                showConfirmButton: true,
                                });
                        }

                      

                    }

                  })
        })







                /*=============================================
        LISTAR TODOS LOS PRODUCTOS
        =============================================*/

        function listarProductos(){

                var listaProductos = [];

                var descripcion_corta = $(".nuevaDescripcionProducto");

                var clave_producto = $(".nuevaClaveProducto");

                var stock_actual = $(".stockActual");

                var nivel_maximo = $(".nivelMaximo");

                var a_pedir = $(".nuevoAPedir");


                for(var i = 0; i < descripcion_corta.length; i++){

                        listaProductos.push({ "id_producto" : $(descripcion_corta[i]).attr("id_producto"),
                              "stock_actual" : $(stock_actual[i]).val(),
                              "nivel_maximo" : $(nivel_maximo[i]).val(),
                              "a_pedir" : $(a_pedir[i]).val()})

                }
                console.log("listaProductos", listaProductos);

                $("#listaProductos").val(JSON.stringify(listaProductos)); 

        }





















                /*=============================================
        LISTAR TODOS LOS PRODUCTOS PARA UNA POSIBLE COMPRA
        =============================================*/

        function listarProductos2(){

                var listaProductos2 = [];

                var descripcion = $(".nuevaDescripcionProducto");

                var cantidad = $(".nuevoAPedir");

                var parametrosResurtidoCompra = $(".parametrosResurtidoCompra");


                for(var i = 0; i < descripcion.length; i++){

                        listaProductos2.push({ "id" : $(descripcion[i]).attr("id_producto"),
                              "costoCompra" : $(parametrosResurtidoCompra[i]).attr("precioCompra"),
                              "cantidad" : $(cantidad[i]).val(),
                              "descuento" : $(parametrosResurtidoCompra[i]).attr("descuento"),
                              "precio" : $(parametrosResurtidoCompra[i]).attr("precioCompra"),
                              "total" : $(parametrosResurtidoCompra[i]).val()})

                }
                console.log("listaProductos2", listaProductos2);

                $("#listaProductos2").val(JSON.stringify(listaProductos2)); 

        }
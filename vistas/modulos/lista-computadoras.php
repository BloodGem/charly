


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--CONTENIDO-->
    <div class="card">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> LISTA DE COMPUTADORAS</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <div class="breadcrumb float-sm-right">
                            <?php

                            $indiceCrearComputadoras = array_search("Crear computadoras",$array,true);

                            if($indiceCrearComputadoras !== false){
                                echo '<button class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalCrearComputadora" id="btnCrearNuevaComputadora">Crear Computadora</button>';
                            }

                            ?>
                            


                            
                        </div>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <?php


        $indiceVerComputadoras = array_search("Ver computadoras",$array,true);

        if($indiceVerComputadoras !== false){
            ?>


            <div class="card-body">
                <table id="tablaComputadoras" class="table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Computadora</th>
                            <th>imp Ventas</th>
                            <th>imp Caja</th>
                            <th>imp Almacen</th>
                            <th>imp Devol</th>
                            <th>imp Compras</th>
                            <th>imp Cotiza</th>
                            <th>imp Garant</th>
                            <th>Acciones</th>
                       </tr>
                   </thead>
                   <tbody>
                    <?php
                    $traerComputadoras =  ControladorComputadoras::ctrMostrarComputadorasSucursal(1);
                    foreach ($traerComputadoras as $key => $value) {
                        echo '<tr><td>'.$value["codigo"].'</td>
                        <td>'.$value["computadora"].'</td>
                        <td>'.$value["imp_ventas"].'</td>
                        <td>'.$value["imp_caja"].'</td>
                        <td>'.$value["imp_almacen"].'</td>
                        <td>'.$value["imp_devoluciones"].'</td>
                        <td>'.$value["imp_compras"].'</td>
                        <td>'.$value["imp_cotizaciones"].'</td>
                        <td>'.$value["imp_garantias"].'</td>
                        <td><div class="btn-group">';

                        $indiceEditarComputadoras = array_search("Editar computadoras",$array,true);

                        if($indiceEditarComputadoras !== false){



                            echo'
                            <button class="btn-xs btn-warning btnEditarComputadora" id_computadora="'.$value["id_computadora"].'"><i class="fa fa-edit"></i>Editar</button>';

                        }

                        $indiceEliminarComputadoras = array_search("Eliminar computadoras",$array,true);

                        if($indiceEliminarComputadoras !== false){

                            echo '<button class="btn-xs btn-danger btnEliminarComputadora" id_computadora="'.$value["id_computadora"].'"><i class="fa fa-times"></i>Eliminar</button>';

                        }
                        echo '</div></td>';
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código</th>
                       <th>Computadora</th>
                       <th>imp Ventas</th>
                       <th>imp Caja</th>
                       <th>imp Almacen</th>
                       <th>imp Devol</th>
                       <th>imp Compras</th>
                       <th>imp Cotiza</th>
                       <th>imp Garant</th>
                       <th>Acciones</th>
                   </tr>
               </tfoot>
           </table>
       </div>
       <?php 

   }

   ?>
<!-- /.card-body -->
</div>









</div>

<div class="modal fade" id="modalCrearComputadora">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioCrearComputadora">
                <div class="modal-header">
                    <h4 class="modal-title">Crear computadora</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Código 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" placeholder="Código" value="" autocomplete="new-text" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Computadora 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="nuevaComputadora" name="nuevaComputadora" placeholder="Computadora" value="" autocomplete="new-text" required>
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Impresora ventas
                                </label>
                                <select class="form-control" id="nuevaImpresoraVentas" name="nuevaImpresoraVentas">
                                    <option value="">--Selecciona--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Impresora caja
                                </label>
                                <select class="form-control" id="nuevaImpresoraCaja" name="nuevaImpresoraCaja">
                                    <option value="">--Selecciona--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Impresora almacen
                                </label>
                                <select class="form-control" id="nuevaImpresoraAlmacen" name="nuevaImpresoraAlmacen">
                                    <option value="">--Selecciona--</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Impresora devoluciones
                                </label>
                                <select class="form-control" id="nuevaImpresoraDevoluciones" name="nuevaImpresoraDevoluciones">
                                    <option value="">--Selecciona--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Impresora compras
                                </label>
                                <select class="form-control" id="nuevaImpresoraCompras" name="nuevaImpresoraCompras">
                                    <option value="">--Selecciona--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Impresora cotizaciones
                                </label>
                                <select class="form-control" id="nuevaImpresoraCotizaciones" name="nuevaImpresoraCotizaciones">
                                    <option value="">--Selecciona--</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Impresora garantias
                                </label>
                                <select class="form-control" id="nuevaImpresoraGarantias" name="nuevaImpresoraGarantias">
                                    <option value="">--Selecciona--</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnCrearComputadora">Crear computadora</button>
                </div>

                <?php 

                $crearComputadora = new ControladorComputadoras();
                $crearComputadora -> ctrCrearComputadora();

                ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modalEditarComputadora">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" id="formularioEditarComputadora">
                <input type="hidden" Class="form-control" id="idComputadora" name="idComputadora" value="">
                <div class="modal-header">
                    <h4 class="modal-title">Editar computadora</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Código 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="editarCodigo" name="editarCodigo" placeholder="Código" value="" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Computadora 
                                    <big><code>*</code></big>
                                </label>
                                <input type="text" class="form-control" id="editarComputadora" name="editarComputadora" placeholder="Computadora" value="" required>
                            </div>
                        </div>






                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Impresora ventas
                                    </label>
                                    <select class="form-control" id="editarImpresoraVentas" name="editarImpresoraVentas">
                                        <option value="">--Selecciona--</option>
                                    </select>
                                    <input type="text" class="form-control" id="mostrarImpresoraVentas" name="mostrarImpresoraVentas" readonly disabled>
                                </div></div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Impresora caja
                                        </label>
                                        <select class="form-control" id="editarImpresoraCaja" name="editarImpresoraCaja">
                                            <option value="">--Selecciona--</option>
                                        </select>
                                        <input type="text" class="form-control" id="mostrarImpresoraCaja" name="mostrarImpresoraCaja" readonly disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Impresora almacen
                                        </label>
                                        <select class="form-control" id="editarImpresoraAlmacen" name="editarImpresoraAlmacen">
                                            <option value="">--Selecciona--</option>
                                        </select>
                                        <input type="text" class="form-control" id="mostrarImpresoraAlmacen" name="mostrarImpresoraAlmacen" readonly disabled>
                                    </div>
                                </div>




                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Impresora devoluciones
                                        </label>
                                        <select class="form-control" id="editarImpresoraDevoluciones" name="editarImpresoraDevoluciones">
                                            <option value="">--Selecciona--</option>
                                        </select>
                                        <input type="text" class="form-control" id="mostrarImpresoraDevoluciones" name="mostrarImpresoraDevoluciones" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Impresora compras
                                        </label>
                                        <select class="form-control" id="editarImpresoraCompras" name="editarImpresoraCompras">
                                            <option value="">--Selecciona--</option>
                                        </select>
                                        <input type="text" class="form-control" id="mostrarImpresoraCompras" name="mostrarImpresoraCompras" readonly disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Impresora cotizaciones
                                        </label>
                                        <select class="form-control" id="editarImpresoraCotizaciones" name="editarImpresoraCotizaciones">
                                            <option value="">--Selecciona--</option>
                                        </select>
                                        <input type="text" class="form-control" id="mostrarImpresoraCotizaciones" name="mostrarImpresoraCotizaciones" readonly disabled>
                                    </div>
                                </div>




                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Impresora garantias
                                        </label>
                                        <select class="form-control" id="editarImpresoraGarantias" name="editarImpresoraGarantias">
                                            <option value="">--Selecciona--</option>
                                        </select>
                                        <input type="text" class="form-control" id="mostrarImpresoraGarantias" name="mostrarImpresoraGarantias" readonly disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnEditarComputadora">Guardar modificaciones</button>
                        </div>

                        <?php 

                        $editarComputadora = new ControladorComputadoras();
                        $editarComputadora -> ctrEditarComputadora();

                        ?>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <?php 

        $eliminarComputadora = new ControladorComputadoras();
        $eliminarComputadora -> ctrEliminarComputadora();

        ?>



                    <!--<script>

                        const obtenerListaDeImpresoras = async () => {
                            return await ConectorPluginV3.obtenerImpresoras();
                        }
                        const URLPlugin = "http://localhost:8000"
                        const $nuevaImpresoraVentas = document.querySelector("#nuevaImpresoraVentas");
                        const $nuevaImpresoraAlmacen = document.querySelector("#nuevaImpresoraAlmacen");
                        const $nuevaImpresoraDevoluciones = document.querySelector("#nuevaImpresoraDevoluciones");
                        const $nuevaImpresoraCompras = document.querySelector("#nuevaImpresoraCompras");
                        const $editarImpresoraVentas = document.querySelector("#editarImpresoraVentas");
                        const $editarImpresoraAlmacen = document.querySelector("#editarImpresoraAlmacen");
                        const $editarImpresoraDevoluciones = document.querySelector("#editarImpresoraDevoluciones");
                        const $editarImpresoraCompras = document.querySelector("#editarImpresoraCompras");

                        const init = async () => {
                            const impresoras = await ConectorPluginV3.obtenerImpresoras(URLPlugin);
                            for (const impresora of impresoras) {
                                $nuevaImpresoraVentas.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));

                                $nuevaImpresoraAlmacen.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));

                                $nuevaImpresoraDevoluciones.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));

                                $nuevaImpresoraCompras.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));

                                $editarImpresoraVentas.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));

                                $editarImpresoraAlmacen.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));

                                $editarImpresoraDevoluciones.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));

                                $editarImpresoraCompras.appendChild(Object.assign(document.createElement("option"), {
                                    value: impresora,
                                    text: impresora,
                                }));


                            }
                            
                        }


                        init();
                    </script>-->

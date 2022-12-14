<?php require_once "../Template/cabecera.php" ?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Factura</h1>
    <?php
    include_once '../Database/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT idCliente, cedula, nombre, apellido, telefono, direccion, correo FROM cliente";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nueva Factura</button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaFactura" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Fecha vencimiento</th>
                                <th>cliente</th>
                                <th>cantidad</th>
                                <th>descripcion</th>
                                <th>Precio unitario</th>
                                <th>Importe</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                            ?>
                                <tr>
                                    <td><?php echo $dat['idFactura'] ?></td>
                                    <td><?php echo $dat['fecha'] ?></td>
                                    <td><?php echo $dat['fechaVencimiento'] ?></td>
                                    <td><?php echo $dat['cliente'] ?></td>
                                    <td><?php echo $dat['cantidad'] ?></td>
                                    <td><?php echo $dat['descripcion'] ?></td>
                                    <td><?php echo $dat['precioUnitario'] ?></td>
                                    <td><?php echo $dat['importe'] ?></td>
                                    <td><?php echo $dat['total'] ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formCliente">
                    <div class="modal-body">
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="cedula" name="cedula" placeholder="cedula">
                            <span class="focus-efecto"></span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="nombre" name="nombre" placeholder="nombre">
                            <span class="focus-efecto"></span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="apellido" name="apellido" placeholder="apellido">
                            <span class="focus-efecto"></span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="telefono" name="telefono" placeholder="telefono/celular">
                            <span class="focus-efecto"></span>
                        </div>

                        <div class="wrap-input100">
                            <input class="input100" type="text" id="direccion" name="direccion" placeholder="direccion de residencia">
                            <span class="focus-efecto"></span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="correo" name="correo" placeholder="Correo electronico">
                            <span class="focus-efecto"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!--FIN del cont principal-->
<?php require_once "../Template/footer.php" ?>
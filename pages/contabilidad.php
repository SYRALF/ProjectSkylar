<?php require_once "../Template/cabecera.php" ?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contabilidad</h1>
    <?php
    include_once '../Database/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT idContabilidad, fecha, servicio, detalle, tipo, precio FROM contabilidad";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nueva Contabilidad</button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaContabilidad" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Servicio</th>
                                <th>Detalle</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                            ?>
                                <tr>
                                    <td><?php echo $dat['idContabilidad'] ?></td>
                                    <td><?php echo $dat['fecha'] ?></td>
                                    <td><?php echo $dat['servicio'] ?></td>
                                    <td><?php echo $dat['detalle'] ?></td>
                                    <td><?php echo $dat['tipo'] ?></td>
                                    <td><?php echo $dat['precio'] ?></td>
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
                <form id="formContabilidad">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha" class="col-form-label">Fecha:</label>
                            <input type="date" id="fecha" name="fecha">
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="servicio" name="servicio" placeholder="servicio">
                            <span class="focus-efecto"></span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="detalle" name="detalle" placeholder="detalle">
                            <span class="focus-efecto"></span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="tipo" name="tipo" placeholder="ingreso/gasto">
                            <span class="focus-efecto"></span>
                        </div>
                        
                        <div class="wrap-input100">
                            <input class="input100" type="text" id="precio" name="precio" placeholder="precio">
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
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
                                <th># Factura</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Total Facturado</th>
                                <th>Imprimir</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                            ?>
                                <tr>
                                    <td><?php echo $dat['idFactura'] ?></td>
                                    <td><?php echo $dat['fecha'] ?></td>
                                    <td><?php echo $dat['cliente'] ?></td>
                                    <td><?php echo $dat['total'] ?></td>
                                    <td><?php echo $dat['imprimir'] ?></td>
                                    <td><?php echo $dat['editar'] ?></td>
                                    <td><?php echo $dat['eliminar'] ?></td>
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

</div>
<!--FIN del cont principal-->
<?php require_once "../Template/footer.php" ?>
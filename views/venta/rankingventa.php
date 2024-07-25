<?php require_once "views/layout/header.php"; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold " style="color: black; font-weight: bold;">Ranking de Ventas por Producto</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style=" color: black; background-color: #F8C29B;">ID Producto</th>
                        <th style=" color: black; background-color: #F8C29B;">Nombre del Producto</th>
                        <th style=" color: black; background-color: #F8C29B;">Cantidad Total Vendida</th>
                        <th style=" color: black; background-color: #F8C29B;">Venta Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($datos) && is_array($datos)) { ?>
                        <?php foreach ($datos as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idproducto']); ?></td>
                                <td><?php echo htmlspecialchars($row['nombre_producto']); ?></td>
                                <td><?php echo htmlspecialchars($row['cantidad_total']); ?></td>
                                <td><?php echo htmlspecialchars(number_format($row['venta_total'], 2)); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4">No se encontraron datos.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<?php require_once "views/layout/footer.php"; ?>

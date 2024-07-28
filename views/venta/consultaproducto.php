<?php require_once "views/layout/header.php"; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold" style="color: black; font-weight: bold;">Consulta por Productos</h3>
    </div>
    <div class="card-body">
    <div class="card-body" style="background-color: #FDE5DD;">
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre_producto" style="color: black;">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese el nombre del producto">
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="buscar" style="background-color: #973A5C; border-color: #973A5C;">Obtener Consulta</button>
            <button type="submit" class="btn btn-secondary" name="action" value="mostrar_todos" style="background-color: #8D7BB3; border-color: #8D7BB3;">Mostrar Todos los Productos</button>
        </form>
        </div>

        <?php if (!empty($datos)) { ?>
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="color: black; background-color: #F8C29B;">ID Producto</th>
                            <th style="color: black; background-color: #F8C29B;">Nombre</th>
                            <th style="color: black; background-color: #F8C29B;">Precio</th>
                            <th style="color: black; background-color: #F8C29B;">Costo</th>
                            <th style="color: black; background-color: #F8C29B;">Cantidad</th>
                            <th style="color: black; background-color: #F8C29B;">Venta Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idproducto']); ?></td>
                                <td><?php echo htmlspecialchars($row['nomproducto']); ?></td>
                                <td><?php echo htmlspecialchars(number_format($row['precio'], 2)); ?></td>
                                <td><?php echo htmlspecialchars(number_format($row['costo'], 2)); ?></td>
                                <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                                <td><?php echo htmlspecialchars(number_format($row['valorventa'], 2)); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
        <?php } ?>
    </div>
</div>
</div>
<?php require_once "views/layout/footer.php"; ?>

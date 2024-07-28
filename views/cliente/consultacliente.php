<?php require_once "views/layout/header.php"; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold" style="color: black; font-weight: bold;">Consulta por Cliente</h3>
    </div>
    <div class="card-body">
    <div class="card-body" style="background-color: #FDE5DD;">
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre_cliente" style="color: black;">Nombre del Cliente:</label>
                <input type="text" class="form-control" id="nomcli" name="nomcli" placeholder="Ingrese el nombre del cliente">
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="obtener" style="background-color: #973A5C; border-color: #973A5C;">Obtener Consulta</button>
            <button type="submit" class="btn btn-secondary" name="action" value="mostrar_todos" style="background-color: #8D7BB3; border-color: #8D7BB3;" >Mostrar Todos los Clientes</button>
        </form>
</div>

        <?php if (!empty($datos)) { ?>
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="color: black; background-color: #F8C29B;">ID Cliente</th>
                            <th style="color: black; background-color: #F8C29B;">Nombre Cliente</th>
                            <th style="color: black; background-color: #F8C29B;">Venta Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['idcliente']); ?></td>
                                <td><?php echo htmlspecialchars($row['nomcliente']); ?></td>
                                <td><?php echo htmlspecialchars(number_format($row['valorventa'], 2)); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>
</div>

<?php require_once "views/layout/footer.php"; ?>

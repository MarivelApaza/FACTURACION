<?php require_once "views/layout/header.php"; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold " style="color: black; font-weight: bold;">Consulta por Cliente</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style=" color: black; background-color: #F8C29B;">ID Cliente</th>
                        <th style=" color: black; background-color: #F8C29B;">Nombre Cliente</th>
                        <th style=" color: black; background-color: #F8C29B;">Venta Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $row) { ?>
                        <tr>
                            <td><?php echo $row['idcliente']; ?></td>
                            <td><?php echo $row['nomcliente']; ?></td>
                            <td><?php echo $row['valorventa']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<?php require_once "views/layout/footer.php"; ?>
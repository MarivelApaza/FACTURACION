<?php require_once "views/layout/header.php"; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold" style="color: black; font-weight: bold;">Ventas por Fecha y Día de la Semana</h3>
    </div>
    <div class="card-body">
        <div class="card-body" style="background-color: #FDE5DD;">
        <form method="POST" action="">
            <div class="form-group">
                <label for="fecha" style="color: black;">Selecciona la Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha">
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="obtener" style="background-color: #973A5C; border-color: #973A5C;">Obtener Consulta</button>
            <button type="submit" class="btn btn-secondary" name="action" value="mostrar_todas" style="background-color: #8D7BB3; border-color: #8D7BB3;">Mostrar Todas las Ventas</button>
        </form>
        </div>
        <?php if (!empty($datos)) { ?>
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="color: black; background-color: #F8C29B;">Fecha</th>
                            <th style="color: black; background-color: #F8C29B;">Día de la Semana</th>
                            <th style="color: black; background-color: #F8C29B;">Total Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                                <td>
                                    <?php
                                    $dias = [
                                        1 => 'Domingo',
                                        2 => 'Lunes',
                                        3 => 'Martes',
                                        4 => 'Miércoles',
                                        5 => 'Jueves',
                                        6 => 'Viernes',
                                        7 => 'Sábado'
                                    ];
                                    echo htmlspecialchars($dias[$row['dia_semana']]);
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars(number_format($row['total_venta'], 2)); ?></td>
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

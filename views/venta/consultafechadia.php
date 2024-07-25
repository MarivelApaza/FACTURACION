<?php require_once "views/layout/header.php"; ?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold" style="color: black; font-weight: bold;">Ventas por Fecha y Día de la Semana</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style=" color: black; background-color: #F8C29B;">Fecha</th>
                        <th style=" color: black; background-color: #F8C29B;">Día de la Semana</th>
                        <th style=" color: black; background-color: #F8C29B;">Total Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $row) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td>
                                <?php
                                    // Map the day of the week (1 = Sunday, 2 = Monday, etc.) to a readable format
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
    </div>
</div>

</div>


<?php require_once "views/layout/footer.php"; ?>

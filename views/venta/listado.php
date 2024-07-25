<?php
require_once "views/layout/header.php";

$oVenta = new ModeloVenta();
$datos = $oVenta->listaVentas();
?>

 <div class="card shadow mb-4">

    
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold" style="color: black; font-weight: bold;" >Listado de Ventas</h3>
        <div class="card text-right">
            <div class="card-body">
                <a href="index.php?c=venta&a=nuevo" class="btn btn-success">Registrar Nueva Venta</a> 
               
            </div>
        </div>
    </div>
   
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style=" color: black; background-color: #F8C29B;">ID</th>
                        <th style=" color: black; background-color: #F8C29B;">Fecha</th>
                        <th style=" color: black; background-color: #F8C29B;">Cliente</th>
                        <th style=" color: black; background-color: #F8C29B;">Usuario</th>
                        <th style=" color: black; background-color: #F8C29B;">Fecha Registrada</th>
                        <th style=" color: black; background-color: #F8C29B;">Condicion</th>
                        <th style=" color: black; background-color: #F8C29B;">IGV</th>
                        <th style=" color: black; background-color: #F8C29B;">Total</th>
                        <th style=" color: black; background-color: #F8C29B;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                       foreach ($datos as $row) {
                    ?>
                    <tr>
                        <td><?php echo $row['idfactura']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td><?php echo $row['nomcliente']; ?></td>
                        <td><?php echo $row['nomusuario']; ?></td>
                        <td><?php echo $row['fechareg']; ?></td>   
                        <td><?php echo $row['nomcondicion']; ?></td>
                        <td><?php echo $row['igv']; ?></td>
                        <td><?php echo $row['valorventa']; ?></td>
                        <td>
                        <a href="index.php?c=venta&a=borrar&id=<?php echo $row['idfactura']; ?>" class="btn btn-danger btn-circle btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


</div>

<?php
require_once "views/layout/footer.php"; 
?>

 
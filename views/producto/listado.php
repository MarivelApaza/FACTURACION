<?php
require_once "views/layout/header.php";
 ?>

 <div class="card shadow mb-4">

    
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold" style="color: black; font-weight: bold;">Lista de Productos</h3>
        <div class="card text-right">
            <div class="card-body">
                <a href="index.php?c=producto&a=nuevo" class="btn btn-success" style="background-color: #FADF80; color: #000000;">Agregar Productos</a>              
            </div>
        </div>
    </div>
   
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Unidad</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Costo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                       foreach ($datos as $row) {
                    ?>
                    <tr>
                        <td><?php echo $row['idproducto']; ?></td> 
                        <td><?php echo $row['nomproducto']; ?></td>
                        <td><?php echo $row['unimed']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                        <td><?php echo $row['preuni']; ?></td>
                        <td><?php echo $row['cosuni']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                    <td>
                        <a href="index.php?c=producto&a=editar&id=<?php echo $row['idproducto']; ?>" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i>
                        </a>
                        <a href="index.php?c=producto&a=borrar&id=<?php echo $row['idproducto']; ?>" class="btn btn-danger btn-circle btn-sm">
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

 
<?php
require_once ROOT_PATH."views/layout/header.php";

 ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Proveedor</h1>  
    </div>

    <!-- Content Row -->
    <div class="row">
    <div class="card-body shadow" style="background-color: #FDE5DD;">
   
      <form method="post" action="?c=proveedor&a=actualizar">
          
        <div class="form-group">
            <input type="hidden" name="idproveedor" value="<?php echo $datos['idproveedor']; ?>">
            <label for="nomproveedor">Nombre Proveedor</label>
            <input type="text" class="form-control" name="nomproveedor" value="<?php echo $datos['nomproveedor']; ?>">
          </div>
          <div class="form-group">
            <label for="rucproveedor">RUC</label>
            <input type="text" class="form-control" name="rucproveedor" value="<?php echo $datos['rucproveedor']; ?>">
          </div>
          <div class="form-group">
            <label for="dirproveedor">Direccion</label>
            <input type="text" class="form-control" name="dirproveedor" value="<?php echo $datos['dirproveedor']; ?>">
          </div>
          <div class="form-group">
            <label for="telproveedor">Telefono</label>
            <input type="text" class="form-control" name="telproveedor" value="<?php echo $datos['telproveedor']; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="emailproveedor" value="<?php echo $datos['emailproveedor']; ?>">
          </div>
          
          <input class="btn btn-primary" type="submit" value="Guardar" style="background-color: #973A5C; border-color: #973A5C;">
          <a class="btn btn-secondary" href="?c=proveedor&a=index">Cancelar</a>
        </form>
      </div>
    </div>

    

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once ROOT_PATH."views/layout/footer.php";
 ?>
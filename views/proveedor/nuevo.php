<?php
require_once ROOT_PATH."views/layout/header.php";
 ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color: black; font-weight: bold;">Agregar Proveedor </h1>  
    </div>

    <!-- Content Row -->
    <div class="row">
    <div class="card-body shadow" style="background-color: #FDDDDF;">

    
      <form method="post" action="?c=proveedor&a=guardar">
          <div class="form-group">
            <label for="nomproveedor">Nombre Proveedor</label>
            <input type="text" class="form-control" name="nomproveedor" required>
          </div>
          <div class="form-group">
            <label for="rucproveedor">RUC</label>
            <input type="text" class="form-control" name="rucproveedor" required>
          </div>
          <div class="form-group">
            <label for="dirproveedor">Direccion</label>
            <input type="text" class="form-control" name="dirproveedor" required>
          </div>
          <div class="form-group">
            <label for="telproveedor">Telefono</label>
            <input type="text" class="form-control" name="telproveedor" required>
          </div>
          <div class="form-group">
            <label for="emailproveedor">Email</label>
            <input type="text" class="form-control" name="emailproveedor" required>
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
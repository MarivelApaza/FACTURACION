<?php
require_once ROOT_PATH."views/layout/header.php";

 ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Cliente</h1>  
    </div>

    <!-- Content Row -->
    <div class="row">
    <div class="card-body shadow" style="background-color: #FDE5DD;">
   
      <form method="post" action="?c=cliente&a=actualizar">
          
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $datos['idcliente']; ?>">
            <label for="descripcion">Nombre</label>
            <input type="text" class="form-control" name="nomcli" value="<?php echo $datos['nomcliente']; ?>">
          </div>
          <div class="form-group">
            <label for="unidad">RUC</label>
            <input type="text" class="form-control" name="ruccli" value="<?php echo $datos['ruccliente']; ?>">
          </div>
          <div class="form-group">
            <label for="stock">Direccion</label>
            <input type="text" class="form-control" name="dircli" value="<?php echo $datos['dircliente']; ?>">
          </div>
          <div class="form-group">
            <label for="costo">Telefono</label>
            <input type="text" class="form-control" name="telcli" value="<?php echo $datos['telcliente']; ?>">
          </div>
          <div class="form-group">
            <label for="precio">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $datos['emailcliente']; ?>">
          </div>
          
          <input class="btn btn-primary" type="submit" value="Guardar" style="background-color: #973A5C; border-color: #973A5C;">
          <a class="btn btn-secondary" href="?c=cliente&a=index">Cancelar</a>
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
<?php
require_once ROOT_PATH."views/layout/header.php";

 ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Usuario</h1>  
    </div>

    <!-- Content Row -->
    <div class="row">
    <div class="card-body shadow" style="background-color: #FDE5DD;">
   
      <form method="post" action="?c=usuario&a=actualizar">
          
        <div class="form-group">
            <input type="hidden" name="idusuario" value="<?php echo $datos['idusuario']; ?>">
            <label for="nomusuario">Nombre de Usuario</label>
            <input type="text" class="form-control" name="nomusuario" value="<?php echo $datos['nomusuario']; ?>">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo $datos['password']; ?>">
          </div>
          <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" value="<?php echo $datos['apellidos']; ?>">
          </div>
          <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" name="nombres" value="<?php echo $datos['nombres']; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo $datos['email']; ?>">
          </div>
          <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" name="estado" id="estado">
                        <option value="">Seleccione un estado</option>
                        <option value="A" <?php if ($datos['estado'] == 'A') echo 'selected'; ?>>A</option>
                        <option value="I" <?php if ($datos['estado'] == 'I') echo 'selected'; ?>>I</option>
                    </select>
                </div>
          <input class="btn btn-primary" type="submit" value="Guardar" style="background-color: #973A5C; border-color: #973A5C;">
          <a class="btn btn-secondary" href="?c=usuario&a=index">Cancelar</a>
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
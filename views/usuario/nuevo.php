<?php
require_once ROOT_PATH."views/layout/header.php";
 ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color: black; font-weight: bold;">Agregar Usuario </h1>  
    </div>

    <!-- Content Row -->
    <div class="row">
    <div class="card-body shadow" style="background-color: #FDDDDF;">

    
      <form method="post" action="?c=usuario&a=guardar">
          <div class="form-group">
            <label for="nomusuario">Nombre de Usuario</label>
            <input type="text" class="form-control" name="nomusuario" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
          <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" required>
          </div>
          <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" name="nombres" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" required>
          </div>
          <div class="form-group">
          <label for="estado">Estado</label>
          <select class="form-control" id="estado" name="estado" required>
          <option value="">Seleccione un estado</option>
          <option value="A">A</option>
          <option value="I">I</option>
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
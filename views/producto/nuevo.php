<?php
require_once ROOT_PATH . "libs/conexion.php";
require_once ROOT_PATH."views/layout/header.php";
require_once ROOT_PATH . "models/modeloCategoria.php";
require_once ROOT_PATH . "models/modeloProveedor.php";
 ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color: black; font-weight: bold;">Agregar Producto</h1>  
    </div>

    <!-- Content Row -->
    <div class="row">
    <div class="card-body shadow" style="background-color: #FDDDDF;">

    
    <form action="?c=producto&a=guardar" method="post">
       <div class="form-group">
         <label for="nomprodu">Nombre Producto</label>
           <input type="text" class="form-control" id="nomprodu" name="nomprodu" required>
        </div>
        <div class="form-group">
          <label for="unimed">Unidad de Medida</label>
          <input type="text" class="form-control" id="unimed" name="unimed" required>
        </div>
        <div class="form-group">
          <label for="stock">Stock</label>
          <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="form-group">
          <label for="cosuni">Costo Unitario</label>
          <input type="number" class="form-control" id="cosuni" name="cosuni" step="0.01" required>
        </div>
        <div class="form-group">
          <label for="preuni">Precio Unitario</label>
          <input type="number" class="form-control" id="preuni" name="preuni" step="0.01" required>
        </div>
        <div class="form-group">
          <label for="categoria">Categoría</label>
          <select class="form-control" id="categoria" name="categoria" required>
          <option value="">Seleccione una categoría</option>
          <?php
            $ocat = new ModeloCategoria();
            $datocat = $ocat->listaCategoria();
            foreach ($datocat as $filacat) {
              echo "<option value='" . $filacat["idcategoria"] . "'>" . $filacat["nomcategoria"] . "</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-group">
          <label for="proveedor">Proveedor</label>
          <select class="form-control" id="proveedor" name="proveedor" required>
          <option value="">Seleccione un proveedor</option>
          <?php
              $oprov = new ModeloProveedor;
              $datoprov = $oprov->listaProveedor();
              foreach($datoprov as $filaprov) {
                echo "<option value='".$filaprov["idproveedor"]."'>".$filaprov["nomproveedor"]."</option>";
              } 
          ?>
         </select>
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
            <a class="btn btn-secondary" href="?c=producto&a=index">Cancelar</a>
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
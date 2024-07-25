<?php
require_once ROOT_PATH . "views/layout/header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Producto</h1>  
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card-body shadow" style="background-color: #FDE5DD;">
            <form method="post" action="?c=producto&a=actualizar">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $datos['idproducto']; ?>">
                    <label for="descripcion">Nombre Producto</label>
                    <input type="text" class="form-control" name="nomprodu" value="<?php echo $datos['nomproducto']; ?>">
                </div>
                <div class="form-group">
                    <label for="unidad">Unidad de Medida</label>
                    <input type="text" class="form-control" name="unimed" value="<?php echo $datos['unimed']; ?>">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" name="stock" value="<?php echo $datos['stock']; ?>">
                </div>
                <div class="form-group">
                    <label for="precio">Precio Unitario</label>
                    <input type="text" class="form-control" name="preuni" value="<?php echo $datos['preuni']; ?>">
                </div>
                <div class="form-group">
                    <label for="costo">Costo Unitario</label>
                    <input type="text" class="form-control" name="cosuni" value="<?php echo $datos['cosuni']; ?>">
                </div>
                <div class="form-group">
                    <label for="cbocategoria">Categoria</label>
                    <select class="form-control" name="categoria">
                        <option value="0">Seleccione Categoria</option>
                        <?php
                        $ocat = new ModeloCategoria;
                        $datocat = $ocat->listaCategoria();
                        foreach ($datocat as $filacat) {
                            $selcat = ($filacat['idcategoria'] == $datos['idcategoria']) ? "selected" : "";
                            echo "<option $selcat value='" . $filacat["idcategoria"] . "'>" . $filacat["nomcategoria"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cboproveedor">Proveedor</label>
                    <select class="form-control" name="proveedor">
                        <option value="0">Seleccione Proveedor</option>
                        <?php
                        $oprov = new ModeloProveedor;
                        $datoprov = $oprov->listaProveedor();
                        foreach ($datoprov as $filaprov) {
                            $selprov = ($filaprov['idproveedor'] == $datos['idproveedor']) ? "selected" : "";
                            echo "<option $selprov value='" . $filaprov["idproveedor"] . "'>" . $filaprov["nomproveedor"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" name="estado" id="estado">
                        <option value="">Seleccione un estado</option>
                        <option value="A" <?php if ($datos['estado'] == 'A') echo 'selected'; ?>>A</option>
                        <option value="I" <?php if ($datos['estado'] == 'I') echo 'selected'; ?>>I</option>
                    </select>
                </div>
                <input class="btn btn-primary" type="submit" value="Guardar Cambios" style="background-color: #973A5C; border-color: #973A5C;">
                <a class="btn btn-secondary" href="?c=producto&a=index">Cancelar</a>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
require_once ROOT_PATH . "views/layout/footer.php";
?>

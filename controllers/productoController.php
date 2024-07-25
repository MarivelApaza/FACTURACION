<?php
require_once ROOT_PATH . "models/modeloProducto.php";

class ProductoController {
    
    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloProducto();
    }

    public function getProductoById() {
        $idProducto = $_POST['idProducto'];
        $producto = $this->modelo->getProductoById($idProducto);
        echo json_encode($producto);
    }

    public function index() {
        $datos = $this->modelo->listaProductos();
        require_once ROOT_PATH . "views/producto/listado.php";
    }

    public function nuevo() {
        require_once ROOT_PATH . "views/producto/nuevo.php";
    }

    public function guardar() {
            $datos = array(
                'nomproducto' => $_POST["nomprodu"],
                'unimed' => $_POST["unimed"],
                'stock' => $_POST["stock"],
                'cosuni' => $_POST["cosuni"],
                'preuni' => $_POST["preuni"],
                'idcategoria' => $_POST["categoria"],
                'idproveedor' => $_POST["proveedor"],
                'estado' => $_POST["estado"]
            );
                $this->modelo->guardarProducto($datos);
                $this->index();
 
    }

    public function editar($id) {
        $datos = $this->modelo->buscaProducto($id);
        require_once ROOT_PATH . "views/producto/modificar.php";
    }

    public function actualizar() {
            $datos = array(
                'nomproducto' => $_POST["nomprodu"],
                'unimed' => $_POST["unimed"],
                'stock' => $_POST["stock"],
                'cosuni' => $_POST["cosuni"],
                'preuni' => $_POST["preuni"],
                'idcategoria' => $_POST["categoria"],
                'idproveedor' => $_POST["proveedor"],
                'estado' => $_POST["estado"],
                'id' => $_POST["id"]);

                $this->modelo->actualizarProducto($datos);
                $this->index();
    }

    public function borrar($id) {
            $this->modelo->borraProducto($id);
            $this->index();
    }

    public function stockProductos(){
        $datos = $this->modelo->obtenerStockProductos();
        require_once ROOT_PATH."views/producto/stockproducto.php";
    }
}


<?php

require_once ROOT_PATH . "models/modeloVenta.php";
require_once ROOT_PATH . "models/modeloProducto.php";

class VentaController {

    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloVenta();
    }



    public function index() {
        $datos = $this->modelo->listaVentas();
        require_once ROOT_PATH . "views/venta/listado.php";
    }

    public function nuevo() {
        require_once ROOT_PATH . "views/venta/nuevo.php";
    }

    public function guardar() {
        $fecha_actual = $_POST['fecha_actual'];
        $fecha_registrada = $_POST['fecha_registrada'];
        $idcliente = $_POST['idcliente'];
        $idusuario = $_POST['idusuario'];
        $subtotal = $_POST['subtotal'];
        $igv = $_POST['igv'];
        $valorventa = $_POST['valorventa'];
        $condicion_pago = $_POST['condicion_pago'];
        $productos_json = isset($_POST['productos']) ? $_POST['productos'] : '';
    
        // Verificar si productos_json no está vacío
        if (empty($productos_json)) {
            die('No se ha proporcionado información de productos.');
        }
    
        // Decodificar el JSON
        $productos = json_decode($productos_json, true);
    
        // Aquí deberías agregar el código para insertar la venta en la base de datos
        $venta_id = $this->modelo->insertarVenta($fecha_actual, $fecha_registrada, $idcliente, $idusuario, $igv, $valorventa, $condicion_pago);
    
        // Insertar detalles de la venta
        foreach ($productos as $producto) {
            $id_producto = $producto['id'];
            $cantidad = $producto['cantidad'];
            $precio = $producto['precio'];
            $costo = $producto['costo'];
    
            $this->modelo->insertarDetalleFactura($venta_id, $id_producto, $cantidad, $precio, $costo);

            }

    // Disminuir el stock de los productos vendidos
    $this->modelo->disminuirStockVenta($venta_id);
    
    
        // Redirigir o mostrar un mensaje de éxito
        header('Location: ?c=venta&a=index');
    }
    


    
    

    public function editar($id) {
        $datos = $this->modelo->buscaVenta($id);
        require_once ROOT_PATH . "views/venta/modificar.php";
    }


    public function actualizar() {
        $datos = array(
            'fecha' => $_POST["fecha"],
            'idcliente' => $_POST["idcliente"],
            'idusuario' => $_POST["idusuario"],
            'fechareg' => $_POST["fechareg"],
            'idcondicion' => $_POST["idcondicion"],
            'valorventa' => $_POST["valorventa"],
            'igv' => $_POST["igv"]
        );
        
        $this->modelo->actualizarVenta($datos);
            
        
        $this->index();
    }


    public function borrar($id) {
        // Aumentar el stock para los productos de la venta eliminada
        $this->modelo->aumentarStockVenta($id);
    
        // Eliminar la venta
        $this->modelo->borraVenta($id);
    
        // Redirigir a la lista de ventas
        $this->index();
    }
    
    
    
    public function consultaPorProducto(){
        $datos = $this->modelo->obtenerConsultasPorProducto();
        require_once ROOT_PATH."views/venta/consultaproducto.php";
    }

    public function consultaPorFechaDia(){
        $datos = $this->modelo->obtenerVentasPorFechaYDia();
        require_once ROOT_PATH."views/venta/consultafechadia.php";
    }

    public function rankingVenta(){
        $datos = $this->modelo->obtenerRankingVentas();
        require_once ROOT_PATH."views/venta/rankingventa.php";
    }

    

}

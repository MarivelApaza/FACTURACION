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
    
        
        if (empty($productos_json)) {
            die('No se ha proporcionado información de productos.');
        }
    
        $productos = json_decode($productos_json, true); //DECODIFICA JSON
    
        $venta_id = $this->modelo->insertarVenta($fecha_actual, $fecha_registrada, $idcliente, $idusuario, $igv, $valorventa, $condicion_pago);
    
        foreach ($productos as $producto) {
            $id_producto = $producto['id'];
            $cantidad = $producto['cantidad'];
            $precio = $producto['precio'];
            $costo = $producto['costo'];
    
            $this->modelo->insertarDetalleFactura($venta_id, $id_producto, $cantidad, $precio, $costo);

            }
    $this->modelo->disminuirStockVenta($venta_id);
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
        $this->modelo->aumentarStockVenta($id);
        $this->modelo->borraVenta($id);
        $this->index();
    }
    
      
    public function consultaPorProducto() {
        $datos = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['nombre_producto']) && !empty($_POST['nombre_producto'])) {
                $nombre_producto = $_POST['nombre_producto'];
                $datos = $this->modelo->obtenerConsultasPorProducto($nombre_producto);
            } elseif (isset($_POST['action']) && $_POST['action'] === 'mostrar_todos') {
                $datos = $this->modelo->obtenerConsultasPorProducto(); 
            }
        } else {
            $datos = $this->modelo->obtenerConsultasPorProducto(); 
        }
        require_once ROOT_PATH."views/venta/consultaproducto.php";
    }
    

    public function consultaPorFechaDia() {
        $datos = [];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['action']) && $_POST['action'] == 'obtener' && isset($_POST['fecha'])) {
                $fecha = $_POST['fecha'];
                $datos = $this->modelo->obtenerVentasPorFechaYDia($fecha);
            } elseif (isset($_POST['action']) && $_POST['action'] == 'mostrar_todas') {
                $datos = $this->modelo->obtenerTodasLasVentas();
            }
        }
        
        require_once ROOT_PATH . "views/venta/consultafechadia.php";
    }
    

    public function rankingVenta(){
        $datos = $this->modelo->obtenerRankingVentas();
        require_once ROOT_PATH."views/venta/rankingventa.php";
    }

    

}

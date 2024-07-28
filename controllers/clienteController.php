<?php

require_once ROOT_PATH . "models/modeloCliente.php";

class ClienteController {

    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloCliente();
    }

    public function index() {
        $datos = $this->modelo->listaClientes();
        require_once ROOT_PATH . "views/cliente/listado.php";
    }

    public function nuevo() {
        require_once ROOT_PATH . "views/cliente/nuevo.php";
    }

    public function guardar() {
        $datos = array(
            'nomcliente' => $_POST["nomcli"],
            'ruccliente' => $_POST["ruccli"],
            'dircliente' => $_POST["dircli"],
            'telcliente' => $_POST["telcli"],
            'emailcliente' => $_POST["email"]
        );
        
        $this->modelo->guardarCliente($datos);
        
        $this->index();
    }

    public function editar($id) {
        $datos = $this->modelo->buscaCliente($id);
        require_once ROOT_PATH . "views/cliente/modificar.php";
    }

    public function actualizar() {
        $datos = array(
            'nomcliente' => $_POST["nomcli"],
            'ruccliente' => $_POST["ruccli"],
            'dircliente' => $_POST["dircli"],
            'telcliente' => $_POST["telcli"],
            'emailcliente' => $_POST["email"],
            'idcliente' => $_POST["id"]
        );
        
        $this->modelo->actualizarCliente($datos);
            
        
        $this->index();
    }

    public function borrar($id) {
        $this->modelo->borraCliente($id);
        $this->index();
    }

    public function consultaPorCliente() {
        $datos = [];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['action']) && $_POST['action'] == 'obtener' && isset($_POST['nomcli'])) {
                $nombre_cliente = $_POST['nomcli'];
                $datos = $this->modelo->obtenerConsultasPorCliente($nombre_cliente);
            } elseif (isset($_POST['action']) && $_POST['action'] == 'mostrar_todos') {
                $datos = $this->modelo->obtenerConsultasPorCliente(); 
            }
        } else {
            $datos = $this->modelo->obtenerConsultasPorCliente();
        }
        
        require_once ROOT_PATH . "views/cliente/consultacliente.php";
    }
    

}

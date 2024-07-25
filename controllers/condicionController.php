<?php

require_once ROOT_PATH . "models/modeloCliente.php";

class CondicionController {

    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloCondicion();
    }

    public function index() {
        $datos = $this->modelo->listaCondiciones();
    }



    public function guardar() {
        $datos = array(
            'nomcondicion' => $_POST["nomcondicion"]
        );
        
        $this->modelo->guardarCliente($datos);
        
        $this->index();
    }

}
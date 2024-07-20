<?php

require_once ROOT_PATH . "models/modeloCliente.php";

class CategoriaController {

    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloCategoria();
    }

    public function index() {
        $datos = $this->modelo->listaCategoria();
        require_once ROOT_PATH . "views/categoria/listado.php";
    }

    public function nuevo() {
        require_once ROOT_PATH . "views/categoria/nuevo.php";
    }

    public function guardar() {
        $datos = array(
            'nomcategoria' => $_POST["nomcategoria"],
        );
        
        $this->modelo->guardarCategoria($datos);
        
        $this->index();
    }

    public function editar($id) {
        $datos = $this->modelo->buscaCategoria($id);
        require_once ROOT_PATH . "views/categoria/modificar.php";
    }

    public function actualizar() {
        $datos = array(
            'nomcategoria' => $_POST["nomcategoria"],
            'idcategoria' => $_POST["id"]
        );
        
        $this->modelo->actualizarCategoria($datos);
            
        
        $this->index();
    }

    public function borrar($id) {
        $this->modelo->borraCategoria($id);
        $this->index();
    }
}

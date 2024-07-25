<?php

require_once ROOT_PATH . "libs/conexion.php";

class ModeloCondicion {

    private $con;

    public function __construct() {
        try {
            $cnn = new Conexion();
            $this->con = $cnn->getConectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function listaCondiciones() {
        try {
            $lista = $this->con->prepare("SELECT * FROM condicionventa");
            $lista->execute();
            $res = $lista->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }


    public function guardarCondicion($data) {
        try {
            $query = $this->con->prepare("INSERT INTO condicionventa (nomcondicion) 
                VALUES (:nomcondicion)");

            $query->bindParam(":nomcondicion", $data['nomcondicion']);

            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = false;
        }
    }

}
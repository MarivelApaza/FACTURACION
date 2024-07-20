<?php

require_once ROOT_PATH . "libs/conexion.php";

class ModeloProveedor {

    private $con;

    public function __construct() {
        try {
            $cnn = new Conexion();
            $this->con = $cnn->getConectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listaProveedor() {
        try {
            $lista = $this->con->prepare("SELECT * FROM proveedores");
            $lista->execute();
            $res = $lista->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }

    public function buscaProveedor($id) {
        try {
            $busca = $this->con->prepare("SELECT * FROM proveedores WHERE idproveedor = :cod");
            $busca->bindParam(":cod", $id, PDO::PARAM_INT);
            $busca->execute();
            $res = $busca->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }

    public function guardarProveedor($data) {
        try {
            $query = $this->con->prepare("INSERT INTO proveedores (nomproveedor, rucproveedor, dirproveedor, telproveedor, emailproveedor) 
                VALUES (:nomproveedor, :rucproveedor, :dirproveedor, :telproveedor, :emailproveedor)");

            $query->bindParam(":nomproveedor", $data['nomproveedor']);
            $query->bindParam(":rucproveedor", $data['rucproveedor']);
            $query->bindParam(":dirproveedor", $data['dirproveedor']);
            $query->bindParam(":telproveedor", $data['telproveedor']);
            $query->bindParam(":emailproveedor", $data['emailproveedor']);

            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = false;
        }
    }

    public function actualizarProveedor($data) {
        try {
            $query = $this->con->prepare("UPDATE proveedores
                SET nomproveedor = :nomproveedor,
                    rucproveedor = :rucproveedor,
                    dirproveedor = :dirproveedor,
                    telproveedor = :telproveedor,
                    emailproveedor = :emailproveedor
                WHERE idproveedor = :cod");

            $query->bindParam(":nomproveedor", $data['nomproveedor']);
            $query->bindParam(":rucproveedor", $data['rucproveedor']);
            $query->bindParam(":dirproveedor", $data['dirproveedor']);
            $query->bindParam(":telproveedor", $data['telproveedor']);
            $query->bindParam(":emailproveedor", $data['emailproveedor']);
            $query->bindParam(":cod", $data['idproveedor'], PDO::PARAM_INT);
            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = false;
        }
    }

    public function borraProveedor($id) {
        try {
            $borra = $this->con->prepare("DELETE FROM proveedores WHERE idproveedor = :cod");
            $borra->bindParam(":cod", $id, PDO::PARAM_INT);
            $borra->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }
}

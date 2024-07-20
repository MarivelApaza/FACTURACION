<?php

require_once ROOT_PATH . "libs/conexion.php";

class ModeloCategoria {

    private $con;

    public function __construct() {
        try {
            $cnn = new Conexion();
            $this->con = $cnn->getConectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listaCategoria() {
        try {
            $lista = $this->con->prepare("SELECT * FROM categorias");
            $lista->execute();
            $res = $lista->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }

    public function buscaCategoria($id) {
        try {
            $busca = $this->con->prepare("SELECT * FROM categorias WHERE idcategoria = :cod");
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

    public function guardarCategoria($data) {
        try {
            $query = $this->con->prepare("INSERT INTO categorias (nomcategoria) 
                VALUES (:nomcategoria)");

            $query->bindParam(":nomcategoria", $data['nomcategoria']);
            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = false;
        }
    }

    public function actualizarCategoria($data) {
        try {
            $query = $this->con->prepare("UPDATE categorias
                SET nomcategoria = :nomcategoria
                WHERE idcategoria = :cod");

            $query->bindParam(":nomcategoria", $data['nomcategoria']);
            $query->bindParam(":cod", $data['idcategoria'], PDO::PARAM_INT);
            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = false;
        }
    }

    public function borraCategoria($id) {
        try {
            $borra = $this->con->prepare("DELETE FROM categorias WHERE idcategoria = :cod");
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
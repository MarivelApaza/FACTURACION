<?php

require_once ROOT_PATH . "libs/conexion.php";

class ModeloProducto {

    private $con;

    public function __construct() {
        try {
            $cnn = new Conexion();
            $this->con = $cnn->getConectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listaProductos() {
        try {
            $lista = $this->con->prepare("SELECT * FROM productos");
            $lista->execute();
            $res = $lista->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }

    public function buscaProducto($id) {
        try {
            $busca = $this->con->prepare("SELECT * FROM productos WHERE idproducto = :cod");
            $busca->bindParam(":cod", $id);
            $busca->execute();
            $res = $busca->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }

    public function guardarProducto($data) {
        try {
            $query = $this->con->prepare("INSERT INTO productos (nomproducto, unimed, stock, cosuni, preuni, idcategoria, idproveedor, estado) 
                VALUES (:nombre, :und, :stock, :cosuni, :preuni, :idcat, :idpro, :estado)");

            $query->bindParam(":nombre", $data['nomproducto']);
            $query->bindParam(":und", $data['unimed']);
            $query->bindParam(":stock", $data['stock']);
            $query->bindParam(":cosuni", $data['cosuni']);
            $query->bindParam(":preuni", $data['preuni']);
            $query->bindParam(":idcat", $data['idcategoria']);
            $query->bindParam(":idpro", $data['idproveedor']);
            $query->bindParam(":estado", $data['estado']);
            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = false;
        }
    }

    public function actualizarProducto($data) {
        try {
            $query = $this->con->prepare("UPDATE productos
                SET nomproducto = :nombre,
                    unimed = :und,
                    stock = :stock,
                    cosuni = :cosuni,
                    preuni = :preuni,
                    idcategoria = :idcat,
                    idproveedor = :idpro,
                    estado = :estado
                WHERE idproducto = :cod");

            $query->bindParam(":nombre", $data['nomproducto']);
            $query->bindParam(":und", $data['unimed']);
            $query->bindParam(":stock", $data['stock']);
            $query->bindParam(":cosuni", $data['cosuni']);
            $query->bindParam(":preuni", $data['preuni']);
            $query->bindParam(":idcat", $data['idcategoria']);
            $query->bindParam(":idpro", $data['idproveedor']);
            $query->bindParam(":estado", $data['estado']);
            $query->bindParam(":cod", $data['id']);
            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = false;
        }
    }

    public function borraProducto($id) {
        try {
            $borra = $this->con->prepare("DELETE FROM productos WHERE idproducto = :cod");
            $borra->bindParam(":cod", $id);
            $borra->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $res = null;
        }
    }
}

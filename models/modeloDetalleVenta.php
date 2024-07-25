<?php

require_once ROOT_PATH . "libs/conexion.php";

class ModeloDetalle {
    private $con;

    ublic function __construct() {
        try {
            $cnn = new Conexion();
            $this->con = $cnn->getConectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function guardarDetalle($ventaId, $producto, $cantidad, $precio, $costo) {
        $query = "INSERT INTO detallefactura (idventa, producto, cantidad, precio, costo) VALUES (:ventaId, :producto, :cantidad, :precio, :costo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ventaId', $ventaId);
        $stmt->bindParam(':producto', $producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':costo', $costo);
        $stmt->execute();
    }
}

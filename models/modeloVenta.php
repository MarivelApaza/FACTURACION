<?php

require_once ROOT_PATH . "libs/conexion.php";
class ModeloVenta {

    private $con;

    public function __construct() {
        try {
            $cnn = new Conexion();
            $this->con = $cnn->getConectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // En tu modelo de Venta
public function insertarVenta($fecha_actual, $fecha_registrada, $idcliente, $idusuario, $igv, $valorventa, $condicion_pago) {
    $query = "INSERT INTO facturas (fecha, fechareg, idcliente, idusuario, igv, valorventa, idcondicion) VALUES (:fecha_actual, :fecha_registrada, :idcliente, :idusuario, :igv, :valorventa, :condicion_pago)";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':fecha_actual', $fecha_actual);
    $stmt->bindParam(':fecha_registrada', $fecha_registrada);
    $stmt->bindParam(':idcliente', $idcliente);
    $stmt->bindParam(':idusuario', $idusuario);
    $stmt->bindParam(':igv', $igv);
    $stmt->bindParam(':valorventa', $valorventa);
    $stmt->bindParam(':condicion_pago', $condicion_pago);
    $stmt->execute();

    return $this->con->lastInsertId(); // Devuelve el ID de la venta recién insertada
}

public function obtenerIdProductoPorNombre($nombreProducto) {
    $sql = "SELECT idproducto FROM productos WHERE nomproducto = :nombreproducto";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':nombreproducto', $nombreProducto);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado ? $resultado['idproducto'] : null;
}

public function insertarDetalleFactura($venta_id, $nombre_producto, $cantidad, $precio, $costo) {
    // Obtener el ID del producto a partir del nombre
    $id_producto = $this->obtenerIdProductoPorNombre($nombre_producto);

    if ($id_producto === null) {
        throw new Exception("El producto no existe.");
    }

    $sql = "INSERT INTO detallefactura (idfactura, idproducto, cant, preuni, cosuni) VALUES (:venta_id, :id_producto, :cantidad, :precio, :costo)";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':venta_id', $venta_id);
    $stmt->bindParam(':id_producto', $id_producto);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':costo', $costo);

    return $stmt->execute();
    
}

public function disminuirStockVenta($venta_id) {
    try {
        $query = "SELECT idproducto, cant FROM detallefactura WHERE idfactura = :venta_id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':venta_id', $venta_id);
        $stmt->execute();
        $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($detalles as $detalle) {
            $idProducto = $detalle['idproducto'];
            $cantidadVendida = $detalle['cant'];
            $this->modificarStock($idProducto, -$cantidadVendida);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
}




public function aumentarStockVenta($venta_id) {
    try {
        // Obtener todos los detalles de la venta
        $query = "SELECT idproducto, cant FROM detallefactura WHERE idfactura = :venta_id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':venta_id', $venta_id);
        $stmt->execute();
        $detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Aumentar el stock para cada producto
        foreach ($detalles as $detalle) {
            $idProducto = $detalle['idproducto'];
            $cantidadVendida = $detalle['cant'];
            $this->modificarStock($idProducto, $cantidadVendida);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
}

public function modificarStock($idProducto, $cantidad) {
    try {
        $query = "SELECT stock FROM productos WHERE idproducto = :idProducto";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();
        $stockActual = $stmt->fetchColumn();

        // Verificar el stock actual
        if ($stockActual === false) {
            throw new Exception("Producto no encontrado.");
        }

        $nuevoStock = $stockActual + $cantidad;
        
        if ($nuevoStock < 0) {
            throw new Exception("No se puede tener stock negativo.");
        }

        $query = "UPDATE productos SET stock = :nuevoStock WHERE idproducto = :idProducto";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':nuevoStock', $nuevoStock);
        $stmt->bindParam(':idProducto', $idProducto);
        $stmt->execute();

        // Verificar que la actualización fue exitosa
        if ($stmt->rowCount() === 0) {
            throw new Exception("No se actualizó el stock del producto.");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
}





public function borraVenta($id) {
    try {
        $this->con->beginTransaction();
        
        // Eliminar los detalles de la venta
        $query = "DELETE FROM detallefactura WHERE idfactura = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Eliminar la venta
        $query = "DELETE FROM facturas WHERE idfactura = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $this->con->commit();
    } catch (Exception $e) {
        $this->con->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
/*-----*/    

    public function listaVentas() {
        try {
            $stmt = $this->con->prepare("
                SELECT 
                    f.idfactura,
                    f.fecha,
                    c.idcliente AS nomcliente,
                    u.idusuario AS nomusuario,
                    f.fechareg,
                    co.idcondicion AS nomcondicion,
                    f.igv,
                    f.valorventa
                FROM facturas f
                JOIN clientes c ON f.idcliente = c.idcliente
                JOIN usuarios u ON f.idusuario = u.idusuario
                JOIN condicionventa co ON f.idcondicion = co.idcondicion
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function buscaVenta($id) {
        try {
            $busca = $this->con->prepare("SELECT * FROM facturas WHERE idfactura = :id");
            $busca->bindParam(":id", $id);
            $busca->execute();
            $res = $busca->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $busca = null;
        }
    }

    public function guardarVenta($fecha_actual, $fecha_registrada, $idcliente, $idusuario, $idcondicion, $igv, $total) {
        $sql = "INSERT INTO facturas (fecha, fechareg, idcliente, idusuario, idcondicion, igv, valorventa)
                VALUES (:fecha, :fechareg, :idcliente, :idusuario, :idcondicion, :igv, :valorventa)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha', $fecha_actual);
        $stmt->bindParam(':fechareg', $fecha_registrada);
        $stmt->bindParam(':idcliente', $idcliente);
        $stmt->bindParam(':idusuario', $idusuario);
        $stmt->bindParam(':idcondicion', $idcondicion);
        $stmt->bindParam(':igv', $igv);
        $stmt->bindParam(':valorventa', $total);
        $stmt->execute();
        return $this->con->lastInsertId(); // Devuelve el ID de la última factura insertada
    }

    public function actualizarVenta($data) {
        try {
            $query = $this->con->prepare("UPDATE facturas
                SET fecha = :fecha,
                    idcliente = :idcliente,
                    idusuario = :idusuario,
                    fechareg = :fechareg,
                    idcondicion = :idcondicion,
                    valorventa = :valorventa,
                    igv = :igv
                WHERE idfactura = :id");

            $query->bindParam(":fecha", $data['fecha']);
            $query->bindParam(":idcliente", $data['idcliente']);
            $query->bindParam(":idusuario", $data['idusuario']);
            $query->bindParam(":fechareg", $data['fechareg']);
            $query->bindParam(":idcondicion", $data['idcondicion']);
            $query->bindParam(":valorventa", $data['valorventa']);
            $query->bindParam(":igv", $data['igv']);
            $query->bindParam(":id", $data['id']);
            $query->execute();

            return true;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $query = null;
        }
    }



    public function obtenerConsultasPorProducto() {
        try {
            $consulta = $this->con->prepare("
                SELECT 
                    p.idproducto, 
                    p.nomproducto, 
                    p.preuni AS precio, 
                    p.cosuni AS costo, 
                    IFNULL(SUM(df.cant), 0) AS cantidad,
                    IFNULL(SUM(df.cant * p.preuni), 0) AS valorventa
                FROM 
                    productos p
                LEFT JOIN 
                    detallefactura df ON p.idproducto = df.idproducto
                GROUP BY 
                    p.idproducto, 
                    p.nomproducto, 
                    p.preuni, 
                    p.cosuni
                ORDER BY 
                    valorventa DESC
            ");
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $consulta = null;
            $resultados = null;
        }
    }
    
    

    public function obtenerVentasPorFechaYDia() {
        try {
            $consulta = $this->con->prepare("
                SELECT 
                    DATE(f.fecha) AS fecha, 
                    DAYOFWEEK(f.fecha) AS dia_semana, 
                    SUM(f.valorventa) AS total_venta
                FROM 
                    facturas f
                GROUP BY 
                    DATE(f.fecha), 
                    DAYOFWEEK(f.fecha)
                ORDER BY 
                    DATE(f.fecha) ASC
            ");
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $consulta = null;
            $resultados = null;
        }
    }
    

    public function obtenerRankingVentas() {
        try {
            $consulta = $this->con->prepare("
                SELECT p.idproducto, p.nomproducto AS nombre_producto, SUM(df.cant) AS cantidad_total, SUM(df.cant * df.preuni) AS venta_total
                FROM detallefactura df
                JOIN productos p ON df.idproducto = p.idproducto
                GROUP BY p.idproducto, p.nomproducto
                ORDER BY venta_total DESC
                LIMIT 10
            ");
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        } finally {
            $consulta = null;
            $resultados = null;
        }
    }
    
}

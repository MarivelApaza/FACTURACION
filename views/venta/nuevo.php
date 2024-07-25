<?php
require_once ROOT_PATH . "libs/conexion.php";
require_once ROOT_PATH . "views/layout/header.php";
require_once ROOT_PATH . "models/modeloProducto.php";
require_once ROOT_PATH . "models/modeloCliente.php";
require_once ROOT_PATH . "models/modeloUsuario.php";
require_once ROOT_PATH . "models/modeloCondicion.php"; 
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color: black; font-weight: bold;">Nuevo Registro de Venta</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card-body shadow" style="background-color: #F6ECC8;">
            <form id="formVenta" method="post" action="?c=venta&a=guardar">
            <input type="hidden" id="productos" name="productos" value="">
                <div class="row mb-3">
                    <label for="fecha" class="col-sm-2 col-form-label">Fecha Actual:</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="fecha_actual" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fecha" class="col-sm-2 col-form-label">Fecha Registrada:</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="fecha_registrada" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="cliente" class="col-sm-2 col-form-label">Cliente:</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="idcliente" required>
                            <option value="0">Seleccione Cliente</option>
                            <?php
                            $ocli = new ModeloCliente();
                            $datocli = $ocli->listaClientes();
                            foreach ($datocli as $filacli) {
                                echo "<option value='" . $filacli["idcliente"] . "'>" . $filacli["nomcliente"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="idusuario" required>
                            <option value="0">Seleccione Usuario</option>
                            <?php
                            $ousuario = new ModeloUsuario();
                            $datousuario = $ousuario->listaUsuarios();
                            foreach ($datousuario as $filausuario) {
                                echo "<option value='" . $filausuario["idusuario"] . "'>" . $filausuario["nomusuario"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <!-- Table for Product Details -->
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <table class="table table-bordered" id="tablaProductos">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Costo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán las filas de productos -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventaModal"  style="background-color: #9D390E; color: #000000;">Agregar Productos</button>
                    </div>
                </div>

                <!-- Subtotal, IGV, Condición de Pago y Total -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="subtotal">Subtotal:</label>
                        <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="igv">IGV (18%):</label>
                        <input type="number" class="form-control" id="igv" name="igv" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="condicion_pago">Condición de Pago:</label>
                        <select class="form-control" id="condicion_pago" name="condicion_pago" required>
                            <option value="0">Seleccione Condición de Pago</option>
                            <?php
                            $ocondicion = new ModeloCondicion(); 
                            $datocondicion = $ocondicion->listaCondiciones();
                            foreach ($datocondicion as $filacondicion) {
                                echo "<option value='" . $filacondicion["idcondicion"] . "'>" . $filacondicion["nomcondicion"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="total">Total:</label>
                        <input type="number" class="form-control" id="valorventa" name="valorventa" readonly>
                    </div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input class="btn btn-primary" type="submit"  style="background-color: #9D390E; color: #000000;" value="Guardar Factura">
                        <a class="btn btn-secondary" href="?c=venta&a=index">Cancelar</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button type="button" class="btn btn-info" onclick="imprimirFactura()">Imprimir Factura</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Adding Products -->
    <div class="modal fade" id="ventaModal" tabindex="-1" role="dialog" aria-labelledby="ventaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ventaModalLabel">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarProducto" method="POST" action="">
                        <div class="form-group">
                            <label for="producto">Producto:</label>
                            <select class="form-control" id="producto" name="producto">
                                <option value="0">Seleccione Producto</option>
                                <?php
                                $oproducto = new ModeloProducto();
                                $datoproducto = $oproducto->listaProductos();
                                foreach ($datoproducto as $filaproducto) {
                                    echo "<option value='" . $filaproducto["idproducto"] . "' data-precio='" . $filaproducto["preuni"] . "' data-costo='" . $filaproducto["cosuni"] . "'>" . $filaproducto["nomproducto"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" step="0.01" class="form-control" id="preuni" name="preuni" readonly>
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo:</label>
                            <input type="number" step="0.01" class="form-control" id="cosuni" name="cosuni" readonly>
                        </div>
                        
                        <button type="button" class="btn btn-primary" id="agregarProducto">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Div for Printable Invoice -->
    <div id="printableArea" style="display:none;">
        <h1>INNOVART</h1>
        <h3>Factura</h3>
        <!-- Here you can duplicate the structure of the form you want to print -->
        <div>
            <label>Fecha Actual:</label> <span id="printFechaActual"></span><br>
            <label>Fecha Registrada:</label> <span id="printFechaRegistrada"></span><br>
            <label>Cliente:</label> <span id="printCliente"></span><br>
            <label>Usuario:</label> <span id="printUsuario"></span><br>
            <table class="table table-bordered" id="tablaProductosPrint">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se agregarán las filas de productos -->
                </tbody>
            </table>
            <label>Subtotal:</label> <span id="printSubtotal"></span><br>
            <label>IGV (18%):</label> <span id="printIGV"></span><br>
            <label>Condición de Pago:</label> <span id="printCondicionPago"></span><br>
            <label>Total:</label> <span id="printTotal"></span><br>
        </div>
    </div>

    <!-- /.container-fluid -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const formAgregarProducto = document.getElementById('formAgregarProducto');
    const tablaProductos = document.getElementById('tablaProductos').getElementsByTagName('tbody')[0];
    const agregarProductoBtn = document.getElementById('agregarProducto');
    const productoSelect = document.getElementById('producto');
    const precioInput = document.getElementById('preuni');
    const costoInput = document.getElementById('cosuni');
    const subtotalInput = document.getElementById('subtotal');
    const igvInput = document.getElementById('igv');
    const totalInput = document.getElementById('valorventa');
    const productosInput = document.getElementById('productos');
    let subtotal = 0;
    let idDetalle = 1;

    productoSelect.addEventListener('change', function () {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        precioInput.value = selectedOption.getAttribute('data-precio') || '';
        costoInput.value = selectedOption.getAttribute('data-costo') || '';
    });

    agregarProductoBtn.addEventListener('click', function () {
    const producto = productoSelect.value;
    const cantidad = formAgregarProducto.cantidad.value;
    const precio = precioInput.value;
    const costo = costoInput.value;

    if (producto && cantidad && precio && costo) {
        const productos = JSON.parse(productosInput.value || '[]'); // Obtener productos existentes o inicializar un arreglo vacío
        productos.push({ producto, cantidad, precio, costo }); // Agregar el nuevo producto al arreglo

        const fila = tablaProductos.insertRow();
        fila.innerHTML = `
            <td>${idDetalle}</td>
            <td>${productoSelect.options[productoSelect.selectedIndex].text}</td>
            <td>${cantidad}</td>
            <td>${precio}</td>
            <td>${costo}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this, ${costo * cantidad})">Eliminar</button></td>
        `;
        idDetalle++;
        subtotal += parseFloat(costo) * parseFloat(cantidad);
        actualizarTotales();
        $('#ventaModal').modal('hide');
        formAgregarProducto.reset();
        precioInput.value = '';
        costoInput.value = '';
        actualizarProductosInput(productos);
    } else {
        alert('Por favor complete todos los campos.');
    }
});

function actualizarProductosInput() {
    const filas = tablaProductos.rows;
    const productos = [];

    for (let i = 0; i < filas.length; i++) {
        const celdas = filas[i].cells;
        productos.push({
            id: celdas[1].innerText,
            cantidad: celdas[2].innerText,
            precio: celdas[3].innerText,
            costo: celdas[4].innerText
        });
    }

    productosInput.value = JSON.stringify(productos);
}


    function actualizarTotales() {
        subtotalInput.value = subtotal.toFixed(2);
        const igv = subtotal * 0.18;
        igvInput.value = igv.toFixed(2);
        const total = subtotal + igv;
        totalInput.value = total.toFixed(2);
    }

    window.eliminarFila = function (button, subtotalProducto) {
        const fila = button.parentElement.parentElement;
        fila.remove();
        subtotal -= subtotalProducto;
        actualizarTotales();
        actualizarProductosInput();
    }

    window.imprimirFactura = function () {
        const fechaActual = document.querySelector('[name="fecha_actual"]').value;
        const fechaRegistrada = document.querySelector('[name="fecha_registrada"]').value;
        const cliente = document.querySelector('[name="idcliente"] option:checked').text;
        const usuario = document.querySelector('[name="idusuario"] option:checked').text;
        const subtotal = subtotalInput.value;
        const igv = igvInput.value;
        const total = totalInput.value;
        const condicionPago = document.querySelector('[name="condicion_pago"] option:checked').text;

        let contenidoImprimir = `
            <html>
            <head>
                <title>Imprimir Factura</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .container { width: 80%; margin: 0 auto; }
                    h1, h3 { text-align: center; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    table, th, td { border: 1px solid black; }
                    th, td { padding: 8px; text-align: left; }
                    .total { font-weight: bold; }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>INNOVART</h1>
                    <h3>Factura</h3>
                    <p><strong>Fecha Actual:</strong> ${fechaActual}</p>
                    <p><strong>Fecha Registrada:</strong> ${fechaRegistrada}</p>
                    <p><strong>Cliente:</strong> ${cliente}</p>
                    <p><strong>Usuario:</strong> ${usuario}</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Costo</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${Array.from(document.getElementById('tablaProductos').rows).map((row, index) => {
                                if (index === 0) return '';
                                return `
                                    <tr>
                                        ${Array.from(row.cells).map(cell => `<td>${cell.innerText}</td>`).join('')}
                                    </tr>
                                `;
                            }).join('')}
                        </tbody>
                    </table>
                    <p class="total"><strong>Subtotal:</strong> ${subtotal}</p>
                    <p class="total"><strong>IGV (18%):</strong> ${igv}</p>
                    <p class="total"><strong>Total:</strong> ${total}</p>
                    <p><strong>Condición de Pago:</strong> ${condicionPago}</p>
                </div>
            </body>
            </html>
        `;

        const ventanaImpresion = window.open('', '_blank');
        ventanaImpresion.document.open();
        ventanaImpresion.document.write(contenidoImprimir);
        ventanaImpresion.document.close();

        ventanaImpresion.onload = function() {
            ventanaImpresion.print();
            ventanaImpresion.onafterprint = function() {
                ventanaImpresion.close();
            };
        };
    };
});



</script>

</div>
<?php
require_once ROOT_PATH . "views/layout/footer.php";
?>
</body>

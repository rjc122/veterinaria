<?php
// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veterinariaprime";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch clients from the clientes table
$clientQuery = "SELECT id, nombre FROM clientes";
$clientResult = $conn->query($clientQuery);

// Fetch products from the productos table
$productQuery = "SELECT id, nombre FROM productos";
$productResult = $conn->query($productQuery);

// Fetch services from the servicios table
$serviceQuery = "SELECT id, nombre FROM servicios";
$serviceResult = $conn->query($serviceQuery);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $cliente_id = $_POST['cliente_id'];
    $type = $_POST['type'];

    // Initialize variable
    $producto_servicio_id = null;

    // Set $producto_servicio_id based on the selected type
    if ($type == 'producto') {
        $producto_servicio_id = $_POST['producto_servicio_id_producto'];
    } elseif ($type == 'servicio') {
        $producto_servicio_id = $_POST['producto_servicio_id_servicio'];
    }

    $total_pagar = $_POST['total_pagar'];
    $fecha_emision = $_POST['fecha_emision'];

    // Insert data into the facturas table
    $sql = "INSERT INTO facturas (cliente_id, producto_servicio_id, total_pagar, fecha_emision) VALUES ('$cliente_id', '$producto_servicio_id', '$total_pagar', '$fecha_emision')";

    if ($conn->query($sql) === TRUE) {
        echo "Factura creada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all invoices with client names and product/service names from the facturas, clientes, productos, and servicios tables
$invoicesQuery = "SELECT facturas.id, clientes.nombre AS cliente_nombre, CASE WHEN facturas.producto_servicio_id IS NOT NULL THEN productos.nombre ELSE servicios.nombre END AS producto_servicio_nombre, total_pagar, fecha_emision FROM facturas JOIN clientes ON facturas.cliente_id = clientes.id LEFT JOIN productos ON facturas.producto_servicio_id = productos.id AND facturas.producto_servicio_id IS NOT NULL LEFT JOIN servicios ON facturas.producto_servicio_id = servicios.id AND facturas.producto_servicio_id IS NULL";
$invoicesResult = $conn->query($invoicesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center; 
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a.button-regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        a.button-regresar:hover {
            background-color: #2980b9;
        }
    </style>
    <script>
        // Function to show/hide options based on the selection
        function showOptions() {
            var selectedType = document.getElementById("type").value;
            var products = document.getElementById("productos");
            var services = document.getElementById("servicios");

            if (selectedType === "producto") {
                products.style.display = "block";
                services.style.display = "none";
            } else if (selectedType === "servicio") {
                products.style.display = "none";
                services.style.display = "block";
            } else {
                products.style.display = "none";
                services.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <h2>Facturas</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="cliente_id">Cliente:</label>
        <select name="cliente_id" required>
            <?php
            // Populate the dropdown list with clients
            while ($clientRow = $clientResult->fetch_assoc()) {
                echo "<option value='" . $clientRow['id'] . "'>" . $clientRow['nombre'] . "</option>";
            }
            ?>
        </select><br>

        <label for="type">Seleccione Tipo:</label>
        <select name="type" id="type" onchange="showOptions()" required>
            <option value="" disabled selected>Seleccione Tipo</option>
            <option value="producto">Producto</option>
            <option value="servicio">Servicio</option>
        </select><br>

        <div id="productos" style="display: none;">
            <label for="producto_servicio_id_producto">Producto:</label>
            <select name="producto_servicio_id_producto" required>
                <?php
                // Populate the dropdown list with products
                $productResult->data_seek(0); // Reset the pointer to fetch from the beginning
                while ($productRow = $productResult->fetch_assoc()) {
                    echo "<option value='" . $productRow['id'] . "'>" . $productRow['nombre'] . "</option>";
                }
                ?>
            </select><br>
        </div>

        <div id="servicios" style="display: none;">
            <label for="producto_servicio_id_servicio">Servicio:</label>
            <select name="producto_servicio_id_servicio" required>
                <?php
                // Populate the dropdown list with services
                $serviceResult->data_seek(0); // Reset the pointer to fetch from the beginning
                while ($serviceRow = $serviceResult->fetch_assoc()) {
                    echo "<option value='" . $serviceRow['id'] . "'>" . $serviceRow['nombre'] . "</option>";
                }
                ?>
            </select><br>
        </div>

        <label for="total_pagar">Total a Pagar:</label>
        <input type="text" name="total_pagar" required><br>

        <label for="fecha_emision">Fecha de Emisión:</label>
        <input type="date" name="fecha_emision" required><br>

        <input type="submit" value="Submit">
    </form>

    <h3>Facturas Creadas</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Producto/Servicio</th>
            <th>Total a Pagar</th>
            <th>Fecha de Emisión</th>
        </tr>
        <?php
        // Display the invoices with client names and product/service names
        while ($invoiceRow = $invoicesResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $invoiceRow['id'] . "</td>";
            echo "<td>" . $invoiceRow['cliente_nombre'] . "</td>";
            echo "<td>" . $invoiceRow['producto_servicio_nombre'] . "</td>";
            echo "<td>" . $invoiceRow['total_pagar'] . "</td>";
            echo "<td>" . $invoiceRow['fecha_emision'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a class="button-regresar" href="http://localhost/parcial-final">Regresar</a>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
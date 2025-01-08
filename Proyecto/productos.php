<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chein";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}


$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

$productos = [];


if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $productos[] = $row;
    }
}


header('Content-Type: application/json');
echo json_encode($productos);

// Cerrar conexión
$conn->close();
?>

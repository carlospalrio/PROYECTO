<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chein";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$cambio = $data['cambio'];


$sql = "UPDATE productos SET stock = stock + $cambio WHERE id = $id AND stock + $cambio >= 0";

if ($conn->query($sql) === TRUE) {
    $result = $conn->query("SELECT stock FROM productos WHERE id = $id");
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'nuevo_stock' => $row['stock']]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>

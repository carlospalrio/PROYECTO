<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chein";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$precio = $data['precio'];


$sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);

if ($stmt->execute()) {

    echo json_encode(['success' => true]);
} else {

    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chein";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}


if (!isset($_SESSION['usuario'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no identificado."]);
    exit();
}

$usuario = $_SESSION['usuario'];
$new_password = $_POST['new_password'];


$sql = "UPDATE usersq SET contrasena='$new_password' WHERE id='$usuario'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Contraseña actualizada correctamente."]);
    session_destroy(); 
} else {
    echo json_encode(["status" => "error", "message" => "Error al actualizar la contraseña: " . $conn->error]);
}

$conn->close();
?>

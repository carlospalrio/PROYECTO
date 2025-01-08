<?php
session_start(); // Iniciar la sesión

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "chein"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

$usuario = $_POST["usuario"];
$color_favorito = $_POST["color_favorito"];

$sql = "SELECT * FROM usersq WHERE id='$usuario' AND color_favorito='$color_favorito'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;  // Guardar usuario en sesión
    echo json_encode(["status" => "success", "message" => "Validación exitosa."]);
} else {
    echo json_encode(["status" => "error", "message" => "Usuario o color favorito incorrecto."]);
}

$conn->close();
?>

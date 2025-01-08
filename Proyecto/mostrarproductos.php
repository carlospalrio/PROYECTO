<?php
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "chein"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}


$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

// Verificar si hay productos
if ($resultado->num_rows > 0) {

    $productos = [];
    while ($row = $resultado->fetch_assoc()) {
        $productos[] = $row; 
    }
} else {
    $productos = []; 
}

// Cerrar la conexión
$conn->close();
?>
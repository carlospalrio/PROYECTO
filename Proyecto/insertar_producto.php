<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chein";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];






$sql = "SELECT MAX(id) AS max_id FROM productos";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$nuevo_id = $row['max_id'] + 1;


$directorio_destino = 'Fotos/';
$archivo_temporal = $_FILES['imagen']['tmp_name'];
$archivo_destino = $directorio_destino . $nuevo_id . '.jpg';


$tipo_imagen = mime_content_type($archivo_temporal);
if ($tipo_imagen != 'image/jpeg') {
    die("Error: El archivo debe ser una imagen JPG.");
}


if (move_uploaded_file($archivo_temporal, $archivo_destino)) {

    $sql_insert = "INSERT INTO productos (id, nombre, descripcion, precio, stock) 
               VALUES ('$nuevo_id', '$nombre', '$descripcion', '$precio', '$stock')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Producto agregado correctamente');</script>";
        echo "<script>window.location.href = 'web.html';</script>";
    } else {
        echo "Error al insertar producto: " . $conn->error;
    }
} else {
    echo "Error al subir la imagen.";
}

// Cerrar conexión
$conn->close();
?>

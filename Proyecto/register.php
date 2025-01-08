<?php
header("Content-Type: application/xml");

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "chein");
if ($conexion->connect_error) {
    die("<response><status>error</status><message>Error de conexión: " . $conexion->connect_error . "</message></response>");
}

$id = $_POST['id'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';
$color_favorito = $_POST['color_favorito'] ?? ''; 

$response = new SimpleXMLElement('<response/>');

if ($id && $contrasena && $color_favorito) { 
    $stmt = $conexion->prepare("SELECT id FROM usersq WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response->addChild('status', 'error');
        $response->addChild('message', 'El usuario ya existe.');
    } else {
        $stmt->close();


        $stmt = $conexion->prepare("INSERT INTO usersq (id, contrasena, color_favorito) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $id, $contrasena, $color_favorito); 
        if ($stmt->execute()) {
            $response->addChild('status', 'success');
            $response->addChild('message', 'Usuario creado correctamente.');
        } else {
            $response->addChild('status', 'error');
            $response->addChild('message', 'Error al crear el usuario.');
        }
    }
    $stmt->close();
} else {
    $response->addChild('status', 'error');
    $response->addChild('message', 'Los campos usuario, contraseña y color favorito son obligatorios.');
}

$conexion->close();
echo $response->asXML();
?>

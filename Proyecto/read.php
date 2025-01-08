<?php
header("Content-Type: application/xml");


$conexion = new mysqli("localhost", "root", "", "carlospalrio");
if ($conexion->connect_error) {
    die("<response><status>error</status><message>Error de conexión: " . $conexion->connect_error . "</message></response>");
}


$id = $_POST['id'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

$response = new SimpleXMLElement('<response/>');

if ($id && $contrasena) {

    $stmt = $conexion->prepare("SELECT id FROM usersq WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response->addChild('status', 'error');
        $response->addChild('message', 'El usuario ya existe.');
    } else {
        // Insertar el nuevo usuario si no existe
        $stmt->close();
        $stmt = $conexion->prepare("INSERT INTO usersq (id, contrasena) VALUES (?, ?)");
        $stmt->bind_param("ss", $id, $contrasena);
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
    $response->addChild('message', 'Los campos usuario y contraseña son obligatorios.');
}

$conexion->close();
echo $response->asXML();
?>

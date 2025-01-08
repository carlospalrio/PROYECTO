    <?php
    $servername = "localhost"; // Nombre del servidor
    $username = "root"; // Nombre de usuario de la base de datos
    $password = ""; // Contraseña de la base de datos
    $dbname = "chein"; // Nombre de la base de datos

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("La conexión ha fallado: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $id = $_POST["id"];
    $contrasena = $_POST["contrasena"];

    // Consulta SQL para verificar si el usuario existe y la contraseña es correcta
    $sql = "SELECT * FROM usersq WHERE id='$id' AND contrasena='$contrasena'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // Inicio de sesión exitoso: Redirigir a web.html
        header("Location: http://localhost/Proyecto/web.html");
        exit();
    } else {
        // Inicio de sesión fallido: Mostrar un mensaje de error
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        echo "<script>window.location.href = 'http://localhost/Proyecto/login.html';</script>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

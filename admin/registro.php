<?php
session_start();
include("funciones.php");

// Verificar si se envió el formulario
if (isset($_POST['registrar'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptamos la contraseña
    $email = $_POST['email'];

    // Conectamos a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'bd_inmobiliaria');

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Verificamos si el usuario o el email ya existen
    $consulta = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $mensaje = "El nombre de usuario o el correo ya están registrados";
    } else {
        // Insertamos el nuevo usuario
        $query = "INSERT INTO users (fullname, username, password, email) VALUES ('$fullname', '$username', '$password', '$email')";
        if ($conexion->query($query) === TRUE) {
            $mensaje = "Usuario registrado correctamente";
            header("Location: login.php"); // Redirigir al login
        } else {
            $mensaje = "Error: " . $conexion->error;
        }
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registro.css">
    <title>Registro InmoConnect</title>
</head>

<body>
    <div id="contenedor-registro">
        <div class="presentacion">
            <div class="titulo">
                <h1>Registro InmoConnect</h1>
                <p>Completa los campos para registrarte</p>
            </div>
            <div class="contenedor-formulario">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-registro">
                    <input type="text" placeholder="Nombre Completo" name="fullname" required class="input-registro">
                    <input type="text" placeholder="Nombre de Usuario" name="username" required class="input-registro">
                    <input type="password" placeholder="Contraseña" name="password" required class="input-registro">
                    <input type="email" placeholder="Correo Electrónico" name="email" required class="input-registro">
                    <input type="submit" value="Registrarse" name="registrar" class="btn">

                    <!-- Mensaje de error o éxito -->
                    <?php if (isset($mensaje)) : ?>
                        <span class="msj-registro"><?php echo $mensaje ?></span>
                    <?php endif ?>

                    <!-- Botón para regresar al login -->
                    <p>¿Ya tienes cuenta?</p>
                    <a href="login.php" class="btn-secundario">Inicia Sesión</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

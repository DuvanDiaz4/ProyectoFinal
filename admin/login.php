<?php
session_start();
include("funciones.php");

// Verificamos si se presionó el botón iniciar
if (isset($_POST['iniciar'])) {
    // Conectamos a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'bd_inmobiliaria');

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Tomamos los datos del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta para buscar el usuario en la base de datos
    $query = "SELECT * FROM users WHERE username = '$usuario'";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $usuarioBD = $resultado->fetch_assoc();

        // Verificamos si la contraseña es correcta
        if (password_verify($password, $usuarioBD['password'])) {
            // Inicio de sesión exitoso, creamos la sesión
            $_SESSION['usuarioLogeado'] = $usuarioBD['fullname'];
            header("Location: index.php"); // Redirigimos al index
        } else {
            $mensaje = "* La contraseña es incorrecta";
        }
    } else {
        $mensaje = "* El nombre de usuario no existe";
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
    <link rel="stylesheet" href="estilo.css">
    <title>Login admin InmoConnect</title>
</head>

<body>
    <div id="contenedor-login">
        <div class="presentacion">
            <div class="titulo">
                <h1>InmoConnect</h1>
                <p>Sistema de Administración Web Para Inmobiliaria</p>
            </div>
            <div class="contenedor-formulario">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-login">
                    <p>INICIAR SESIOIN COMO ADMINISTRADOR</strong></p>
                    
                    <label for="usuario">Nombre de Usuario</label>
                    <input type="text" id="usuario" name="usuario" required class="input-login">

                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required class="input-login">
                    
                    <input type="submit" value="Iniciar Sesión" name="iniciar" class="btn">

                    <!-- Enlace para registro -->
                    <a href="registro.php" class="btn-registrarse">Registrarse</a>

                    <?php if (isset($mensaje)) : ?>
                        <span class="msj-error-input"><?php echo $mensaje ?></span>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

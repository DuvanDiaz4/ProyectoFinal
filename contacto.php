<?php
include("funciones.php");

$config = obtenerConfiguracion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InmoConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
</head>

<body class="page-contacto">
    <div class="container">
        <?php include("header.php"); ?>
        <h2 class="titulo-seccion">Contacto</h2>
        <div class="contenedor-contacto">
            <div class="col info">
                <div>
                    <h3><i class="fa-solid fa-location-dot"></i> Nuestra Oficina Central</h3>
                    <p><?php echo htmlspecialchars($config['oficina_central']); ?></p>
                </div>

                <div>
                    <h3><i class="fa-solid fa-phone"></i> Nuestros teléfonos</h3>
                    <p><?php echo htmlspecialchars($config['telefono1']); ?></p>
                    <p><?php echo htmlspecialchars($config['telefono2']); ?></p>
                </div>

                <div>
                    <h3><i class="fa-solid fa-envelope"></i> Correo Electrónico</h3>
                    <p><?php echo htmlspecialchars($config['email_contacto']); ?></p>
                </div>

                <div>
                    <h3><i class="fa-solid fa-clock"></i> Horarios de atención en Oficina</h3>
                    <p><?php echo htmlspecialchars($config['horarios']); ?></p>
                </div>
            </div>
            <div class="col formulario">
                <form action="enviarCorreo.php" method="post">
                    <h3>Comuníquese con nosotros</h3>
                    <div>
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Ingrese su nombre" name="nombre" required>
                    </div>
                    <div>
                        <label for="email">Dirección de Correo</label>
                        <input type="email" placeholder="Dirección de Correo" name="email" required>
                    </div>
                    <div>
                        <label for="telefono">Teléfono</label>
                        <input type="text" placeholder="Ingrese su teléfono" name="telefono">
                    </div>
                    <div>
                        <label for="mensaje">Consulta</label>
                        <textarea type="text" placeholder="Escriba su consulta" name="mensaje" required></textarea>
                    </div>
                    <input type="submit" value="Enviar Mensaje" name="enviar">
                </form>
            </div>
            <div class="col">
                <!-- Código actualizado con el mapa de Usme, Bogotá -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.0113642162816!2d-74.13738032519477!3d4.482927392593749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99b92ba6634b%3A0x9f4c7a048e3adbf4!2sUsme%2C%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1694133276905!5m2!1ses!2sco" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <footer class="inferior2">
        <?php include("contenido-footer.php"); ?>
    </footer>

    <script src="script.js"></script>
</body>

</html>

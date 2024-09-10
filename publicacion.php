<?php 
include("funciones.php");

$config = obtenerConfiguracion(); // Asegúrate de que esta función esté disponible y definida.

if (!isset($_GET['idPropiedad']) || empty($_GET['idPropiedad'])) {
    die("ID de propiedad no proporcionado."); 
}

$id_propiedad = $_GET['idPropiedad'];
$id_propiedad = intval($id_propiedad);

$propiedad = obtenerPropiedadPorId($id_propiedad);

if (!$propiedad) {
    die("Propiedad no encontrada."); 
}

$restul_fotos_galeria = obtenerFotosGaleria($id_propiedad);
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

<body class="page-publicacion">
    <div class="container">
        <?php include("header.php"); ?>

        <div class="contenedor-principal">
            <div class="info-publicacion">
                <section class="info-principal-galeria">
                    <div class="dato1">
                        <span class="estado"><?php echo htmlspecialchars($propiedad['estado']) ?></span>
                        <span class="precio"><?php echo htmlspecialchars($propiedad['moneda']) ?> <?php echo number_format($propiedad['precio'], 0, '', '.') ?></span>
                    </div>
                    <h2><?php echo htmlspecialchars($propiedad['titulo']) ?></h2>
                    <p> <i class="fa-solid fa-location-pin"></i> <?php echo htmlspecialchars($propiedad['ubicacion']) . ", " . htmlspecialchars(obtenerCiudad($propiedad['ciudad'])) . ", " . htmlspecialchars(obtenerPais($propiedad['pais'])) ?></p>
                    <div class="contenedor-imagen-principal">
                        <img src="<?php echo htmlspecialchars("admin/" . $propiedad['url_foto_principal']) ?>" alt="">
                    </div>
                    <div class="galeria" id="galeria">
                        <?php $i = 0; ?>
                        <?php while ($foto = mysqli_fetch_assoc($restul_fotos_galeria)) : ?>
                            <img src="<?php echo htmlspecialchars('admin/fotos/' . $foto['id_propiedad'] . '/' . $foto['nombre_foto']) ?>" onclick="abrirModal(this,<?php echo $i ?>)" alt="s">
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </div>
                </section>
                <section class="descripcion">
                    <h3>Descripción</h3>
                    <div class="fila">
                        <div class="dato">
                            <span class="header">Tipo</span>
                            <span class="valor"><?php echo htmlspecialchars(obtenerTipo($propiedad['tipo'])) ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Estado</span>
                            <span class="valor"><?php echo htmlspecialchars($propiedad['estado']) ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Precio</span>
                            <span class="valor"><?php echo htmlspecialchars($propiedad['moneda']) ?> <?php echo number_format($propiedad['precio'], 0, '', '.') ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Habitaciones</span>
                            <span class="valor"><?php echo htmlspecialchars($propiedad['habitaciones']) ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Baños</span>
                            <span class="valor"><?php echo htmlspecialchars($propiedad['banios']) ?></span>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="dato">
                            <span class="header">Garage</span>
                            <span class="valor"><?php echo htmlspecialchars($propiedad['garage']) ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Dimensiones</span>
                            <span class="valor"><?php echo htmlspecialchars($propiedad['dimensiones']) ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Pisos</span>
                            <span class="valor"><?php echo htmlspecialchars($propiedad['pisos']) ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Ciudad</span>
                            <span class="valor"><?php echo htmlspecialchars(obtenerCiudad($propiedad['ciudad'])) ?> </span>
                        </div>
                        <div class="dato">
                            <span class="header">Pais</span>
                            <span class="valor"> <?php echo htmlspecialchars(obtenerPais($propiedad['pais'])) ?> </span>
                        </div>
                    </div>

                    <?php
                    $descripcion = str_replace("\n", "<br>", htmlspecialchars($propiedad['descripcion']));
                    ?>

                    <div class="detalle"><?php echo $descripcion ?></div>
                </section>
                <section class="compartir">
                    <h3>Compartir esta propiedad</h3>
                    <a href="http://facebook.com/sharer.php?u=http://localhost/sapi/publicacion.php?idPublicacion=<?php echo htmlspecialchars($propiedad['id']) ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>

                    <a href="whatsapp://send?text=http://paulopelegrina.com/publicacion.php?idPublicacion=<?php echo htmlspecialchars($propiedad['id']) ?>" data-action="share/whatsapp/share"> <i class="fa-brands fa-whatsapp"></i> </a>
                </section>
            </div>
            <div class="form-contacto-publicacion">
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
        </div>

        <?php include("footer.php"); ?>

    </div>
    <script src="scripts.js"></script>
</body>

</html>

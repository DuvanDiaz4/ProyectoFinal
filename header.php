<?php
// Verificar si $config está definido
if (!isset($config)) {
    // Definir un valor predeterminado si no está definido
    $config = [
        'telefono1' => 'No disponible'
    ];
}
?>
<div class="contenedor-header">
    <header>
        <div class="logo">
            <a href="index.php">
                <h1><i class="fa-solid fa-city"></i></h1>
                <p>InmoConnect</p>
            </a>
        </div>

        <div class="nav-responsive" onclick="mostrarMenuResponsive()">
            <i class="fa-solid fa-bars"></i>
        </div>
        <nav class="" id="nav">
            <a href="index.php">Inicio</a>
            <a href="propiedades.php">Propiedades</a>
            <a href="contacto.php">Contacto</a>
        </nav>

        <div class="info-contacto">
            <span class="info">
                <a href="tel:<?php echo htmlspecialchars($config['telefono1']) ?>">
                    <i class="fa-solid fa-phone"></i>
                    <span class="numero-telefono"><?php echo htmlspecialchars($config['telefono1']) ?> </span>
                </a>
            </span>
        </div>
    </header>
</div>

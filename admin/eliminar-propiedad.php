<?php

include("conexion.php");
$id = $_GET['idPropiedad'];

// Determino la cantidad de fotos que tiene la publicación
$query = "SELECT * FROM fotos WHERE id_propiedad = '$id'";
$result = mysqli_query($conn, $query);

$directorio = 'fotos/'.$id."/";

// Elimino cada uno de los archivos de las fotos de galería de la propiedad
while ($foto = mysqli_fetch_assoc($result)){
    $archivo = $foto['nombre_foto'];
    unlink($directorio.$archivo);
}

// Eliminar la foto principal de la propiedad de la carpeta
$query = "SELECT * FROM propiedades WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$foto = mysqli_fetch_assoc($result);
$archivo = $foto['url_foto_principal'];
unlink($archivo);

// Eliminamos la carpeta (la cual ya está vacía)
rmdir($directorio);

// Primero eliminamos todos los registros de las fotos de la BD
$query = "DELETE FROM fotos WHERE id_propiedad = '$id'";
mysqli_query($conn, $query);

// Ahora elimino el registro de la propiedad
$query = "DELETE FROM propiedades WHERE id = '$id'";
mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Propiedad</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: '¡Éxito!',
            text: 'La propiedad se eliminó.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'listado-propiedades.php';
            }
        });
    </script>
</body>
</html>

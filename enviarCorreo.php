<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir el autoload de Composer
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    // Configuración del servidor
    $mail->SMTPDebug = 0; 
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;  
    $mail->Username = 'duvan060605@gmail.com';  // Tu correo electrónico
    $mail->Password = 'alcc eylq ncvn pjxk';  // Contraseña de la aplicación de Google
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
    $mail->Port = 587;

    // Configuración del correo
    $mail->setFrom($email, $nombre);
    $mail->addAddress('diazduvan584@gmail.com', 'Destinatario'); // Dirección del destinatario

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Nuevo mensaje de contacto';
    $mail->Body    = "Has recibido un nuevo mensaje de <b>$nombre</b>.<br>Teléfono: $telefono<br><br>Mensaje:<br>$mensaje";
    $mail->AltBody = "Has recibido un nuevo mensaje de $nombre. Teléfono: $telefono. Mensaje: $mensaje";

    // Enviar el correo
    $mail->send();
    
    // Mostrar alerta con SweetAlert si el correo se envía correctamente
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Mensaje enviado!',
                text: 'El mensaje ha sido enviado correctamente.',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.history.back();  // Redirigir a la página anterior
            });
        });
    </script>";

} catch (Exception $e) {
    // Mostrar alerta con SweetAlert si hay un error al enviar el correo
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.history.back();  // Redirigir a la página anterior
            });
        });
    </script>";
}
?>

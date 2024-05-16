<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido, <?php echo e($userName); ?>!</h1>
    <p>Gracias por registrarte en nuestro sitio web. Estamos encantados de tenerte con nosotros.</p>
    <p>Saludos,<br><?php echo e(config('app.name')); ?></p>
</body>
</html>
<?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/emails/welcome.blade.php ENDPATH**/ ?>
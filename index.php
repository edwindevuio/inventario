<?php
ob_start();
require_once('includes/load.php');
if ($session->isUserLoggedIn(true)) {
    redirect('home.php', false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu título aquí</title>
    <link rel="stylesheet" href="ruta/a/tu/hoja/de/estilos.css"> <!-- Enlaza tu hoja de estilos si la tienes -->
</head>

<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-repeat: no-repeat;">
 
        
   
    <!-- Tu contenido HTML y PHP aquí -->

    <?php include_once('layouts/header.php'); ?>

    <div class="login-page" style="background-color: rgba(255, 255, 255, 0.5);">
        <div class="text-center">
        <img src="img/logo.jpg" alt="Logo" style="max-width: 100%; height: auto;">
            <h1>INGRESO</h1>
            <h4>SISTEMA DE CONTROL DE INVENTARIOS</h4>
        </div>
        <?php echo display_msg($msg); ?>
        <form method="post" action="auth.php" class="clearfix">
            <div class="form-group">
                <label for="username" class="control-label">Usuario</label>
                <input type="name" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="Password" class="control-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger" style="border-radius:0%">Login</button>
            </div>
        </form>
    </div>
    <?php include_once('layouts/footer.php'); ?>

</body>

</html>
<?php
ob_start();
require_once('controllers/load.php');
if ($session->isUserLoggedIn(true)) {
    redirect('controllers/home.php', false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ControldeInventarios</title>
    <link rel="stylesheet" href="views/libs/css/main.css">
</head>

<body style="background-image: url('views/img/inventario2.jpg');alignament-items:center; ">
 
    <?php include_once('views/layouts/header.php'); ?>

    <div class="login-page" style="background-color: rgba(255, 255, 255,130);display:center;border-radius: 10px;">
        <div class="text-center">
        <img src="views/img/LOGO INSTITUTO.png" alt="Logo" style="max-width: 90%; height: 100%;padding-top: 20px;">
            <h1>INGRESO</h1>
            <h4>SISTEMA DE CONTROL DE INVENTARIOS</h4>
        </div>
        <?php echo display_msg($msg); ?>
        <form method="post" action="controllers/auth.php" class="clearfix">
            <div class="form-group">
                <label for="username" class="control-label">Usuario</label>
                <input type="name" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="Password" class="control-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group" style="align-items: center;padding-left:130px">
                <button type="submit" class="btn btn-danger" style="border-radius:5px;">Login</button>
            </div>
        </form>
    </div>
    <?php include_once('views/layouts/footer.php'); ?>

</body>

</html>
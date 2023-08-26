<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu título aquí</title>
    <link rel="stylesheet" href="ruta/a/tu/hoja/de/estilos.css"> <!-- Enlaza tu hoja de estilos si la tienes -->
    <style>
        /* Estilo para la imagen de fondo */
        .login-page {
            background-image: url('ruta/a/tu/imagen/de/fondo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Asegura que la imagen de fondo cubra toda la pantalla */
        }
        /* Resto de estilos que ya tienes */
    </style>
</head>
<body>
    <!-- Tu contenido HTML y PHP aquí -->
    
<?php include_once('layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
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
            <input type="password" name= "password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-danger" style="border-radius:0%">Login</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>

</body>
</html>







<?php include_once('load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

  if(empty($errors)){

    $user = authenticate_v2($username, $password);

        if($user):
           //crear sesion con id
           $session->login($user['id']);
           //Update Sign in time
           updateLastLogIn($user['id']);
           // Redirige al sistema y da permisos dependiendo del nivel
           if($user['user_level'] === '1'):
             $session->msg("s", "Hola ".$user['username'].", Bienvenido al Sistema.");
             redirect('../controllers/admin.php',false);
           elseif ($user['user_level'] === '2'):
              $session->msg("s", "Hola ".$user['username'].", Bienvenido al Sistema.");
             redirect('../controllers/special.php',false);
           else:
              $session->msg("s", "Hola ".$user['username'].", Bienvenido al Sistema.");
             redirect('../controllers/home.php',false);
           endif;

        else:
          $session->msg("d", "Usuario o Contraseña Incorrecta");
          redirect('../index.php',false);
        endif;

  } else {

     $session->msg("d", $errors);
     redirect('login_v2.php',false);
  }

?>

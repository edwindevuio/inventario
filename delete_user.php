<?php
  require_once('includes/load.php');
  // Permiso nivel 1
   page_require_level(1);
?>
<?php
  $delete_id = delete_by_id('users',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Usuario eliminado.");
      redirect('users.php');
  } else {
      $session->msg("d","Fallo eliminacion");
      redirect('users.php');
  }
?>

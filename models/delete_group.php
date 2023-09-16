<?php
  require_once('../controllers/load.php');
  // Requiere permisos de nivel 1
   page_require_level(1);
?>
<?php
  $delete_id = delete_by_id('user_groups',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Grupo eliminado.");
      redirect('../controllers/group.php');
  } else {
      $session->msg("d","No se elimino el grupo");
      redirect('../controllers/group.php');
  }
?>

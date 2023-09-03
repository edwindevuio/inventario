<?php
  require_once('includes/load.php');
  // nivel 1
  page_require_level(1);
?>
<?php
  $categorie = find_by_id('categories',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Sin id de categoria.");
    redirect('categorie.php');
  }
?>
<?php
  $delete_id = delete_by_id('categories',(int)$categorie['id']);
  if($delete_id){
      $session->msg("s","Categoria eliminada.");
      redirect('categorie.php');
  } else {
      $session->msg("d","Fallo eliminacion.");
      redirect('categorie.php');
  }
?>

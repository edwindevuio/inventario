<?php
  require_once('../controllers/load.php');
  // Permiso nivel 2
  page_require_level(2);
?>
<?php
  $find_media = find_by_id('media',(int)$_GET['id']);
  $photo = new Media();
  if($photo->media_destroy($find_media['id'],$find_media['file_name'])){
      $session->msg("s","Foto eliminada.");
      redirect('../controllers/media.php');
  } else {
      $session->msg("d","No se elimino foto");
      redirect('../controllers/media.php');
  }
?>

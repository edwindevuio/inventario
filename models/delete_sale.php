<?php
  require_once('../controllers/load.php');
  // nivel de usuario 2
  page_require_level(2);
?>
<?php
  $d_sale = find_by_id('sales',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Sin id de venta.");
    redirect('../controllers/sales.php');
  }
?>
<?php
  $delete_id = delete_by_id('sales',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","Venta eliminada.");
      redirect('sales.php');
  } else {
      $session->msg("d","Eliminación fallida.");
      redirect('../controllers/sales.php');
  }
?>

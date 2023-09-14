<?php
  require_once('../controllers/load.php');
  // Permiso nivel 2
  page_require_level(2);
?>
<?php
  $product = find_by_id('products',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","Sin id de venta.");
    redirect('../controllers/product.php');
  }
?>
<?php
  $delete_id = delete_by_id('products',(int)$product['id']);
  if($delete_id){
      $session->msg("s","Producto elminado.");
      redirect('product.php');
  } else {
      $session->msg("d","Fallo eliminacion.");
      redirect('../controllers/product.php');
  }
?>

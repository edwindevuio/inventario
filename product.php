<?php
$page_title = 'All Product';
require_once('includes/load.php');
// nivel 2
page_require_level(2);
$products = join_product_table();
function get_stock_color_class($quantity)
{
  if ($quantity < 3) {
    return 'text-red'; // Clase CSS para color rojo
  } elseif ($quantity < 8) {
    return 'text-yellow'; // Clase CSS para color amarillo
  } else {
    return 'text-green'; // Clase CSS para color verde
  }
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <style>.text-red {
    background-color: red; /* Puedes ajustar el color según tus preferencias */
    color: white;         /* Puedes ajustar el color del texto según tus preferencias */
}

.text-yellow {
    background-color: yellow; /* Puedes ajustar el color según tus preferencias */
}

.text-green {
    background-color: green; /* Puedes ajustar el color según tus preferencias */
    color: white;           /* Puedes ajustar el color del texto según tus preferencias */
}
</style>
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-primary">Agregar Nuevo</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Foto</th>
              <th> Nombre del Producto </th>
              <th class="text-center" style="width: 10%;"> Categorias </th>
              <th class="text-center" style="width: 10%;"> En Stock </th>
              <th class="text-center" style="width: 10%;"> Precio Compra </th>
              <th class="text-center" style="width: 10%;"> P.V.P. </th>
              <th class="text-center" style="width: 10%;"> Producto añadido </th>
              <th class="text-center" style="width: 100px;"> Acciones </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
              <tr>
                <td class="text-center">
                  <?php echo count_id(); ?>
                </td>
                <td>
                  <?php if ($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td>
                  <?php echo remove_junk($product['name']); ?>
                </td>
                <td class="text-center">
                  <?php echo remove_junk($product['categorie']); ?>
                </td>
                <td class="text-center <?php echo get_stock_color_class($product['quantity']); ?>">
                  <?php echo remove_junk($product['quantity']); ?>
                </td>
                <td class="text-center">
                  <?php echo remove_junk($product['buy_price']); ?>
                </td>
                <td class="text-center">
                  <?php echo remove_junk($product['sale_price']); ?>
                </td>
                <td class="text-center">
                  <?php echo read_date($product['date']); ?>
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int) $product['id']; ?>" class="btn btn-info btn-xs"
                      title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int) $product['id']; ?>" class="btn btn-danger btn-xs"
                      title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          </tabel>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
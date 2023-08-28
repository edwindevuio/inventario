<?php
$page_title = 'Admin Home Page';
require_once('includes/load.php');
// Revisar los permisos que necesita cada pagina, aqui nivel 1 
page_require_level(1);

?>
<?php
$c_categorie = count_by_id('categories');
$c_product = count_by_id('products');
$c_sale = count_by_id('sales');
$c_user = count_by_id('users');
$products_sold = find_higest_saleing_product('10');
$recent_products = find_recent_product_added('5');
$recent_sales = find_recent_sale_added('5');

?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <a href="users.php" style="color:black; display: block;">
      <div class="panel panel-box clearfix" style="height: 120px;">
        <div class="panel-icon pull-left bg-secondary1">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top">
            <?php echo $c_user['total']; ?>
          </h2>
          <p class="text-muted">Usuarios</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-3">
    <a href="categorie.php" style="color:black; display: block;">
      <div class="panel panel-box clearfix" style="height: 120px;">
        <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top">
            <?php echo $c_categorie['total']; ?>
          </h2>
          <p class="text-muted">Categorias</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-3">
    <a href="product.php" style="color:black; display: block;">
      <div class="panel panel-box clearfix" style="height: 120px;">
        <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top">
            <?php echo $c_product['total']; ?>
          </h2>
          <p class="text-muted">Productos</p>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-3">
    <a href="sales.php" style="color:black; display: block;">
      <div class="panel panel-box clearfix" style="height: 120px;">
        <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top">
            <?php echo $c_sale['total']; ?>
          </h2>
          <p class="text-muted">Ventas</p>
        </div>
      </div>
    </a>
  </div>
</div>


<div class="row">

  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Productos mas vendidos</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Venta Total</th>
              <th>Cantidad Total</th>
            <tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as $product_sold): ?>
              <tr>
                <td>
                  <?php echo remove_junk(first_character($product_sold['name'])); ?>
                </td>
                <td>
                  <?php echo (int) $product_sold['totalSold']; ?>
                </td>
                <td>
                  <?php echo (int) $product_sold['totalQty']; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Ultimas Ventas</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Nombre del producto</th>
              <th>Fecha</th>
              <th>Ventas totales</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recent_sales as $recent_sale): ?>
              <tr>
                <td class="text-center">
                  <?php echo count_id(); ?>
                </td>
                <td>
                  <a href="edit_sale.php?id=<?php echo (int) $recent_sale['id']; ?>">
                    <?php echo remove_junk(first_character($recent_sale['name'])); ?>
                  </a>
                </td>
                <td>
                  <?php echo remove_junk(ucfirst($recent_sale['date'])); ?>
                </td>
                <td>$
                  <?php echo remove_junk(first_character($recent_sale['price'])); ?>
                </td>
              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Productos agregados recientemente</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
          <?php foreach ($recent_products as $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo (int) $recent_product['id']; ?>">
              <h4 class="list-group-item-heading">
                <?php if ($recent_product['media_id'] === '0'): ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image']; ?>"
                    alt="" />
                <?php endif; ?>
                <?php echo remove_junk(first_character($recent_product['name'])); ?>
                <span class="label label-warning pull-right">
                  $
                  <?php echo (int) $recent_product['sale_price']; ?>
                </span>
              </h4>
              <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
              </span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <?php
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
  <style>
    .text-red {
      background-color: red;
      /* Puedes ajustar el color según tus preferencias */
      color: white;
      /* Puedes ajustar el color del texto según tus preferencias */
    }

    .text-yellow {
      background-color: yellow;
      /* Puedes ajustar el color según tus preferencias */
    }

    .text-green {
      background-color: green;
      /* Puedes ajustar el color según tus preferencias */
      color: white;
      /* Puedes ajustar el color del texto según tus preferencias */
    }
  </style>

  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Productos</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped table-condensed">
          <thead>
            <tr>

              <th>Nombre</th>
              <th>Cantidad</th>

            </tr>
          </thead>
          <tbody>
            <?php
            $products = join_product_table();
            foreach ($products as $product):
              ?>
              <tr>

                <td>
                  <?php echo remove_junk($product['name']); ?>
                </td>
                <td class="<?php echo get_stock_color_class($product['quantity']); ?>"><?php echo (int) $product['quantity']; ?></td>


              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">

</div>



<?php include_once('layouts/footer.php'); ?>
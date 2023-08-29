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
            <?php
            $counter = 0;
            foreach ($products_sold as $product_sold):
              $counter++;
              if ($counter > 5)
                break; // Limitar a 5 elementos
              ?>
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
            <?php
            $counter = 0; foreach ($recent_sales as $recent_sale):
              $counter++;
              if ($counter > 5)
                break; // Limitar a 5 elementos
              ?>
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
          <?php
          $counter = 0; foreach ($recent_products as $recent_product):
            $counter++;
            if ($counter > 5)
              break; // Limitar a 5 elementos
            ?>
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
            $totalProducts = count($products);

            // Obtén los índices de los últimos 5 productos (si hay menos de 5 productos, obtén todos los índices)
            $lastFiveIndices = array_slice(array_keys($products), max(0, $totalProducts - 5));

            foreach ($lastFiveIndices as $index):
              $product = $products[$index];
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
  <?php
  // Obtén el año actual y el año anterior
  $currentYear = date("Y");
  $lastYear = $currentYear;

  // Consulta para obtener las ventas por mes del último año
  $sql = "SELECT MONTH(s.date) AS month, SUM(p.sale_price * s.qty) AS total_sales";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE YEAR(s.date) = '{$lastYear}'";
  $sql .= " GROUP BY MONTH(s.date)";
  $monthlySalesData = find_by_sql($sql); // Asumiendo que esta función existe y maneja la consulta
  
  $monthlySales = array_fill(1, 12, 0); // Inicializa el array con ceros para todos los meses
  
  foreach ($monthlySalesData as $row) {
    $month = $row['month'];
    $totalSales = $row['total_sales'];
    $monthlySales[$month] = $totalSales;
  }
  ?>
  <div style="width: 80%; margin: auto;">
    <canvas id="gananciasPorMes" width="400" height="200"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Datos de ganancias por mes desde la base de datos
  var gananciasPorMes = <?php echo json_encode(array_values($monthlySales)); ?>;

  var ctx = document.getElementById("gananciasPorMes").getContext("2d");

  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
      ],
      datasets: [
        {
          label: "Ganancias por Mes",
          data: gananciasPorMes,
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>




<?php include_once('layouts/footer.php'); ?>
<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Esta página requiere nivel 3, no olvides verificar los permisos
  page_require_level(3);
?>

<?php
date_default_timezone_set('America/Guayaquil');
if (isset($_POST['add_sale'])) {
    $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');
    validate_fields($req_fields);

    if (empty($errors)) {
        $p_id = $db->escape((int)$_POST['s_id']);
        $s_qty = $db->escape((int)$_POST['quantity']);
        $s_total = $db->escape($_POST['total']);
        $date = $db->escape($_POST['date']);
        $s_date = make_date();
        $user_name = current_user()['name']; // Obtener el nombre del usuario actual

        $sql = "INSERT INTO sales (";
        $sql .= " product_id, qty, price, date, user_name"; // Agregar user_name al INSERT
        $sql .= ") VALUES (";
        $sql .= "'{$p_id}', '{$s_qty}', '{$s_total}', '{$s_date}', '{$user_name}'"; // Agregar user_name al VALUES
        $sql .= ")";

        if ($db->query($sql)) {
            update_product_qty($s_qty, $p_id);
            $session->msg('s', "Sale added. ");
            redirect('add_sale.php', false);
        } else {
            $session->msg('d', 'Sorry failed to add!');
            redirect('add_sale.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_sale.php', false);
    }
}
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
          </span>
          <input type="text" id="sug_input" class="form-control" name="title" placeholder="Buscar por nombre de producto">
        </div>
        <div id="result" class="list-group"></div>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Ventas</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
          <table class="table table-bordered">
            <thead>
              <th>Articulo</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Accion</th>
            </thead>
            <tbody id="product_info"> </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

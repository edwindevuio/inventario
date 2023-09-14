<?php
  $page_title = 'Add Group';
  require_once('../controllers/load.php');
  //Tomar en cuenta el nivel de usuario 
   page_require_level(1);
?>
<?php
  if(isset($_POST['add'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);

   if(find_by_groupName($_POST['group-name']) === false ){
     $session->msg('d','<b>Sorry!</b> ¡El nombre del grupo ingresado ya está en la base de datos!');
     redirect('add_group.php', false);
   }elseif(find_by_groupLevel($_POST['group-level']) === false) {
     $session->msg('d','<b>Sorry!</b> ¡El nombre del grupo ingresado ya está en la base de datos!');
     redirect('add_group.php', false);
   }
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO user_groups (";
        $query .="group_name,group_level,group_status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Grupo creado! ");
          redirect('add_group.php', false);
        } else {
          //failed
          $session->msg('d',' Fallo creacion del grupo!');
          redirect('add_group.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_group.php',false);
   }
 }
?>
<?php include_once('../views/layouts/header.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h3>Agregar nuevo grupo de usuarios</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="add_group.php" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre</label>
              <input type="name" class="form-control" name="group-name">
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel</label>
              <input type="number" class="form-control" name="group-level">
        </div>
        <div class="form-group">
          <label for="status">Estado</label>
            <select class="form-control" name="status">
              <option value="1">Activado</option>
              <option value="0">Desactivado</option>
            </select>
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="add" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('../views/layouts/footer.php'); ?>

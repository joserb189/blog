<?php 
      include('../includes/header.php');
      include('../config/Basemysql.php');
      include('../modelos/Usuario.php');
      $base = new Basemysql();
      $cx = $base->connect();
      $usuarios = new Usuario($cx);
      if(isset($_GET['mensaje'])){
          $mensaje = $_GET['mensaje'];
      }
?>
<div clas="row">
    <div class="col-sm-12">
        <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong><?=$error?></strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
    </div>
</div>
<div clas="row">
    <div class="col-sm-12">
        <?php if (isset($mensaje)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
<strong><?=$mensaje?></strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
    </div>
</div>
<!--Inicio de la tabla de usuarios-->
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <h3>listado de usuarios</h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12 caja">
            <table id="tblUsuarios" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>CORREO</th>
                        <th>ROL</th>
                        <th>FECHA DE CREACION</th>
                        <th>OPERACIONES</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($usuarios->listar() as $u) : ?>    
                    <tr>
                        <td><?=$u->id?></td>
                        <td><?=$u->nombre?></td>
                        <td><?=$u->email?></td>
                        <td><?= $u->rol?></td>
                        <td><?=formatearFecha($u->fecha_creacion)?></td>
                        <td>
                            <a class="btn btn-warning" href="<?=RUTA_ADMIN?>editar_usuario.php?id=<?=$u->id?>"><i
                                    class="bi-pencil-fill"></i></a>
                        </td>
                    </tr>
                   <?php endforeach; ?>     
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--fin de la tabla de usuarios-->


<?php include('../includes/footer.php');?>

<!--inicio DATATALE usuarios-->
<script>
$(document).ready(function() {
    $('#tblUsuarios').DataTable();
});
</script>
<!--final DATATALE usuarios-->
<?php
  include('../includes/header.php');
  include('../config/Basemysql.php');
  include('../modelos/Comentario.php');
 $base = new Basemysql();
  $cx = $base->connect();
  $comentarios = new Comentario($cx); 
     if (isset($_GET['mensaje'])){
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
<!--Inicio de la tabla de Comentarios-->
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <h3>listado de Comentarios</h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12 caja">
            <table id="tblComentarios" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>COMENTARIO</th>
                        <th>USUARIO</th>
                        <th>ARTICULO</th>
                        <th>ESTADO</th>
                        <th>FECHA DE CREACION</th>
                        <th>OPERACIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($comentarios->listar($_SESSION['id'], $_SESSION['rol_id']) as $c):?>
                    <tr>
                        <td><?=$c->id?></td>
                        <td><?=$c->comentario?></td>
                        <td><?=$c->autor?></td>
                        <td><?=$c->titulo?></td>
                        <td><?=$c->estado==1?'APROBADO':'PENDIENTE'?></td>
                        <td><?=formatearFecha($c->fecha_creacion)?></td>
                        <td><a class="btn btn-warning" href="<?=RUTA_ADMIN?>editar_comentario.php?id=<?=$c->id?>"><i
                                    class="bi-pencil-fill"></i></a>

                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--fin de la tabla de Comentarios-->

<?php
include('../includes/footer.php');
?>

<!--inicio DATATALE Comentarios-->
<script>
$(document).ready(function() {
    $('#tblComentarios').DataTable();
});
</script>
<!--final DATATALE Comentarios-->
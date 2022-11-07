<?php
 include('../includes/header.php');
 include('../config/Basemysql.php');
 include('../modelos/Comentario.php');
 $base = new Basemysql();
 $cx = $base->connect();
 $comentario = new Comentario($cx);
 if (isset($_GET['id'])){
     $id = $_GET['id'];
     $c = $comentario->get_comentario($id);
     
 }
 if (isset($_POST['editar'])){
     $id = $_GET['id'];
     $estado=$_POST['cambiar Estado'];
     if ($estado==-1){
         $error = "Debe seleccionar un estado del comentario!!";
     }else{
         if ($comentario->editar($id, $estado)){
             $mensaje = "Estado del comentario actualizado con exito";
             header("Location:comentarios.php?mensaje=".urlencode($mensaje));
            }else{
             $error = "No se pudo actualizar el comentario";
         }
     }
 }
 if (isset($_POST['borrar'])){
     $id = $_GET['id'];
     if ($comentario->eliminar($id)){
         $mensaje = "Comentario eliminado correctamente!!";
         header("Location:comentarios.php?mensaje=".urlencode($mensaje));
     }else {
         $error="Error, el comentario no se pudo eliminar!!";
     }
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
<!--inicio de la seccion de edicion de comentarios-->
<div class="container mt-5">
    <div class="container-fluid">
        <h1 clas="text-center">Editar Comentario</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
            <div class="card">
                <div class="card-header">
                    Aprueva tu Comentario
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="texto">texto</label>
                            <textarea name="texto" id="texto" class="form-control" readonly><?=$c->comentario?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="tex" class="form-control" value="<?=$_SESSION['nombre']?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Cambiar Estado :</label>
                            <select name="cambiar de estado" id="cambiar de estado" class="form-select">
                                <option value="-1">-- Selecciona un estado --</option>
                                <option value="1" <?=$c->estado==1?'selected':''?>>APROBADO</option>
                                <option value="0" <?=$c->estado==2?'selected':''?>>PENDIENTE</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" name="editar" class="btn btn-success float-start">
                            <i class="bi bi-person-bounding-box"></i>&nbsp;&nbsp;
                            Editar Comentario
                        </button>
                        <button type="submit" name="borrar " class="btn btn-danger float-end">
                            <i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;
                             Borrar Comentario
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--fin de la seccion de edicion de comentarios-->


<?php include('../includes/footer.php');?>
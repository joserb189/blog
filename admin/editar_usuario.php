<?php
   include('../includes/header.php');
   include('../config/Basemysql.php');
   include('../modelos/Usuario.php');
   $base = new Basemysql();
   $cx = $base->connect();
   $usuario = new Usuario($cx);
   if(isset($_GET['id'])){
       $id = $_GET['id'];
       $u = $usuario->individual($id);
   }
   if(isset($_POST['editar'])){
      $id = $_POST['id'];
      $rol = $_POST['rol'];
      if($rol!=0){
          if ($usuario->editar($id, $rol)){
              $mensaje = "Usuario editado correctamente!!";
              header("Location:usuarios.php?mensaje=".urlencode($mensaje));
          }else {
              $error = "Error, No se pudo actualizar el registro!!";
          }
      }else {
        $error = "Error, debes seleccionar un rol!!";
      }
   }
   if(isset($_POST['borrar'])){
       $id = $_POST['id'];
       if($usuario->eliminar($id)){
        $mensaje = "Usuario eliminado correctamente!!";
        header("Location:usuarios.php?mensaje=".urlencode($mensaje));
       }else{
           $error = "Error, el usuario no se puede eliminar!!";
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

 <!--inicio de la seccion de edicion de usuarios-->
 <div class="container mt-5">
            <div class="container-fluid">
                <h1 clas="text-center">Editar Usuario</h1>
            </div>
            <div class="row">
                <div class="col-sm-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            Ingresa los nuevos Datos
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?=$u->id?>">
                                <div class="mb-3">
                                    <label for="nombre" class="for-label">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="from-control"
                                        value="<?=$u->nombre?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" name="correo" id="correo" class="form-control"
                                        value="<?=$u->email?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="rol" class="form-label">Rol</label>
                                    <select name="rol" id="rol" class="form-select">
                                        <option value="0">--elige el rol--</option>
                                        <option value="1"<?=($u->rol_id==1?'selected':'')?>>Administrador</option>
                                        <option value="2"<?=($u->rol_id==2?'selected':'')?>>Registrado</option>
                                    </select>
                                </div>
                                <button type="submit" name="editar" class="btn btn-success float-start">
                                    <i class="bi bi-person-bounding-box"></i>&nbsp;&nbsp;
                                    EDITAR USUARIO
                                </button>
                                <button type="submit" name="borrar" class="btn btn-danger float-end">
                                    <i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;
                                    Borrar Usuario
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin de la seccion de edicion de usuarios-->

<?php include('../includes/footer.php');?>
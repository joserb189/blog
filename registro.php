<?php 
include('includes/header_front.php');
include ('config/Basemysql.php');
include('modelos/Usuario.php');
$base = new Basemysql(); 
$cx = $base->connect(); 
$u = new Usuario($cx);
if(isset($_POST['registrarse'])){
   $nombre = $_POST['nombre'];
   $email = $_POST['correo'];
   $password = $_POST['password'];
   $confirmar_password = $_POST['confirmar_password'];
  if(empty($nombre) || $nombre=='' || empty($email) || $email=='' || empty($password) || $password=='' || empty($confirmar_password) || $confirmar_password==''){
      $error = "error, algunos campos estan vacios!!";
  }else {
      if($password != $confirmar_password){
          $error = "Error, la contraseña y la confirmacion de contraseña no coinciden!!";
      } else {
          if(!$u->validar_email($email)){
             if ($u->registro($nombre, $email, $password)){
             $mensaje = "Usuario Registrado Correctamente";
        }else {
                 $error = "No se pudo registrar el usuario";
        }
          }else {
              $error = "Ese correo ya ha sido registrado con otro usuario!!";
          } 
      }
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
<!--Inicio del Registro-->
<div class="container mt-5">
    <div class="container-flid">
        <h1 class="text-center">Registro a Usuarios</h1>
        <div class="row">
            <div class="col-sm-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        Registrate para poder comentar
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">correo</label>
                                <input type="email" name="correo" id="correo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">contraseña</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_password" class="form-label">Repite la contraseña</label>
                                <input type="password" name="confirmar_password" id="confirmar_password"
                                    class="form-control">
                            </div>
                            <button type="submit" name="registrarse" class="btn btn-primary w-100"><i
                                    class="bi bi-person-circle"></i>&nbsp;&nbsp;Acceder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Fin del Registor-->

<?php include('includes/footer.php');?>
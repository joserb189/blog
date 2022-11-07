<?php 
include('includes/header_front.php');
include('config/Basemysql.php');
include('Modelos/Usuario.php');
$base = new Basemysql();
$cx = $base->connect();
$usuario = new Usuario($cx);
if(isset($_POST['acceder'])){
    $email = $_POST['correo'];
    $password = $_POST['password'];
    if (empty($email) || $email=="" || empty($password) || $password==""){
        $error = "Error, algunos campos estan vacios!!";
    }else{
        if ($usuario->acceder($email, $password)){
           $_SESSION['auth']=true;
           $_SESSION['email']=$email;
           $u = $usuario->usuario_email($email);
           $_SESSION['id'] = $u->id;
           $_SESSION['nombre'] = $u->nombre;
           $_SESSION['rol_id'] = $u->rol_id;
           header ("Location:".RUTA_FRONT."index.php");
           die();
        }else {
            $error = "Correo y/o contraseña incorrecta!!";
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

<!--Inicio del login-->
<div class="container mt-5">
            <div class="container-flid">
                <h1 class="text-center">Acceso a Usuarios</h1>
                <div class="row">
                    <div class="col-sm-6 offset-3">
                        <div class="card">
                            <div class="card-header">
                                Ingresa tus datos para Acceder
                            </div>
                            <div class="card-body">
                                <form action="" method= "POST">
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">correo</label>
                                        <input type="email" name="correo" id="correo" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <button type="submit" name="acceder" class="btn btn-primary w-100"><i
                                            class="bi bi-person-circle"></i>&nbsp;&nbsp;Acceder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin del login-->

<?php include('includes/footer.php');?>
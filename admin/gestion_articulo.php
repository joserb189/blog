<?php 
include('../includes/header.php');
include('../modelos/Articulo.php');
include('../config/Basemysql.php');
$base = new Basemysql;
$cx = $base->connect();
$articulo = new Articulo($cx);
if (isset($_GET['op'])){
    $op = $_GET['op'];
    $operacion = "crear";
    if ($op == 2){
        $operacion = "Editar";
        $id = $_GET['id'];
        $a = $articulo->get_articulo($id);
    }
}

if (isset($_POST['gestion'])){
    $titulo = $_POST['titulo']; 
    $texto = $_POST['texto'];
    if ($op==2){
         $id = $_POST['id'];
    }
    if (empty($titulo) || $titulo=='' || empty($texto) || $texto==''){
        $error = "Error, algunos campos estan vacios";
    }else{
        if ($_FILES['imagen']['error']>0){//No escogiste ningun archivo
            if ($op!=2){
            $error = "Error, ningun archivo seleccionado";
            }else {
                if ($articulo->editar(id, $titulo,'',$texto)){
                    $mensaje = "Articulo editado correctamente!!";
                    header("Location:articulos.php?mensaje=".urlencode($mensaje));
                }else {
                    $error = "Error, nose pudo editar el registro";
                }
            }
        }else {
            $image = $_FILES['imagen']['name'];
            $imageArr = explode('.',$image);
            $rand = rand(1000,99999);
            $newImage = $imageArr[0].$rand.".".$imageArr[1];//nuevo nombre del archivo
            $rutaFinal ="../img/articulo/".$newImage;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'],$rutaFinal)){
                if ($op==1){
                    if ($articulo->crear($titulo, $newImage, $texto, $_SESSION['id'])){
                        $mensaje = "Articulo creado correctamente!!";
                        header("Location:articulos.php?mensaje=".urlencode($mensaje));
                    }else {
                        $error = "No se pudo crear el articulo";
                    } 
                }else{
                    if ($articulo->editar(id, $titulo,$newImage,$texto)){
                        $mensaje = "Articulo editado correctamente!!";
                        header("Location:articulos.php?mensaje=".urlencode($mensaje));
                    }else {
                        $error = "Error, nose pudo editar el registro";
                    }
                }
            } else {
                $error = "Error, no se pudo sibir el archivo";
            }
        }
    }
}
if (isset($_POST['borrar'])){
    if (isset($_POST[''])){
        $id =_POST['id'];
        if ($articulo->eliminar(id)){
            $mensaje = $mensaje = "Articulo eliminado correctamente!!";
            header("Location:articulos.php?mensaje=".urlencode($mensaje));
        } else {
            $error = "Error, no se pudo eliminar el registro";
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
<!--Inicio de la seccion de Crear|Editar Articulos-->
<div class="container mt-5">
    <div class="container-fluid">
        <h1 class="text-center"><?=$operacion?>Articulo<h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
            <div class="card">
                <div class="card-header">
                    Ingresa los datos
                </div>
                <div class="card-body">
                    <from action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=isset($a->id)?$a->id:1?>">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" name="titulo" class="form-control" id="titulo"
                                value="<?=isset($a->titulo)?$a->titulo:''?>">
                        </div>
                        <div class="mb-3">
                            <img src="<?=isset($a->imagen)?"../img/articulos/".$a->imagen:''?>"
                                class="img-fluid img-thumbnail"
                                alt="<?=isset($a->imagen)?"../img/articulos/".$a->imagen:''?>">
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen :</label>
                            <input type="file" class="form-control" name="imagen" id="imagen"
                                placeholder="seleciona una imagen">
                        </div>
                        <div class="mb-3">
                            <label for="texto" class="form-label">Texto</label>
                            <textarea name="texto" id="texto" class="form-control" placeholder="Escriba el articulo"
                                style="height:200px"><?=isset($a->texo)?$a->texto:''?></textarea>
                        </div>
                        <br>
                        <?php 
                            if($op==1){
                              $w100 = "w-100";
                          }
                        ?>
                        <button type="submit" name="gestion" class="btn btn-success float-start <?=$w100?>">
                            <i class="bi bi-person-bounding-box"></i>&nbsp;&nbsp;
                            <?=$operacion?> Articulo
                        </button>
                        <?php if($op==2): ?>
                        <button type="submit" name="borrar" class="btn btn-danger float end">
                            <i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;
                            Borrar Articulo
                        </button>
                        <?php endif;?>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Fin de la seccion de Crear|Editar Articulos-->

<?php include('../includes/footer.php');?>
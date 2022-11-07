<?php 
include('includes/header_front.php');
include('config/Basemysql.php');
include('modelos/Articulo.php');
include('modelos/Comentario.php');
$base = new Basemysql();
$cx = $base->connect();
$articulo = new Articulo($cx);
$comentario = new Comentario($cx);
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $a = $articulo->get_articulo($id);
}
if (isset($_POST['enviarComentario'])){
    $texto = $_POST['texto'];
    if (!(empty($texto) || $texto="")){
    $usuario_id = $_SESSION['id'];
    $articulo_id = $_GET['id'];
    if ($comentario->crear_comentario($texto, $usuario_id, $articulo_id)){
        header ("Location: index.php");
} else {
    $error = "Error al crear el comentario";
}
    }else {
        $error = "Error, tiene que escribir";
    }
}
?>
<!--Inicio de la seccion del detalle del articulo-->
<div class="container mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h1><?=$a->titulo?></h1>
                    </div>
                    <div class="text-center">
                        <img src="img/articulos/<?=$a->imagen?>" alt="img/articulos/<?=$a->imagen?>"
                            class="img-fluid img-thumbnail">
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?=$a->texto?></p>
                    </div>
                </div>
            </div>
        </div>
        <!--Inicio para escribir un comentario-->
        <div class="row">
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
            <?php if (isset($_SESSION['auth'])):?>
            <div class="row my-5">
                <div class="col-sm-6 0ffset-3">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario :</label>
                            <input type="text" class="from-control" name="usuario" id="usuario"
                                value="<?=$_SESSION['nombre']?>" readonly>
                        </div>
                        <div class="mg-3">
                            <label for="comentario" class="form-label">Comentario : </label>
                            <textarea name="comentario" id="comentario" style="height:200px"
                                class="form-control"></textarea>
                        </div>
                        <br>
                        <button type="submit" name="enviarcomentario" class="btn btn-primary w-100"><i
                                class="bi bi-person-circle"></i>&nbsp;&nbsp;Crear Nuevo Comentario</button>
                    </form>
                </div>
            </div>
            <?php endif; ?>
            <!--Fin para escribir un comentario-->

            <!--Inicio de los comentarios-->
            <div class="row">
                <h3 class="text-center mt5">comentarios</h3>
                <?php foreach ($comentario->comentarios_articulo($id) as $c):?>
                <hr>
                <h4><i class="bi bi-person-circle"></i>&nbsp;&nbsp;<?=$c->autor?> :</h4>
                <p><?=$c->comentario?></p>
                <?php endforeach;?>
            </div>
            <!--Fin de los comentarios-->
        </div>
    </div>
    <!--Fin  de la seccion del detalle del articulo-->

    <?php include('includes/footer.php');?>
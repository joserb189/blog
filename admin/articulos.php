<?php
  include('../includes/header.php');
  include('../config/Basemysql.php');
  include('../modelos/Articulo.php');
  $base = new Basemysql();
  $cx = $base->connect();
  $articulos = new Articulo($cx);
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
<!--Inicio de la tabla de Articulos-->
<div class="container mt-5">
            <div class="row">
                <div class="col-sm-6">
                    <h3>listado de Articulos</h3>
                </div>
                <div class="col-sm-4 offset-2">
                    <a href="<?=RUTA_ADMIN?>gestion_articulo.php?op=1" class="btn btn-success w-100"><i class="bi bi-plus">&nbsp;&nbsp;Nuevo Articulo</i></a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-12 caja">
                    <table id="tblArticulos" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TITULO</th>
                                <th>IMAGEN</th>
                                <th>TEXTO</th>
                                 <?php if ($_SESSION['rol_id']==1):?> 
                                <th>AUTOR</th>
                                <?php endif;?>
                                <th>FECHA DE CREACION</th>
                                <th>OPERACIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($articulos->listar($_SESSION['id'], $_SESSION['rol_id']) as $a):?>
                            <tr>
                                <td><?=$a->id?></td>
                                <td><?=$a->titulo?></td>
                                <td><img class="img-fluid" style="width:180px;" src="../img/articulos/<?=$a->imagen?>"
                                        alt="img/articulos/img4.jpg"></td>
                                <td><?=textoCorto($a->texto)?></td>
                                <?php if ($_SESSION['rol_id']==1):?> 
                                  <td><?=$a->autor?></td>
                                <?php endif;?>
                                <td><?=formatearFecha($a->fecha_creacion)?></td>
                                <td><a class="btn btn-warning" href="<?=RUTA_ADMIN?>gestion_articulo.php?op=2&id=<?=$a->id?>"><i
                                            class="bi-pencil-fill"></i></a>
                                <!--<i class="bi bi-person-x-fill"></i>&nbsp;&nbsp;ELIMINAR</a>-->
                                </td>
                            </tr>
                            <?php endforeach; ?>
                           <!--
                            <tr>
                                <td>2</td>
                                <td>SEGUNDO ARTICULO</td>
                                <td><img class="img-fluid" style="width:180px;" src="../img/articulos/img5.jpg"
                                        alt="img/articulos/img5.jpg"></td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, aliquam a est dicta
                                    officia alias ipsam nihil commodi doloremque sint illo in mollitia sunt nobis. Eos
                                    voluptatum quas similique. Eum?</td>
                                <td>15 DE ABRIL DE 2021</td>
                                <td><a class="btn btn-warning" href="#"><i
                                            class="bi-pencil-fill"></i>&nbsp;&nbsp;EDITAR</a>
                                    <a class="btn btn-danger" href="#"><i
                                            class="bi bi-person-x-fill"></i>&nbsp;&nbsp;ELIMINAR</a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>TERCER ARTICULO</td>
                                <td><img class="img-fluid" style="width:180px;" src="../img/articulos/img6.jpg"
                                        alt="img/articulos/img6.jpg"></td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, aliquam a est dicta
                                    officia alias ipsam nihil commodi doloremque sint illo in mollitia sunt nobis. Eos
                                    voluptatum quas similique. Eum?</td>
                                <td>15 DE ABRIL DE 2021</td>
                                <td><a class="btn btn-warning" href="#"><i
                                            class="bi-pencil-fill"></i>&nbsp;&nbsp;EDITAR</a>
                                    <a class="btn btn-danger" href="#"><i
                                            class="bi bi-person-x-fill"></i>&nbsp;&nbsp;ELIMINAR</a>
                                </td>
                            </tr>
                            -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--fin de la tabla de Articulos-->

<?php
include('../includes/footer.php');
?>

         <!--inicio DATATALE Articulos-->
         <script>
        $(document).ready(function() {
            $('#tblArticulos').DataTable();
        });
        </script>
        <!--final DATATALE Articulos-->

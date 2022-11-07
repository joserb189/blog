<?php
include('config/Basemysql.php');
include('modelos/Articulo.php');
$base = new Basemysql();
$cx = $base->connect();
$articulos = new Articulo($cx);
?>
 <!--inicio articulos-->
 <div class="container mt-5">
            <div class="container -fluid my-4">
                <h1 class="text-center">Articulos</h1>
                <div class="row">
                <?php foreach($articulos->listar(0,1) as $a):?>
                    <div class="col-sm-4 my-2">
                        <div class="card h-100">
                            <img src="img/articulos/<?=$a->imagen?>" class="card-img-top"
                                alt="img/articulos/img3.jpg">
                            <div class="card-body">
                                <h5 class="card-title"><?=$a->titulo?></h5>
                                <p><strong><?=formatearFecha($a->fecha_creacion)?></strong></p>
                                <p class="card-text"><?=textoCorto($a->texto,300)?></p>
                                <a href="<?=RUTA_FRONT?>detalle.php?id=<?=$a->id?>" class="btn btn-primary">ver Articulo</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!--fin articulos-->
<!--3 <div class="col -sm-4">
                        <div class="card">
                            <img src="img/articulos/img3.jpg" class="card-img-top"
                                alt="img/articulos/img3.jpg">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p><strong>16 de Abril de 2021</strong></p>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of
                                    the card's content.</p>
                                <a href="<?=RUTA_FRONT?>detalle.php" class="btn btn-primary">ver Articulo</a>
                            </div>
                        </div>
                    </div>-->

<!--3 <div class="col -sm-4">
                        <div class="card">
                            <img src="img/articulos/articulo1.jpg" class="card-img-top"
                                alt="img/articulos/articulo1.jpg">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p><strong>16 de Abril de 2021</strong></p>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of
                                    the card's content.</p>
                                <a href="<?=RUTA_FRONT?>detalle.php" class="btn btn-primary">ver Articulo</a>
                            </div>
                        </div>
                    </div>-->
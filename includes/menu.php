 <!--Inicia menu-->
 <nav class="navbar navbar-expand-lg navbar-blue bg-dark sticky-top">
     <div class="container">
         <a class="navbar-brand" href="<?=RUTA_FRONT?>">BLOG</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
             aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
             <?php if(isset($_SESSION['auth'])):?>
             <ul class="navbar-nav">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         Administracion
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                         <li><a class="dropdown-item" href="<?php echo RUTA_ADMIN; ?>articulos.php">Articulos</a></li>
                         <li><a class="dropdown-item" href="<?=RUTA_ADMIN?>comentarios.php">Comentarios</a></li>
                     </ul>
                 </li>
                 <?php if ($_SESSION['rol_id']==1):?>
                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="<?=RUTA_ADMIN;?>usuarios.php">Usuarios</a>
                 </li>
                 <?php endif; ?>
             </ul>
             <?php endif; ?>
             <ul class="navbar-nav  ms-md-auto">
                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="<?=RUTA_FRONT?>">Inicio</a>
                 </li>
                 <?php if(!isset($_SESSION['auth'])):?>
                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="<?=RUTA_FRONT?>registro.php">Registrarse</a>
                 </li>
                 <?php endif; ?>
                 <?php if(isset($_SESSION['auth'])):?>
                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="#"><i
                             class="bi bi-person-circle"></i>&nbsp;&nbsp;<?= $_SESSION['nombre']?></a>
                 </li>
                 <?php endif; ?>
                 <?php if(!isset($_SESSION['auth'])):?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?=RUTA_FRONT?>acceso.php">acceder</a>
                 </li>
                 <?php endif; ?>
                 <?php if(isset($_SESSION['auth'])):?>
                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="<?=RUTA_FRONT?>salir.php">salir</a>
                 </li>
                 <?php endif; ?>
             </ul>
         </div>
     </div>
 </nav>
 <!--Fin del menu-->
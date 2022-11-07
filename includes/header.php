<?php
 include('../config/config.php');
 include('../helpers/helper_formatos.php');
 session_start();
 if(!$_SESSION['auth']){//Cuando el usuario intenta entrar al menu restringido (admin)
     header("Location:../acceso.php");//va a redireccionar a el acceso para que
 }                                      //inicie sesion 
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset ="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">


</head>

<body>

<?php
include('menu.php');
?>
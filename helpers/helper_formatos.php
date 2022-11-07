<?php

   function formatearFecha($fecha){
       return date('d M, y, g:i a', strtotime($fecha));
   }

   function textoCorto($texto, $chars=30){
       $texto = $texto . "";
       $texto = substr($texto,0, $chars);
       $texto = substr($texto,0, strrpos($texto, ' '));
       $texto = $texto." ...";
       return $texto;
   }
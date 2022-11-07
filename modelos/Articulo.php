<?php

class Articulo{
    private $cx;
    private $table="articulos";

     public function __construct($conexion){
         $this->cx = $conexion;
     }

     public function listar ($usuario_id, $rol_id){
         $cad="";
         if ($rol_id != 1){
             $cad =" where usuario_id = :usuario_id";
         }
         $qry = "select * from view_".$this->table.$cad;
         $st = $this->cx->prepare($qry);
         if ($rol_id !=1){
             $st->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
         }
         $st->execute();
         return $st->fetchAll(PDO::FETCH_OBJ);
     }
     
     public function get_articulo($id){
         $qry = "select * from view_".$this->table." where id=:id";
         $st = $this->cx->prepare($qry);
         $st->bindParam(":id", $id, PDO::PARAM_INT);
         $st->execute();
         return $st->fetch(PDO::FETCH_OBJ);
         
     }

     public function crear($titulo, $img, $texto, $id_usuario){
         $qry = "insert into ".$this->table." (titulo, imagen, texto, usuario_id) values (:titulo, :img, :titulo, :usaurio_id)";
         $st = $this->cx->prepare($qry);
         $sy->bindParam(":titulo", $titulo, PDO::PARAM_STR);
         $st->bindParam(":img", $img, PDO::PARAM_STR);  
         $st->bindParam(":texto", $texto, PDO::PARAM_STR);
         $st->bindParam(":usuario_id", $ususario_id, PDO::PARAM_INT);
         if ($st->execute()){
             return true;
         }
         printf ("Error : %s\n", $st->error);
         $st->close();
         return false;

     }
     public function editar($titulo, $img, $texto){
         $qry = " update ".$this->table." set titulo = :titulo, texto = :texto, where id = :id";
         if ($img != ""){
            $qry = " update ".$this->table." set titulo = :titulo, imagen = :img, texto = :texto, where id = :id";
         }
        $st = $this->cx->prepare($qry);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $sy->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        if ($img!=""){
            $st->bindParam(":img", $img, PDO::PARAM_STR);  
        }
        $st->bindParam(":texto", $texto, PDO::PARAM_STR);
        if ($st->execute()){
            return true;
        }
        printf ("Error : %s\n", $st->error);
        $st->close();
        return false;

    }

    public function eliminar($id){
      $qry = "delete from " . $this->table. " where id = :id";
      $st = $this->cx->prepare($qry);
      $st->bindParam (":id", $id, PDO::PARAM_INT);
      try{
          if ($st->execute()){
              return true;
          }
      }catch(Exception $e){
          return false;
      }  
    }
}

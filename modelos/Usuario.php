<?php
    class Usuario{
          private $conn;
          private $table = 'usuarios';

        public function __construct($cx)
        {
            $this->conn = $cx;
        }
 
        public function registro ($nombre,$email,$password){
            //lo que se nesecits hacer
             $qry = "insert into ".$this->table." (nombre, email, password, rol_id) values (:nombre, :email, :password, 2)"; 
            //preparo la operacion
             $st = $this->conn->prepare($qry);
            //Encriptar el password
             $pass_encriptada = md5($password);
            //Asociar los parametros de la sentencia
             $st->bindParam(":nombre",$nombre, PDO::PARAM_STR);
             $st->bindParam(":email",$email, PDO::PARAM_STR);
             $st->bindParam(":password",$pass_encriptada, PDO::PARAM_STR);
            //se ejecuta la accion
             if ($st->execute()){
                 return true;
            }   
             return false;
        }
    
        public function validar_email($email){
            $qry = "select * from ".$this->table." where email = :email";
            $st = $this->conn->prepare($qry);
            $st->bindparam(":email", $email, PDO::PARAM_STR);
            $st->execute();
            $resultado = $st->fetch(PDO::FETCH_ASSOC);
            if($resultado){
                return true;
            }
            return false;
        }

        public function listar() {
            $qry = "select * from view_".$this->table;
            $st = $this->conn->prepare($qry);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_OBJ);
        }

        public function individual($id){
            $qry = "select * from ".$this->table." where id = :id";
            $st = $this->conn->prepare($qry);
            $st->bindParam (":id", $id, PDO::PARAM_INT);
            $st->execute();
            return $st->fetch(PDO::FETCH_OBJ);
        }

        public function editar($id_usuario, $rol){
            $qry = "update ".$this->table." set rol_id = :rol where id = :id_usuario";
            $st = $this->conn->prepare($qry);
            $st->bindParam (":id_usuario", $id_usuario, PDO::PARAM_INT);
            $st->bindParam (":rol", $rol, PDO::PARAM_INT);
            if($st->execute()){
            return true;
        }
        printf ("Error $s\n", $st->error);
        return false;
    }

    public function eliminar($id){
        $qry = "delete from ".$this->table." where id = :id";
        $st = $this->conn->prepare($qry);
        $st->bindParam (":id", $id, PDO::PARAM_INT);
        try{
            if($st->execute()){
                return true;
            }
        }catch (Exception $e){
            return false;
        }
    }

    public function acceder($email,$password){
        $pass = md5($password);
        $qry = "select * from ".$this->table." where email=:email and password=:pass";
        $st = $this->conn->prepare($qry);
        $st->bindParam (":email", $email, PDO::PARAM_STR);
        $st->bindParam (":pass", $pass, PDO::PARAM_STR);
         $st->execute();
         if($st->fetch(PDO::FETCH_ASSOC)){
             return true;
         }else {
             return false;
         }
    }

    public function usuario_email ($email){
        $qry = "select * from ".$this->table." where email = :email";
        $st = $this->conn->prepare($qry);
        $st->bindParam (":email", $email, PDO::PARAM_STR);
         $st->execute();
         return $st->fetch(PDO::FETCH_OBJ);
    }
}
<?php
//parametros base de datos
class Basemysql{
private $host='localhost';
private $db_name= 'blog';
private $username= 'root';
private $password='';
private $conn;

//conexion con la BD::PDO
public function connect(){
    $this->conn=null;
    try{
         $this->conn =new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo "Error en la conexion : ". $e->getMessage();
    }
    //echo "Conexion exitosa!!";
    return $this->conn;
}
}
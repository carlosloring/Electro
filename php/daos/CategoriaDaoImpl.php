<?php

require_once("CategoriaDao.php");
require_once("php/clases/Categoria.php");
require_once("php/config/Conexion.php");

class CategoriaDaoImpl implements CategoriaDao {
    
    private $conexion;
    
    function __construct (){
        
        $this->conexion=Conexion::getConnection();
    }
    
    public function findAll(){
        
        $categorias=[];
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM categoria");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            while ($row = $stmt->fetch()){
                $c=new Categoria($row);
                array_push($categorias, $c);
            }
        }
        
        return $categorias;
    }
    
    public function findById($id){
        if(!$this->conexion==null){
        // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM categoria WHERE idCategoria=:id");
            $stmt->bindParam(':id', $id); 
        // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            if ($row = $stmt->fetch()){
                $c=new Categoria($row);
                return $c;
            }
        }
        
        return null;
    }
}
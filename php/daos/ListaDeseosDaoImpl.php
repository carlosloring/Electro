<?php
require_once("ListaDeseosDao.php");
require_once("php/clases/ListaDeseos.php");
require_once("php/config/Conexion.php");

class ListaDeseosDaoImpl implements ListaDeseosDao {
    
    private $conexion;
    
    function __construct (){
        
    $this->conexion=Conexion::getConnection();
        
    }
    
    public function findByIdUsuario($id){
        $lista=[];
        if(!$this->conexion==null){
        // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM listaDeseos WHERE idUsuario=:id");
            $stmt->bindParam(':id', $id); 
        // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            while ($row = $stmt->fetch()){
                $c=new ListaDeseos($row);
                $lista[]=$c;
            }
        }
        
        return $lista;
    }
}

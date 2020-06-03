<?php
require_once("ResenaDao.php");
require_once("php/clases/Resena.php");
require_once("php/config/Conexion.php");

class ResenaDaoImpl implements ResenaDao{
    
    private $conexion;
    
    function __construct (){
        
        $this->conexion=Conexion::getConnection();
    }
    
    
    public function findByIdProducto($id){
        
        $resenas=[];
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM resenas WHERE idProducto=:id");
            
            $stmt->bindParam(':id', $id); //Statement(Consulta preparada).
            
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            while ($row = $stmt->fetch()){
                $r=new Resena($row);
                array_push($resenas, $r);
            }
        }
        
        return $resenas;
    }
    
    public function guardar($resena){
        
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("INSERT into resenas(idResena,email,usuarioResena,puntuacion,fecha,comentario,idProducto) VALUES(NULL, :email, :usuario, :puntuacion,now(), :comentario, :idProducto)");//No tiene que coincidir con los nombres de la BD
            
            $email=$resena->get_email();
            $usuario=$resena->get_usuarioResena();
            $puntuacion=$resena->get_puntuacion();
            $comentario=$resena->get_comentario();
            $idProducto=$resena->get_idProducto();
            
            $stmt->bindParam(':email', $email); //Statement(Consulta preparada).La preparamos para evitar inyeccion de codigo
            $stmt->bindParam(':usuario', $usuario); //Statement(Consulta preparada).La preparamos para evitar inyeccion de codigo
            $stmt->bindParam(':puntuacion', $puntuacion); //Statement(Consulta preparada).La preparamos para evitar inyeccion de codigo
            //no ponemos fecha porque no decidimos nosotros la fecha del comentario now()
            $stmt->bindParam(':comentario',$comentario); //Statement(Consulta preparada).La preparamos para evitar inyeccion de codigo
            $stmt->bindParam(':idProducto',$idProducto); //Statement(Consulta preparada).La preparamos para evitar inyeccion de codigo
            
            
            $resultado=$stmt->execute();
            return $resultado;
            
        }
        
    }
}

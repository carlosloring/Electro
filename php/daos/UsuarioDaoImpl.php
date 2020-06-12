<?php
require_once("UsuarioDao.php");
require_once("php/clases/Usuario.php");
require_once("php/config/Conexion.php");

class UsuarioDaoImpl implements UsuarioDao{
    
    private $conexion;
    
    function __construct (){
        
        $this->conexion=Conexion::getConnection();
    }
    
    
    public function findByEmail($email){
        
        $usuario=null;
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE email=:email");
            
            $stmt->bindParam(':email', $email); //Statement(Consulta preparada).
            
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            if ($row = $stmt->fetch()){
                $usuario=new Usuario($row);
                
            }
        }
        
        return $usuario;
    }
    
    public function guardar($usuario, $password){
        
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("INSERT into usuario(idUsuario, nombre, password, fechaRegistro, email, telefono, apellido, direccion, ciudad, pais, codigoPostal) VALUES(NULL,:nombre, :password, now(), :email, :telefono, :apellido, :direccion, :ciudad, :pais, :codigoPostal)");//No tiene que coincidir con los nombres de la BD
            
            $email=$usuario->get_email();
            $nombre=$usuario->get_nombre();
            $telefono=$usuario->get_telefono();
            $apellido=$usuario->get_apellido();
            $direccion=$usuario->get_direccion();
            $ciudad=$usuario->get_ciudad();
            $pais=$usuario->get_pais();
            $codigoPostal=$usuario->get_codigoPostal();
            $md5=md5($password);
            
            $stmt->bindParam(':email', $email); //Statement(Consulta preparada).La preparamos para evitar inyeccion de codigo
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':direccion',$direccion);
            $stmt->bindParam(':ciudad',$ciudad);
            $stmt->bindParam(':pais',$pais);                                 
            $stmt->bindParam(':codigoPostal', $codigoPostal);
            $stmt->bindParam(':password', $md5);
                                             
            $resultado=$stmt->execute();
            return $resultado;
            
        }
        
    }
    
    public function login ($email, $password){
        
        $usuario=null;
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $md5=md5($password);
            $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE email=:email AND password=:md5");
            
            $stmt->bindParam(':email', $email); //Statement(Consulta preparada).
            
            $stmt->bindParam(':md5', $md5); //Statement(Consulta preparada).
            
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            if ($row = $stmt->fetch()){
                $usuario=$this->findByEmail($email);
                
            }
        }
        return $usuario;
    }
    
    public function carritovacio ($idUsuario){
        
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT COUNT(*) as lineas FROM pedido WHERE estado=false AND idUsuario=:idUsuario");
            
            $stmt->bindParam(':idUsuario', $idUsuario); //Statement(Consulta preparada);
            
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            if ($row = $stmt->fetch()){
                if($row['lineas']==0){
                    $stmt2 = $this->conexion->prepare("INSERT INTO pedido (idUsuario, precioTotal, estado) VALUES (:idUsuario,0,0)");
            
                    $stmt2->bindParam(':idUsuario', $idUsuario); //Statement(Consulta preparada);

                    // Especificamos el fetch mode antes de llamar a fetch()
                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    // Ejecutamos
                    $stmt2->execute();
                }
                
            }
        }
        return $usuario;
    }
    public function suscribirse($email){
            if(!$this->conexion==null){
                    $stmt2 = $this->conexion->prepare("INSERT INTO emails VALUES (:email)");
            
                    $stmt2->bindParam(':email', $email); //Statement(Consulta preparada);

                    // Especificamos el fetch mode antes de llamar a fetch()
                    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                    // Ejecutamos
                    $stmt2->execute();
            }
    }
}

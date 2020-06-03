<?php
require_once("ProductoDao.php");
require_once("php/clases/Producto.php");
require_once("php/config/Conexion.php");

class ProductoDaoImpl implements ProductoDao{
    
    private $conexion;
    
    function __construct (){
        
        $this->conexion=Conexion::getConnection();
    }
    
    public function findAll(){
        
        $productos=[];
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM producto");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            while ($row = $stmt->fetch()){
                $p=new Producto($row);
                array_push($productos, $p);
            }
        }
        
        return $productos;
    }
    
    //REVISAR QUE FUNCIONA CORRECTAMENTE*****
    
    public function findById($id){
        if(!$this->conexion==null){
        // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM producto WHERE idProducto=:id");
            $stmt->bindParam(':id', $id); 
        // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            if ($row = $stmt->fetch()){
                $p=new Producto($row);
                return $p;
            }
        }
        
        return null;
    }
    
    public function findByCategoria($id){
        
        $productos=[];
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT * FROM producto WHERE idCategoria=:id");
            
            $stmt->bindParam(':id', $id); //Statement(Consulta preparada).
            
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            while ($row = $stmt->fetch()){
                $p=new Producto($row);
                array_push($productos, $p);
            }
        }
        
        return $productos;
    }
    
    public function findFilaPedido($idUsuario){
        
        if(!$this->conexion==null){
        // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT p.idPedido, pp.cantidad, pr.nombre, pr.precioRebajado FROM pedido p INNER JOIN productosPedido pp ON p.idPedido = pp.idPedido INNER JOIN producto pr ON pp.idProducto = pr.idProducto WHERE p.estado=0 AND p.idUsuario = :idUsuario;");
            $stmt->bindParam(':idUsuario', $idUsuario); 

        // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            $listapedidos="";

            while ($row = $stmt->fetch()){
                $listapedidos=$listapedidos.'<div class="order-col"><div>'.$row['cantidad'].'x '.$row['nombre'].'</div><div>€'.($row['precioRebajado']*$row['cantidad']).'</div></div>';

            }
            return $listapedidos;
    }
}
    public function calcularCarrito ($idUsuario){
        
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT COUNT(*) as lineas FROM pedido p INNER JOIN productosPedido pp ON p.idPedido = pp.idPedido WHERE p.idUsuario=:idUsuario AND estado=0;");
            
            $stmt->bindParam(':idUsuario', $idUsuario); //Statement(Consulta preparada);
            
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            if ($row = $stmt->fetch()){
                return $row['lineas'];
                
            }
        }
        return 0;
    }
    public function obtenerPedido($idUsuario){
        
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("SELECT p.idPedido FROM pedido p WHERE p.idUsuario=:idUsuario AND estado=0;");
            
            $stmt->bindParam(':idUsuario', $idUsuario); //Statement(Consulta preparada);
            
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            // Ejecutamos
            $stmt->execute();
            // Mostramos los resultados
            if ($row = $stmt->fetch()){
                return $row['idPedido'];
                
            }
        }
        return 0;
    }
    public function anadirProducto($idPedido,$cantidad,$idProducto){
        
        if(!$this->conexion==null){
            
            // FETCH_ASSOC
            $stmt = $this->conexion->prepare("INSERT INTO productosPedido VALUES(:idProducto,:cantidad,:idPedido)");//No tiene que coincidir con los nombres de la BD

            $stmt->bindParam(':idProducto', $idProducto); //Statement(Consulta preparada).La preparamos para evitar inyeccion de codigo
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':idPedido', $idPedido);
                                             
            $resultado=$stmt->execute();
            return $resultado;
            
        }
        
    }
}
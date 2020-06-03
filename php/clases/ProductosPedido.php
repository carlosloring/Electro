<?php

public class ProductosPedido{
    
    private $idProducto;
    private $cantidad;
    private $idPedido;
    
 public function __construct ($row == null){
     
     if (!$row == null) {

        $this->idProducto = $row["idProducto"];
        $this->cantidad = $row["cantidad"];
        $this->idPedido = $row["idPedido"];

    }   
     
 }
     
    public function get_cantidad(){
    return $this->cantidad;
}
    
    public function set_cantidad($cantidad){
    $this->cantidad = $cantidad;
}    

    public function get_idProducto(){
    return $this->idProducto;
}
    
    public function set_idProducto($idProducto){
    $this->idProducto = $idProducto;
}
    public function get_idPedido(){
    return $this->idPedido;
}
    
    public function set_idPedido($idPedido){
    $this->idPedido = $idPedido;
}  
}
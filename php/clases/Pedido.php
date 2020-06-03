<?php

public class Pedido{
    
    private $idPedido;
    private $idUsuario;
    private $fechaPedido;
    private $precioTotal;
    
 public function __construct ($row == null){
     
     if (!$row == null) {

        $this->idPedido = $row["idPedido"];
        $this->idUsuario = $row["idUsuario"];
        $this->fechaPedido = $row["fechaPedido"];
        $this->precioTotal = $row["precioTotal"]

    }   
     
 }
     
    public function get_idPedido(){
    return $this->idPedido;
}
    
    public function set_idPedido($idPedido){
    $this->idPedido = $idPedido;
}  
    
    public function get_fechaPedido(){
    return $this->fechaPedido;
}
    
    public function set_fechaPedido($fechaPedido){
    $this->fechaPedido = $fechaPedido;
}    

    public function get_precioTotal(){
    return $this->precioTotal;
}
    
    public function set_precioTotal($precioTotal){
    $this->precioTotal = $precioTotal;
}    
    public function get_idUsuario(){
    return $this->idUsuario;
}
    
    public function set_idUsuario($idUsuario){
    $this->idUsuario = $idUsuario;
} 
}
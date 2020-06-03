<?php

    class ListaDeseos implements JsonSerializable{
    
    private $idUsuario;
    private $idProducto;
    
    public function __construct($row = null)

{

    if (!$row == null) {

        $this->idUsuario = $row["idUsuario"];
        $this->idProducto = $row["idProducto"];
    }
  
    }
    public function get_idUsuario(){
    return $this->idUsuario;
}
    
    public function set_idUsuario($idUsuario){
    $this->idUsuario = $idUsuario;
}
     public function get_idProducto(){
    return $this->idProducto;
}
    
    public function set_idProducto($idProducto){
    $this->idProducto = $idProducto;
} 
    
    public function jsonSerialize()
{
        $vars = get_object_vars($this);

        return $vars;
}
}
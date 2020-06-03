<?php



class Producto implements JsonSerializable{
    
    private $idProducto;
    private $nombre;
    private $descripcion;
    private $descripcionCorta;
    private $detalles;
    private $precioNormal;
    private $precioRebajado;
    private $stock;
    private $foto;
    private $idCategoria;
    
 public function __construct ($row = null){
     
     if ($row != null) {

        $this->idProducto = $row["idProducto"];
        $this->nombre = $row["nombre"];
        $this->descripcion = $row["descripcion"];
        $this->descripcionCorta = $row["descripcionCorta"];
        $this->detalles = $row["detalles"];
        $this->precioNormal = $row["precioNormal"];
        $this->precioRebajado = $row["precioRebajado"];
        $this->stock = $row["stock"];
        $this->foto = $row["foto"];
        $this->idCategoria = $row["idCategoria"];

    }   
     
 }
     
    public function get_idProducto(){
    return $this->idProducto;
}
    
    public function set_idProducto($idProducto){
    $this->idProducto = $idProducto;
}    

    public function get_nombre(){
    return $this->nombre;
}
    
    public function set_nombre($nombre){
    $this->nombre = $nombre;
              
} 
    public function get_descripcion(){
    return $this->descripcion;
}
    public function set_descripcion($descripcion){
    $this->descripcion = $descripcion;
}    
    
    
    public function get_descripcionCorta(){
    return $this->descripcionCorta;
}
    
    public function set_descripcionCorta($descripcionCorta){
    $this->descripcionCorta = $descripcionCorta;
}
    
    
    
    
    
    public function get_detalles(){
    return $this->detalles;
}
    
    public function set_detalles($detalles){
    $this->detalles = $detalles;
}    
    public function get_precioNormal(){
    return $this->precioNormal;
}
    
    public function set_precioNormal($precioNormal){
    $this->precioNormal = $precioNormal;
} 
 
    public function get_precioRebajado(){
    return $this->precioRebajado;
}
    
    public function set_precioRebajado($precioRebajado){
    $this->precioRebajado = $precioRebajado;
} 
    public function get_stock(){
    return $this->stock;
}
    
    public function set_stock($stock){
    $this->stock = $stock;
} 
    
    public function get_foto(){
    return $this->foto;
}
    
    public function set_foto($foto){
    $this->foto = $foto;
}    
    public function get_idCategoria(){
    return $this->idCategoria;
}
    
    public function set_idCategoria($idCategoria){
    $this->idCategoria = $idCategoria;
}
    
    public function jsonSerialize()
{
        $vars = get_object_vars($this);

        return $vars;
}
}
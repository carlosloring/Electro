<?php

 class Resena implements JsonSerializable

{
    
    private $idResena;
    private $email;
    private $usuarioResena;
    private $puntuacion;
    private $fecha;
    private $comentario;
    private $idProducto;
    
    
    public function __construct($row = null)

{

    if (!$row == null) {

        $this->idResena = $row["idResena"];
        $this->email = $row["email"];
        $this->usuarioResena = $row["usuarioResena"];
        $this->puntuacion = $row ["puntuacion"];
        $this->fecha = $row ["fecha"];
        $this->comentario = $row ["comentario"];  
        $this->idProducto = $row["idProducto"];
    }   
} 
    
  public function get_idResena(){
    return $this->idResena;
}
    
    public function set_idResena($idResena){
    $this->idResena = $idResena;
}  
 public function get_email(){
    return $this->email;
}
    
    public function set_email($email){
    $this->email = $email;
}  
    public function get_usuarioResena(){
    return $this->usuarioResena;
}
    
    public function set_usuarioResena($usuarioResena){
    $this->usuarioResena = $usuarioResena;
}
    public function get_puntuacion(){
    return $this->puntuacion;
}
    
    public function set_puntuacion($puntuacion){
    $this->puntuacion = $puntuacion;
}
    
    public function get_fecha(){
    return $this->fecha;
}
    
    public function set_fecha($fecha){
    $this->fecha = $fecha;
}
    
    public function get_comentario(){
    return $this->comentario;
}
    
    public function set_comentario($comentario){
    $this->comentario = $comentario;
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
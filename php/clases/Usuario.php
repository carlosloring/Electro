<?php


class Usuario

{
    private $idUsuario;
    private $nombre;
    private $fechaRegistro;
    private $email;
    private $telefono;
    private $apellido;
    private $direccion;
    private $ciudad;
    private $pais;
    private $codigoPostal;
    private $tarjeta;

    //No pongo password por seguridad. A medida que el usuario se registre se comprobara.

    public function __construct($row = null)

{

    if (!$row == null) {

        $this->idUsuario = $row["idUsuario"];
        $this->nombre = $row["nombre"];
        $this->fechaRegistro = $row ["fechaRegistro"];
        $this->email = $row ["email"];
        $this->telefono = $row ["telefono"];
        $this->apellido = $row ["apellido"];
        $this->direccion = $row ["direccion"];
        $this->ciudad = $row ["ciudad"];
        $this->pais = $row ["pais"];
        $this->codigoPostal = $row ["codigoPostal"];
        $this->tarjeta = $row ["tarjeta"];

    }   
}  
    public function get_idUsuario(){
    return $this->idUsuario;
}
    
    public function set_idUsuario($idUsuario){
    $this->idUsuario = $idUsuario;
}
    
    public function get_nombre(){
    return $this->nombre;
}
    
    public function set_nombre($nombre){
    $this->nombre = $nombre;
}
       
    public function get_fechaRegistro(){
    return $this->fecharegistro;
}
    
    public function set_fechaRegistro($fechaRegistro){
    $this->fechaRegistro = $fechaRegistro;
}
    public function get_email(){
    return $this->email;
}
    
    public function set_email($email){
    $this->email = $email;
}  
 
    public function get_telefono(){
    return $this->telefono;
}
    
    public function set_telefono($telefono){
    $this->telefono = $telefono;
}
    
    public function get_apellido(){
    return $this->apellido;
}
    
    public function set_apellido($apellido){
    $this->apellido = $apellido;
}
  
    public function get_direccion(){
    return $this->direccion;
}
    
    public function set_direccion($direccion){
    $this->direccion = $direccion;
}
    
    public function get_ciudad(){
    return $this->ciudad;
}
    
    public function set_ciudad($ciudad){
    $this->ciudad = $ciudad;
}
    
    public function get_pais(){
    return $this->pais;
}
    
    public function set_pais($pais){
    $this->pais = $pais;
}
    
    public function get_codigoPostal(){
    return $this->codigoPostal;
}
    
    public function set_codigoPostal($codigoPostal){
    $this->codigoPostal = $codigoPostal;
}
    
    public function get_tarjeta(){
    return $this->tarjeta;
}
    
    public function set_tarjeta($tarjeta){
    $this->tarjeta = $tarjeta;
}
    
}
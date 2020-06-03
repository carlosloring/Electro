<?php

public class Tarjeta 

{
 
private $idTarjeta;
private $numero;
private $caducidadAno;
private $caducidadMes;
private $cvv;
private $idUsuario;

    
public function __construct($row == null)

{

    if (!$row == null) {

        $this->idTarjeta = $row["idtarjeta"];
        $this->numero = $row["numero"];
        $this->caducidadAno = $row ["caducidadAno"];
        $this->caducidadMes = $row ["caducidadMes"];
        $this->cvv = $row ["cvv"]; 
        $this->idUsuario = $row ["idUsuario"];

    }   
} 
    
    public function get_idtarjeta(){
    return $this->idTarjeta;
}
    
    public function set_idTarjeta($idTarjeta){
    $this->idTarjeta = $idTarjeta;
}
    
    public function get_numero(){
    return $this->numero;
}
    
    public function set_numero($numero){
    $this->numero = $numero;
}
    public function get_caducidadAno(){
    return $this->caducidadAno;
}
    
    public function set_caducidadAno($caducidadAno){
    $this->caducidadAno = $caducidadAno;
}
  
    public function get_caducidadMes(){
    return $this->caducidadMes;
}
    
    public function set_caducidadMes($caducidadMes){
    $this->caducidadMes = $caducidadMes;
}
    
    public function get_cvv(){
    return $this->cvv;
}
    
    public function set_cvv($cvv){
    $this->cvv = $cvv;
}
    public function get_idUsuario(){
    return $this->$idUsuario;
}
    
    public function set_idUsuario($idUsuario){
    $this->idUsuario = $idUsuario;
}   
}
<?php

class Categoria{
    
    private $idCategoria;
    private $nombre;
    private $foto;
    private $idCategoriaPadre;
    
   public function __construct ($row = null){
     
     if (!$row == null) {

        $this->idCategoria = $row["idCategoria"];
        $this->nombre = $row["nombre"];
        $this->foto= $row["foto"];
        $this->idCategoriaPadre = $row["idCategoriaPadre"];
    }   
     
 }
  
    public function get_idCategoria(){
    return $this->idCategoria;
}
    
    public function set_idCategoria($idCategoria){
    $this->idCategoria = $idCategoria;
}  
  public function get_nombre(){
    return $this->nombre;
}
    
    public function set_nombre($nombre){
    $this->nombre = $nombre;
}  
    
    public function get_foto(){
    return $this->foto;
}
    
    public function set_foto($foto){
    $this->foto = $foto;
}  
    
    public function get_idCategoriaPadre(){
    return $this->idCategoriaPadre;
}
    
    public function set_idCategoriaPadre($idCategoriaPadre){
    $this->idCategoriaPadre = $idCategoriaPadre;
}  
    
}
<?php
interface ProductoDao {
    
    
    public function findAll ();
    public function findById ($id);
    public function findByCategoria($idCategoria);
    public function findFilaPedido($idUsuario);
    public function calcularCarrito ($idUsuario);
    public function anadirProducto($idPedido,$cantidad,$idProducto);
    public function obtenerPedido($idUsuario);
    
}
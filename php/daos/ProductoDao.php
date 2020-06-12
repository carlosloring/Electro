<?php
interface ProductoDao {
    
    
    public function findAll ();
    public function findById ($id);
    public function findByCategoria($idCategoria);
    public function findFilaPedido($idUsuario);//Dandole el id te dice cuales son las filas del carrito en el checkout
    public function calcularCarrito ($idUsuario);//Calcula lineas del pedido.
    public function anadirProducto($idPedido,$cantidad,$idProducto);
    public function obtenerPedido($idUsuario);//id del pedido que tienes sin comprar aún.
    public function calcularTotal($idUsuario);//del carrito
    public function comprar($idUsuario);
    public function quitar($idProducto,$idPedido);//quita una linea del pedido
}
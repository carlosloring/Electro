<?php
interface ResenaDao {
    
    public function findByIdProducto ($idProducto);
    public function guardar ($resena);//Insertar reseña en BD
    
}
<?php
interface UsuarioDao {
    
    public function findByEmail ($email);
    public function guardar ($usuario, $password);//Insertar reseña en BD
    public function login ($email, $password);
    public function carritovacio ($idUsuario);
}
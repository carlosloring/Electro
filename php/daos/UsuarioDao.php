<?php
interface UsuarioDao {
    
    public function findByEmail ($email);
    public function guardar ($usuario, $password);//Crea el usuario y lo guarda en la BD
    public function login ($email, $password);
    public function carritovacio ($idUsuario);//crea una carrito vacío al registrarse para ir metiendo productos
    public function suscribirse($email);
}
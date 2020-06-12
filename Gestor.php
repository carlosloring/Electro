<?php
session_start();
require_once("php/daos/ProductoDaoImpl.php");
require_once("php/daos/ResenaDaoImpl.php");
require_once("php/daos/UsuarioDaoImpl.php");
require_once("php/clases/Usuario.php");

$accion=$_POST["accion"];

if($accion=="obtenerProducto"){
    
    $idProducto=$_POST["idProducto"];
    
    $gestorProductos=new ProductoDaoImpl();
    
    $producto = $gestorProductos->findById($idProducto);
    
    echo json_encode($producto);
    
    
}else if($accion=="obtenerResena"){
    //TERMINAR CON ESTO EN LA PARTE DE AJAX
    $idProducto=$_POST["idProducto"];
    
    $gestorResena=new ResenaDaoImpl();
    
    $resena = $gestorResena->findByIdProducto($idProducto);
    
    echo json_encode($resena);
    
}else if($accion=='enviarResena'){
    
    $puntuacion = $_POST['puntuacion'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $texto = $_POST['texto'];
    $idProducto = $_POST['idProducto'];
    if(empty($nombre)||empty($email)||empty($puntuacion)||empty($texto)||empty($idProducto)){
        die;//validacion de reseñas
    }
    
    $gestorResena=new ResenaDaoImpl();
    
    $resena = new Resena();
    $resena->set_usuarioResena($nombre);
    $resena->set_email($email);
    $resena->set_comentario($texto);//texto lo llamamos en el POST (mas arriba)
    $resena->set_puntuacion($puntuacion);
    $resena->set_idProducto($idProducto);
    
    $estado = $gestorResena->guardar($resena);
    echo $estado;
    
}else if($accion=='obtenerListaDeseos'){//No lo quitamos por residuos
    $idUsuario=$_POST["idUsuario"];
    $gestorListaDeseos=new ListaDeseosDaoImpl();
    $lista=$gestorListaDeseos->findByIdUsuario($idUsuario);
    echo json_encode($lista);
}

else if($accion=="registro"){
    
    $usuario=new Usuario($_POST);
    $password = $_POST['password'];
    $gestorUsuarios = new UsuarioDaoImpl();
    $estado=$gestorUsuarios->guardar($usuario, $password);
    
    if($estado==1){
        
        $_SESSION['usuario']=serialize($usuario);
        $_SESSION['carrito']=[];
        header('Location: index.php');
    }
}

else if($accion=='login'){
    
    $email=$_POST['email'];
    $password = $_POST['password'];
    $gestorUsuarios = new UsuarioDaoImpl();
    $usuario=$gestorUsuarios->login($email,$password);
    
    if($usuario!=null){
        
        $_SESSION['usuario']=serialize($usuario);
        $gestorUsuarios->carritovacio($usuario->get_idUsuario());
        $_SESSION['carrito']=[];
        header('Location: index.php');
        
    }else{
        
        header('Location: registro.php?error');
    }
}
 
else if($accion=='anadir'){
    $idProducto=$_POST['idProducto'];
    $cantidad= $_POST['cantidad'];
    $gestorProductos=new ProductoDaoImpl();
    $producto=$gestorProductos->findById($idProducto);
    $pedido = $gestorProductos->anadirProducto($idProducto,$cantidad,$_POST['idpedido']);
    
    $_SESSION['carrito']=actualizacarrito($_SESSION['carrito'],$producto,$cantidad);
    echo json_encode($_SESSION['carrito']);
}

else if($accion=='comprar'){
    if(isset($_SESSION['usuario'])){
    $gestorProductos=new ProductoDaoImpl();
    $gestorProductos->comprar($_POST['idpedido']);
    $gestorUsuarios = new UsuarioDaoImpl();
    //INDICAR EL USUARIO EN EL PARENTESIS
    $gestorUsuarios->carritoVacio($_POST['idUsuario']);
}
}
else if($accion=='quitar'){
    if(isset($_SESSION['usuario'])){
        $gestorProductos=new ProductoDaoImpl();
        $gestorProductos->quitar($_POST['idProducto'],$_POST['idPedido']);
    }
}
else if($accion=='suscribirse'){
        $gestorUsuarios=new UsuarioDaoImpl();
        $gestorUsuarios->suscribirse($_POST['email']);
}

else if(isset($_GET['logout'])){
    
    unset($_SESSION['carrito']);
    session_destroy();
    header('Location: index.php');
} 


function actualizacarrito($carrito, $producto, $cantidad){//No se usa
   
        
        $item['producto']=$producto;
        $item['cantidad']=$cantidad;
        $carrito[]=serialize($item);
    
    return $carrito;
}

<?php


class Utils{
    
    
    //eliminar sesion
    public static function deleteSession($name){
        
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = NULL;
            unset($_SESSION[$name]);
        }
        return $name;
        
    }
    
    //comprobar si es admin
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return TRUE;
        }
    }
    
    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return TRUE;
        }
    }

    //mostrar categorias en el menu
    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }
    
    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            
            //calcular total
            foreach ($_SESSION['carrito'] as  $producto){
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
            
        }
        return $stats;
    }
    
    public static function showStatus($status){
        $value = 'Pendiente';
        if($status == 'confirm'){
            $value = 'Pendiente';
        }elseif($status == 'preparation'){
            $value = 'En preparación';
        }elseif($status == 'ready'){
            $value = 'Preparado para enviar';
        }elseif($status == 'sended'){
            $value = 'Enviado';
        }
        return $value;
    }
    
    
}

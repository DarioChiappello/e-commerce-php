<?php
require_once 'models/pedido.php';
class pedidoController{
    
    public function hacer(){
        
        
        require_once 'views/pedido/hacer.php';
    }
    
    public function add(){
        
        
        if(isset($_SESSION['identity'])){
            $usuario_id = $_SESSION['identity']->id;

            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            
            $stats = Utils::statsCarrito();
            $costo = $stats['total'];

            if($provincia && $localidad && $direccion){
                //guardar datos en db
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                
                
                $pedido->setCosto($costo);
                
                $save = $pedido->save();
                
                //guardar linea_pedido
                $save_linea = $pedido->save_linea();
                
                if($save && $save_linea){
                    
                    $_SESSION['pedido'] = "complete";
                    
                }else{
                    $_SESSION['pedido'] = "failed";
                }
                
            }else{
                $_SESSION['pedido'] = "failed";
            }
            
            header("Location:".base_url."pedido/confirmado");
            
        }else{
            //redirigir al index
            header("Location:".base_url);
            
        }
    }
    
    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();
            
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductoByPedido($pedido->id);
        }
    
        require_once 'views/pedido/confirmado.php';
    }
   
    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        
        //sacar los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos= $pedido->getAllByUser();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function detalle(){
        Utils::isIdentity();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            //sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();
            
            //sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductoByPedido($id);
            
            require_once 'views/pedido/detalle.php';
        }else{
            header("Location:".base_url."pedido/mis_pedidos");
        }      
    }
    
    public function gestion(){
        Utils::isAdmin();
        $gestion = TRUE;
        
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            //recoger datos del formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            //update del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();
            header("Location:".base_url."pedido/detalle&id=$id");
            ob_end_flush();
            //set_error_handler(header);
           //echo "<h3 style='text-align:center;'>Estado del pedido modificado</h3>";
        }else{
            header("Location:".base_url);
        }      
    }
}
<?php
require_once 'models/producto.php';
class productoController{
    
    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom(6);


        //renderizar vista
        require_once 'views/producto/destacados.php';
    }
    
    //ver producto
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $producto = new Producto();
            $producto->setId($id);
            $product = $producto->getOne();
        }
        require_once 'views/producto/ver.php';
    }


    //gestion de productos
    public function gestion(){
        Utils::isAdmin();
        
        //obtener todos los productos
        $producto = new Producto();
        $productos = $producto->getAll();
        
        require_once 'views/producto/gestion.php';
    }
    //crear producto
    public function crear(){
        Utils::isAdmin();
        
        require_once 'views/producto/crear.php';
    }
    
    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : FALSE;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : FALSE;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : FALSE;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : FALSE;
            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : FALSE;
            
            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                
                //save image - guardar imagen
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                $filename = $file['name'];
                $mimetype = $file['type'];
                
                if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){
                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, TRUE);
                    }
                    
                    move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    $producto->setImagen($filename);
                 }
                }
                
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    
                    $save = $producto->edit(); //edita si viene por parametro
                }else {
                    $save = $producto->save(); // guarda si no viene por parametro
                }
              
                if($save){
                    $_SESSION['producto'] = "complete";
                }else{
                    $_SESSION['producto'] = "failed";
                }
            }  else {
                $_SESSION['producto'] = "failed";
            }
        }else{
        $_SESSION['producto'] = "failed";
        }
        header("Location:".base_url.'producto/gestion');
    }
    
    //editar producto - edit product
    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = TRUE;
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            
            require_once 'views/producto/crear.php';
        }else{
            header("Location:".base_url."producto/gestion");
        }
        
    }
    
    //eliminar producto - delete product
    public function eliminar(){
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();
            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }
        header("Location:".base_url."producto/gestion");
    }
}
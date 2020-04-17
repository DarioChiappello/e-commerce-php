<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class categoriaController{
    
    //Utils::isAdmin(); comprueba que sea admin para ejecutar las acciones
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once 'views/categoria/index.php';
    }
    
    //ver categoría
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            
            //conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        
        require_once 'views/categoria/ver.php';
    }

        public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    
    public function save(){
        Utils::isAdmin();
        
        if(isset($_POST) && isset($_POST['nombre'])){
            //Guardar categoria
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
        
        
        header("Location:".base_url."categoria/index");
    }
}
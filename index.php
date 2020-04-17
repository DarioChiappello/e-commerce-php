<?php
ob_start();
session_start();
//cargar autoload
require_once 'autoload.php'; //autoload
require_once 'config/db.php'; //database
require_once 'config/parameters.php'; //params de url
require_once 'helpers/utils.php'; // helpers
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';



function show_error(){
    $error = new errorController();
    $error->index();
}

//comprobar si llega el parametro
if(isset($_GET['controller'])){
    
$nombre_controlador = $_GET['controller'].'Controller';
   
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    //para que se vea el index html por default
    $nombre_controlador = controller_default;
}else{

    show_error();
    exit();
}
 

//comprobar si existe el controlador
if (isset($nombre_controlador) && class_exists($nombre_controlador)) {
    
    $controlador = new $nombre_controlador();
    
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];

        $controlador->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        //para que se vea el index html por default
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        show_error();
    }
} else {
   show_error();
}


require_once 'views/layout/footer.php';
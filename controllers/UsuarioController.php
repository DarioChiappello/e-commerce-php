<?php

require_once 'models/usuario.php';

class usuarioController{
    
    public function index(){
        echo "Controlador Usuarios, Accion index";
    }
    
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    
    //save user
    public function save(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : FALSE;
            $email = isset($_POST['email']) ? $_POST['email'] : FALSE;
            $password = isset($_POST['password']) ? $_POST['password'] : FALSE;
            
            if($nombre && $apellido && $email && $password){
                    $usuario = new Usuario();
                    $usuario->setNombre($nombre);
                    $usuario->setApellido($apellido);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);
                    
                    $errores = array();
                    
                    // NOMBRE - NAME (VALIDATE)
                        if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                        $nombre_validado = TRUE;
                    } else {
                        $nombre_validado = FALSE;
                        $errores['nombre'] = "El nombre no es valido";
                    }
                
                    // APELLIDO - LAST NAME (VALIDATE)
                    if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
                        $apellido_validado = TRUE;
                    } else {
                        $apellido_validado = FALSE;
                        $errores['apellido'] = "El apellido no es valido";
                    }
                    
                     // EMAIL (VALIDATE)
                    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $email_validado = TRUE;
                    } else {
                        $email_validado = FALSE;
                        $errores['email'] = "El email no es valido";
                    }
                    
                    //PASSWORD (VALIDATE)
                    if (!empty($password)) {
                        $password_validado = TRUE;
                    } else {
                        $password_validado = FALSE;
                        $errores['password'] = "La contraseña no es valida";
                    }
                    
                    $save_user = FALSE;
                    if(count($errores) == 0){
                        $save_user = TRUE;
                    }

                $save = $usuario->save();
                    if($save){
                        $_SESSION['register'] = "complete";
                    }else{
                        $_SESSION['register'] = "failed";
                    }
            }else{
                $_SESSION['register'] = "failed";
            }           
            
        }else{
            $_SESSION['register'] = "failed";
            
        }
        header("Location:".base_url.'usuario/registro');
    }
    
    
    //login
    public function login(){
        if (isset($_POST)){
            //identificar al usuario
            //consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            
            //con parametros y sin set
            //$usuario->login($_POST['email'], $_POST['password']);
            $identity = $usuario->login();
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                
                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'Identificación fallida!';
            }
            
            
        }
        header("Location:".base_url);
    }
    
    //cerrar sesion - log out
    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        
        header("Location:".base_url);
    }
}// fin de la clase
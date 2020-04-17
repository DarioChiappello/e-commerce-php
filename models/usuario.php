<?php



class Usuario{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;
    
    public function __construct() {
    $this->db = Database::connect();;
    }
    //variable de conexion a db

    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRol() {
        return $this->rol;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellido($apellido) {
        $this->apellido = $this->db->real_escape_string($apellido);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    //save
    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
        $save = $this->db->query($sql);
        
        $result = FALSE;
        if ($save){
            $result = TRUE;
        }
        return $result;
    }
    
    public function login(){
        $result = FALSE;
        $email = $this->email;
        $password = $this->password;
        
        //comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);
        
        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();
            
            //verificar la contraseña - password verify
            $verify = password_verify($password, $usuario->password);
            
            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }
    
}

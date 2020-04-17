<?php

class Categoria{
    private $id;
    private $nombre;
    private $db;
    
    public function __construct() {
    $this->db = Database::connect();;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDb() {
        return $this->db;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDb($db) {
        $this->db = $db;
    }

    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC");
        return $categorias;
    }
    
    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()}");
        return $categoria->fetch_object();
    }
    
    //funcion para guardar que se pasa al controlador 
    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}');";
        $save = $this->db->query($sql);
        
        $result = FALSE;
        if($save){
            $result = TRUE;
        }
        return $result;
    }
}
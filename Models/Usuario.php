<?php

class Usuario {

    private $Id;
    private $Nombre;
    private $Apellidos;
    private $Email;
    private $Password;
    private $Rol;
    private $Imagen;
    private $DB;

    public function __construct() {
        $this->DB = DataBase::Connect();
    }

    function getId() {
        return $this->Id;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getApellidos() {
        return $this->Apellidos;
    }

    function getEmail() {
        return $this->Email;
    }

    function getPassword() {
        return password_hash($this->DB->real_escape_string($this->Password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRol() {
        return $this->Rol;
    }

    function getImagen() {
        return $this->Imagen;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setNombre($Nombre) {
        $this->Nombre = $this->DB->real_escape_string($Nombre);
    }

    function setApellidos($Apellidos) {
        $this->Apellidos = $this->DB->real_escape_string($Apellidos);
    }

    function setEmail($Email) {
        $this->Email = $this->DB->real_escape_string($Email);
    }

    function setPassword($Password) {
        $this->Password=$Password; 
    }

    function setRol($Rol) {
        $this->Rol = $this->DB->real_escape_string($Rol);
    }

    function setImagen($Imagen) {
        $this->Imagen = $this->DB->real_escape_string($Imagen);
    }

    public function Save() {
        $Sql = "INSERT INTO Usuarios VALUES(null,'{$this->getNombre()}',"
                . "'{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user','null')";
        $Save = $this->DB->query($Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        } else {
            
        }
        return $Result;
    }

    public function LogIn() {
        $Email = $this->Email;
        $Password = $this->Password;
        $Sql = "SELECT * FROM Usuarios WHERE Email='{$this->Email}'";
        $Login = $this->DB->query($Sql);
        $Result=false;
        if ($Login && $Login->num_rows == 1) {
            $Usuario = $Login->fetch_object();
            $Verify = password_verify($Password, $Usuario->Password);
            if ($Verify) {
                
                $Result = $Usuario;
            }
        }
        return $Result;
    }

}

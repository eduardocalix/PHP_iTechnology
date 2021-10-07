<?php

class Usuario {

    private $Id;
    private $Nombre;
    private $Apellido;
    private $Usuario;
    private $Clave;
    private $DB;

    public function __construct() {
        $this->DB = DataBase::OpenConnection();
    }

    function getId() {
        return $this->Id;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getApellido() {
        return $this->Apellido;
    }

    function getUsuario() {
        return $this->Usuario;
    }

    function getClave() {
        return Clave_hash($this->DB->real_escape_string($this->Clave), Clave_BCRYPT, ['cost' => 4]);
    }
    function setId($Id) {
        $this->Id = $Id;
    }

    function setNombre($Nombre) {
        $this->Nombre = $this->DB->real_escape_string($Nombre);
    }

    function setApellido($Apellido) {
        $this->Apellido = $this->DB->real_escape_string($Apellido);
    }

    function setUsuario($Usuario) {
        $this->Usuario = $this->DB->real_escape_string($Usuario);
    }

    function setClave($Clave) {
        $this->Clave=$Clave; 
    }

    public function Save() {
        $Sql = "INSERT INTO Acceso.Usuarios VALUES('{$this->getNombre()}',"
                . "'{$this->getApellido()}','{$this->getUsuario()}','{$this->getClave()}')";
        $Save = sqlsrv_query($this->DB,$Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        } else {
            
        }
        return $Result;
    }

    public function LogIn() {
        $Usuario = $this->Usuario;
        $Clave = $this->Clave;
        $Sql = "SELECT * FROM Acceso.Usuarios WHERE usuario='{$this->Usuario}'";
        $Login = sqlsrv_query($this->DB,$Sql);
        $Result=false;
        if ($Login && $Login->num_rows == 1) {
            $Usuario =  sqlsrv_fetch_array($Login);
            $Verify = Clave_verify($Clave, $Usuario['clave']);
            if ($Verify) {
                
                $Result = $Usuario;
            }
        }
        return $Result;
    }

}

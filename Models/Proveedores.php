<?php

class Proveedores {

    private $Db;
    private $IdProveedor;
    private $Nombre;
    private $Telefono;
    private $Direccion;

    public function __construct() {
        $this->Db = DataBase::OpenConnection();
    }

    function getIdProveedor() {
        return $this->IdProveedor;
    }

    function setIdProveedor($IdProveedor) {
        $this->IdProveedor = $this->Db->escape_string($IdProveedor);
    }


    function getNombre() {
        return $this->Nombre;
    }

    function getTelefono() {
        return $this->Telefono;
    }

    function getDireccion() {
        return $this->Direccion;
    }

    function setNombre($Nombre) {
        $this->Nombre = $this->Db->real_escape_string($Nombre);
    }

    function setTelefono($Telefono) {
        $this->Telefono = $this->Db->real_escape_string($Telefono);
    }

    function setDireccion($Direccion) {
        $this->Direccion = $this->Db->real_escape_string($Direccion);
    }

/*     public function getProductbyLinea($Id) {
        $Sql = "SELECT L.*, Pe.* FROM Productos.Producto Pe INNER JOIN Productos.Proveedores L"
                . " ON L.Producto_Id=Pe.idProducto WHERE L.idProveedor='{$Id}'";
        $Query = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Query) {
            $Result = $Query;
        }
        return $Result;
    } */

    public function getAll() {
        $Sql = 'SELECT * FROM Productos.Proveedores';
        $Query = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Query) {
            $Result = $Query;
        }
        return $Result;
    }

    public function getOne() {
        $Sql = "SELECT Pe.* FROM Productos.Proveedores Pe WHERE Pe.idProveedor='{$this->getIdProveedor()}'";
        $Query = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Query) {
            $Result = $Query;
        }
        return $Result;
    }
    
    public function Save() {
        $Sql = "INSERT INTO Productos.Proveedores VALUES("
                . "'{$this->getNombre()}','{$this->getTelefono()}',"
                . "'{$this->getDireccion()}')";
        $Save = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        }
        return $Result;
    }
    
}

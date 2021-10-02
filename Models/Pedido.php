<?php

class Pedido {

    private $Db;
    private $Id;
    private $UsuerId;
    private $Provincia;
    private $Localidad;
    private $Direccion;
    private $Coste;
    private $Estado;

    public function __construct() {
        $this->Db = DataBase::Connect();
    }

    function getId() {
        return $this->Id;
    }

    function setId($Id) {
        $this->Id = $this->Db->escape_string($Id);
    }

    function getUsuerId() {
        return $this->UsuerId;
    }

    function getProvincia() {
        return $this->Provincia;
    }

    function getLocalidad() {
        return $this->Localidad;
    }

    function getDireccion() {
        return $this->Direccion;
    }

    function getCoste() {
        return $this->Coste;
    }

    function getEstado() {
        return $this->Estado;
    }

    function setUsuerId($UsuerId) {
        $this->UsuerId = $this->Db->real_escape_string($UsuerId);
    }

    function setProvincia($Provincia) {
        $this->Provincia = $this->Db->real_escape_string($Provincia);
    }

    function setLocalidad($Localidad) {
        $this->Localidad = $this->Db->real_escape_string($Localidad);
    }

    function setDireccion($Direccion) {
        $this->Direccion = $this->Db->real_escape_string($Direccion);
    }

    function setCoste($Coste) {
        $this->Coste = $this->Db->real_escape_string($Coste);
    }

    function setEstado($Estado) {
        $this->Estado = $this->Db->real_escape_string($Estado);
    }

    public function getByUser() {
        $Sql = "SELECT L.*, P.* FROM Pedidos P INNER JOIN"
                . " LineasPedido L ON P.Id=L.Pedido_Id "
                . "WHERE P.Usuario_Id='{$this->getUsuerId()}'";
        $Query = $this->Db->query($Sql);
        $Result = FALSE;
        if ($Query) {
            $Result = $Query;
        }
        return $Result;
    }
    
    public function getAllbyUser() {
        $Sql="SELECT * FROM Pedidos WHERE Usuario_Id='{$this->getUsuerId()}'";
        $Query= $this->Db->query($Sql);
        $Result=false;
        if($Query){
            $Result=$Query;
        }
        
        return $Result;
    }

    public function getProductbyLinea($Id) {
        $Sql = "SELECT L.*, Pe.* FROM Productos Pe INNER JOIN LineasPedido L"
                . " ON L.Producto_Id=Pe.Id WHERE L.Pedido_Id='{$Id}'";
        $Query = $this->Db->query($Sql);
        $Result = false;
        if ($Query) {
            $Result = $Query;
        }
        return $Result;
    }

    public function getAll() {
        $Sql = 'SELECT * FROM Pedidos';
        $Query = $this->Db->query($Sql);
        $Result = false;
        if ($Query) {
            $Result = $Query;
        }
        return $Result;
    }

    public function getOne() {
        $Sql = "SELECT Pe.*,U.* FROM Pedidos Pe INNER JOIN Usuarios U ON Pe.Usuario_Id=U.Id WHERE Pe.Id='{$this->getId()}'";
        $Query = $this->Db->query($Sql);
        $Result = false;
        if ($Query) {
            $Result = $Query;
        }
        return $Result;
    }
    
    public function Save() {
        $Sql = "INSERT INTO Pedidos VALUES(null,'{$this->UsuerId}',"
                . "'{$this->getProvincia()}','{$this->getLocalidad()}',"
                . "'{$this->getDireccion()}','{$this->getCoste()}','CONFIRM',CURDATE(), CURTIME())";
        $Save = $this->Db->query($Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        }
        return $Result;
    }
    
    public function UpdateEstado() {
        $Sql="UPDATE Pedidos SET Estado='{$this->getEstado()}' WHERE Id='{$this->getId()}'";
        $Update= $this->Db->query($Sql);
        $Result=false;
        if($Update){
            $Result=true;
        }
        return $Result;
    }

}

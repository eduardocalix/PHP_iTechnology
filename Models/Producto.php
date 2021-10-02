<?php

class Producto {

    private $Id;
    private $CategoriaId;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $Stock;
    private $Oferta;
    private $Fecha;
    private $Image;
    private $Db;

    public function __construct() {
        $this->Db = DataBase::Connect();
    }

    function getId() {
        return $this->Id;
    }

    function getCategoriaId() {
        return $this->CategoriaId;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function getPrecio() {
        return $this->Precio;
    }

    function getStock() {
        return $this->Stock;
    }

    function getOferta() {
        return $this->Oferta;
    }

    function getFecha() {
        return $this->Fecha;
    }

    function getImage() {
        return $this->Image;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setCategoriaId($CategoriaId) {
        $this->CategoriaId = $CategoriaId;
    }

    function setNombre($Nombre) {
        $this->Nombre = $this->Db->real_escape_string($Nombre);
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $this->Db->real_escape_string($Descripcion);
    }

    function setPrecio($Precio) {
        $this->Precio = $this->Db->real_escape_string($Precio);
    }

    function setStock($Stock) {
        $this->Stock = $this->Db->real_escape_string($Stock);
    }

    function setOferta($Oferta) {
        $this->Oferta = $this->Db->real_escape_string($Oferta);
    }

    function setFecha($Fecha) {
        $this->Fecha = $this->Db->real_escape_string($Fecha);
    }

    function setImage($Image) {
        $this->Image = $this->Db->real_escape_string($Image);
    }

    public function getAll() {
        $Sql = "SELECT *  FROM Productos ORDER BY Id";
        $Productos = $this->Db->query($Sql);
        $Result = false;
        if ($Productos) {
            $Result = $Productos;
        }
        return $Result;
    }

    public function getOne() {
        $Sql = "SELECT * FROM Productos WHERE Id='{$this->Id}'";
        $Producto = $this->Db->query($Sql);
        $Result = false;
        if ($Producto) {
            $Result = $Producto;
        }
        return $Result;
    }
    
    public function getPro($CatId){
        $Sql="SELECT pro.*,ca.Nombre AS 'CaNombre' FROM Productos pro INNER JOIN Categorias ca ON ca.Id=pro.Categoria_Id WHERE ca.Id='{$CatId}'";
        $Query= $this->Db->query($Sql);
        $Result=false;
        if($Query){
            $Result=$Query;
        }
        return $Query;
        
    }

    public function getRand() {
        $Sql="SELECT * FROM Productos ORDER BY Rand() LIMIT 4";
        $Result=false;
        $Query= $this->Db->query($Sql);
        if($Query){
            $Result=$Query;
        }
        return $Result;
                
    }

    public function Save() {
        $Sql = "INSERT INTO Productos VALUES(null,'{$this->getCategoriaId()}','{$this->getNombre()}',"
                . "'{$this->getDescripcion()}','{$this->getPrecio()}','{$this->getStock()}',"
                . "NULL,CURDATE(),'{$this->getImage()}')";
        $Save = $this->Db->query($Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        }
        return $Result;
    }

    public function ValidateIfExists($Id) {
        $Sql = "SELECT * FROM Productos WHERE Id=$Id";
        $Result = false;
        $Query = $this->Db->query($Sql);
        if ($Query) {
            $Result = true;
        }
        return $Result;
    }

    public function Eliminar($Id) {
        $Sql = "DELETE FROM Productos WHERE Id='$Id'";
        $Result = false;
        $Delete = $this->Db->query($Sql);
        if ($Delete) {
            $Result = true;
        }
        return $Result;
    }

    public function DecreaseStock($Unit) {
        $Sql="UPDATE Productos SET Stock=Stock-'{$Unit}' WHERE Id='{$this->getId()}'";
        $Update= $this->Db->query($Sql);
        $Result=false;
        if($Update){
            $Result=true;
        }
        
        return $Result;
            
    }
    
    public function GetStockByProduct() {
        $Sql="SELECT Stock From Productos WHERE Id='{$this->getId()}'";
        $Query= $this->Db->query($Sql);
        $Result=false;
        if($Query){
            $Result=$Query->fetch_object();
        }
        return $Result;
    }
    
    public function Update($Id) {
        $Sql = "UPDATE Productos SET "
                . "Categoria_Id='{$this->getCategoriaId()}',"
                . "Nombre='{$this->getNombre()}',"
                . "Descripcion='{$this->getDescripcion()}', "
                . "Precio='{$this->getPrecio()}', "
                . "Stock='{$this->getStock()}',"
                . "Oferta='{$this->getOferta()}'";

        if ($this->getImage() != null) {
            $Sql .= ",Image='{$this->getImage()}'";
        }
        $Sql .= " WHERE Id='$Id'";
        $Result = false;
        $Update = $this->Db->query($Sql);
        if ($Update) {
            $Result = true;
        }

        return $Result;
    }

}

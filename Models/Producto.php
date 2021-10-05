<?php
class Producto {

    private $Id;
    private $Descripcion;
    private $Costo;
    private $PrecioVenta;   
    private $Stock;
    private $IdCategoria;
    private $IdProveedor;   
    private $Image;
    private $Db;

    public function __construct() {
        $this->Db = DataBase::OpenConnection();
    }

    function getId() {
        return $this->Id;
    }
    function getDescripcion() {
        return $this->Descripcion;
    }
    function getCosto() {
        return $this->Costo;
    }
    function getPrecioVenta() {
        return $this->PrecioVenta;
    }

    function getStock() {
        return $this->Stock;
    }
    function getIdCategoria() {
        return $this->IdCategoria;
    }

    function getIdProveedor() {
        return $this->IdProveedor;
    }
    function getImage() {
        return $this->Image;
    }

    function setId($Id) {
        $this->Id = $Id;
    }
    function setDescripcion($Descripcion) {
        $this->Descripcion = $this->Db->real_escape_string($Descripcion);
    }
    function setCosto($Costo) {
        $this->Costo = $this->Db->real_escape_string($Costo);
    }
    function setPrecioVenta($PrecioVenta) {
        $this->PrecioVenta = $this->Db->real_escape_string($PrecioVenta);
    }
    function setStock($Stock) {
        $this->Stock = $this->Db->real_escape_string($Stock);
    }
    function setCategoriaId($CategoriaId) {
        $this->CategoriaId = $CategoriaId;
    }
    function setIdProveedot($IdProveedor) {
        $this->IdProveedor = $IdProveedor;
    }
    function setImage($Image) {
        $this->Image = $this->Db->real_escape_string($Image);
    }

    public function getAll() {
        $Sql = "SELECT *  FROM Productos.Producto ORDER BY idProducto";
        $Productos = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Productos) {
            $Result = $Productos;
        }
        return $Result;
    }

    public function getOne() {
        $Sql = "SELECT * FROM Productos.Producto WHERE idProducto='{$this->Id}'";
        $Producto = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Producto) {
            $Result = $Producto;
        }
        return $Result;
    }
    
    public function getPro($CatId){
        $Sql="SELECT pro.*,ca.Descripcion AS 'CategoriaNombre' FROM Productos.Producto pro INNER JOIN Productos.CategoriaProducto ca ON ca.idCategoria=pro.idCategoria WHERE ca.idCategoria='{$CatId}'";
        $Query=sqlsrv_query($this->Db,$Sql);
        $Result=false;
        if($Query){
            $Result=$Query;
        }
        return $Query;
        
    }

    public function getRand() {
        $Sql="SELECT * FROM Productos.Producto ORDER BY Rand() LIMIT 4";
        $Result=false;
        $Query= sqlsrv_query($this->Db,$Sql);
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

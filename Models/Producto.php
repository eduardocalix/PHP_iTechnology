<?php
//include("Config/Db.php");
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
    function setIdProveedor($IdProveedor) {
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
        $Sql="SELECT * FROM Productos.Producto ORDER BY Rand()";
        $Result=false;
        $Query= sqlsrv_query($this->Db,$Sql);
        if($Query){
            $Result=$Query;
        }
        return $Result;
    }
 
    public function Save() {
        $Sql = "INSERT INTO Productos.Producto VALUES('{$this->getDescripcion()}','{$this->getCosto()}',"
                . "'{$this->getPrecioVenta()}','{$this->getStock()}',"
                . "'{$this->getIdCategoria()}','{$this->getIdProveedor()}','{$this->getImage()}')";
        $Save = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        }
        return $Result;
    }

    public function ValidateIfExists($Id) {
        $Sql = "SELECT * FROM Productos.Producto WHERE idProducto=$Id";
        $Result = false;
        $Query = sqlsrv_query($this->Db,$Sql);
        if ($Query) {
            $Result = true;
        }
        return $Result;
    }

    public function Eliminar($Id) {
        $Sql = "DELETE FROM Productos.Producto WHERE idProducto='$Id'";
        $Result = false;
        $Delete = sqlsrv_query($this->Db,$Sql);
        if ($Delete) {
            $Result = true;
        }
        return $Result;
    }

    public function DecreaseStock($Unit) {
        $Sql="UPDATE Productos.Producto SET stock=stock-'{$Unit}' WHERE idProducto='{$this->getId()}'";
        $Update= sqlsrv_query($this->Db,$Sql);
        $Result=false;
        if($Update){
            $Result=true;
        }
        
        return $Result;
            
    }
    
    public function GetStockByProduct() {
        $Sql="SELECT stock From Productos.Producto WHERE idProducto='{$this->getId()}'";
        $Query= sqlsrv_query($this->Db,$Sql);
        $Result=false;
        if($Query){
            $Result=$Query->fetch_object();
        }
        return $Result;
    }
    
    public function Update($Id) {
        $Sql = "UPDATE Productos.Producto SET "         
                . "descripcion='{$this->getDescripcion()}', "
                . "costo='{$this->getCosto()}',"
                . "precioVenta='{$this->getPrecioVenta()}', "
                . "stock='{$this->getStock()}',"
                . "idCategoria='{$this->getIdCategoria()}',"
                . "idProveedor='{$this->getIdProveedor()}',";
        if ($this->getImage() != null) {
            $Sql .= ",Image='{$this->getImage()}'";
        }
        $Sql .= " WHERE idProducto='$Id'";
        $Result = false;
        $Update = sqlsrv_query($this->Db,$Sql);
        if ($Update) {
            $Result = true;
        }

        return $Result;
    }

}

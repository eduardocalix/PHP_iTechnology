<?php

class Compras {

    private $IdCompras;
    private $IdCategoria;
    private $IdProducto;
    private $Cantidad;
    private $Db;

    public function __construct() {
        $this->Db =  DataBase::OpenConnection();
    }

    function getIdCompras() {
        return $this->IdCompras;
    }

    function getIdCategoria() {
        return $this->IdCategoria;
    }

    function getIdProducto() {
        return $this->IdProducto;
    }

    function getCantidad() {
        return $this->Cantidad;
    }

    function setIdCompras($IdCompras) {
        $this->IdCompras = $IdCompras;
    }

    function setIdCategoria($IdCategoria) {
        $this->IdCategoria = $this->Db->real_escape_string($IdCategoria);
    }

    function setIdProducto($IdProducto) {
        $this->IdProducto = $this->Db->real_escape_string($IdProducto);
    }

    function setCantidad($Cantidad) {
        $this->Cantidad = $this->Db->real_escape_string($Cantidad);
    }

    
    public function Save() {
        $Sql = "SELECT MAX(idCategoria) as 'IdCategoria' FROM Productos.CategoriaProductos";
        $Query = sqlsrv_query($this->Db,$Sql);
        $QueryResult = sqlsrv_fetch_array($Query);
        $IdCategoria = $QueryResult['idCategoria'];
        $Result=false;
        foreach ($_SESSION['Carrito'] as $Elementos) {
            $Insert = "INSERT INTO LineasPedido VALUES(null,'{$IdCategoria}','{$Elementos['ProductId']}','{$Elementos['ProductUnit']}')";
            $Save= sqlsrv_query($this->Db,$Insert);
            if($Save){
                $Result=true;
            }
       }
       
       return $Result;
        
    }

}

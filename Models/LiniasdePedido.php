<?php

class LiniasdePedido {

    private $Id;
    private $PedidoId;
    private $ProductoId;
    private $Unidades;
    private $Db;

    public function __construct() {
        $this->Db = DataBase::Connect();
    }

    function getId() {
        return $this->Id;
    }

    function getPedidoId() {
        return $this->PedidoId;
    }

    function getProductoId() {
        return $this->ProductoId;
    }

    function getUnidades() {
        return $this->Unidades;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setPedidoId($PedidoId) {
        $this->PedidoId = $this->Db->real_escape_string($PedidoId);
    }

    function setProductoId($ProductoId) {
        $this->ProductoId = $this->Db->real_escape_string($ProductoId);
    }

    function setUnidades($Unidades) {
        $this->Unidades = $this->Db->real_escape_string($Unidades);
    }

    
    public function Save() {
        $Sql = "SELECT MAX(Id) as 'PedidoId' FROM Pedidos";
        $Query = $this->Db->query($Sql);
        $QueryResult = $Query->fetch_Object();
        $PedidoId = $QueryResult->PedidoId;
        $Result=false;
        foreach ($_SESSION['Carrito'] as $Elementos) {
            $Insert = "INSERT INTO LineasPedido VALUES(null,'{$PedidoId}','{$Elementos['ProductId']}','{$Elementos['ProductUnit']}')";
            $Save= $this->Db->query($Insert);
            if($Save){
                $Result=true;
            }
       }
       
       return $Result;
        
    }

}

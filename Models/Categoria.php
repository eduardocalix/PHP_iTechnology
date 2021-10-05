<?php

class Categoria {

    private $IdCategoria;
    private $Descripcion;
    private $Db;

    public function __construct() {
        $this->Db = DataBase::OpenConnection();
    }

    function getIdCategoria() {
        return $this->IdCategoria;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function setIdCategoria($IdCategoria) {
        $this->IdCategoria = $IdCategoria;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $this->Db->real_escape_string($Descripcion);
    }

    public function getAll() {
        $Sql = "SELECT * FROM Productos.CategoriaProducto ORDER BY idCategoria ASC";
        $Result=false;
       /*  if ($Limit) {
            $Sql = $Sql . " LIMIT $Num";
        } */
        $Categorias = sqlsrv_query($this->Db,$Sql);
        if($Categorias){
            $Result=$Categorias;
            echo ($Categorias);
        }
        return $Result;
    }

    public function getOne($IdCategoria) {
        $Sql = "SELECT * FROM Productos.CategoriaProducto WHERE idCategoria=$IdCategoria";
        $Categoria = sqlsrv_query($this->Db,$Sql);
        $Result=false;
        if($Categoria){
            $Result=$Categoria;
        }
        return $Result;
        
    }

    public function Save() {
        $Descripcion = $this->Descripcion;
        $Sql = "INSERT INTO Productos.CategoriaProducto VALUES(null,'$Descripcion')";
        $Save = sqlsrv_query($this->Db,$Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        }
        return $Result;
    }

    public function Update($IdCategoria, $Descripcion) {
        $Sql="UPDATE Productos.CategoriaProducto SET(Descripcion='$Descripcion') WHERE idCategoria='$IdCategoria'";
        echo $Sql;
        die();
        
    }

    public function Delete($IdCategoria) {
        
    }

}

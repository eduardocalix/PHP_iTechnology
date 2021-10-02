<?php

class Categoria {

    private $Id;
    private $Nombre;
    private $Db;

    public function __construct() {
        $this->Db = DataBase::Connect();
    }

    function getId() {
        return $this->Id;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setNombre($Nombre) {
        $this->Nombre = $this->Db->real_escape_string($Nombre);
    }

    public function getAll($Limit, $Num) {
        $Sql = "SELECT * FROM CATEGORIAS ORDER BY Id DESC";
        $Result=false;
        if ($Limit) {
            $Sql = $Sql . " LIMIT $Num";
        }
        $Categorias = $this->Db->query($Sql);
        if($Categorias){
            $Result=$Categorias;
        }
        return $Result;
    }

    public function getOne($Id) {
        $Sql = "SELECT * FROM Categorias WHERE Id=$Id";
        $Categoria = $this->Db->query($Sql);
        $Result=false;
        if($Categoria){
            $Result=$Categoria;
        }
        return $Result;
        
    }

    public function Save() {
        $Nombre = $this->Nombre;
        $Sql = "INSERT INTO Categorias VALUES(null,'$Nombre')";
        $Save = $this->Db->query($Sql);
        $Result = false;
        if ($Save) {
            $Result = true;
        }
        return $Result;
    }

    public function Update($Id, $Nombre) {
        $Sql="UPDATE Categorias SET(Nombre='$Nombre') WHERE Id='$Id'";
        echo $Sql;
        die();
        
    }

    public function Delete($Id) {
        
    }

}

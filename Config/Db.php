<?php
class DataBase{
   public static function OpenConnection()
    {  
        $serverName = "DESKTOP-2I0PR9Q";
        $connectionInfo = array("Database"=>"DBKonoha"/* ,"UID"=>"calix", "PWD"=>"123456","characterset"=>"UTF-8" */);
        //$conn = sqlsrv_connect($serverName,$connectionInfo);
        $conn = sqlsrv_connect($serverName,$connectionInfo);
        if($conn){
       // echo "Conexion Establecida";
        }else{
            echo"fallo";
            die(print_r(sqlsrv_errors(),true));
        }
        return $conn;
    } 
} 
?>
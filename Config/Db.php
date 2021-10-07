<?php
class DataBase{
   public static function OpenConnection()
    {   
        $serverName = "DESKTOP-2I0PR9Q";
        $connectionInfo = array("Database"=>"DBKonoha"/* ,"UID"=>"calix", "PWD"=>"123456"*/,"characterset"=>"UTF-8" );
        $conn = sqlsrv_connect($serverName,$connectionInfo);
        if(!$conn){
            echo"fallo";
            die(print_r(sqlsrv_errors(),true));
        }

   /*     //echo "Conexion Establecida";
       $Sql = "SELECT * FROM Productos.Producto ORDER BY Rand()";
       $Producto = sqlsrv_query($conn,$Sql);
       while($Produ=sqlsrv_fetch_array($Producto/* ,SQLSRV_FETCH_ASSOC *//* ){ */
          // print_r($Produ['descripcion']."<br>");
          // echo($Produ['stock']);
           //print_r("$Produ");
       /*}
       */
        
     return $conn;
   } 
}  
?>
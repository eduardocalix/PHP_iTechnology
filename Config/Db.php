<?php
class DataBase{
    public static function Connect(){
        $db=new mysqli('localhost','root','','TiendaMaster');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
    
}

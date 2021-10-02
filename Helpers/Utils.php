+<?php

class Utils {

    public static function DeleteSession($Name) {
        if (isset($_SESSION[$Name])) {
            $_SESSION[$Name] = null;
            unset($_SESSION[$Name]);
        }
    }

    public static function ValidateText($Type, $Text) {
        $Error = array();
        if ($Type == 'Nombre') {
            if (empty($Text) || is_numeric($Text) || preg_match('/[0-9]/', $Text)) {
                $Error[$Type] = 'El Nombre Tiene Un Error';
            }
        }

        if ($Type == 'Apellidos') {
            if (empty($Text) || is_numeric($Text) || preg_match('/[0-9]/', $Text)) {
                $Error[$Type] = 'El Apellido Tiene Un Error';
            }
        }

        if ($Type == 'Email') {
            if (empty($Text) || !filter_var($Text, FILTER_VALIDATE_EMAIL)) {
                $Error[$Type] = 'El Correo Electronico no es valido';
            }
        }

        if ($Type == 'Password') {
            if (empty($Text)) {
                $Error[$Type] = 'La Contraseña Esta Vacia';
            }
        }

        if ($Type == 'Stock' || $Type=='Precio') {
            if (empty($Text) || !is_numeric($Text) || preg_match('/[a-z][A-Z]/', $Text) || $Text<0) {
                $Error[$Type] = 'Numero Invalido';
            }
        }
        return $Error;
    }

    public static function ShowErrors($Array, $Campo) {
        $Alerta = "";
        if (!empty($Campo) && isset($_SESSION[$Array][$Campo])) {
            $Alerta = "<strong class=" . '"Alertas AlertasError">' . $_SESSION[$Array][$Campo] . '</strong>';
        }
        return $Alerta;
    }

    public static function isAdmin() {
        if (!isset($_SESSION['Admin'])) {
            header('LOCATION:' . BaseUrl);
        } else {
            return true;
        }
    }

    public static function ShowCategorias() {
        require_once 'Models/Categoria.php';
        $Categoria = new Categoria();
        $Cat = $Categoria->getAll(true, 7);
        return $Cat;
    }
    
    public static function StatsCarrito(){
        $Total=0;
        $Cont=0;
        if(isset($_SESSION['Carrito'])){
            foreach($_SESSION['Carrito'] as $Indice=>$Elements){
                $Cont++;
                $Unidades=0;
                $Unidades+=$Elements['ProductUnit'];
                $Precio=$Elements['ProductPrice'];
                $Total+=($Unidades*$Precio);
            }
            $Stats=array(
            "Unidades"=>$Cont,
            "Total"=>$Total
        );
        }
        if(isset($Stats)){
            return $Stats;
        }
        
    }
    
    public static function isLog () {
        if(isset($_SESSION['User'])){
            
        }else{
            echo 'Hola1';
            die();
            header('LOCATION: '.BaseUrl);
        }
    }
    
    public static function ShowEstados($Estado) {
        $Value='Confirm';
        switch ($Estado){
            case 'Confirm':$Value='Pendiente'; break;
            case 'Preparation':$Value='En Preparacion';  break;
            case 'Ready':$Value='Preparado para enviar'; break;
            case 'Sended': $Value='Enviado'; break;
        } 
        return $Value;
    }

}

<?php

require_once 'Models/Producto.php';

class CarritoController {

    public function Index() {
        $Carrito = isset($_SESSION['Carrito']) ? $_SESSION['Carrito'] : null;
        require_once 'Views/Carrito/Ver.php';
    }

    public function Add() {
        if (isset($_GET['Id'])) {
            $ProductoId = $_GET['Id'];
        } else {
            header('LOCATION:' . BaseUrl);
        }



        if (isset($_SESSION['Carrito'])) {
            $Cont = 0;
            foreach ($_SESSION['Carrito'] as $Indice => $Element) {
                if ($Element['ProductId'] == $ProductoId) {
                    $_SESSION['Carrito'][$Indice]['ProductUnit'] ++;
                    $Cont++;
                }
            }
        }

        if (!isset($Cont) || $Cont == 0) {
            //Tomar el Producto
            $Pro = new Producto();
            $Pro->setId($ProductoId);
            $Producto = $Pro->getOne();

            //Registrar el Producto
            if (is_object($Producto) && $Product = $Producto->fetch_object()) {
                $_SESSION['Carrito'][] = array(
                    "ProductId" => $Product->Id,
                    "ProductPrice" => $Product->Precio,
                    "ProductUnit" => 1,
                    "Product" => $Product
                );
            }
        }


        header('LOCATION:' . BaseUrl . 'Carrito/Index');
    }

    public function Remove() {
        if (isset($_GET['Index'])) {
            $Index = $_GET['Index'];
            unset($_SESSION['Carrito'][$Index]);
            header('LOCATION: ' . BaseUrl . 'Carrito/Index');
        } elseif (isset($_SESSION['SinStock'])) {
            foreach($_SESSION['SinStock']as $Elementos){
                $Index=$Elementos['Index'];
                unset($_SESSION['Carrito'][$Index]);
            }
            header('LOCATION: '.BaseUrl.'Productos/SinStock');
        }
    }

    public function DeleteAll() {
        unset($_SESSION['Carrito']);
        header('LOCATION:' . BaseUrl . 'Carrito/Index');
    }

    public function Up() {
        if (isset($_GET['Index'])) {
            $Index = $_GET['Index'];
            $_SESSION['Carrito'][$Index]['ProductUnit'] += 1;
        }

        header('LOCATION: ' . BaseUrl . 'Carrito/Index');
    }

    public function Down() {
        if (isset($_GET['Index'])) {
            $Index = $_GET['Index'];
            if ($_SESSION['Carrito'][$Index]['ProductUnit'] == 0) {
                $this->Remove();
            } else {
                $_SESSION['Carrito'][$Index]['ProductUnit'] -= 1;
            }
        }

        header('LOCATION: ' . BaseUrl . 'Carrito/Index');
    }

}

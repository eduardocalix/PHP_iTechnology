<?php

require_once 'Models/Pedido.php';
require_once 'Models/LiniasdePedido.php';
require_once 'Models/Producto.php';

class PedidoController {

    public function Index() {
        require_once 'Views/Pedido/Realizar.php';
    }

    public function Confirmado() {
        Utils::isLog();
        $UserId = $_SESSION['User']->Id;
        $Pedido = new Pedido();
        $Pedido->setUsuerId($UserId);
        $Pe = $Pedido->getByUser();
        if (is_object($Pe) && $Ped = $Pe->fetch_object()) {
            $PedId = $Ped->Id;
            $Produ = $Pedido->getProductbyLinea($PedId);
            Utils::DeleteSession('Carrito');
            require_once 'Views/Pedido/Confirmado.php';
        }
    }

    public function Add() {
        if (isset($_POST)) {
            Utils::isLog();
            $Provincia = isset($_POST['Provincia']) ? $_POST['Provincia'] : false;
            $Localidad = isset($_POST['Localidad']) ? $_POST['Localidad'] : false;
            $Direccion = isset($_POST['Direccion']) ? $_POST['Direccion'] : false;
            $UsuerId = $_SESSION['User']->Id;

            if ($Provincia && $Localidad && $Direccion) {
                $Pedido = new Pedido();
                $LiniasPedido = new LiniasdePedido();
                $Producto = new Producto();
                $Cont = 0;

                foreach ($_SESSION['Carrito'] as $Index => $Elementos) {
                    $Producto->setId($Elementos['ProductId']);
                    $Sto = $Producto->GetStockByProduct();
                    if ($Sto && $Stock = $Sto->Stock) {
                        $Unit = $Elementos['ProductUnit'];
                        $Residuo = $Stock - $Unit;
                        if ($Residuo >= 0) {
                            $Decrase = $Producto->DecreaseStock($Elementos['ProductUnit']);
                            if ($Decrase) {
                                $Cont++;
                            }
                        } else {
                            echo 'Hola Residuo';
                            $_SESSION['SinStock'][] = array(
                                'Index' => $Index,
                                'Stock' => $Stock,
                                'Unit' => $Unit,
                                'ProductId' => $Elementos['ProductId'],
                                'Product' => $Elementos['Product']
                            );
                            header('LOCATION: ' . BaseUrl . 'Carrito/Remove');
                        }
                    }
                }
                $Stats = Utils::StatsCarrito();
                $Coste = $Stats['Total'];

                $Result = false;
                if ($Cont >= 1) {
                    $Pedido->setUsuerId($UsuerId);
                    $Pedido->setProvincia($Provincia);
                    $Pedido->setLocalidad($Localidad);
                    $Pedido->setDireccion($Direccion);
                    $Pedido->setCoste($Coste);
                    $Save = $Pedido->Save();
                    if ($Save) {
                        $SaveLinia = $LiniasPedido->Save();
                        if ($LiniasPedido) {
                            $Result = true;
                            $_SESSION['AddPedido'] = $Result;
                        }
                    }
                }
            }
        }
        if ($Residuo >= 0) {
            header('LOCATION:' . BaseUrl . 'Pedido/Confirmado');
        }
    }

    public function MisPedidos() {
        $Admin = Utils::isLog();
        $Pedido = new Pedido();
        if (isset($_SESSION['User'])) {
            $UserId = $_SESSION['User']->Id;
            $Pedido->setUsuerId($UserId);
            $Ped = $Pedido->getAllbyUser();
        }

        require_once 'Views/Pedido/MisPedidos.php';
    }

    public function Details() {
        Utils::isLog();
        if (isset($_SESSION['Admin'])) {
            $Admin = true;
        }
        if (isset($_GET['Id'])) {
            $PedId = $_GET['Id'];
            $Pedido = new Pedido();
            $Pedido->setId($PedId);
            $Pro = $Pedido->getProductbyLinea($PedId);
            $Ped = $Pedido->getOne();
        }

        require_once 'Views/Pedido/Details.php';
    }

    public function GestionarPedidos() {
        Utils::isAdmin();
        $Admin = true;
        $Pedido = new Pedido();
        $Ped = $Pedido->getAll();
        require_once 'Views/Pedido/MisPedidos.php';
    }

    public function Estado() {
        if (isset($_POST)) {
            $Estado = $_POST['Estado'];
            $PedidoId = $_POST['PedidoId'];
            $Pedido = new Pedido();
            $Pedido->setEstado($Estado);
            $Pedido->setId($PedidoId);
            $Update = $Pedido->UpdateEstado();
        }
        if ($Update) {
            header("LOCATION: " . BaseUrl . 'Pedido/Details&Id=' . $PedidoId);
        } else {
            header('LOCATION: ' . BaseUrl);
        }
    }

}
?>


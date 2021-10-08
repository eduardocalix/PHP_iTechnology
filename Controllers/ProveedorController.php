<?php

require_once 'Models/Proveedores.php';
require_once 'Models/Producto.php';

class ProveedoresController {

    public function Index() {
        require_once 'Views/Proveedores/Realizar.php';
    }

    public function Confirmado() {
        Utils::isLog();
        $UserId = $_SESSION['User']->Id;
        $Proveedores = new Proveedores();
        $Proveedores->setUsuerId($UserId);
        $Pe = $Proveedores->getByUser();
        if (is_object($Pe) && $Ped = sqlsrv_fetch_array($Pe)) {
            $PedId = $Ped->Id;
            $Produ = $Proveedores->getProductbyLinea($PedId);
            Utils::DeleteSession('Carrito');
            require_once 'Views/Proveedor/Confirmado.php';
        }
    }

    public function Add() {
        if (isset($_POST)) {
            Utils::isLog();
            $Nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : false;
            $Telefono = isset($_POST['Telefono']) ? $_POST['Telefono'] : false;
            $Direccion = isset($_POST['Direccion']) ? $_POST['Direccion'] : false;
          

            if ($Nombre && $Telefono && $Direccion) {
                $Proveedores = new Proveedores();
                $LiniasProveedores = new LiniasdeProveedores();
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
                    $Proveedores->setUsuerId($UsuerId);
                    $Proveedores->setNombre($Nombre);
                    $Proveedores->setTelefono($Telefono);
                    $Proveedores->setDireccion($Direccion);
                    $Proveedores->setCoste($Coste);
                    $Save = $Proveedores->Save();
                    if ($Save) {
                        $SaveLinia = $LiniasProveedores->Save();
                        if ($LiniasProveedores) {
                            $Result = true;
                            $_SESSION['AddProveedores'] = $Result;
                        }
                    }
                }
            }
        }
        if ($Residuo >= 0) {
            header('LOCATION:' . BaseUrl . 'Proveedores/Confirmado');
        }
    }

    public function MisProveedoress() {
        $Admin = Utils::isLog();
        $Proveedores = new Proveedores();
        if (isset($_SESSION['User'])) {
            $UserId = $_SESSION['User']->Id;
            $Proveedores->setUsuerId($UserId);
            $Ped = $Proveedores->getAllbyUser();
        }

        require_once 'Views/Proveedor/Mostrar.php';
    }

    public function Details() {
        Utils::isLog();
        if (isset($_SESSION['Admin'])) {
            $Admin = true;
        }
        if (isset($_GET['Id'])) {
            $PedId = $_GET['Id'];
            $Proveedores = new Proveedores();
            $Proveedores->setId($PedId);
            $Pro = $Proveedores->getProductbyLinea($PedId);
            $Ped = $Proveedores->getOne();
        }

        require_once 'Views/Proveedor/Details.php';
    }

    public function GestionarProveedoress() {
        Utils::isAdmin();
        $Admin = true;
        $Proveedores = new Proveedores();
        $Ped = $Proveedores->getAll();
        require_once 'Views/Proveedor/Mostrar.php';
    }

    public function Estado() {
        if (isset($_POST)) {
            $Estado = $_POST['Estado'];
            $ProveedoresId = $_POST['IdProveedores'];
            $Proveedores = new Proveedores();
            $Proveedores->setEstado($Estado);
            $Proveedores->setId($ProveedoresId);
            $Update = $Proveedores->UpdateEstado();
        }
        if ($Update) {
            header("LOCATION: " . BaseUrl . 'Proveedor/Details&Id=' . $ProveedoresId);
        } else {
            header('LOCATION: ' . BaseUrl);
        }
    }

}
?>


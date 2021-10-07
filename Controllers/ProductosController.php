<?php

require_once 'Models/Producto.php';

class ProductosController {

    public function Index() {
        //Renderizar Vista
        $Producto = new Producto();
        $Pro = $Producto->getRand();
        $Index=true;
        if(!$Pro){
            
        }else{
            require_once 'Views/Productos/ProductosDestacados.php';
        }
        
    }

    public function Gestion() {
        Utils::isAdmin();
        $Producto = new Producto();
        $Pro = $Producto->getAll();
        if (!$Pro) {
            
        } else {
            require_once 'Views/Productos/Gestion.php';
        }
    }

    public function Crear() {
        Utils::isAdmin();
        require_once 'Views/Productos/Formulario.php';
    }

    public function Save() {
        Utils::isAdmin();
        $Errores = array();
        if (isset($_POST)) {
            $Descripcion = isset($_POST['Descripcion']) ? $_POST['Descripcion'] : FALSE;
            $Costo = isset($_POST['Costo']) ? $_POST['Costo'] : false;
            $PrecioVenta = isset($_POST['PrecioVenta']) ? $_POST['PrecioVenta'] : false;
            $Stock = isset($_POST['Stock']) ? $_POST['Stock'] : false;
            $idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : false;
            $idProveedor = isset($_POST['idProveedor']) ? $_POST['idProveedor'] : false;
            if ($Descripcion && $idCategoria ) {
                $Errores = Utils::ValidateText('Descripcion', $Descripcion);
                //$Errores += Utils::ValidateText('Precio', $Precio);
                //$Errores += Utils::ValidateText('Stock', $Stock);
                if (count($Errores) == 0) {
                    $Producto = new Producto();
                    
                    
                    $Producto->setDescripcion($Descripcion);
                    $Producto->setCosto($Costo);
                    $Producto->setPrecioVenta($PrecioVenta);
                    $Producto->setStock($Stock);
                    $Producto->setCategoriaId($idCategoria);
                    $Producto->setIdProveedor($idProveedor);
                    //Guardar Imagen
                    if (isset($_FILES['Imagen'])) {
                        $File = $_FILES['Imagen'];
                        $FileName = $File['name'];
                        $FileType = $File['type'];
                        if ($FileType == 'image/jpg' || $FileType == 'image/jpeg' || $FileType == 'image/png' || $FileType == 'image/gif') {
                            if (!is_dir('Uploads/Images')) {
                                mkdir('Uploads/Images', 0777, true);
                            }
                            move_uploaded_file($File['tmp_name'], 'Uploads/Images/' . $FileName);
                            $Producto->setImage($FileName);
                        }
                    }
                    if (isset($_GET['Id'])) {
                        $Id = $_GET['Id'];
                        $Save = $Producto->Update($Id);
                    } else {
                        $Save = $Producto->Save();
                    }
                }
            } else {
                $_SESSION['RegisterProductos'] = 'Failed';
            }
        } else {
            $_SESSION['RegisterProductos'] = 'Failed';
        }
        $_SESSION['Errores-Productos-Save'] = $Errores;
        if ($Save) {
            $_SESSION['RegisterProductos'] = 'Complete';
            header('LOCATION:' . BaseUrl . 'Productos/Gestion');
        } else {
            $_SESSION['RegisterProductos'] = 'Failed';
            if (isset($_GET['Id'])) {
                $Id = $_GET['Id'];
                header('LOCATION:' . BaseUrl . 'Productos/Editar&Id=' . $Id);
            } else {
                header('LOCATION:' . BaseUrl . 'Productos/Crear');
            }
        }
    }

    public function Details() {
        if(isset($_GET['Id'])){
            $Id=$_GET['Id'];
            $Producto=new Producto();
            $Producto->setId($Id);
            $Pro=$Producto->getOne();
            if(is_object($Pro)){
                require_once 'Views/Productos/Details.php';
            }
        }
    }
    
    public function Eliminar() {
        Utils::isAdmin();

        if (isset($_GET['Id'])) {
            $Producto = new Producto();
            $Id = $_GET['Id'];
            $Exist = $Producto->ValidateIfExists($Id);

            if ($Exist) {

                $Delete = $Producto->Eliminar($Id);
                if ($Delete) {
                    header('LOCATION:' . BaseUrl . 'Productos/Gestion');
                }
            }
        }
    }
  
    public function SinStock() {
        if(isset($_SESSION['SinStock'])){
            require_once 'Views/Productos/NotEnough.php';
        }
    }
   
    public function Editar() {
        Utils::isAdmin();
        $Producto = new Producto();
        $Edit = true;
        $Id = isset($_GET['Id']) ? $_GET['Id'] : false;
        $Producto->setId($Id);
        $Pro = $Producto->getOne();
        require_once 'Views/Productos/Formulario.php';
    }
    
  
    

//    public function Update() {
//        Utils::isAdmin();
//        $Errores=array();
//        if(isset($_POST)){
//            $Categoria = isset($_POST['Categoria']) ? $_POST['Categoria'] : false;
//            $Nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : false;
//            $Descripcion = isset($_POST['Descripcion']) ? $_POST['Descripcion'] : false;
//            $Precio = isset($_POST['Precio']) ? $_POST['Precio'] : false;
//            $Stock = isset($_POST['Stock']) ? $_POST['Stock'] : false;
//            $Oferta = isset($_POST['Oferta']) ? $_POST['Oferta'] : false;
//        }else{
//            $Seee
//        }
//        
//    }
}

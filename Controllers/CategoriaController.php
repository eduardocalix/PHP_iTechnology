<?php

require_once 'Models/Categoria.php';
require_once 'Models/Producto.php';

class CategoriaController {

    public function Index() {
        Utils::isAdmin();
        $Categorias = new Categoria();
        $Categoria = $Categorias->getAll();
        require_once 'Views/Categorias/Index.php';
    }

    public function Create() {
        Utils::isAdmin();
        require_once 'Views/Categorias/Create.php';
    }

    public function Ver() {
        if(isset($_GET['Id'])){
            $Id=$_GET['Id'];
            $Productos=new Producto();
            $Categoria=new Categoria();
            $Cat=$Categoria->getOne($Id);
            $Pro=$Productos->getPro($Id);
        }
        require_once 'Views/Categorias/List.php';
    }

    public function Save() {
        Utils::isAdmin();
        //Guardar La Categoria en la Base de datos
        if (isset($_POST)) {
            $Categoria = new Categoria();
            $Utils = new Utils();
            $Errores = array();
            $Descripcion = isset($_POST['Descripcion']) ? $_POST['Descripcion'] : FALSE;
            if ($Descripcion) {
                $Errores = Utils::ValidateText('Descripcion', $Descripcion);
                if (count($Errores) == 0) {
                    $Categoria->setDescripcion($_POST['Descripcion']);
                    $Save = $Categoria->Save();
                    if ($Save) {
                        $_SESSION['Save-Categorias'] = 'Complete';
                    } else {
                        $_SESSION['Save-Categorias'] = 'Failed';
                    }
                } else {
                    $_SESSION['Save-Categorias'] = 'Failed';
                }
            } else {
                $_SESSION['Save-Categorias'] = 'Failed';
            }

            $_SESSION['Errores-Categoria-Save'] = $Errores;
        } else {
            $_SESSION['Save-Categorias'] = 'Failed';
        }
        header('LOCATION:' . BaseUrl . 'Categoria/Index');
    }


}

<?php

require_once './Helpers/Utils.php';
require_once 'Models/Usuario.php';

class UsuarioController {

    public function Index() {
        echo 'Controlador Usuarios, Acción Index';
    }

    public function Registro() {
        require_once 'views/Usuarios/Registro.php';
    }

    public function Login() {
        $Usuario = new Usuario();
        $Utils = new Utils();
        $Errores = array();

        if ($_POST) {
            $Email = isset($_POST['Email']) ? $_POST['Email'] : false;
            $Password = isset($_POST['Password']) ? $_POST['Password'] : false;
            if ($Email && $Password) {

                $Errores = Utils::ValidateText('Email', $Email);
                $Errores = Utils::ValidateText('Password', $Password);
                if (count($Errores) == 0) {

                    $Usuario->setEmail($Email);
                    $Usuario->setPassword($Password);
                    $LogIn = $Usuario->LogIn();
                    if ($LogIn) {
                        $_SESSION['User'] = $LogIn;
                        if ($LogIn->Rol == 'Admin') {
                            $_SESSION['Admin'] = true;
                        }
                    } else {
                        $_SESSION['LogIn'] = 'Failed';
                    }
                } else {
                    $_SESSION['LogIn'] = 'Failed';
                    $_SESSION['Errores-Login'] = $Errores;
                }
            } else {
                $_SESSION['LogIn'] = 'Failed';
            }
        }
        header('LOCATION:' . BaseUrl);
    }

    public function Save() {
        if (isset($_POST)) {

            $Nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : false;
            $Apellidos = isset($_POST['Apellidos']) ? $_POST['Apellidos'] : false;
            $Email = isset($_POST['Email']) ? $_POST['Email'] : false;
            $Password = isset($_POST['Password']) ? $_POST['Password'] : false;
            $Errores = array();
            $Utils = new Utils();
            if ($Nombre && $Apellidos && $Email && $Password) {
                $Errores = Utils::ValidateText('Nombre', $Nombre);
                $Errores += Utils::ValidateText('Apellidos', $Apellidos);
                $Errores += Utils::ValidateText('Email', $Email);
                $Errores += Utils::ValidateText('Password', $Password);

                if (count($Errores) == 0) {
                    $Usuario = new Usuario();
                    $Usuario->setNombre($Nombre);
                    $Usuario->setApellidos($Apellidos);
                    $Usuario->setEmail($Email);
                    $Usuario->setPassword($Password);
                    $Save = $Usuario->Save();
                    if ($Save) {
                        $_SESSION['Register'] = 'Complete';
                    } else {
                        $_SESSION['Register'] = 'Failed';
                    }
                } else {
                    $_SESSION['Register'] = 'Failed';
                }
            } else {
                $_SESSION['Register'] = 'Failed';
            }
        }


        $_SESSION['Errores-Register'] = $Errores;
        header('LOCATION:' . BaseUrl . 'Usuario/Registro');
    }

    public function LogOut() {
        if (isset($_SESSION['User'])) {
            unset($_SESSION['User']);
        }

        if (isset($_SESSION['Admin'])) {
            unset($_SESSION['Admin']);
        }
        header('Location:' . BaseUrl);
    }

}

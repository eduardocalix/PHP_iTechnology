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
        $UsuarioU = new Usuario();
        $Utils = new Utils();
        $Errores = array();

        if ($_POST) {
            $Usuario = isset($_POST['Usuario']) ? $_POST['Usuario'] : false;
            $Clave = isset($_POST['Clave']) ? $_POST['Clave'] : false;
            if ($Usuario && $Clave) {

                $Errores = Utils::ValidateText('Usuario', $Usuario);
                $Errores = Utils::ValidateText('Clave', $Clave);
                if (count($Errores) == 0) {

                    $UsuarioU->setUsuario($Usuario);
                    $UsuarioU->setClave($Clave);
                    $LogIn = $UsuarioU->LogIn();
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
            $Apellido = isset($_POST['Apellido']) ? $_POST['Apellido'] : false;
            $Usuario = isset($_POST['Usuario']) ? $_POST['Usuario'] : false;
            $Clave = isset($_POST['Clave']) ? $_POST['Clave'] : false;
            $Errores = array();
            $Utils = new Utils();
            if ($Nombre && $Apellido && $Usuario && $Clave) {
                $Errores = Utils::ValidateText('Nombre', $Nombre);
                $Errores += Utils::ValidateText('Apellido', $Apellido);
                $Errores += Utils::ValidateText('Usuario', $Usuario);
                $Errores += Utils::ValidateText('Clave', $Clave);

                if (count($Errores) == 0) {
                    $UsuarioU = new Usuario();
                    $UsuarioU->setNombre($Nombre);
                    $UsuarioU->setApellido($Apellido);
                    $UsuarioU->setUsuario($Usuario);
                    $UsuarioU->setClave($Clave);
                    $Save = $UsuarioU->Save();
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

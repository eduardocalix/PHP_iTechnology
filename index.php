<?php
session_start();
require_once'autoload.php';
require_once 'Config/Db.php';
require_once 'Config/Parameters.php';
require_once 'Helpers/Utils.php';
require_once 'Views/Layout/Header.php';
require_once 'Views/Layout/Slidebar.php';

//Conexion Base de Datos
//$Controlador->MostrarTodos();
//$Controlador->CrearUsuario();

function showError() {
    $Error = new ErrorController();
    $Error->Index();
}

if (isset($_GET['Controller'])) {
    $NombreControlador = $_GET['Controller'] . 'Controller';
} elseif (!isset($_GET['Controller']) && !isset($_GET['Action'])) {
    $NombreControlador = ControlerDefault;
} else {
    showError();
    exit();
}
if (class_exists($NombreControlador)) {
    $Controlador = new $NombreControlador();
    if (isset($_GET['Action']) && method_exists($Controlador, $_GET['Action'])) {
        $Action = $_GET['Action'];
        $Controlador->$Action();
    } elseif (!isset($_GET['Controller']) && !isset($_GET['Action'])) {
        $Default = ActionDefault;
        $Controlador->$Default();
    } else {
        showError();
    }
} else {
    showError();
}

require_once 'views/Layout/Footer.php';
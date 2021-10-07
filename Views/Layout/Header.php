<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Tienda Konoha</title>
        <link rel="stylesheet" href="<?= BaseUrl ?>assets/css/styles.css"/>
    </head>
    <body>
        <div id="Container">
            <!--Cabecera-->
            <header id="Header">
                <div id="Logo">
                    <img src="<?= BaseUrl ?>Assets/img/Logo.jpg" alt="Konoha Logo">
                    <a href="<?= BaseUrl ?>">
                        Tienda de Productos Tematicos
                    </a>
                </div>
            </header>
            <h1>    Konoha</h1> 
            <!--Menu-->
            <nav id="Menu">
                <ul>
                    <li>
                        <a href="<?= BaseUrl ?>">Inicio</a>
                    </li>
                    <li>
                        <a href="<?= BaseUrl ?>">Administración</a>
                    </li>
                    <li>
                        <a href="<?= BaseUrl ?>">Carrito</a>
                    </li>
                    <?php
                        require_once 'Models/Categoria.php';
                        $Categoria = new Categoria();
                        $Cat = $Categoria->getAll();
                        //$Categoria = Utils::ShowCategorias();
                        while ($Cate = sqlsrv_fetch_array($Cat)){      
                    ?>
                    <li>
                       <a href="<?= BaseUrl?>Categoria/Ver&Id=<?=$Cate['idCategoria']?>"><?=$Cate['descripcion']?></a>
                    </li>
                    <?php }  ?> 
                   
                </ul>
            </nav>
            <div id="Content">

<?php
function ControllersAutoload($classname){
    include_once 'Controllers/'.$classname.'.php';
}
spl_autoload_register('ControllersAutoload');
?>
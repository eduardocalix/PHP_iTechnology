<?php
function ControllersAutoload($classname){
    include 'Controllers/'.$classname.'.php';
}
spl_autoload_register('ControllersAutoload');

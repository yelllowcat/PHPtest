<?php 

spl_autoload_register(function ($class) {

    $file = '../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }else{
        die("The file $file does not exist.");
    }
});

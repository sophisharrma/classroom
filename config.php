<?php
date_default_timezone_set('Asia/kolkata');
//autoloader

function autoloader($class){
    $directories = glob(__DIR__.'/*', GLOB_ONLYDIR);
    foreach($directories as $directory){
        $directory = glob($directory.'/*', GLOB_ONLYDIR);
        foreach($directory as $dir){
            $file = $dir . "/" . $class . '.php';
            if(file_exists($file)){
                require_once $file;
                break;
            }
        } 
    }
}
spl_autoload_register("autoloader");
//echo "config added";

require_once "traits/getId.php";
//$theStudent = new Student('mysql:host=localhost; dbname=moodle', 'root', '');


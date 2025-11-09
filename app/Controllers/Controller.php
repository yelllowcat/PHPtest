<?php

namespace app\Controllers;

class Controller{
    public function view($route, $data = []){
      
        extract($data);
        
        $route = str_replace(".", "/", $route);

        if(file_exists("../recources/views/" . $route . ".php")){
            ob_start();
            include "../recources/views/" . $route . ".php";
            $content = ob_get_clean();
            return $content;
            
        }
        return "404 Not Found";
    }
    public function redirect($url){
        header("Location:" . $url);
    }
}
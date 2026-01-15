<?php

namespace App\Core;

class Controller 
{
    public function view($view, $data = [])
    {
        extract($data);
        $viewDemander = "../app/Views/{$view}.php";
        if (file_exists($viewDemander)) {
            require_once $viewDemander;
        }else{
            
        }
    }
}
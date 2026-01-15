<?php
namespace App\Core;

class View {
    public static function show($view, $data = []) {
        extract($data);        
        ob_start();
        require_once "../app/Views/$view.php";
        $content = ob_get_clean();
        
        echo $content;
    }
}
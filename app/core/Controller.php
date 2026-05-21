<?php

namespace App\Core;

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        $viewFile = BASE_PATH . '/app/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            // We use output buffering to load the view inside a layout
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
            
            // Require layout
            require_once BASE_PATH . '/app/views/layouts/main.php';
        } else {
            die("View $view not found!");
        }
    }

    protected function redirect($url) {
        header('Location: ' . BASE_URL . $url);
        exit;
    }
}

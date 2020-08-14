<?php
namespace App\Core;

class View
{
    public $viewPath = 'App/Views/';
    public $layoutPath = 'App/Layouts/';
    
    public function importLayout()
    {
        ob_start();
        include_once $this->layoutPath.'main.php';
        return ob_get_clean();
    }

    public function importView($view, $data)
    {
        $file = $this->viewPath.$view.'.php';
        if (!file_exists($file)) {
            return $this->importErrorView(['page not found']);
        }
        
        ob_start();
        include_once $file;
        return ob_get_clean();
        
    }

    public function renderView($view, array $data = null)
    {
        $layout = $this->importLayout();
        $view = $this->importView($view, $data);
        return str_replace('{{content}}', $view, $layout);
    }

    public function importErrorView($error)
    {
        ob_start();
        include_once 'App/_404.php';
        return ob_get_clean();
    }

    public function renderErrorView($error)
    {
        $layout = $this->importLayout();
        $errorView = $this->importErrorView($error);
        return str_replace('{{content}}', $errorView, $layout);
    }
}
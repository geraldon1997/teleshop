<?php
namespace App\Core;

use App\Controllers\User;
use ReflectionClass;

class Route
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'];
        return $path;
    }

    public function resolve()
    {
        $position = strrpos($this->path(), '?', 0);
        $homePosition = strrpos($this->path(), '/', 0);

        if ($position === false) {
            if ($homePosition === 0) {
                return [$this->path()];
            }
            return [rtrim($this->path(), '/')];
        }
        return [rtrim(substr($this->path(), 0, $position), '/')];
    }

    public function get()
    {
        $namespace = 'App\\Controllers\\';
        $path = ltrim($this->resolve()[0], '/');
        $default = $namespace.'Page';

        if ($path === '' || $path === null) {
            return call_user_func([new $default, 'index']);
        }
        
        $pathArray = explode('/', $path);
        $pathArray[0] = ucfirst($pathArray[0]);
        $class = $pathArray[0];
        $controller = $namespace.$class;

        if (!class_exists($controller)) {
            $this->setStatusCode(404);
            $error = [$class.' Controller does not exist'];
            return call_user_func([new View, 'renderErrorView'], $error);
        }
        unset($pathArray[0]);

        if (empty($pathArray)) {
            $this->setStatusCode(404);
            $error = ["no method found for $class controller"];
            return call_user_func([new View, 'renderErrorView'], $error);
        }

        $method = $pathArray[1];

        if (!method_exists(new $controller, $method)) {
            $this->setStatusCode(404);
            $error = [$method.' Method does not exist'];
            return call_user_func([new View, 'renderErrorView'], $error);
        }
        unset($pathArray[1]);

        $params = array_values($pathArray);

        return call_user_func([new $controller, $method], $params);
        
    }
}
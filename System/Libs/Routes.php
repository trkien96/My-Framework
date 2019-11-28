<?php

class Routes
{
    protected $controller;
    protected $action;
    protected $params = [];

    public function model($modelName)
    {
        require_once './app/models/'.ucfirst($modelName).'.php';
        return new $modelName;
    }

    public function view($viewName, $data = [])
    {
        require_once './app/views/'.$viewName.'.php';
    }

    public function controller($controllerName)
    {
        require_once './app/controllers/'.ucfirst($controllerName).'.php';
        return new $controllerName;
    }

    public function lib($libName)
    {
        require_once './System/Libs/'.ucfirst($libName).'.php';
    }

    public function helper($helperName)
    {
        require_once './System/Helpers/'.ucfirst($helperName).'.php';
    }

    public function route($url)
    {
        $data = $this->createUrl($url);
        $this->callFunction($data);
    }

    public function createUrl($url)
    {
        if (strlen($url)) {
            return explode('/', filter_var(trim($url, '/')));
        }
    }

    public function callFunction($arr = [])
    {
        if(is_array($arr) && count($arr) >= 2)
        {
            $this->controller = ucwords($arr[0]).'Controller';
            $this->action = $arr[1];
            unset($arr[0],$arr[1]);
            if (file_exists('./app/controllers/'.$this->controller.'.php')) {
                $this->controller = $this->controller($this->controller);
                if (method_exists($this->controller, $this->action)) {
                    $this->params = $arr ? array_values($arr):[];
                    call_user_func_array([$this->controller,$this->action],$this->params);
                } else {
                    $this->homePage();
                }
            } else {
                $this->homePage();
            }
        } else {
            $this->homePage();
        }
    }

    public function getGET($name = null)
    {
    	if ($name !== null) {
    		return isset($_GET[$name]) ? $_GET[$name]: null;
    	}
    	return $_GET;
    }

    public function getPOST($name = null)
    {
    	if ($name !== null) {
    		return isset($_POST[$name]) ? $_POST[$name]: null;
    	}
    	return $_POST;
    }

    public function homePage()
    {
        header('Location: '.base().'/'.env('CONTROLLER_DEFAULT').'/'.env('ACTION_DEFAULT'));
    }

    public function errorPage()
    {
        header('HTTP/1.0 404 Not Found', true, 404);
        echo 'Page Not Found!';
        exit(1);
    }
}
<?php
//App core class
//Creates URL & loads core controller
//URL Format: - /controller/method/params

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        //print_r($this->getUrl());

        $url = $this->getUrl();

        //Check controllers for correct route
        if(isset($url[0])) {
            if(file_exists('../app/controllers/'.ucwords($url[0].'.php'))) {
                $this->currentController = ucwords($url[0]);
            }
            unset($url[0]);
        }

        //If controller exists, load and instantiate, otherwise defaults to Pages
        require_once '../app/controllers/'.$this->currentController.'.php';
        $this->currentController = new $this->currentController;

        //Check for method in second part of url
        if(isset($url[1])) {
            //Check to see if method exists in controller
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
            }
            unset($url[1]);
        }

        //Get parameters from third (or more) part(s) of url
        $this->params = $url ? array_values($url) : [];

        //Use callback on all array parameters
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
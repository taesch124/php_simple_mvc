<?php
//Base controller class all others will extend
//Loads models and views for http response

class Controller {
    //Load model
    public function model($model) {
        if(file_exists('../app/models/'.$model.'.php')) {
            require_once '../app/models/'.$model.'.php';
            return new $model();
        } else {
            throw new Exception('Model '.$model.' does not exist');
        }
    }

    //Load view
    public function view($view, $data = []) {
        if(file_exists('../app/views/'.$view.'.php')) {
            require_once '../app/views/'.$view.'.php';
        }
        else {
            throw new Exception('View '.$view.' does not exist');
        }
    }
}
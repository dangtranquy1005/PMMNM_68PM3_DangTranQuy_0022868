<?php
class Controller
{
    public function model($model)
    {
        require_once '../app/model/' . $model . '.php';
        return new $model();
    }
    public function view($viewName, $data = [], $layout = 'layout/masterlayout')
    {
        extract($data);
        if ($layout) {
            $viewname = $viewName;
            require_once '../app/view/' . $layout . '.php';
        } else {
            require_once '../app/view/' . $viewName . '.php';
        }
    }
}
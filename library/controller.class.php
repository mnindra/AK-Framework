<?php

class Controller {
    
    protected function view($viewName, $data = array(), $returnAsData = FALSE)
    {
        $view = new View($viewName, $data, $returnAsData);
        return $view->forceRender();
    }
    
    protected function model($modelName) 
    {
        require_once ROOT . DS . 'modules' . DS . 'models' . DS . $modelName . 'Model.php';
        $className = ucfirst($modelName) . 'Model';
        $this->$modelName = new $className();
    }
    
    public function back()
    {
        echo '<script> history.go(-1); </script>';
    }
    
    public function redirect($url = "") 
    {
        header("location:" . $url);
    }
    
    public function validate($data) 
    {
        return htmlentities(trim(strip_tags($data)));
    }
}

?>

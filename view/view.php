<?php
class View{

    protected $data;

    public function __construct($data = []){
        $this->data = $data;      
    }

    public function assign($key, $val){
        $this->data[$key] = $val;
    }

    public function render($file){
        ob_start();
        extract($this->data);
        require $file;
        $html = ob_get_clean();

        echo $html;
    }
}
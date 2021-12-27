<?php
class View{

    protected $data;

    static private function escapeHTML(&$data){
        if(is_array($data)){
            foreach($data as &$val){
                self::escapeHTML($val);
            }
        } else {
            $data = htmlspecialchars($data);
        }
    }

    public function __construct($data = []){
        $this->data = $data;
    }

    public function assign($key, $val){
        $this->data[$key] = $val;
    }

    public function render($file){
        ob_start();
        self::escapeHTML($this->data);
        extract($this->data);
        require $file;
        $html = ob_get_clean();

        echo $html;
    }
}
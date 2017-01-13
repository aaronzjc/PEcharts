<?php

class Option {

    public $option = []; // 最终属性

    public function __call($name, $args) {
        $className = "modules\\".ucfirst($name);

        if(!class_exists($className, true)) {
            echo 'unable to load class.'.$className;
            exit;
        }

        $class = new $className($args);
        $this->option[$name] = $class->get();

        return $this;
    }

    // 这是sugar方法,快速生成legends
    public function autoLegend() {

    }

    public function getArray() {
        return $this->option;
    }

    public function getJson($flag) {
        return json_encode($this->option, $flag);
    }
}
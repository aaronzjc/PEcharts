<?php

class Option {

    public $option = []; // 最终属性

    /**
     * 超级入口
     */
    public function __call($name, $args) {
        $className = "modules\\".ucfirst($name);

        // 如果不存在,则调用父类方法进行处理.
        if(!class_exists($className, false)) {
            $className = "modules\\Handler";
        }

        $class = new $className();
        // 前置钩子处理
        $class->beforeHook($this->option);
        // 构造数据
        $this->option[$name] = $class->get($args);
        // 后置钩子处理
        $class->afterHook($this->option);

        return $this;
    }

    // 这是sugar方法,快速生成legends
    public function autoLegend() {
        if (!$this->option['series']);
    }

    public function getArray() {
        return $this->option;
    }

    public function getJson($flag = JSON_UNESCAPED_UNICODE) {
        return json_encode($this->option, $flag);
    }
}
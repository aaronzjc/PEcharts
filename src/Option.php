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
        $data = $class->get($args);
        if (isset($this->option[$name])) {
            // 如果设置了$name的值,则表明是第二次调用
            $tmp = $this->option[$name];
            if ($tmp[0]) {
                // 如果存在0元素,表明之前已经调用过了.
                $this->option[$name][] = $data;
            } else {
                $this->option[$name] = [$tmp, $data];
            }
        } else {
            $this->option[$name] = $data;
        }
        // 后置钩子处理
        $class->afterHook($this->option);

        return $this;
    }

    public function getArray() {
        return $this->option;
    }

    public function getJson($flag = JSON_UNESCAPED_UNICODE) {
        return json_encode($this->option, $flag);
    }
}
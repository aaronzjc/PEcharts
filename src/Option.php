<?php
namespace PEcharts;

class Option {

    public $option = []; // 最终属性

    /**
     * 入口,兼容旧版本
     *
     * @param $arg
     * @return $this
     */
    public function init($arg) {
        if (is_array($arg)) {
            $this->data = $arg;
        }

        if ($arg instanceof \Closure) {
            $callback = $arg;
            $builder = new Builder();
            $callback($builder);
        }

        // 如果参数是闭包,这里,获取执行结果
        if ($builder instanceof Builder) {
            $this->option = $builder->option;
        }

        return $this;
    }

    /**
     * @return array 返回option原数据
     */
    public function getArray() {
        return $this->option;
    }

    /**
     * @param int $flag json_encode的参数
     * @return string
     */
    public function getJson($flag = JSON_UNESCAPED_UNICODE) {
        return json_encode($this->option, $flag);
    }
}

class Builder {

    public $option = [];

    public function __construct() {
    }

    public function __set($name, $value) {
        $this->option[$name] = $value;
    }

    /**
     * option调度的引擎
     *
     * @param $name option的最外层对象名
     * @param $args 根据参数来进行不同的处理
     * @return $this
     */
    public function __call($name, $args) {
        $className = "PEcharts\\modules\\".ucfirst($name);

        // 如果不存在,则调用父类方法进行处理.
        if(!class_exists($className, false)) {
            $className = "PEcharts\\modules\\Handler";
        }

        $class = new $className();
        // 前置钩子处理
        $class->beforeHook($this->option);

        // 参数判断
        if (!isset($args[0])) return $this;

        // 构造数据
        $data = $class->get($args);

        if (isset($args[1]) && $args[1]) {
            $this->option[$name][] = $data;
        } else {
            $this->option[$name] = $data;
        }

        // 后置钩子处理
        $class->afterHook($this->option);

        return $this;
    }
}
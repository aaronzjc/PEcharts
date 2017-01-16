<?php
namespace PEcharts\modules;

class Builder {
    public $_option = [];

    public function __construct() {
    }

    public function __set($name, $val) {
        $this->_option[$name] = $val;
    }

    public function __call($name, $args) {
        $m = $args[0];
        $f = isset($args[1])?true:false;

        // 闭包,则继续深入执行.
        if ($m instanceof \Closure) {
            $builder = new self();
            if ($f === true) {
                $data = $this->_option[$name]?:[];
                $index = isset($data)?count($data):0;
                $builder->option = & $this->_option[$name][$index];
            } else {
                $builder->option = & $this->_option[$name];
            }

            $m($builder);
        }

        // 如果是数组,则覆盖原数据.
        if (is_array($m)) {
            $this->option = array_replace($this->_option[$name], $m);
        }

        // 如果是字符串,则认为是调用系统方法进行处理.暂时没有考虑好
        if (is_string($m)) {
            $mm = $args[1];
            if ($mm instanceof \Closure) {
                $mm($m);
            }
            if (is_string($mm)) {
                if (function_exists($mm)) {
                    $mm($m);
                } else {
                    throw new Exception("function doesn't exists.");
                }
            }

        }
    }
}
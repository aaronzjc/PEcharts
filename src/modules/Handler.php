<?php
namespace PEcharts\modules;

class Handler {
    public $data;

    public function __construct() {
    }

    /**
     * 数组处理,这里就当做直接赋值.后期可以改进.
     *
     * @param $option
     */
    public function arrayHandle($option) {
        $this->data = $option;
    }

    /**
     * 闭包处理.启动"链式引擎"进行处理.
     *
     * @param $method
     */
    public function closureHandle($method) {
        $builder = new Builder();
        $builder->data = & $this->data;
        $method($builder);
    }

    /**
     * 处理并最终结果
     *
     * @return array
     */
    public function get($args) {
        // 如果参数大于1,则启动自定义处理模式.
        if (count($args) > 1) {
            $this->sugarHandle($args);
        } else {
            // 参数是数组,则应该是直接赋值option.
            if (is_array($args[0])) {
                // 数组处理
                $this->arrayHandle($args[0]);
            } elseif ($args[0] instanceof \Closure) {
                // 如果是闭包,则走闭包吧.
                $this->closureHandle($args[0]);

            }
        }

        return $this->data;
    }

    /**
     * 前置钩子
     *
     * @param &$option 初始option
     */
    public function beforeHook(&$option) {

    }

    /**
     * 后置钩子
     *
     * @param &$option 此对象之前构造出的option
     */
    public function afterHook(&$option) {

    }

}
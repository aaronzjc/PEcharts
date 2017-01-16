<?php
namespace PEcharts\modules;

class Handler {
    public $_option = [];

    public function __construct() {
    }

    public function sugarHandle($params) {
        // TODO
    }

    /**
     * 数组处理,这里就当做直接赋值.后期可以改进.
     *
     * @param $option
     */
    public function arrayHandle($option) {
        $this->_option = $option;
    }

    /**
     * 闭包处理.启动"链式引擎"进行处理.
     *
     * @param $method
     */
    public function closureHandle($method) {
        $builder = new Builder();
        $builder->_option = & $this->_option;
        $method($builder);
    }

    /**
     * 处理并最终结果
     *
     * @return array
     */
    public function get($args) {
        $r = $args[0]; // route...

        /**
         * 1. 第一个参数为string,启用sugar方法进行处理
         * 2. 第一个参数为数组,启用array方法进行处理
         * 3. 第一个参数为closure,启用closure方法进行处理
         */
        switch(gettype($r)) {
            // case 'string':$this->sugarHandle($args);break;
            case 'array':$this->arrayHandle($r);break;
            case 'object':
                if ($r instanceof \Closure) {
                    $this->closureHandle($r);
                };
                break;
            default:$this->sugarHandle($args);break;
        }

        return $this->_option;
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
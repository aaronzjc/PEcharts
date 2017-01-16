<?php
namespace PEcharts\modules;

class Title extends Handler {
    public function __construct() {
        echo 'title called'."\n";
    }

    /**
     * 前置钩子
     *
     * @param &$option 初始option
     */
    public function beforeHook(&$option) {

    }

    /**
     * 快速设置.后期可以改进.
     *
     * @param $option
     */
    public function sugarHandle($params) {
        list($show, $title, $position) = $params;
        $this->data = [
            'show' => $show,
            'title' => $title,
            'x' => $position?:'center',
        ];
    }
}
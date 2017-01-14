<?php
namespace modules;

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
}
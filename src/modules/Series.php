<?php
namespace PEcharts\modules;

class Series extends Handler {
    public function __construct() {
        echo 'series called'."\n";
    }

    /**
     * 快速设置.后期可以改进.
     *
     * @param $option
     */
    public function sugarHandle($params) {
        list($type, $name, $data) = $params;
        $series = [
            'type' => strtolower($type),
            'name' => $name,
            'data' => $data
        ];

        $this->data = $series;
    }
}
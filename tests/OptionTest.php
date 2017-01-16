<?php

class OptionTest extends PHPUnit_Framework_TestCase {

    public function testOption() {
        $title = ['text' => '标题'];
        /*
        $option = new \PEcharts\Option();
        $arr = $option->init(function($option) use($title){
            $option->title = $title;
        })->getArray();
        */
        $this->assertEquals(['tfitle'=>$title], $title);
    }
}
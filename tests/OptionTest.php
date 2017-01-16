<?php
use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase {

    public function testOption() {
        $title = ['text' => '标题'];
        $option = new \PEcharts\Option();
        $arr = $option->init(function($option) use($title){
            $option->title = $title;
        })->getArray();
        $this->assertEquals(['title'=>$title], $arr);
    }
}
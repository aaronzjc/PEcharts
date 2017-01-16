<?php
use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase {

    public function setUp(){
        $this->option = new \PEcharts\Option();
    }

    public function testOptionOne() {
        $title = ['text' => '标题'];
        $series = ['type' => 'line'];
        $re = ['title'=>$title,'series'=>$series];


        $arr = $this->option->init(function($option) use($title,$series){
            $option->title = $title;
            $option->series($series);
        })->getArray();

        $this->assertEquals($re, $arr);
    }

    public function testOptionTwo() {
        $data['line'] = ['name' => 'aaa', 'value' => 1];
        $data['bar'] = ['name' => 'bbb', 'value' => 2];
        $data['map'] = ['name' => 'ccc', 'value' => 3];

        $arr = $this->option->init(function($option) use($data){
            foreach ($data as $k => $v) {
                $option->series(function($series) use($k, $v) {
                    $series->type = $k;
                    $series->data = $v;
                }, true);
            }
        })->getArray();
        foreach ($data as $k => $v) {
            $option['series'][] = [
                'type' => $k,
                'data' => $v
            ];
        }
        $this->assertEquals($option, $arr);

        $arrJson = $this->option->getJson();
        $this->assertEquals(json_encode($option), $arrJson);
    }
}
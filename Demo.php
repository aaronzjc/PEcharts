<?php
//spl_autoload_register(function ($class) {
//    set_include_path(".");
//});

include("src/Option.php");
include("src/modules/Builder.php");
include("src/modules/Handler.php");

$option = new \PEcharts\Option();
$data = $option->init(function($option) {
    $option->title = ['text' => '标题'];
    $option->series(function ($series) {
        $series->type = 'bar';
    }, true)->series(function ($series) {
        $series->type = 'line';
    }, true);
})->getJson();
echo $data;

//var_export($data);
<?php
spl_autoload_register();

$option = new Option();
$data = $option->title([
    'text' => '标题'
])->series(function($series) {
    $series->type = 'pie';
    $series->data(function($data) {
        $data->name = 'series-data';
    });
})->series(function($series) {
    $series->type = 'bar';
})->legend()->getJson();

echo $data;

//var_export($data);
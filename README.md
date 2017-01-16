## 说明
当初开发PEcharts 1.0版本时,缺乏良好的设计.所以,最后只是实现了其中的功能,得到自己想要的结果.但是实现的不优美,几乎很难扩展.

然后,转眼一年过去,最近捡起来Echarts,自己尝试着重写了这个玩意.现在比之前好用一些了.

## 设计说明

### 目录结果

* 根目录
    * modules/
        * Builder.php
        * Handler.php
        * Title.php
        * ...
    * Demo.php
    * Option.php
    
Option依然是入口类.我将Option的第一层对象,即title,series,legend等,拆分出来了,作为单独的对象进行处理.这样方便区别对待title,series等参数.

## 安装

    composer require aaronzjc/pecharts

## 使用

    $option = new \PEcharts\Option();
    $arr = $option->init(function($option){
    	$option->title = ['text' => '标题'];
    	$option->series(function($series){
    		$series->type = "line";
    		$series->data = [1,2,3,4,5];
    	}, true)->series(funciton($series){
    		$series->type = "bar";
    		$series->data = ['a','b','c'];
    	}, true);
    })->getJson();
    
    // $arr = {'title':{'text':'标题'},'series':[{'type':'line','data':[1,2,3,4,5]},{'type':'bar','data':['a','b','c']}]}


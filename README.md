## 基础方法构思

### Option
$option = new \PEcharts\Option();

$option->title('标题','left'); // 这里可以抽象一些常用的配置
$option->title(function($title) {
    $title->text = '标题';
    $title->textStyle(['...']);
    $title->textStyle = ['...'];
});


### title

class Title implements handler {

}



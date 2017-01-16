<?php
define("BASE_DIR", __DIR__);

function loadClass($className) {

    if ($className[0] === '\\') {
        unset($className[0]);
    }
    if (strpos($className, 'PEcharts') === 0) {
        $className = str_replace("PEcharts\\", '', $className);
    }
    echo $className;
    $file = BASE_DIR . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . $className . ".php";
    require_once($file);
}

spl_autoload_register('loadClass');
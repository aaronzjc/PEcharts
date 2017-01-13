<?php
namespace modules;

class Series extends Handler {
    public function __construct($args) {
        parent::__construct($args);
        echo 'series called'."\n";
    }
}
<?php
namespace modules;

class Title extends Handler {
    public function __construct($args) {
        parent::__construct($args);
        echo 'title called'."\n";
    }
}
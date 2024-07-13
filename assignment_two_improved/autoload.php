<?php
spl_autoload_register(function($className) {
    $baseDir = "";
    require_once $baseDir.$className.".php";
});
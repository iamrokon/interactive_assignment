<?php 
session_start();
require 'helpers.php';
spl_autoload_register(function ($className) {
    $baseDir = "";
    require_once $baseDir.$className.".php";
});
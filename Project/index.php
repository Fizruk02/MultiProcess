<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Project\Multi;
$scripts = [__DIR__ . "/test.php"];
$callBackFunction = function (){
    $file = __DIR__."/../log.txt";
    file_put_contents($file, "script completed\n", FILE_APPEND);
};

new Multi($scripts, $callBackFunction);

?>
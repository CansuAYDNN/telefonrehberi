<?php
require_once __DIR__ . "/../controller/engine.php";
require_once __DIR__ . "/../controller/pages/rehber.php";
require_once __DIR__ . "/../controller/pages/ekle.php";
require_once __DIR__ . "/../controller/pages/detay.php";
$ROUTE = new engine([
    'views' => __DIR__ . '/../view/',
    'cache' => __DIR__ . '/../cache/',
    'suffix' => "blade"
]);

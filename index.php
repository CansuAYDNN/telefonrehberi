<?php
error_reporting(E_ALL);
ini_set("display_errors", true);
$page = @$_GET['page'] ?? "index";
require_once __DIR__ . "/config/include.php";
if ($page == "index" || empty($page)) {
    echo $ROUTE->view("index", $rehber->push());
} else if ($page == "ekle") {
    echo $ROUTE->view("ekle", $ekle->push());
} else if ($page == "detay") {
    
    echo $ROUTE->view("detay", $detay->push());
} else {
    echo $ROUTE->view("404", $notfound->push());
}
$ROUTE->cacheClear();

<?php
require_once __DIR__ . "/core.php";
class ekle
{
    var $config;
    var $data = array();
    function __construct()
    {
        $this->config = new BASE();
    }
    public function pageSeo()
    {
        $request = array();
        $request["title"] = "Kişi Ekle";
        return $request;
    }
    public function push()
    {
        $this->data["config"] = $this->config->push()["config"];
        $this->data["seo"] = $this->pageSeo();
        return $this->data;
    }
    function __destruct()
    {
    }
}
$ekle = new ekle();

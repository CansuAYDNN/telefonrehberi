<?php
require_once __DIR__ . "/core.php";
class rehber
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
        $request["title"] = "Anasayfa";
        return $request;
    }
    public function push()
    {
        $this->data["config"] = $this->config->push()["config"];
        $this->data["rehber"] = $this->rehberList();
        $this->data["seo"] = $this->pageSeo();
        return $this->data;
    }
    public function rehberList()
    {
        $rehber = $this->config->core->VeriGetir("liste");
        if ($rehber != false) {
            return $rehber;
        } else {
            return array();
        }
    }
}
$rehber = new rehber();

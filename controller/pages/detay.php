<?php
require_once __DIR__ . "/core.php";
class detay
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
        $request["title"] = "Kişiyi Düzenle";
        return $request;
    }
    public function push()
    {
        $this->data["config"] = $this->config->push()["config"];
        $this->data["list"] = $this->numaralist();
        $this->data["seo"] = $this->pageSeo();
        return $this->data;
    }
    public function numaralist()
    {
        @$numara = $this->config->core->VeriGetir("liste", "id=?", array($_GET['bir']));
        if ($numara != false) {
            return $numara[0];
        } else {
            return array();
        }
    }
}
$detay = new detay();

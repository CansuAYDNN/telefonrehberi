<?php
require_once __DIR__ . "/../core.php";
class BASE
{
    var $core;
    var $data = array();
    function __construct()
    {
        $this->core = new CORE();
        if (DEV_MODE == false) {
            error_reporting(0);
            ini_set("display_errors", false);
        } else {
            error_reporting(E_ALL);
            ini_set("display_errors", true);
        }
    }
    public function configs()
    {
        $check = $this->core->VeriGetir("config");
        if ($check != false) {
            $this->data["config"] = $check[0];
        } else {
            $this->data["config"] = array();
        }
    }
    protected function addArray($value, $key = "config")
    {
        if (!empty($value)) {
            if (isset($this->config)) {
                $this->data[$key] = $value;
            } else {
                $this->configs();
                $this->data[$key] = $value;
            }
        }
    }
    public function push()
    {
        $this->configs();
        return $this->data;
    }
}

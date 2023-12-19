<?php
require_once __DIR__ . "/../config/config.php";
class db
{
    var $sunucu   = HOST;
    var $user     = USER;
    var $password = PASSWORD;
    var $dbname   = DBNAME;
    var $devMode = DEV_MODE;
    var $baglanti;
    function __construct()
    {
        try {
            $this->baglanti = new \PDO("mysql:host=" . $this->sunucu . ";dbname=" . $this->dbname . ";charset=utf8", $this->user, $this->password);
        } catch (\PDOException $error) {
            if ($this->devMode == false) {
                echo $error->getMessage();
            } else {
                echo "Aksaklık oluştu. Lütfen daha sonra tekrar deneyiniz. Yada yöneticinize başvurunuz.";
                exit();
            }
        }
    }
}

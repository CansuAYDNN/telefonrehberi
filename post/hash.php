<?php
@session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once __DIR__ . "/../config/function.php";
$hash = $_GET["hash"];
switch ($hash) {
    case 'numberadd':
        $token = verifyToken('numberadd', @$_POST["numberadd"]);
        if ($token != false) {
            require_once __DIR__ . "/../model/number.php";
            $number = new NUMBER();
            $number->numberadd();
        } else {
            echo json_encode(array("title" => "Başarısız", "text" => "Güvenliğiniz için verilen token'in süresi doldu!", "statu" => "error"));
        }
        break;
        case 'numberupdate':
            $token = verifyToken('numberupdate', @$_POST["numberupdate"]);
            if ($token != false) {
                require_once __DIR__ . "/../model/number.php";
                $number = new NUMBER();
                $number->numberupdate();
            } else {
                echo json_encode(array("title" => "Başarısız", "text" => "Güvenliğiniz için verilen token'in süresi doldu!", "statu" => "error"));
            }
            break;
        case 'sil':
                require_once __DIR__ . "/../model/number.php";
                $id = $_GET["bir"];
                $numberdelete = new NUMBER();
                $numberdelete->numberdelete($id);
                break;
        }

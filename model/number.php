<?php
error_reporting(E_ALL);
ini_set("display_errors",true);
require_once __DIR__ . "/../controller/core.php";

class NUMBER
{
    var $core = "";

    function __construct()
    {
        $this->core = new core();
    }

    public function numberadd()
    {
        if (isset($_POST['ekle'])) { // 'ekle' butonuna tıklanıp tıklanmadığını kontrol et
            extract($_POST);

            // Formdan gelen resim dosyasının adını 'resim' olarak değiştir
            @$tmp_name = $_FILES['resim']["tmp_name"];
            @$name = $_FILES['resim']["name"];
            @$uzanti = "." . explode(".", $name)[1];

            // Resmi yükleyerek kaydet
            $uploads_dir = '../assets/img';
            $ad = uniqid() . $uzanti; // veya başka bir benzersizlik oluşturma yöntemi
            $refimg = substr($uploads_dir, 3) . "/" . $ad;
            @move_uploaded_file($tmp_name, "$uploads_dir/$ad");
            $path = "assets/img/" . $ad;

            // Veritabanına kayıt ekle
            $insert = $this->core->SorguCalistir("INSERT INTO liste SET ", "isim=?, numara=?, dogumtarihi=?, notlar=?, resim=?", array($isim, $numara, $dogumtarihi, $notlar, $path));

            if ($insert != false) {
                header("Location:../index.php?ok");
                exit(); // header fonksiyonundan sonra scriptin çalışmasını sonlandır
            } else {
                header("Location:index.php?no");
                exit();
            }
        }
    }

    public function numberupdate()
    {
        if (isset($_POST['duzenle'])) {
            extract($_POST);
    
            // Yeni bir resim yüklenmişse işlemleri gerçekleştir
            if ($_FILES['resim']['size'] > 0) {
                // Formdan gelen resim dosyasının adını 'resim' olarak değiştir
                $tmp_name = $_FILES['resim']["tmp_name"];
                $name = $_FILES['resim']["name"];
                $uzanti = "." . explode(".", $name)[1];
    
                // Resmi yükleyerek kaydet
                $uploads_dir = '../assets/img';
                $ad = uniqid() . $uzanti;
                $refimg = substr($uploads_dir, 3) . "/" . $ad;
                move_uploaded_file($tmp_name, "$uploads_dir/$ad");
                $path = "assets/img/" . $ad;
            } else {
                // Eğer yeni bir resim yüklenmediyse, mevcut resmi kullan
                $path = $_POST['eski_resim'];
            }
    
            // Veritabanında güncelleme yapacak sorgu
            $update = $this->core->SorguCalistir("UPDATE liste SET ", "isim=?, numara=?, dogumtarihi=?, notlar=?, resim=? WHERE id=?", array($isim, $numara, $dogumtarihi, $notlar, $path, $id));
    
            if ($update != false) {
                header("Location:../index.php?ok");
                exit();
            } else {
                header("Location:index.php?no");
                exit();
            }
        }
    }

    public function numberdelete($id)
    {
           
            extract($_POST);
            $delete = $this->core->SorguCalistir("DELETE FROM liste", " WHERE id=?", array($id));

            if ($delete != false) {
                header("Location:../../index.php?ok");
                exit();
            } else {
                header("Location:../../index.php?no");
                exit();
            }
    }
}

<?php

// * ekleme sorgu örneği

//?  $modulekle =  $this->SorguCalistir("INSERT INTO moduller", " SET baslik=?, tablo=?,durum=?,tarih=?", array($baslik, $tablo, $durum, date("Y-m-d")));

//* güncelleme işlemi  sorgu örneği

//? $guncelle = $this->uSorguCalistir("UPDATE urunler","SET fiyat=? WHERE stok_kod=?",array($fiyat,$urun_kod));

include_once "database.php";

class core extends db
{
    var $stmt = "";
    public function transaction()
    {
        if (!$this->transactionInProgress()) {
            $this->baglanti->beginTransaction();
        }
    }
    public function MyCommit()
    {
        if ($this->transactionInProgress()) {
            $this->baglanti->commit();
        }
    }
    public function MyRollback()
    {
        if ($this->transactionInProgress()) {
            $this->baglanti->rollBack();
        }
    }
    public function transactionInProgress()
    {
        return $this->baglanti->inTransaction();
    }
    public function VeriGetir($tablo, $whereAlanlar = "", $wherearraydeger = "", $orderby = "", $limit = "", $yildiz = "*", $gurup = "", $devMode = 1)
    {
        try {
            if (strpos($tablo, "SELECT") !== false || strpos($tablo, "INSERT") !== false) {
                $sql = $tablo;
                if (!empty($wherearraydeger)) {
                    @$this->stmt = $this->baglanti->prepare($sql);
                    $sonuc = $this->stmt->execute($wherearraydeger);
                    $veri = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    @$this->stmt = $this->baglanti->prepare($sql);
                    $sonuc = $this->stmt->execute();
                    $veri = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            } else {
                $sql = "SELECT " . $yildiz . " FROM " . $tablo;
            }
            if (!empty($whereAlanlar) && !empty($wherearraydeger)) {
                $sql .= " WHERE " . $whereAlanlar;
                if (!empty($orderby)) {
                    $sql .= " " . $orderby;
                }
                if (!empty($limit)) {
                    $sql .= " LIMIT " . $limit;
                }
                @$this->stmt = $this->baglanti->prepare($sql);
                $sonuc = $this->stmt->execute($wherearraydeger);
                $veri = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                if (!empty($gurup)) {
                    $sql .= " GROUP BY " . $gurup;
                }
                if (!empty($orderby)) {
                    $sql .= " " . $orderby;
                }
                if (!empty($limit)) {
                    $sql .= " LIMIT " . $limit;
                }
                $this->stmt = $this->baglanti->prepare($sql);
                $sonuc = $this->stmt->execute();
                $veri = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            if ($veri != false && !empty($veri)) {
                $datalar = array();
                foreach ($veri as $bilgiler) {
                    $datalar[] = $bilgiler;
                }
                return $datalar;
            } else {
                return false;
            }
        } catch (\PDOException $error) {
            if ($devMode == 1) {
                echo $error->getMessage();
                self::developerNatification($error->getMessage());
            } else {
                self::alert("Verdiğimiz Rahatsızlıktan Dolayı Çok Özür Dileriz. Elimizden Geleni Sizin İçin Yapıyoruz.", "Hata Oluştu", "basarisiz", "basic", "", "0");
            }
        }
    }
    public function SorguCalistir($tablo, $alanlar = "", $degerlerarray = "", $limit = "", $devMode = "1", $alert = "0")
    {
        try {
            if (!empty($alanlar) && !empty($degerlerarray)) {
                $sql = $tablo . " " . $alanlar;
                if (!empty($limit)) {
                    $sql .= " LIMIT " . $limit;
                }
                @$this->stmt = $this->baglanti->prepare($sql);
                @$sonuc = $this->stmt->execute($degerlerarray);
            } else {
                $sql = $tablo . " " . $alanlar;
                if (!empty($limit)) {
                    $sql .= " LIMIT " . $limit;
                }
                $sonuc = $this->baglanti->query($sql);
            }
            if ($sonuc != false) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $error) {
            if ($devMode == 1) {
                echo $error->getMessage();
                if ($alert == 0)
                    self::developerNatification($error->getMessage());
                else
                    $error->getMessage();
            } else {
                echo "Hata Oluştu.";
            }
        }
    }
}

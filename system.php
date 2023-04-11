<?php
    $connection = mysqli_connect("localhost", "root", "");
    function connectDB() {
        global $connection;
        if (!$connection) {
            die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
        }
        mysqli_select_db($connection, "muhasebe");
        mysqli_query($connection, "SET NAMES 'utf8'");
    }

    function addAccountingRecords($tur, $miktar, $tarih, $aciklama) {
        global $connection;
        $sorgu = "INSERT INTO gelirgider SET tur= '$tur', miktar = '$miktar', tarih = '$tarih', aciklama = '$aciklama'";
        return mysqli_query($connection, $sorgu);
    }

    function updateAccountingRecords($id, $tur, $miktar, $tarih, $aciklama) {
        global $connection;
        $sorgu = "UPDATE gelirgider SET tur= '$tur', miktar = '$miktar', tarih = '$tarih', aciklama = '$aciklama' WHERE id = '$id'";
        return mysqli_query($connection, $sorgu);
    }

    function deleteAccountingRecords($id) {
        global $connection;
        $sorgu = "DELETE FROM gelirgider WHERE id = '$id'";
        return mysqli_query($connection, $sorgu);
    }

    function getAccountingRecordsRecords() {
        global $connection;
        $sorgu = "SELECT * FROM gelirgider";
        $sonuc = mysqli_query($connection, $sorgu);
        $cevap = array();
        while ($satir = mysqli_fetch_assoc($sonuc)) {
            $cevap[] = $satir;
        }
        return $cevap;
    }

    connectDB();
?>
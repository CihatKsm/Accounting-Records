<?php
    include "system.php";

    $id = $_GET["id"];
    $tur = $_GET["tur"];
    $miktar = $_GET["miktar"];
    $tarih = $_GET["tarih"];
    $aciklama = $_GET["aciklama"];

    connectDB();

    if (updateAccountingRecords ($id, $tur, $miktar, $tarih, $aciklama)) echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
    else echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
?>
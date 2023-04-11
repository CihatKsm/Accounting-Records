<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
  <link href="style.css" rel="stylesheet" />
</head>
<body class="bg-black text-white h-screen select-none">
    <?php $inputStyle = "bg-gray-800 px-2 py-1 border-2 rounded rounded-b-none border-[#00000000] border-b-blue-600 hover:border-blue-600" ?>
    <div class="flex justify-center items-center py-8 w-full">
        <div class="flex flex-col gap-4 w-full lg:w-2/3 xl:w-3/4 2xl:w-4/5">
            <p class="text-2xl font-bold">
                Gelir Gider İşlemleri:
            </p>
            <div class="flex flex-col bg-gray-800 rounded-xl w-full justify-center items-center">
                <div class="grid grid-cols-5 w-full items-center border-b border-blue-600 border-opacity-40">
                    <span class="text-center p-3">Tür</span>
                    <span class="text-center p-3">Miktar (TL)</span>
                    <span class="text-center p-3">Tarih</span>
                    <span class="text-center p-3">Açıklama</span>
                    <span class="text-center p-3"></span>
                </div>
                <form class="grid grid-cols-5 w-full items-center" action="add.php">
                    <span class="text-center p-3">
                        <select name="tur" class="<?php echo $inputStyle ?>" required>
                            <option value="">Lütfen türünü seçiniz.</option>
                            <option value="gelir">Gelir</option>
                            <option value="gider">Gider</option>
                        </select>
                    </span>
                    <span class="text-center p-3">
                        <input name="miktar" type="number" placeHolder="125" min="0" class="<?php echo $inputStyle ?>" required>
                    </span>
                    <span class="text-center p-3">
                        <input name="tarih" type="date" class="<?php echo $inputStyle ?>" required>
                    </span>
                    <span class="text-center p-3">
                        <input name="aciklama" type="text" placeHolder="Ahmet'e olan borcum." class="<?php echo $inputStyle ?>" required>
                    </span>
                    <span class="text-center p-1 flex justify-end p-1">
                        <button onclick="add()" class="bg-green-600 px-4 py-2 rounded-xl" disabled>Ekle</button>
                    </span>
                    <script>
                        setInterval(() => check (), 1000);
                        function check () {
                            var tur = document.getElementsByName("tur")[0].value;
                            var miktar = document.getElementsByName("miktar")[0].value;
                            var tarih = document.getElementsByName("tarih")[0].value;
                            var aciklama = document.getElementsByName("aciklama")[0].value;
                            if (tur != "" && miktar != "" && tarih != "" && aciklama != "") {
                                document.getElementsByTagName("button")[0].disabled = false;
                                document.getElementsByTagName("button")[0].classList.remove("cursor-not-allowed");
                            } else {
                                document.getElementsByTagName("button")[0].disabled = true;
                                document.getElementsByTagName("button")[0].classList.add("cursor-not-allowed");
                            }
                        }

                        function add() {
                            window.location.reload();
                        }
                    </script>
                </form>
            </div>
            <div class="flex flex-col bg-gray-800 rounded-xl w-full">
                <div class="grid grid-cols-5 w-full items-center border-b border-blue-600 border-opacity-40">
                    <span class="text-center p-3">Tür</span>
                    <span class="text-center p-3">Miktar (TL)</span>
                    <span class="text-center p-3">Tarih</span>
                    <span class="text-center p-3">Açıklama</span>
                    <span></span>
                </div>
                
                <div class="flex flex-col max-h-96 overflow-auto">
                    <?php
                        include "system.php";
                        $baglanti = connectDB();
                        $kayitlar = getAccountingRecordsRecords();

                        foreach ($kayitlar as $kayit){
                            $bagGüncelle = "formGuncelleKayit.php?id=".$kayit["id"].",miktar=".$kayit["miktar"].",tarih=".$kayit["tarih"].",aciklama=".$kayit["aciklama"];
                            $bagSil = "delete.php?id=".$kayit["id"];
                            $satir = '';
                            $satir .= '<div class="grid grid-cols-5 w-full items-center">';
                            $satir .= '<span class="text-center p-3">'.$kayit['tur'].'</span>';       
                            $satir .= '<span class="text-center p-3">'.$kayit['miktar'].' TL</span>';
                            $satir .= '<span class="text-center p-3">'.$kayit['tarih'].'</span>';
                            $satir .= '<span class="text-center p-3">'.$kayit['aciklama'].'</span>';
                            $satir .= '<span class="flex gap-2 justify-end p-1">';
                            $satir .= '<button data-modal-target="'.$kayit['id'].'-edit-modal" data-modal-toggle="'.$kayit['id'].'-edit-modal" class="bg-blue-600 px-4 py-2 rounded-xl">Güncelle</button>';
                            $satir .= '<a class="bg-red-600 px-4 py-2 rounded-xl" href="'.$bagSil.'">Sil</a>';
                            $satir .= '</span>';
                            $satir .= '</div>';
                            echo $satir;
                        }

                        foreach ($kayitlar as $kayit){
                            $modal = 
                            '<div id="'.$kayit['id'].'-edit-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-fit">
                                    <form class="relative bg-white rounded-lg shadow dark:bg-gray-700" action="update.php"> 
                                        <div>
                                            <div class="grid grid-cols-4 w-full items-center border-b border-blue-600 border-opacity-40">
                                            <span class="text-center p-3">Tür</span>
                                                <span class="text-center p-3">Miktar</span>
                                                <span class="text-center p-3">Tarih</span>
                                                <span class="text-center p-3">Açıklama</span>
                                            </div>
                                            <div class="grid grid-cols-4 w-full flex items-center py-4">
                                                <input name="id" value="'.$kayit['id'].'" type="text" class="hidden" required>
                                                <span class="text-center p-3">
                                                    <input name="tur" value="'.$kayit['tur'].'" type="text" class="'.$inputStyle.'" required>
                                                </span>
                                                <span class="text-center p-3">
                                                    <input name="miktar" value="'.$kayit['miktar'].'" type="number" class="'.$inputStyle.'" required>
                                                </span>
                                                <span class="text-center p-3">
                                                    <input name="tarih" value="'.$kayit['tarih'].'" type="date" class="'.$inputStyle.'" required>
                                                </span>
                                                <span class="text-center p-3">
                                                    <input name="aciklama" value="'.$kayit['aciklama'].'" type="text" class="'.$inputStyle.'" required>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex justify-center items-center p-3 border-t border-blue-600 border-opacity-40 rounded-b">
                                            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Güncelle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>';
                            echo $modal;
                        }
                    ?>
                </div>
                <div id="gelirgider" class="w-full flex justify-center gap-4 p-4 font-semibold items-center border-t border-blue-600 border-opacity-40">
                    Hesaplanıyor...
                </div>
                <script>
                    var gelir = 0;
                    var gider = 0;
                    var gelirgider = document.getElementById("gelirgider");
                    <?php
                        foreach ($kayitlar as $kayit){
                            if ($kayit['tur'] == "gelir") echo 'gelir += '.$kayit['miktar'].';';
                            else if ($kayit['tur'] == "gider") echo 'gider += '.$kayit['miktar'].';';
                        }
                    ?>
                    let _gelir = `<span class="text-green-600">Gelir: ` + gelir + ` TL</span>`;
                    let _gider = `<span class="text-red-600">Gider: ` + gider + ` TL</span>`;
                    let bakiye = `<span class="text-orange-600">Bakiye: ` + Number(gelir-gider) + ` TL</span>`;
                    gelirgider.innerHTML = _gelir + _gider + bakiye;
                </script>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</html>
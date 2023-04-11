<?php 
    include "system.php";
    connectDB();

    $id = $_GET['id'];

    if (deleteAccountingRecords($id)) echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
    else echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
?>
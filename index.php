<?php 
    include ("includes/classes/checkTable.php");
    $user_tbl = new chkTables();
    $user_tbl->getUser('user');
?>
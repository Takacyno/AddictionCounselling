<?php
    session_start();
    $DBhost='localhost';
    $DBusername='root';
    $DBpassword='local';
    $link=mysqli_connect($DBhost,$DBusername,$DBpassword);
    $db=mysqli_select_db($link,"local");
?>
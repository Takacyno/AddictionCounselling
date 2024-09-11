<?php
    session_start();
    $DBhost='133.18.244.234';
    $DBusername='home10';
    $DBpassword='8940hakuyo';
    $link=mysqli_connect($DBhost,$DBusername,$DBpassword);
    $db=mysqli_select_db($link,"takayuki");
?>
<?php
    session_start();
    header('Location:'.$_SESSION["page"]);
    exit;
?>
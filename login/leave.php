<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/connect/connect.php";
    include $rootPath . "/connect/session.php";
    
    unset($_SESSION['memberID']);
    unset($_SESSION['youEmail']);
    unset($_SESSION['youName']);
    Header("Location: /home");
?>
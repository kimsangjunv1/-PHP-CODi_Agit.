<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    //섹션 생성
    $_SESSION['memberID'] = "12dwdkak220dka";
    $_SESSION['youEmail'] = "guest@codi-agit.com";
    $_SESSION['youName'] = "Guest 12dwdkak220dka";
    $_SESSION['youGrade'] = "0";

    Header("Location: /home");
?>
<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    // 섹션 생성
    // 고유한 난수 생성
    $randomID = bin2hex(random_bytes(16)); // 32자 길이의 난수 생성

    // 세션 설정
    $_SESSION['memberID'] = $randomID;
    $_SESSION['youEmail'] = "guest@codi-agit.com";
    $_SESSION['youName'] = "Guest_" . $randomID;
    $_SESSION['youGrade'] = "0";

    Header("Location: /home");
?>
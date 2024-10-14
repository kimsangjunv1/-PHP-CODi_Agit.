<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $sql = "DELETE FROM boardCategory WHERE categoryTitleKor = {$categoryTitleKor}";

    // 쿼리 전송
    $connect -> query($sql);

    Header("Location: /profile/");
    exit();  // 스크립트 종료
?>
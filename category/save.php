<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $categoryTitleKor = $connect -> real_escape_string($_POST['categoryTitleKor']);
    $categoryTitleEng = $connect -> real_escape_string($_POST['categoryTitleEng']);
    $categoryDescription = $connect -> real_escape_string($_POST['categoryDescription']);
    $regTime = time();

    $sql = "
        INSERT INTO boardCategory(categoryTitleKor, categoryTitleEng, categoryDescription, categoryUsageCount, categoryStatus, categoryOrder)
        VALUES('$categoryTitleKor', '$categoryTitleEng', '$categoryDescription', 0, 1, 0)
    ";

    // 쿼리 전송
    $connect -> query($sql);

    Header("Location: /profile/");
    exit();  // 스크립트 종료
?>
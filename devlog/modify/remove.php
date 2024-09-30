<?php
    // SEO
    $seo = [
        'title' => '데브로그',
        'description' => '오류해결과 관련된 팁들을 모아놨어요!',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/connect/connect.php";
    include $rootPath . "/connect/session.php";

    // 받아올 값(POST 방식)
    // $commentPass = $_POST["pass"];
    $commentID = $_POST["commentID"];

    $sql = "DELETE FROM classComment WHERE commentID = {$commentID}";
    
    // 데이터 가져옴
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $commentID));
?>
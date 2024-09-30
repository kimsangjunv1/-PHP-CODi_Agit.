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

    // 전송할 값
    $postTitle = $connect -> real_escape_string($_POST['postTitle']);
    $postContents = $connect -> real_escape_string(nl2br($_POST['postContents']));
    $memberID = $_SESSION['memberID'];
    $postImgFileUrl = $connect -> real_escape_string(nl2br($_POST['postImgFileUrl']));
    $postView = 1;
    $regTime = time();
    
    // 보낼 쿼리 종합
    $sql = "
        INSERT INTO boardDevlog(memberID, postTitle, postContents, postImgFileUrl, postView, regTime)
        VALUES('$memberID', '$postTitle', '$postContents', '$postImgFileUrl', '$postView', '$regTime')
    ";

    // 쿼리 전송
    $connect -> query($sql);

    Header("Location: /devlog");
    exit();  // 스크립트 종료
?>
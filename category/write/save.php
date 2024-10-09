<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    // 전송할 값
    $postTitle = $connect -> real_escape_string($_POST['postTitle']);
    $postContents = $connect -> real_escape_string($_POST['postContents']);
    $postCategory = $connect -> real_escape_string($_POST['postCategory']);
    $memberID = $_SESSION['memberID'];
    $postView = 1;
    $regTime = time();

    // 썸네일 첨부 여부에 따라 첨부 혹은 기본 이미지로 넣을지 결정
    $isAvailiable = $connect -> real_escape_string($_POST['postImgFileUrl']);

    if ($isAvailiable) {
        $postImgFileUrl = $isAvailiable;
    } else {
        $postImgFileUrl = "/src/assets/images/common/img-default.webp";
    }
    
    // 보낼 쿼리 종합
    $sql = "
        INSERT INTO boardPost(memberID, postTitle, postCategory, postContents, postImgFileUrl, postView, postLike, modTime , regTime)
        VALUES('$memberID', '$postTitle', '$postCategory', '$postContents', '$postImgFileUrl', '$postView', 0, '$regTime', '$regTime')
    ";

    // 쿼리 전송
    $connect -> query($sql);

    Header("Location: /category/?type=");
    exit();  // 스크립트 종료
?>
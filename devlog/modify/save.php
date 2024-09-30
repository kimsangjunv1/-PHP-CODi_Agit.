<?php
    // SEO
    $seo = [
        'title' => '데브로그',
        'description' => '오류해결과 관련된 팁들을 모아놨어요!',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    // 전송할 값
    $postTitle = $connect -> real_escape_string($_POST['postTitle']);
    $postContents = $connect -> real_escape_string($_POST['postContents']);
    $memberID = $_SESSION['memberID'];
    $postID = $_POST['postID'];
    $youPass = $_POST['youPass'];

    $sql = "SELECT youPass, memberID FROM classMember WHERE memberID = {$memberID}";
    $result = $connect -> query($sql);

    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

    if ($memberInfo['youPass'] === $youPass && $memberInfo['memberID'] === $memberID) {
        $sql = "UPDATE boardDevlog SET postTitle = '{$postTitle}', postContents = '{$postContents}' WHERE postID = '{$postID}'";
        $connect -> query($sql);

        Header("Location: /devlog");
        exit();  // 스크립트 종료
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다. 다시 한번 확인해주세요!!')</script>";
        echo "<script>history.back();</script>";
    }
?>
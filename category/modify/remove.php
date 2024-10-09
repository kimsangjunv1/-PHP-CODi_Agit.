<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";
    include $rootPath . "/src/components/common/component_grade_check.php";


    $postID = $connect -> real_escape_string($_GET['postID']);
    $memberID = $connect -> real_escape_string($_SESSION['memberID']);

    $sql = "SELECT postID, memberID FROM boardPost WHERE memberID = {$memberID} && postID = {$postID}";
    $result = $connect -> query($sql);

    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

    if ($memberInfo['postID'] === $postID && $memberInfo['memberID'] === $memberID) {
        $sql = "DELETE FROM boardPost WHERE postID = {$postID} && memberID = {$memberID}";
        $connect -> query($sql);

        Header("Location: /category");
    } else {
        echo "
            <script>
                alert('본인이 작성한 글만 삭제 하실 수 있어요.'); 
                history.back();
            </script>
        ";
    }
?>
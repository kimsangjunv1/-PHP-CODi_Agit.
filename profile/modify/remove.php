<?php
    // SEO
    $seo = [
        'title' => '회원탈퇴',
        'description' => '요청하신 회원탈퇴가 완료되었습니다.',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";
    include $rootPath . "/src/components/common/component_session_check.php";
    
    $userAnswer = $_POST['userAnswer'];
    $correctAnswer = "삭제하겠습니다.";

    $memberID = $connect -> real_escape_string($_SESSION['memberID']);
    
    if ($userAnswer == $correctAnswer) {
        $sql = "DELETE FROM boardPost WHERE memberID = {$memberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM boardComment WHERE memberID = {$memberID}";
        $connect -> query($sql);
        $sql = "DELETE FROM boardMember WHERE memberID = {$memberID}";
        $connect -> query($sql);

        session_destroy();
    } else {
        echo "
            <script>
                alert('답변이 틀렸습니다.');
                window.location.href = '/profile';
            </script>
        ";
    }
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="profile" class="result">
            <section class="container-inner">
                <h2>회원탈퇴 완료</h2>
                <p>탈퇴가 완료되었어요,<br />다음에 다시 방문하실때까지 좀 더 좋은 모습으로 갖춰놓도록 노력할게요!</p>

                <a href="/home" class="button brand lg">메인으로</a>
            </section>    
        </main>

        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
    </body>

    <script src="../../assets/javascript/common.js"></script>
    <script src="../../assets/javascript/board.js"></script>
</html>
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
    include $rootPath . "/connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <!-- 스킵 -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- 스킵 END -->

        <!-- 헤더 -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- 헤더 END -->
        
        <!-- 메인 -->
        <div id="login" class="remove">
            <section class="container-inner">
                <img class="notice_logo" src="../../assets/img/site_board_edit_delete.png" alt="">
                <article>
                    <?php
                        $youDeleteAnswer = $_GET['youDeleteAnswer'];
                        // var_dump($youDeleteAnswer);
                        $myMemberID = $_SESSION['myMemberID'];

                        $myMemberID = $connect -> real_escape_string($myMemberID);
                        
                        if("삭제하겠습니다" == $youDeleteAnswer){
                            $sql = "DELETE FROM myBoard WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM myEvent WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM myComment WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM myDecoboard WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM myEvent WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM myEventComment WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM myComment WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM test WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);
                            $sql = "DELETE FROM myMember WHERE myMemberID = {$myMemberID}";
                            $connect -> query($sql);

                            echo "<script>alert('삭제되었습니다..');</script>";
                            Header("Location: /home");

                            session_start();
                            session_destroy();

                        } else {
                            echo "<script>alert('답변이 틀렸습니다.');</script>";
                        }
                    ?>
                </article>
                
                <article>
                    <p class="cross">ID가 삭제되었습니다, 하단의 버튼을 눌러 확인해주세요!</p>
                    <img src="../assets/img/site_board_notice_cross.png" alt="">
                    <button style="width:216px;" type="submit" class="input__Btn"><a href="board.php">확인</a></button>
                </article>
            </section>
        </div>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>

    <script src="../../assets/javascript/common.js"></script>
    <script src="../../assets/javascript/board.js"></script>
</html>
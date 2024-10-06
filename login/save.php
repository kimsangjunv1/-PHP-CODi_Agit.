<?php
    // SEO
    $seo = [
        'title' => '카테고리',
        'description' => '오류해결과 관련된 팁들을 모아놨어요!',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";
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
        <main id="login">
            <section class="container-inner save">
                <article>
                    <h2 class="blind">로그인 성공.</h2>
                    <img src="../assets/img/banner_img03.svg" alt="배너 이미지">
                </article>

                <article>
                    <?php
                        $youEmail = $_POST['youEmail'];
                        $youPass = sha1($_POST['youPass']);
                        
                        function msg($target){
                            echo "<p class='alert'>{$target}</p>";
                            echo "<a href='/login'>로그인</a>";
                        }

                        // 데이터 조회
                        $sql = "SELECT memberID, youEmail, youName, youPass FROM boardMember WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
                        $result = $connect -> query($sql);

                        if ($result) {
                            $count = $result -> num_rows;
                        } else {
                            msg("에러발생 - 관리자에게 문의하세요");
                        }

                        if ($count == 0) {
                            msg("이메일 또는 비밀번호가 틀렸습니다.");
                        } else {
                            //로그인 성공
                            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

                            //섹션 생성
                            $_SESSION['memberID'] = $memberInfo['memberID'];
                            $_SESSION['youEmail'] = $memberInfo['youEmail'];
                            $_SESSION['youName'] = $memberInfo['youName'];

                            Header("Location: /home");
                        }
                    ?>
                </article>

                <a href="/home">메인으로</a>
            </section>
            <!-- //banner -->
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>
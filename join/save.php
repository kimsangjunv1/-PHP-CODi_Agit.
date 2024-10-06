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
        <!-- 메인 -->
        <main id="join">
            <section class="container-inner save">
                <div class="form">
                    <article class="header">
                        <h2>결과안내</h2>
                        <!-- <p>
                            회원가입은 1인당 1개의 이메일 계정을 이용할 수 있습니다.
                            <br>
                            회원의 개인정보를 안전하게 취급하고, 교육을 목적으로 사용됩니다.
                        </p> -->
                    </article>
    
                    <article class="main">
                        <p>회원가입 완료</p>
                    </article>
    
                    <article class="footer">
                        <a href="/login" class="button black lg">로그인 하러가기</a>
                        <a href="/home" class="button border lg">메인으로</a>
                    </article>
                </div>
            </section>
        </main>
    </body>
</html>
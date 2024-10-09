<?php
    // SEO
    $seo = [
        'title' => '회원가입 결과안내',
        'description' => '회원가입 처리 결과에 관해 안내 드려요.',
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
                    </article>
    
                    <article class="main">
                        <p>회원가입이 완료되었어요,<br/>지금부터 댓글 작성 및 나만의 프로필 변경이 가능해요!</p>
                    </article>
    
                    <article class="footer">
                        <a href="/login" class="button brand lg">로그인 하러가기</a>
                        <a href="/home" class="button border lg">메인으로</a>
                    </article>
                </div>
            </section>
        </main>
    </body>
</html>
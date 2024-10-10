<?php
    // SEO
    $seo = [
        'title' => '앗,,, 오류가 발생했어요',
        'description' => '예상치 못한 오류가 발생해 페이지가 이동되었어요.',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";
?>

<!DOCTYPE html>
<html lang="ko" >
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="error">
            <section class="container-inner">
                <h1>앗 페이지에 오류가 발생하였습니다.</h1>
                <p>불편을 드려 죄송해요...</p>

                <a href="/home" class="button brand lg">메인으로</a>

                <?php include $rootPath . "/src/components/common/component_search.php"; ?>
            </section>    
        </main>
        
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>

        <script type="module" defer>
            import { pageController } from "/src/assets/js/pageController.js";

            pageController.home.showcase();
            pageController.home.specific();
        </script>
    </body>
</html>
<?php
    // SEO
    $seo = [
        'title' => 'CODi_Agit.',
        'description' => '제가 생각하고 해보고 느낀것, 좋아하는 것들을 모아놓은 아지트입니다.',
        'currentPage' => 'home'
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $isTypeAvailable = isset($_GET['type']) ? $_GET['type'] : "";
    $selectedType = $connect -> real_escape_string(trim($isTypeAvailable));
?>

<!DOCTYPE html>
<html lang="ko" >
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="home">
            <section class="container-inner">
                <?php include $rootPath . "/src/components/routes/home/section_post_showcase.php"; ?>
                <?php include $rootPath . "/src/components/routes/home/section_post_all.php"; ?>
                <?php include $rootPath . "/src/components/routes/home/section_post_tab.php"; ?>
                <?php include $rootPath . "/src/components/routes/home/section_post_specific.php"; ?>

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
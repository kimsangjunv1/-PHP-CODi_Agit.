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
?>

<!DOCTYPE html>
<html lang="ko" >
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <!-- skip -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- skip END -->

        <!-- header -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- header END -->
        
        <!-- main -->
        <main id="home">
            <section class="container-inner">
                <?php include $rootPath . "/src/components/routes/home/section_post_showcase.php"; ?>

                <!-- 모든 -->
                <?php include $rootPath . "/src/components/routes/home/section_post_all.php"; ?>

                
                <!-- 게시물 컴포넌트 -->
                <?php include $rootPath . "/src/components/routes/home/section_post_specific.php"; ?>
                <!-- 모든 END -->
            </section>    
        </main>
        <!-- main END -->

        <!-- footer -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- footer END -->

        <script type="module" defer>
            import { pageController } from "/src/assets/js/pageController.js";

            pageController.home.showcase();
        </script>
    </body>
</html>
<?php
    // SEO
    $seo = [
        'title' => '코디 피드',
        'description' => '내 블로그야~',
        'currentPage' => 'home'
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/connect/connect.php";
    include $rootPath . "/connect/session.php";
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
                <!-- 최근 -->
                <?php include $rootPath . "/src/components/routes/home/section_post_recent.php"; ?>
                <!-- 최근 END -->

                <!-- 모든 -->
                <?php include $rootPath . "/src/components/routes/home/section_post_all.php"; ?>
                <!-- 모든 END -->
            </section>    
        </main>
        <!-- main END -->

        <!-- footer -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- footer END -->
    </body>
</html>
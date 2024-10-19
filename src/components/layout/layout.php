<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="home">
            <section class="container-inner">
                <!-- 각 페이지별로 다른 내용이 여기에 들어감 -->
                <?php include $pageContent; ?>
            </section>
        </main>
        
        <?php include $rootPath . "/src/components/layout/footer.php"; ?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
    </body>
</html>
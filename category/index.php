<?php
    // 페이지 세팅
    if (isset($_GET['page'])) {
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;

    //echo $_GET['page'];
    //1~20  --> 1page  : DESC 0,  20  ---> ($viewNum * 1) - $viewNum
    //21~40 --> 2page  : DESC 20, 20  ---> ($viewNum * 2) - $viewNum
    //41~60 --> 3page  : DESC 40, 20  ---> ($viewNum * 3) - $viewNum
    //61~80 --> 4page  : DESC 60, 20  ---> ($viewNum * 4) - $viewNum

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

    $selectedType = $connect -> real_escape_string(trim($_GET['type']));
    $type = $_GET['type'];

    // 등급이 2인 사람만 가능하게
    if (isset($_SESSION['youGrade'])) {
        $memberGrade = $_SESSION['youGrade'];
    } else {
        $memberGrade = 0;
    };
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>

    <body>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="category">
            <section class="container-inner">
                <?php
                    $pathName = "category";

                    include $rootPath . "/src/components/routes/category/section_post_tab.php"; 
                ?>

                <article class="contents">
                    <!-- 게시물 컴포넌트 -->
                    <article id="list">
                        <?php 
                            // 필요한 데이터를 정의
                            $isVertical = true;
                            $isNeedDate = true;
                            
                            if ($selectedType) {
                                $postQuery = "
                                    SELECT b.postID, b.postTitle, b.postContents, b.postCategory, m.youName, b.regTime, b.postView, b.postLike, b.postImgFileUrl
                                    FROM boardPost b
                                    JOIN boardMember m
                                    ON (b.memberID = m.memberID)
                                    WHERE postCategory = '{$selectedType}'
                                    ORDER BY postID DESC
                                ";
                            } else {
                                $postQuery = "
                                    SELECT b.postID, b.postTitle, b.postContents, b.postCategory, m.youName, b.regTime, b.postView, b.postLike, b.postImgFileUrl
                                    FROM boardPost b
                                    JOIN boardMember m
                                    ON (b.memberID = m.memberID)
                                    ORDER BY postID DESC
                                ";          
                            }
        
                            include $rootPath . "/src/components/common/component_post.php";
                        ?>
                    </article>
                    <!-- 게시물 컴포넌트 END -->
    
                    <!-- 페이지네이션 컴포넌트 -->
                    <?php 
                        // 필요한 데이터를 정의
                        $pathName = "category";
    
                        include $rootPath . "/src/components/common/component_pagination.php";
                    ?>
                    <!-- 페이지네이션 컴포넌트 END -->

                    <?php
                        $currentPath = "category";

                        if ($memberGrade == 2) {
                            echo "
                                <a href='/{$currentPath}/write?type={$type}' class='floating'>
                                    <img src='/src/assets/images/icon/ico-write.svg' alt='글쓰기'>
                                </a>
                            ";
                        };
                    ?>
                </article>

                <?php include $rootPath . "/src/components/common/component_search.php"; ?>
            </section>
        </main>
        
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
    </body>
</html>
<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // SEO
    $seo = [
        'title' => '카테고리 검색결과',
        'description' => '에 검색하신 결과 입니다.',
    ];

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
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="result">
            <section class="container-inner">
                <?php
                    $searchKeyword = $connect -> real_escape_string(trim($_POST['keyword']));
                    $searchOption = $connect -> real_escape_string(trim($_POST['option']));
                    
                    switch($searchOption){
                        case "title" : 
                            $searchWhere = "WHERE b.postTitle";
                            break;
            
                        case "content" : 
                            $searchWhere = "WHERE b.postContents";
                            break;
            
                        case "name" : 
                            $searchWhere = "WHERE m.youName";
                            break;
                    };

                    // 필요한 데이터를 정의
                    $isSearch = false;          // 찾기를 위한 컴포넌트인지
                    $isVertical = false;
                    $isNeedContents = true;
                    $isNeedDate = true;
                    // $limit = 5;                 // 찾을 갯수 제한
                    $postQuery = "
                        SELECT b.postID, b.postTitle, b.postContents, b.postCategory, m.youName, b.regTime, b.postView, b.postLike, b.postImgFileUrl
                        FROM boardPost b
                        JOIN boardMember m
                        ON (b.memberID = m.memberID)
                        {$searchWhere}
                        LIKE '%{$searchKeyword}%'
                        ORDER BY postID DESC
                    ";

                    include $rootPath . "/src/components/common/component_post.php";
                ?>

                <?php 
                    // 필요한 데이터를 정의
                    $pathName = "category";

                    include $rootPath . "/src/components/common/component_pagination.php";
                ?>

                <?php include $rootPath . "/src/components/common/component_search.php"; ?>
                <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
            </section>
        </main>

        <?php include $rootPath . "/src/components/layout/footer.php"?>
    </body>
</html>
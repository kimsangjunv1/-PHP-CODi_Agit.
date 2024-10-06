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
        <!-- 스킵 -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- 스킵 END -->

        <!-- 헤더 -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- 헤더 END -->

        <!-- 메인 -->
        <main id="main">
            <section class="container-inner search">
                <!-- 게시판 타이틀 -->
                <article id="title">
                    <h2>검색</h2>
                    <p>OOO을 검색한 결과입니다.</p>
                </article>
                <!-- 게시판 타이틀 END -->

                <!-- 검색 컴포넌트 -->
                <?php 
                    // 필요한 데이터를 정의
                    $isSearch = true;
                    $tableName = "boardPost";
                    $actionPath = "/category/search";  // 검색 처리할 경로
                    $placeholder = "검색어를 입력하세요";
                    $title = "검색";
                    $currentPath = "category";
                    $select = [
                        ["title" => "title", "desc" => "제목"],
                        ["title" => "content", "desc" => "내용"],
                        ["title" => "author", "desc" => "작성자"]
                    ];
                    $postQuery = "
                        SELECT b.postID, b.postTitle, m.youName, b.regTime, b.postCategory, b.postView, b.postContents, b.postImgFileUrl
                        FROM boardPost b
                        JOIN boardMember m
                        ON (b.memberID = m.memberID)
                    ";
                    $orderRule = "ORDER BY postID DESC";

                    include $rootPath . "/src/components/common/component_search.php";
                ?>
                <!-- 검색 컴포넌트 END -->

                <!-- 게시물 컴포넌트 -->
                <?php 
                    // 필요한 데이터를 정의
                    $isSearch = true;
                    $isVertical = true;

                    include $rootPath . "/src/components/common/component_post.php";
                ?>
                <!-- 게시물 컴포넌트 END -->

                <!-- 페이지네이션 컴포넌트 -->
                <?php 
                    // 필요한 데이터를 정의
                    $pathName = "devlog";

                    include $rootPath . "/src/components/common/component_pagination.php";
                ?>
                <!-- 페이지네이션 컴포넌트 END -->
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>
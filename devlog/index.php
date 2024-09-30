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
        'title' => '데브로그',
        'description' => '오류해결과 관련된 팁들을 모아놨어요!',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/connect/connect.php";
    include $rootPath . "/connect/session.php";
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
        <main id="devlog">
            <section class="container-inner">
                <!-- 게시판 타이틀 -->
                <article class="title">
                    <h2>데브로그</h2>
                    <p>개발일지를 올리는 곳입니다.</p>
                </article>
                <!-- 게시판 타이틀 END -->

                <!-- 검색 컴포넌트 -->
                <?php 
                    // 필요한 데이터를 정의
                    $isSearch = false;
                    $tableName = "boardDevlog";
                    $currentPath = "devlog";  // 검색 처리할 경로
                    $placeholder = "검색어를 입력하세요";
                    $title = "검색";
                    $select = [
                        ["title" => "title", "desc" => "제목"],
                        ["title" => "content", "desc" => "내용"],
                        ["title" => "author", "desc" => "작성자"]
                    ];
                    $postQuery = "
                        SELECT count(postID) AS totalPosts FROM boardDevlog
                        ORDER BY postID DESC
                    ";

                    include $rootPath . "/src/components/common/component_search.php";
                ?>
                <!-- 검색 컴포넌트 END -->

                <!-- 게시물 컴포넌트 -->
                <?php 
                    // 필요한 데이터를 정의
                    $postQuery = "
                        SELECT b.postID, b.postTitle, m.youName, b.regTime, b.postView
                        FROM boardDevlog b
                        JOIN classMember m
                        ON (b.memberID = m.memberID)
                        ORDER BY postID DESC
                        LIMIT {$viewLimit}, {$viewNum}
                    ";

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
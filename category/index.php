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
        <main id="category">
            <section class="container-inner">
                <aside class="menu">
                    <div class="item">
                        <img src="/" alt="전체보기">
                        <a href="/category?type=">전체보기</a>
                    </div>
                    
                    <section>
                        <h4>Library</h4>

                        <div class="item">
                            <img src="/" alt="스와이퍼">
                            <a href="/category?type=programmers">Swiper</a>
                        </div>

                        <div class="item">
                            <img src="/" alt="MatterJS">
                            <a href="/category?type=matterjs">MatterJS</a>
                        </div>

                        <div class="item">
                            <img src="/" alt="Framer-Motion">
                            <a href="/category?type=framermotion">Framer-Motion</a>
                        </div>
                    </section>
                    
                    <section>
                        <h4>Framework</h4>
                        
                        <div>
                            <img src="/" alt="아이콘">
                            <a href="/category?type=programmers">Svelte</a>
                        </div>
                        <div>
                            <img src="/" alt="아이콘">
                            <a href="/category?type=programmers">React</a>
                        </div>
                    </section>

                    <section>
                        <h4>Backend</h4>
                        
                        <div>
                            <img src="/" alt="아이콘">
                            <a href="/category?type=php">php</a>
                        </div>
                        <div>
                            <img src="/" alt="아이콘">
                            <a href="/category?type=mongodb">MongoDB</a>
                        </div>
                    </section>

                    <section>
                        <h4>개인 공부</h4>
                        
                        <div class="<?= $selectedType == 'programmers' ? 'active' : '' ?>">
                            <img src="/" alt="아이콘">
                            <a href="/category?type=programmers">프로그래머스</a>
                        </div>

                        <div class="<?= $selectedType == 'tip' ? 'active' : '' ?>">
                            <img src="/" alt="아이콘">
                            <a href="/category?type=tip">팁</a>
                        </div>
                    </section>
                </aside>

                <div class="contents">
                    <!-- 게시판 타이틀 -->
                    <article id="title">
                        <h2>
                            <?php
                                echo $selectedType ? $selectedType : "모든 게시물";
                            ?>
                        </h2>
                        <p>개발일지를 올리는 곳입니다.</p>
                    </article>
                    <!-- 게시판 타이틀 END -->
    
                    <!-- 검색 컴포넌트 -->
                    <?php 
                        // 필요한 데이터를 정의
                        $isSearch = false;
                        $tableName = "boardPost";
                        $currentPath = "category";  // 검색 처리할 경로
                        $placeholder = "검색어를 입력하세요";
                        $title = "검색";
                        $select = [
                            ["title" => "title", "desc" => "제목"],
                            ["title" => "content", "desc" => "내용"],
                            ["title" => "author", "desc" => "작성자"]
                        ];
                        $postQuery = "
                            SELECT count(postID) AS totalPosts FROM boardPost
                            ORDER BY postID DESC
                        ";
    
                        include $rootPath . "/src/components/common/component_search.php";
                    ?>
                    <!-- 검색 컴포넌트 END -->
    
                    <!-- 게시물 컴포넌트 -->
                    <article id="list">
                        <?php 
                            // 필요한 데이터를 정의
                            $isVertical = true;
                            
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
                        $pathName = "devlog";
    
                        include $rootPath . "/src/components/common/component_pagination.php";
                    ?>
                    <!-- 페이지네이션 컴포넌트 END -->
                </div>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>
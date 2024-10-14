<?php

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    
    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $searchKeyword = isset($_POST['keyword']) ? 
        $connect->real_escape_string(trim($_POST['keyword'])) : 
        (isset($_GET['keyword']) ? $connect->real_escape_string(trim($_GET['keyword'])) : '');
    $searchOption = $connect -> real_escape_string(trim($_POST['option']));

    // SEO
    $seo = [
        'title' => '"' . $searchKeyword . '"의 검색결과',
        'description' => '"' . $searchKeyword . '"의 검색결과에 대한 내역입니다.',
    ];

    // --------------------------------------------------------------------
    // --------------------------------------------------------------------
    // --------------------------------------------------------------------

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
            
        default : 
            $searchWhere = "";
            break;
    };

    // 필요한 데이터를 정의
    $isSearch = false;          // 찾기를 위한 컴포넌트인지
    $isVertical = true;
    $isNeedContents = false;
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

    $sql = $postQuery;
    $result = $connect -> query($postQuery);
    $count = $result -> num_rows;
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
                    $isSearchRoute = true;

                    include $rootPath . "/src/components/common/component_search.php";
                ?>

                <article class="info">
                    <h2>"<?php echo $searchKeyword ?>" 의 검색결과</h2>
                    <p><?php echo $count ?></p>
                </article>

                <article class="contents">
                    <article id="list">
                        <?php

                            include $rootPath . "/src/components/common/component_post.php";
                        ?>
                    </article>

                    <?php 
                        // 필요한 데이터를 정의
                        $pathName = "search";

                        include $rootPath . "/src/components/common/component_pagination.php";
                    ?>
                </article>
            </section>
        </main>
        
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
    </body>
</html>
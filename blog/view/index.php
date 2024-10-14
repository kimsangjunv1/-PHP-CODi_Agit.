<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];
    
    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $postID = isset($_GET['postID']) ? (int)$_GET['postID'] : 0;

    if ($postID <= 0) {
        header("Location: /error/");
        exit();
    }

    $likeSql = "
        SELECT b.postID FROM boardLikes b WHERE b.postID = {$postID}
    ";

    $result = $connect -> query($likeSql);

    $countLikes = $result -> num_rows;

    // 보드뷰 + 1(UPDATE)
    $sql = "UPDATE boardPost SET postView = postView + 1 WHERE postID = {$postID}";
    $connect -> query($sql);

    $sql = "
        SELECT b.postTitle, b.memberID, m.youName, b.regTime, b.postView, b.postContents, b.postCategory, b.postImgFileUrl
        FROM boardPost b
        JOIN boardMember m
        ON(m.memberID = b.memberID)
        WHERE b.postID = {$postID}
    ";
    
    $result = $connect -> query($sql);

    if ($result) {
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        // 데이터베이스에서 포스트 내용 가져오기
        $postContents = $info['postContents'];

        // 마크다운을 HTML로 변환
        $formattedContents = $postContents;
    }

    // SEO
    $seo = [
        'title' => $info['postTitle'],
        'description' => $info['postTitle'],
    ];

    if (isset($_SESSION['youGrade'])) {
        $memberGrade = $_SESSION['youGrade'];
    } else {
        $memberGrade = 0;
    };

    if (isset($_SESSION['memberID'])) {
        $memberID = $_SESSION['memberID'];
    }
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="category" class="view">
            <section class="container-inner">
                <article class="header">
                    <?php
                        echo "
                            <img src='" . $info['postImgFileUrl'] . "' alt='썸네일'>
                            
                            <div>
                                <h2 class='title'>".$info['postTitle']."</h2>

                                <div>
                                    <p class='author'>".$info['youName']."</p>
                                    <p>•</p>
                                    <p class='date'>".date('Y-m-d H:i', $info['regTime'])."</p>
                                </div>
                            </div>
                        ";
                    ?>
                </article>

                <article class="main sun-editor-editable">
                    <?php
                        $item = htmlspecialchars($info['postContents']);
                        $convert = str_replace('&lt;br&gt;', "\n", $item);
                        echo htmlspecialchars_decode($convert);
                    ?>
                </article>

                <article class="footer">
                    <section class="modify">
                        <?php
                            $postID = $connect -> real_escape_string(trim($_GET['postID']));
    
                            if ($memberGrade == 2) {
                                echo "<a href='/blog/modify?postID={$postID}'>수정하기</a>";
                                echo "<a href='/blog/modify/remove?postID={$postID}'>삭제하기</a>";
                            };

                            echo "<a href='/blog/?type={$info['postCategory']}'>목록보기</a>";
                        ?>
                    </section>

                    <section class="status">
                        <?php
                            echo "
                                <button type='button' class='item like'>
                                    <img src='/src/assets/images/icon/ico-like-stroke.svg' alt='좋아요'>
                                    <p class='countLike'>{$countLikes}</p>
                                </button>
                                <button type='button' class='item'>
                                    <img src='/src/assets/images/icon/ico-view.svg' alt='조회수'>
                                    <p class='countView'>{$info['postView']}</p>
                                </button>

                                <input type='hidden' name='postID' id='postID' value='".$postID."' />
                            ";
                        ?>
                    </section>
                </article>

                <!-- 추천 포스트 -->
                <!-- 추천 포스트 END -->

                <?php include $rootPath . "/src/components/common/component_search.php"; ?>
            </section>
        </main>

        <?php include $rootPath . "/src/components/layout/footer.php"?>
    </body>

    <!-- giscus 임시 비활성화 2024.10.13 -->
    <!-- <script src="https://giscus.app/client.js"
            data-repo="kimsangjunv1/-PHP-CODi_Agit."
            data-repo-id="R_kgDOIhytwg"
            data-category="Q&A"
            data-category-id="DIC_kwDOIhytws4CjTiC"
            data-mapping="url"
            data-strict="0"
            data-reactions-enabled="1"
            data-emit-metadata="0"
            data-input-position="top"
            data-theme="light"
            data-lang="ko"
            data-loading="lazy"
            crossorigin="anonymous"
            async>
    </script> -->

    <script type="module" defer>
        import { pageController } from "/src/assets/js/pageController.js";
        import { hljs } from "/src/utils/highlight.min.js";

        pageController.category.view();
        pageController.common.sendLike();
        hljs.highlightAll();
    </script>
</html>
<?php
    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];
    
    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";

    $postID = $_GET['postID'];

    // 보드뷰 + 1(UPDATE)
    $sql = "UPDATE boardPost SET postView = postView + 1 WHERE postID = {$postID}";
    $connect -> query($sql);

    $sql = "
        SELECT b.postTitle, m.youName, b.regTime, b.postView, b.postLike, b.postContents, b.postCategory, b.postImgFileUrl
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
                    <section>
                        <?php
                            $postID = $connect -> real_escape_string(trim($_GET['postID']));
    
                            if ($memberGrade == 2) {
                                echo "<a href='/category/modify?postID={$postID}'>수정하기</a>";
                                echo "<a href='/category/modify/remove?postID={$postID}'>삭제하기</a>";
                            };

                            echo "<a href='/category/?type={$info['postCategory']}'>목록보기</a>";
                        ?>
                    </section>
                    <section>
                        <?php
                            echo "
                                <div class='item'>
                                    <img src='/src/assets/images/icon/ico-like-stroke.svg' alt='좋아요'>
                                    <p class='like'>{$info['postLike']}</p>
                                </div>
                                <div class='item'>
                                    <img src='/src/assets/images/icon/ico-view.svg' alt='조회수'>
                                    <p class='view'>{$info['postView']}</p>
                                </div>
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

    <script type="module" defer>
        import { pageController } from "/src/assets/js/pageController.js";
        import { hljs } from "/src/utils/highlight.min.js";

        pageController.category.view();
        hljs.highlightAll();
    </script>
</html>
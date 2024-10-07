<?php
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

    // Parsedown 포함
    include $rootPath . '/src/components/common/component_parsedown.php';

    $postID = $_GET['postID'];
    $parsedown = new Parsedown();

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
        $formattedContents = $parsedown->text($postContents);
    }
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
        <!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet"> -->
    </head>
    
    <body>
        <!-- 스킵 -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- 스킵 END -->

        <!-- 헤더 -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- 헤더 END -->
        
        <!-- 메인 -->
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

                <article class="main">
                    <?php echo $formattedContents; ?>
                </article>

                <article class="footer">
                    <section>
                        <?php
                            echo "<div class='view'>".$info['postView']."</div>";
                            echo "<div class='like'>".$info['postLike']."</div>";
                        ?>
                    </section>
                    <section>
                        <?php
                            $postID = $connect -> real_escape_string(trim($_GET['postID']));

                            echo "
                                <a href='/category/modify?postID={$postID}'>수정하기</a>
                                <a href='/category/modify/remove?postID={$postID}'>삭제하기</a>
                                <a href='/category/?type={$info['postCategory']}'>목록보기</a>
                            ";
                        ?>
                    </section>
                </article>

                <!-- 추천 포스트 -->
                <!-- 추천 포스트 END -->
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>

    <script>
        const test = document.querySelector("#header");
        test.classList.add("transparent");
    </script>
</html>
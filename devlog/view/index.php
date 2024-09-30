<?php
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
        <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
    </head>
    
    <body>
        <!-- 스킵 -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- 스킵 END -->

        <!-- 헤더 -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- 헤더 END -->
        
        <!-- 메인 -->
        <main id="devlog" class="view">
            <section class="container-inner">
                <article>
                    <h2>게시판</h2>
                    <p>게시판 설명이 들어갈 자리입니다.</p>
                </article>

                <article>
                    <?php
                        // Parsedown 포함
                        include $rootPath . '/src/components/common/component_parsedown.php';

                        $postID = $_GET['postID'];
                        $parsedown = new Parsedown();

                        // 보드뷰 + 1(UPDATE)
                        $sql = "UPDATE boardDevlog SET postView = postView + 1 WHERE postID = {$postID}";
                        $connect -> query($sql);
                        $sql = "SELECT b.postTitle, m.youName, b.regTime, b.postView, b.postContents FROM boardDevlog b JOIN classMember m ON(m.memberID = b.memberID) WHERE b.postID = {$postID}";
                        $result = $connect -> query($sql);

                        if ($result) {
                            $info = $result -> fetch_array(MYSQLI_ASSOC);

                            // 데이터베이스에서 포스트 내용 가져오기
                            $postContents = $info['postContents'];

                            // 마크다운을 HTML로 변환
                            $formattedContents = $parsedown->text($postContents);

                            echo "<div class='title'>".$info['postTitle']."</div>";
                            echo "<div class='author'>".$info['youName']."</div>";
                            echo "<div class='date'>".date('Y-m-d H:i', $info['regTime'])."</div>";
                            echo "<div class='view'>".$info['postView']."</div>";
                            echo "<div class='toastui-editor-contents'>".$formattedContents."</div>";
                        }
                    ?>
                </article>

                <article>
                    <?php
                        $postID = $connect -> real_escape_string(trim($_GET['postID']));

                        echo "
                            <a href='/devlog/modify?postID={$postID}'>수정하기</a>
                            <a href='/devlog/modify/remove?postID={$postID}'>삭제하기</a>
                            <a href='/devlog'>목록보기</a>
                        ";
                    ?>
                </article>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>
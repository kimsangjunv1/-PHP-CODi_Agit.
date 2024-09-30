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
        <main id="devlog" class="write">
            <section class="container-inner">
                <article>
                    <h2>게시물 작성</h2>
                    <p>게시물 작성을 위한 섹션입니다.</p>
                </article>

                <article>
                    <form 
                        id="form"
                        method="post"
                        action="/devlog/write/save"
                        enctype="multipart/form-data"
                    >
                        <fieldset>
                            <legend>게시판 작성 영역</legend>

                            <section>
                                <label for="postTitle">제목</label>
                                <input type="text" name="postTitle" id="postTitle">
                            </section>

                            <section>
                                <label for="postContents">내용</label>
                                <textarea name="postContents" id="postContents" style="display:none;"></textarea>
                                <input type="hidden" name="postImgFileUrl" id="postImgFileUrl" value="">
                                <div id="editor"></div>
                            </section>
                            
                            <section>
                                <button type="submit">저장하기</button>
                            </section>
                        </fieldset>
                    </form>
                </article>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->

        <!-- 스크립트 -->
        <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js" defer></script>
        <script type="module" defer>
            import { pageController } from '/src/assets/js/pageController.js'; // 경로를 확인하세요

            pageController.devlog.write();  // devlog 함수 추출
            pageController.common.sendFormContents();  // devlog 함수 추출
        </script>
        <!-- 스크립트 -->
    </body>
</html>
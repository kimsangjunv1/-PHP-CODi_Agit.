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
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>

        <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor.css" rel="stylesheet"> -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor-contents.css" rel="stylesheet"> -->
        <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
        <!-- languages (Basic Language: English/en) -->
        <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/ko.js"></script>

        <!-- https://github.com/codemirror/CodeMirror -->
        <!-- codeMirror (^5.0.0) -->
        <!-- Use version 5.x.x -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.css">
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/htmlmixed/htmlmixed.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/xml/xml.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/css/css.js"></script>
    </head>
    <body>
        <!-- 스킵 -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- 스킵 END -->

        <!-- 헤더 -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- 헤더 END -->
        
        <!-- 메인 -->
        <main id="category" class="write">
            <section class="container-inner">
                <article>
                    <form 
                        id="form"
                        method="post"
                        action="/category/write/save"
                        enctype="multipart/form-data"
                    >
                        <fieldset>
                            <legend class="blind">게시판 작성 영역</legend>

                            <section>
                                <label for="postTitle" class="blind">제목</label>
                                <input type="text" name="postTitle" placeholder="제목을 입력해주세요." id="postTitle" class="input border">
                            </section>

                            <section>
                                <label for="postCategory" class="blind">카테고리</label>
                                <select name="postCategory" id="postCategory" class="input border">
                                    <option value="programmers" default>프로그래머스</option>
                                    <option value="tip">팁</option>
                                    <option value="js">자바스크립트</option>
                                </select>
                            </section>
                            
                            <section>
                                <label for="postThumbnail" class="blind">썸네일</label>
                                <input type="file" accept="image/*" class="button border lg">
                                <input type="hidden" name="postImgFileUrl" id="postImgFileUrl" value="">
                            </section>

                            <section>
                                <label for="postContents" class="blind">내용</label>
                                <textarea name="postContents" id="postContents">내용을 입력해주세요.</textarea>
                            </section>
                            
                            <section>
                                <button type="submit" class="button black lg">저장하기</button>
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
        <script type="module" defer>
            import { pageController } from "/src/assets/js/pageController.js"; // 경로를 확인하세요

            const input = document.querySelector('input[type="file"]');
            const inputUrlElements = document.querySelector("#postImgFileUrl");

            input.addEventListener("change", async (event) => {
                const file = event.target.files[0];

                if (file) {
                    const data = await pageController.common.saveImgToUrl(file); // 파일을 URL로 반환받음
                    inputUrlElements.value = data;
                }
            });

            pageController.category.writeNew();
        </script>
        <!-- 스크립트 -->
    </body>
</html>
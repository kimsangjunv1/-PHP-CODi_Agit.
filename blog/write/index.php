<?php
    // SEO
    $seo = [
        'title' => '글 작성',
        'description' => '게시물 작성을 위한 페이지에요.',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";
    include $rootPath . "/src/components/common/component_grade_check.php";

    $selectedType = $_GET['type'];
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>

        <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/ko.js"></script>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.css">
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/lib/codemirror.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/htmlmixed/htmlmixed.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/xml/xml.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/codemirror@5.49.0/mode/css/css.js"></script>
    </head>
    <body>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="category" class="write">
            <section class="container-inner">
                <article>
                    <form 
                        id="form"
                        method="post"
                        action="/blog/write/save"
                        enctype="multipart/form-data"
                    >
                        <fieldset>
                            <legend class="blind">게시판 작성 영역</legend>

                            <section>
                                <label for="postCategory" class="blind">카테고리</label>
                                <select name="postCategory" id="postCategory" class="select">
                                    <?php
                                        $option = "option";
                                
                                        include $rootPath . "/src/components/common/component_category.php";
                                    ?>
                                </select>
                            </section>

                            <section>
                                <label for="postTitle" class="blind">제목</label>
                                <input type="text" name="postTitle" placeholder="제목을 입력해주세요." id="postTitle" class="input underline">
                            </section>

                            <section>
                                <label for="postContents" class="blind">내용</label>
                                <textarea name="postContents" id="postContents">내용을 입력해주세요.</textarea>
                            </section>

                            <section>
                                <label for="postThumbnail">기존 썸네일</label>
                                <input type="file" accept="image/*" class="input underline">
                                <input type="hidden" name="postImgFileUrl" id="postImgFileUrl" value="">
                            </section>
                            
                            <section>
                                <button type="submit" class="button brand lg">저장하기</button>
                            </section>
                        </fieldset>
                    </form>
                </article>

                <?php include $rootPath . "/src/components/common/component_search.php"; ?>
            </section>
        </main>
        
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>

        <script type="module" defer>
            import { pageController } from "/src/assets/js/pageController.js"; // 경로를 확인하세요
            import { hljs } from "/src/utils/highlight.min.js";

            const input = document.querySelector('input[type="file"]');
            const inputUrlElements = document.querySelector("#postImgFileUrl");

            input.addEventListener("change", async (event) => {
                const file = event.target.files[0];

                if (file) {
                    const data = await pageController.common.saveImgToUrl(file); // 파일을 URL로 반환받음
                    inputUrlElements.value = data;
                }
            });

            hljs.highlightAll();
            pageController.category.writeNew();
            pageController.category.view();
        </script>
        <!-- 스크립트 -->
    </body>
</html>
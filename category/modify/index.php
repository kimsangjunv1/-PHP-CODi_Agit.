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
    include $rootPath . "/src/components/common/component_session_check.php";
    include $rootPath . "/src/components/common/component_grade_check.php";

    $postID = $_GET['postID'];

    $sql = "SELECT postID, postTitle, postContents, postCategory, postImgFileUrl FROM boardPost WHERE postID = {$postID}";
    $result = $connect -> query($sql);

    isset($result) && $info = $result -> fetch_array(MYSQLI_ASSOC);
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
        <?php $target = htmlspecialchars($info['postContents']); ?>
        <?php include $rootPath . "/src/components/layout/header.php"; ?>

        <main id="category" class="modify">
            <section class="container-inner">
                <article>
                    <form
                        id="form"
                        method="post"
                        name="boardModify"
                        action="/category/modify/save"
                        enctype="multipart/form-data"
                    >
                        <fieldset>
                            <legend class="blind">게시판 수정 영역</legend>
                            <?php echo "<input type='hidden' name='postID' id='postID' value='".$info['postID']."' />"; ?>

                            <section>
                                <label for="postCategory" class="blind">카테고리</label>
                                <select name="postCategory" id="postCategory" class="select">
                                    <option value="programmers" <? echo $info['postCategory'] == 'programmers' ? "selected" : '' ?> >프로그래머스</option>
                                    <option value="tip" <?php echo $info['postCategory'] == 'tip' ? 'selected' : '' ?> >팁</option>
                                    <option value="js" <?php echo $info['postCategory'] == 'js' ? 'selected' : '' ?> >자바스크립트</option>
                                </select>
                            </section>

                            <section>
                                <label for="postTitle" class="blind">제목</label>
                                <?php echo "<input type='text' name='postTitle' id='postTitle' value='".$info['postTitle']."' class='input underline' />" ?>
                            </section>

                            <section>
                                <label for="postContents" class="blind">내용</label>
                                <?php
                                    $formattedContent = htmlspecialchars($info['postContents'], ENT_QUOTES, 'UTF-8');
                                    echo "<textarea name='postContents' id='postContents' rows='20' style='display:none;'>$formattedContent</textarea>";
                                ?>
                            </section>

                            <section>
                                <?php echo "<img src='".$info['postImgFileUrl']."' alt=''>" ?>
                                
                                <label for="postThumbnail" class="blind">썸네일</label>
                                <?php echo "<input type='file' accept='image/*' class='input border' value=''>" ?>
                                <?php echo "<input type='hidden' name='postImgFileUrl' id='postImgFileUrl' value='".$info['postImgFileUrl']."'>" ?>
                            </section>

                            <section>
                                <?php echo "<input type='password' name='youPass' id='youPass' placeholder='로그인 비밀번호를 입력해주세요!'autocomplete='off' class='input border' required />" ?>
                                <button type="submit" value="수정하기" class="button brand lg" >수정하기</button>
                            </section>
                        </fieldset>
                    </form>
                </article>
            </section>
        </main>

        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>

        <script type="module" defer>
            import { pageController } from '/src/assets/js/pageController.js'; // 경로를 확인하세요
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

            let valueContents = document.querySelector("#postContents").value;

            pageController.category.modifyNew(valueContents);  // category 함수 추출
            hljs.highlightAll();
        </script>
        <!-- 스크립트 -->
    </body>
</html>
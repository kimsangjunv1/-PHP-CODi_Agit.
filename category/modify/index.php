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

    $postID = $_GET['postID'];

    $sql = "SELECT postID, postTitle, postContents, postCategory FROM boardPost WHERE postID = {$postID}";
    $result = $connect -> query($sql);

    isset($result) && $info = $result -> fetch_array(MYSQLI_ASSOC);
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
                                <select name="postCategory" id="postCategory" class="input border">
                                    <option value="programmers" <? echo $info['postCategory'] == 'programmers' ? "selected" : '' ?> >프로그래머스</option>
                                    <option value="tip" <?php echo $info['postCategory'] == 'tip' ? 'selected' : '' ?> >팁</option>
                                    <option value="js" <?php echo $info['postCategory'] == 'js' ? 'selected' : '' ?> >자바스크립트</option>
                                </select>
                            </section>

                            <section>
                                <label for="postTitle" class="label">제목</label>
                                <?php echo "<input type='text' name='postTitle' id='postTitle' value='".$info['postTitle']."' class='input border' />" ?>
                            </section>

                            <section>
                                <label for="postContents" class="label">내용</label>
                                <?php echo "<textarea name='postContents' id='postContents' rows='20' style='display:none;'>".$info['postContents']."</textarea>" ?>
                                <input type="hidden" name="postImgFileUrl" id="postImgFileUrl" value="">
                                <div id="editor"></div>
                            </section>

                            <section>
                                <?php echo "<input type='password' name='youPass' id='youPass' placeholder='로그인 비밀번호를 입력해주세요!'autocomplete='off' class='input border' required />" ?>
                                <button type="submit" value="수정하기" class="button black lg" >수정하기</button>
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
            import { pageController } from '/src/assets/js/pageController.js'; // 경로를 확인하세요

            let valueContents = document.querySelector("#postContents").value;
            console.log("잔딜 받은 내용 : ", valueContents)

            pageController.category.modifyNew(valueContents);  // category 함수 추출
            // pageController.common.sendFormContents();  // category 함수 추출
        </script>
        <!-- 스크립트 -->
    </body>
</html>
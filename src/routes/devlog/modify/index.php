<?php
    // SEO
    $seo = [
        'title' => '데브로그',
        'description' => '오류해결과 관련된 팁들을 모아놨어요!',
    ];

    // 최상위 경로
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    // MySQL 연결
    include $rootPath . "/src/components/common/component_connect.php";
    include $rootPath . "/src/components/common/component_session.php";
    include $rootPath . "/src/components/common/component_session_check.php";

    $postID = $_GET['postID'];

    $sql = "SELECT postID, postTitle, postContents FROM boardDevlog WHERE postID = {$postID}";
    $result = $connect -> query($sql);

    if (isset($result)) {
        $info = $result -> fetch_array(MYSQLI_ASSOC);
    }
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
        <main id="devlog" class="modify">
            <section class="container-inner">
                <article>
                    <h3>게시판</h3>
                    <p> 게시판 설명이 들어갈 자리입니다.</p>
                </article>

                <article>
                    <form
                        id="form"
                        method="post"
                        name="boardModify"
                        action="/src/routes/devlog/modify/save/save"
                        enctype="multipart/form-data"
                    >
                        <fieldset>
                            <legend>게시판 수정 영역</legend>
                            <?php echo "<input type='hidden' name='postID' id='postID' value='".$info['postID']."' />"; ?>

                            <section>
                                <label for="postTitle">제목</label>
                                <?php echo "<input type='text' name='postTitle' id='postTitle' value='".$info['postTitle']."' />" ?>
                            </section>

                            <section>
                                <label for="postContents">내용</label>
                                <?php echo "<textarea name='postContents' id='postContents' rows='20' style='display:none;'>".$info['postContents']."</textarea>" ?>
                                <input type="hidden" name="postImgFileUrl" id="postImgFileUrl" value="">
                                <div id="editor"></div>
                            </section>

                            <section>
                                <?php echo "<input type='password' name='youPass' id='youPass' placeholder='로그인 비밀번호를 입력해주세요!'autocomplete='off' required />" ?>
                                <button type="submit" value="수정하기" >수정하기</button>
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

            let valueContents = document.querySelector("#postContents").value;
            console.log("잔딜 받은 내용 : ", valueContents.replace(/<br\s*\/?>/gi, '\n'))

            pageController.devlog.modify(valueContents.replace(/<br\s*\/?>/gi, '\n'));  // devlog 함수 추출
            pageController.common.sendFormContents();  // devlog 함수 추출
        </script>
        <!-- 스크립트 -->
    </body>
</html>
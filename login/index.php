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
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include $rootPath . "/src/components/layout/head.php"; ?>
    </head>
    
    <body>
        <!-- 스킵 -->
        <?php include $rootPath . "/src/components/common/component_skip.php"; ?>
        <!-- 스킵 END -->

        <!-- 헤더 -->
        <?php include $rootPath . "/src/components/layout/header.php"; ?>
        <!-- 헤더 END -->
        
        <!-- 메인 -->
        <main id="login">
            <section class="container-inner">
                <article>
                    <h2>PHP BLOG</h2>
                    <p>
                        로그인을 하시면 댓글 작성이 가능해요,<br>
                        임시 로그인이 필요하시다면 하단의 게스트 로그인을 클릭해주세요!
                    </p>
                </article>

                <article>
                    <form name="login" action="/login/save" method="post">
                        <fieldset>
                            <legend class="blind">로그인 입력폼</legend>
                            <div>
                                <label class="blind" for="youEmail">이메일</label>
                                <input type="email" name="youEmail" id="youEmail" class="input_style4" placeholder="이메일" class="input__style" required>
                            </div>
                            <div>
                                <label class="blind" for="youPass">비밀번호</label>
                                <input type="password" name="youPass" id="youPass" class="input_style4" placeholder="비밀번호" class="input__style" required>
                            </div>
                            <button type="submit" class="btn_style5 mt20">로그인</button>
                        </fieldset>
                    </form>
                </article>

                <article>
                    <section>
                        <a href="/join">회원가입</a>
                        <a href="/login">게스트 로그인</a>
                    </section>
                    <section>
                        <a href="#">아이디 찾기</a>
                        <a href="#">비밀번호 찾기</a>
                    </section>
                </article>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>
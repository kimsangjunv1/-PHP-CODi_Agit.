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
                    <h2 class="login__logo">PHP BLOG</h2>
                    <p>
                        로그인을 하시면 게시글 및 댓글 작성이 가능합니다.<br>
                        회원가입을 하면 로그인을 할 수 있습니다.<br>
                        구경하시려면 admin@naver.com / 1234를 입력해주세요!
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
                    <ul>
                        <li>회원가입을 하지 않았다면 회원가입 먼저 해주세요! <a href="/join" class="link">회원가입</a></li>
                        <li>아이디가 기억이 나지 않는다면. <a href="#" class="link">아이디 찾기</a></li>
                        <li>비밀번호가 기억이 나지 않는다면. <a href="#" class="link">비밀번호 찾기</a></li>
                    </ul>
                </article>
            </section>
        </main>
        <!-- 메인 END -->

        <!-- 푸터 -->
        <?php include $rootPath . "/src/components/layout/footer.php"?>
        <!-- 푸터 END -->
    </body>
</html>
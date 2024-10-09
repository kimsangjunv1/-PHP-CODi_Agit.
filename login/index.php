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
    </head>
    
    <body>
        <!-- 메인 -->
        <main id="login">
            <section class="container-inner">
                <form action="/login/save" name="login" method="post">
                    <fieldset>
                        <article class="header">
                            <a href="/home">
                                <img src="/src/assets/images/common/img-logo-color.svg" alt="코디 아지트">
                            </a>
                        </article>

                        <article class="main">
                            <legend class="blind">로그인 입력폼</legend>
                            <div>
                                <label class="blind" for="youEmail">이메일</label>
                                <input type="email" name="youEmail" id="youEmail" class="input underline" placeholder="이메일을 입력해주세요" required>
                            </div>
                            <div>
                                <label class="blind" for="youPass">비밀번호</label>
                                <input type="password" name="youPass" id="youPass" class="input underline" placeholder="비밀번호를 입력해주세요" required>
                            </div>
                        </article>
                        
                        <article class="footer">
                            <section class="account">
                                <button type="submit" class="button black lg">로그인</button>
                                
                                <div>
                                    <hr>
                                    <p>간편하게 시작하기</p>
                                    <hr>
                                </div>
                                
                                <a href="/login/guest" class="button border lg">게스트 접속</a>
                            </section>
                            <!-- <section class="help">
                                <a href="#">아이디 찾기</a>
                                <hr>
                                <a href="#">비밀번호 찾기</a>
                                <hr>
                                <a href="/join">회원가입</a>
                            </section> -->
                            <section class="notice">
                                <p>회원가입 기능은 현재 임시 비활성화 상태입니다. <br />댓글 작성만 원하실 경우 게스트 로그인을 눌러주세요</p>
                            </section>
                        </article>
                    </fieldset>
                </form>
            </section>
        </main>
        <!-- 메인 END -->
    </body>
</html>